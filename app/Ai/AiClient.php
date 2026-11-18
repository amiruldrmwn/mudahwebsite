<?php

namespace App\Ai;

use App\Support\Site;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

/**
 * Chat completions on MudahCloud AI (OpenAI compatible) with the API key and model the owner
 * saved in Pengaturan Situs. Usage is paid from the owner's AI credit at MudahCloud.
 */
class AiClient
{
    public const BASE_URL = 'https://ai.mudahcloud.com/v1';

    public const DEFAULT_MODEL = 'deepseek-v4-flash';

    public function __construct(private Site $site) {}

    public function enabled(): bool
    {
        return $this->site->aiApiKey() !== null;
    }

    public function model(): string
    {
        return (string) ($this->site->get('ai_model') ?: self::DEFAULT_MODEL);
    }

    /**
     * The assistant's reply text.
     *
     * @param  list<array{role: string, content: string}>  $messages
     */
    public function chat(array $messages, int $maxTokens = 6000): string
    {
        if (! $this->enabled()) {
            throw new AiException('Asisten AI belum aktif. Isi API key MudahCloud AI di Pengaturan Situs.');
        }

        try {
            $response = Http::withToken((string) $this->site->aiApiKey())
                ->acceptJson()
                ->timeout(120)
                ->post(self::BASE_URL.'/chat/completions', [
                    'model' => $this->model(),
                    'messages' => $messages,
                    'max_tokens' => $maxTokens,
                    'temperature' => 0.6,
                    'response_format' => ['type' => 'json_object'],
                ]);
        } catch (ConnectionException) {
            throw new AiException('MudahCloud AI tidak bisa dihubungi. Coba lagi sebentar lagi.');
        }

        if ($response->failed()) {
            throw new AiException(match ($response->status()) {
                401, 403 => 'API key AI ditolak. Periksa API key di Pengaturan Situs.',
                402 => 'Kredit AI Anda habis. Isi ulang kredit AI di MudahCloud lalu coba lagi.',
                404 => 'Model AI tidak ditemukan. Pilih model lain di Pengaturan Situs.',
                429 => 'Terlalu banyak permintaan ke AI. Tunggu sebentar lalu coba lagi.',
                default => 'MudahCloud AI sedang bermasalah (HTTP '.$response->status().'). Coba lagi nanti.',
            });
        }

        $text = $response->json('choices.0.message.content');

        if (! is_string($text) || trim($text) === '') {
            throw new AiException('AI tidak memberi jawaban. Coba ulangi permintaan Anda.');
        }

        return $text;
    }
}
