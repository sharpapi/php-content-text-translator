<?php

declare(strict_types=1);

namespace SharpAPI\ContentTranslator;

use GuzzleHttp\Exception\GuzzleException;
use SharpAPI\Core\Client\SharpApiClient;

/**
 * Advanced text translator powered by AI - supports 80+ languages
 *
 * @package SharpAPI\ContentTranslator
 * @api
 */
class TextTranslatorClient extends SharpApiClient
{
    public function __construct(
        string $apiKey,
        ?string $apiBaseUrl = 'https://sharpapi.com/api/v1',
        ?string $userAgent = 'SharpAPIPHPContentTranslator/1.0.0'
    ) {
        parent::__construct($apiKey, $apiBaseUrl, $userAgent);
    }

    /**
     * Translate text to the specified language
     *
     * @param string $content The text content to translate
     * @param string $toLanguage Target language for translation
     * @param string $fromLanguage Source language (default: English)
     * @param string|null $voiceTone Optional tone of voice for the translation
     * @param string|null $context Optional additional context for better translation
     * @return string Status URL for polling the job result
     * @throws GuzzleException
     * @api
     */
    public function translateText(
        string $content,
        string $toLanguage,
        string $fromLanguage = 'English',
        ?string $voiceTone = null,
        ?string $context = null
    ): string {
        $response = $this->makeRequest('POST', '/content/translate', array_filter([
            'content' => $content,
            'language' => $toLanguage,
            'from_language' => $fromLanguage,
            'voice_tone' => $voiceTone,
            'context' => $context,
        ], fn($v) => $v !== null));

        return $this->parseStatusUrl($response);
    }
}
