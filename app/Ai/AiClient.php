<?php

namespace App\Ai;

use App\Support\Site;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

/**
 * Chat completions on an OpenAI-compatible API (MudahCloud AI Gateway, OpenAI, DeepSeek, ...)
 * with the address, key and model the owner saved in Pengaturan Situs.
 */
class AiClient
{
    public const DEFAULT_MODEL = 'deepseek-v4-flash';

    public function __construct(private Site $site) {}

    public function enabled(): bool
    {
        return filled($this->site->get('ai_base_url')) && $this->site->aiApiKey() !== null;
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
            throw new AiException('Asisten AI belum aktif. Isi alamat API dan API key di Pengaturan Situs.');
        }

        try {
            $response = Http::withToken((string) $this->site->aiApiKey())
                ->acceptJson()
                ->timeout(120)
                ->post(rtrim((string) $this->site->get('ai_base_url'), '/').'/chat/completions', [
                    'model' => $this->model(),
                    'messages' => $messages,
                    'max_tokens' => $maxTokens,
                    'temperature' => 0.6,
                    'response_format' => ['type' => 'json_object'],
                ]);
        } catch (ConnectionException) {
            throw new AiException('Layanan AI tidak bisa dihubungi. Periksa alamat API di Pengaturan Situs atau coba lagi nanti.');
        }

        if ($response->failed()) {
            throw new AiException(match ($response->status()) {
                401, 403 => 'API key AI ditolak. Periksa API key di Pengaturan Situs.',
                402 => 'Saldo atau kredit AI habis. Isi ulang di penyedia AI Anda lalu coba lagi.',
                404 => 'Alamat API atau nama model tidak ditemukan. Periksa di Pengaturan Situs.',
                429 => 'Terlalu banyak permintaan ke AI. Tunggu sebentar lalu coba lagi.',
                default => 'Layanan AI sedang bermasalah (HTTP '.$response->status().'). Coba lagi nanti.',
            });
        }

        $text = $response->json('choices.0.message.content');

        if (! is_string($text) || trim($text) === '') {
            throw new AiException('AI tidak memberi jawaban. Coba ulangi permintaan Anda.');
        }

        return $text;
    }
}
