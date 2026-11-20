<?php

namespace App\Providers;

use App\Http\Controllers\BlogController;
use App\Models\Page;
use App\Models\Post;
use App\Support\Site;
use App\Support\Themes;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(Site::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();

        // Every public site view gets the settings and the menu.
        View::composer('site.*', function ($view) {
            $view->with([
                'site' => app(Site::class),
                'menu' => $view->getData()['menu'] ?? self::menu(),
                'page' => $view->getData()['page'] ?? null,
                'theme' => $view->getData()['theme'] ?? Themes::current(app(Site::class)),
            ]);
        });
    }

    /**
     * The site menu: published pages in order, and the blog once it has a post (before Kontak
     * when there is one), unless the owner turned that link off.
     *
     * @return Collection<int, Page>
     */
    private static function menu(): Collection
    {
        $menu = Page::query()->menu()->get();
        $site = app(Site::class);

        if ($site->get('blog_menu') === 'no' || $menu->contains('slug', 'blog') || ! Post::query()->published()->exists()) {
            return $menu;
        }

        $contact = $menu->search(fn (Page $page) => $page->slug === 'kontak');
        $menu->splice($contact === false ? $menu->count() : $contact, 0, [BlogController::menuItem($site)]);

        return $menu;
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
