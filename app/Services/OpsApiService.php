<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpsApiService
{
    protected ?string $baseUrl;
    protected ?string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.ops_api.url') ?? '';
        $this->apiKey = config('services.ops_api.key') ?? '';
    }

    /**
     * Check if the API is configured
     */
    public function isConfigured(): bool
    {
        return !empty($this->baseUrl) && !empty($this->apiKey);
    }

    /**
     * Get availability data from Ops API
     *
     * @return array|null
     */
    public function getAvailability(): ?array
    {
        if (!$this->isConfigured()) {
            Log::error('OpsApiService: API not configured. Check OPS_API_URL and OPS_API_KEY in .env');
            return null;
        }

        try {
            $response = Http::withHeaders([
                'X-API-KEY' => $this->apiKey,
                'Accept' => 'application/json',
            ])->timeout(30)->get("{$this->baseUrl}/availability");

            if ($response->successful()) {
                $data = $response->json();
                
                if ($data['success'] ?? false) {
                    Log::info('OpsApiService: Successfully fetched availability data', [
                        'total_bookings' => $data['summary']['total_bookings'] ?? 0,
                        'total_booked_dates' => $data['summary']['total_booked_dates'] ?? 0,
                    ]);
                    return $data;
                }
                
                Log::error('OpsApiService: API returned unsuccessful response', ['response' => $data]);
                return null;
            }

            Log::error('OpsApiService: API request failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return null;

        } catch (\Exception $e) {
            Log::error('OpsApiService: Exception during API call', [
                'message' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Check API health
     *
     * @return bool
     */
    public function healthCheck(): bool
    {
        if (!$this->isConfigured()) {
            return false;
        }

        try {
            $response = Http::withHeaders([
                'X-API-KEY' => $this->apiKey,
                'Accept' => 'application/json',
            ])->timeout(10)->get("{$this->baseUrl}/health");

            return $response->successful() && ($response->json()['success'] ?? false);

        } catch (\Exception $e) {
            Log::error('OpsApiService: Health check failed', ['message' => $e->getMessage()]);
            return false;
        }
    }
}
