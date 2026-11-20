<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\User;
use App\Support\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaTest extends TestCase
{
    use RefreshDatabase;

    private const SVG = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" onload="alert(1)"><script>alert(2)</script><circle cx="5" cy="5" r="4" fill="red"/><image href="https://evil.test/x.png"/></svg>';

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /** A noisy photo, so it compresses like a real one. */
    private function photo(string $name, int $width, int $height, string $type = 'jpg'): UploadedFile
    {
        $image = imagecreatetruecolor($width, $height);

        for ($i = 0; $i < 4000; $i++) {
            imagefilledellipse($image, random_int(0, $width), random_int(0, $height), 40, 40, random_int(0, 0xFFFFFF));
        }

        ob_start();
        $type === 'png' ? imagepng($image) : imagejpeg($image, null, 95);

        return UploadedFile::fake()->createWithContent($name, (string) ob_get_clean());
    }

    public function test_guests_cannot_open_the_library()
    {
        $this->get(route('media.index'))->assertRedirect(route('login'));
        $this->postJson(route('media.store'))->assertUnauthorized();
    }

    public function test_large_photos_are_shrunk_and_saved_as_webp()
    {
        $path = $this->actingAs(User::factory()->create())
            ->postJson(route('media.store'), ['file' => $this->photo('Foto Toko (1).JPG', 3000, 2000)])
            ->assertOk()->json('path');

        $this->assertMatchesRegularExpression('#^media/foto-toko-1-[a-z0-9]{6}\.webp$#', $path);
        [$width, $height, $type] = getimagesize(Storage::disk('public')->path($path));
        $this->assertSame([1920, 1280, IMAGETYPE_WEBP], [$width, $height, $type]);
    }

    public function test_svgs_are_cleaned_of_scripts_and_outside_references()
    {
        $path = $this->actingAs(User::factory()->create())
            ->postJson(route('media.store'), ['file' => UploadedFile::fake()->createWithContent('ikon.svg', self::SVG)])
            ->assertOk()->json('path');

        $this->assertStringEndsWith('.svg', $path);
        $svg = Storage::disk('public')->get($path);
        $this->assertStringContainsString('<circle', $svg);
        $this->assertStringNotContainsString('script', $svg);
        $this->assertStringNotContainsString('onload', $svg);
        $this->assertStringNotContainsString('evil.test', $svg);
    }

    public function test_broken_svgs_and_other_files_are_refused()
    {
        $this->actingAs(User::factory()->create());

        $this->postJson(route('media.store'), ['file' => UploadedFile::fake()->createWithContent('a.svg', '<svg><unclosed')])->assertUnprocessable();
        $this->postJson(route('media.store'), ['file' => UploadedFile::fake()->create('a.pdf')])->assertUnprocessable();
    }

    public function test_the_library_lists_images_with_where_they_are_used()
    {
        $this->actingAs(User::factory()->create());
        $used = $this->postJson(route('media.store'), ['file' => $this->photo('hero.jpg', 800, 600)])->json('path');
        $spare = $this->postJson(route('media.store'), ['file' => $this->photo('lain.jpg', 800, 600)])->json('path');
        Page::query()->create(['title' => 'Beranda', 'slug' => 'beranda', 'sections' => [['id' => 'a', 'type' => 'hero', 'data' => ['image' => $used]]]]);

        $media = collect($this->getJson(route('media.index'))->assertOk()->json('media'))->keyBy('path');

        $this->assertSame('Beranda', $media[$used]['used_in'][0]['label']);
        $this->assertStringEndsWith('/admin/pages/'.Page::where('slug', 'beranda')->value('id'), $media[$used]['used_in'][0]['href']);
        $this->assertSame([], $media[$spare]['used_in']);
        $this->assertSame(800, $media[$spare]['width']);
        $this->get(route('media.index'))->assertInertia(fn ($page) => $page->component('media/Index')->has('media', 2));
    }

    public function test_only_unused_library_images_can_be_deleted()
    {
        $this->actingAs(User::factory()->create());
        $used = $this->postJson(route('media.store'), ['file' => $this->photo('hero.jpg', 400, 300)])->json('path');
        $spare = $this->postJson(route('media.store'), ['file' => $this->photo('lain.jpg', 400, 300)])->json('path');
        Page::query()->create(['title' => 'Layanan', 'slug' => 'layanan', 'sections' => [['id' => 'a', 'type' => 'services', 'data' => ['items' => [['image' => $used]]]]]]);
        Storage::disk('public')->put('site/logo.png', 'x');

        $this->postJson(route('media.destroy'), ['path' => $used])->assertUnprocessable()->assertJsonPath('errors.path.0', fn ($m) => str_contains($m, 'Layanan'));
        $this->postJson(route('media.destroy'), ['path' => $spare])->assertOk();
        $this->postJson(route('media.destroy'), ['path' => 'site/logo.png'])->assertNotFound();
        $this->postJson(route('media.destroy'), ['path' => 'media/../site/logo.png'])->assertNotFound();

        Storage::disk('public')->assertExists([$used, 'site/logo.png']);
        Storage::disk('public')->assertMissing($spare);
    }

    public function test_svg_logos_are_accepted_and_cleaned_and_png_logos_stay_png()
    {
        $user = User::factory()->create();
        $settings = ['site_name' => 'PT Maju', 'primary_color' => '#112233'];

        $this->actingAs($user)->post(route('site.update'), [...$settings, 'logo' => UploadedFile::fake()->createWithContent('logo.svg', self::SVG)])->assertSessionHasNoErrors();
        $svg = Storage::disk('public')->get(app(Site::class)->get('logo'));
        $this->assertStringNotContainsString('script', $svg);

        $this->post(route('site.update'), [...$settings, 'logo' => $this->photo('logo.png', 2400, 800, 'png')])->assertSessionHasNoErrors();
        $logo = app(Site::class)->get('logo');
        $this->assertStringEndsWith('.png', $logo);
        $this->assertSame([1024, 341], array_slice(getimagesize(Storage::disk('public')->path($logo)), 0, 2));
    }
}
