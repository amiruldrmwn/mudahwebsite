<?php

use App\Support\Themes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Pages belong to a group of templates (Themes preset): switching to a template of another group
 * shows that group's pages, and the others are kept for when the owner switches back.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('preset', 30)->default('korporat');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->unique(['preset', 'slug']);
        });

        // Existing pages belong to the group of the template in use.
        // Settings values are stored as JSON.
        $theme = json_decode((string) DB::table('settings')->where('key', 'theme')->value('value'), true);
        $preset = Themes::has($theme) ? Themes::all()[$theme]['preset'] : 'korporat';
        DB::table('pages')->update(['preset' => $preset]);
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropUnique(['preset', 'slug']);
            $table->unique('slug');
            $table->dropColumn('preset');
        });
    }
};
