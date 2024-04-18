<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GotenbergService
{
    private HttpClientInterface $client;
    private string $gotenbergBaseUrl;

    public function __construct(HttpClientInterface $client, string $gotenbergBaseUrl)
    {
        $this->client = $client;
        $this->gotenbergBaseUrl = $gotenbergBaseUrl;
    }

    public function generatePdfFromHtml(string $htmlContent): string
    {
        $generatePdfUrl = $this->gotenbergBaseUrl . '/forms/chromium/convert/url';

        $response = $this->client->request('POST', $generatePdfUrl, [
            'headers' => [
                'Content-Type' => 'multipart/form-data',
            ],
            'body' => [
                'html' => $htmlContent,
            ],
        ]);

        return $response->getContent();
    }
}
