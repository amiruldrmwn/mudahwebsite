<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Daily visitor counts for the dashboard: page views and WhatsApp clicks.
 *
 * @property Carbon $date
 * @property int $views
 * @property int $whatsapp_clicks
 */
class SiteVisit extends Model
{
    protected $fillable = ['date', 'views', 'whatsapp_clicks'];

    protected function casts(): array
    {
        return ['date' => 'date', 'views' => 'integer', 'whatsapp_clicks' => 'integer'];
    }

    /**
     * Add one to today's views or whatsapp_clicks.
     */
    public static function bump(string $column): void
    {
        // The query builder keeps the date as a plain Y-m-d string, matching the unique key.
        $today = now()->toDateString();
        $table = DB::table('site_visits');

        if ($table->where('date', $today)->increment($column) === 0) {
            DB::table('site_visits')->insertOrIgnore(['date' => $today, 'created_at' => now(), 'updated_at' => now()]);
            DB::table('site_visits')->where('date', $today)->increment($column);
        }
    }

    /**
     * The last $days days, oldest first, with zeros for days without visits.
     *
     * @return Collection<int, array{date: string, label: string, views: int, clicks: int}>
     */
    public static function lastDays(int $days): Collection
    {
        $start = now()->subDays($days - 1)->startOfDay();
        $rows = self::query()->where('date', '>=', $start->toDateString())->get()->keyBy(fn (self $v) => $v->date->toDateString());

        return collect(range(0, $days - 1))->map(function (int $i) use ($start, $rows) {
            $day = $start->copy()->addDays($i);
            $row = $rows->get($day->toDateString());

            return [
                'date' => $day->toDateString(),
                'label' => $day->translatedFormat('d M'),
                'views' => $row instanceof self ? $row->views : 0,
                'clicks' => $row instanceof self ? $row->whatsapp_clicks : 0,
            ];
        });
    }
}
