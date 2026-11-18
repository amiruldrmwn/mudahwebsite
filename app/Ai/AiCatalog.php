<?php

namespace App\Ai;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

/**
 * The chat models offered by MudahCloud AI, with what the admin needs to choose one: provider,
 * context size, USD price per million tokens, and reasoning / vision support. The list is
 * public and cached for a few hours.
 */
class AiCatalog
{
    private const CACHE_KEY = 'ai.catalog';

    /**
     * @return list<array{id: string, provider: string, context: int|null, input: float|null, output: float|null, reasoning: bool, vision: bool}>
     */
    public function models(): array
    {
        $raw = Cache::get(self::CACHE_KEY);

        if (! is_array($raw)) {
            $raw = $this->fetch();
            // An empty list (gateway down) is retried after a minute instead of hours.
            Cache::put(self::CACHE_KEY, $raw, $raw === [] ? 60 : 6 * 3600);
        }

        return $this->normalize($raw);
    }

    /**
     * The three choices the settings page offers, simple enough for owners who don't know AI
     * models: each names the model it runs on and its price (null when the gateway lacks it).
     */
    public const TIERS = [
        'standar' => ['label' => 'Standar', 'model' => AiClient::DEFAULT_MODEL, 'description' => 'Hemat dan cukup untuk menulis serta mengubah isi website sehari-hari.'],
        'medium' => ['label' => 'Medium', 'model' => 'gemini/gemini-3.8-flash', 'description' => 'Tulisan lebih rapi dan cepat, bisa membaca gambar yang Anda kirim.'],
        'pro' => ['label' => 'Pro', 'model' => 'claude-sonnet-5-5', 'description' => 'Paling cerdas: tulisan paling halus dan perubahan halaman yang rumit.'],
    ];

    /**
     * @return list<array{key: string, label: string, description: string, model: string, input: float|null, output: float|null}>
     */
    public function tiers(): array
    {
        $models = collect($this->models())->keyBy('id');

        $tiers = [];

        foreach (self::TIERS as $key => $t) {
            $tiers[] = [
                'key' => $key,
                'label' => $t['label'],
                'description' => $t['description'],
                'model' => $t['model'],
                'input' => $models[$t['model']]['input'] ?? null,
                'output' => $models[$t['model']]['output'] ?? null,
            ];
        }

        return $tiers;
    }

    public function has(string $id): bool
    {
        return in_array($id, array_column($this->models(), 'id'), true);
    }

    /**
     * The gateway's raw model list, or an empty list when it can't be reached.
     *
     * @return array<mixed>
     */
    private function fetch(): array
    {
        try {
            $response = Http::acceptJson()->timeout(10)->get(AiClient::BASE_URL.'/models');
        } catch (ConnectionException|RuntimeException) {
            return [];
        }

        $data = $response->successful() ? $response->json('data') : null;

        return is_array($data) ? $data : [];
    }

    /**
     * @param  array<mixed>  $data
     * @return list<array{id: string, provider: string, context: int|null, input: float|null, output: float|null, reasoning: bool, vision: bool}>
     */
    private function normalize(array $data): array
    {
        $models = [];

        foreach ($data as $m) {
            if (! is_array($m) || ! is_string($m['id'] ?? null) || ($m['mode'] ?? 'chat') !== 'chat') {
                continue;
            }

            $models[] = [
                'id' => $m['id'],
                'provider' => is_string($m['owned_by'] ?? null) && $m['owned_by'] !== '' ? $m['owned_by'] : 'lainnya',
                'context' => is_numeric($m['context_length'] ?? null) ? (int) $m['context_length'] : null,
                'input' => is_numeric($m['pricing']['prompt'] ?? null) ? round((float) $m['pricing']['prompt'] * 1_000_000, 4) : null,
                'output' => is_numeric($m['pricing']['completion'] ?? null) ? round((float) $m['pricing']['completion'] * 1_000_000, 4) : null,
                'reasoning' => (bool) ($m['supports_reasoning'] ?? false),
                'vision' => (bool) ($m['supports_vision'] ?? false),
            ];
        }

        usort($models, fn (array $a, array $b) => [$a['provider'], $a['id']] <=> [$b['provider'], $b['id']]);

        return $models;
    }
}
