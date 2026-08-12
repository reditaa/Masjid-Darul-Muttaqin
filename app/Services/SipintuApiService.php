<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SipintuApiService
{
    protected string $baseUrl;
    protected string $clientId;
    protected string $clientSecret;

  public function __construct()
    {
        $this->baseUrl = rtrim(config('sipintu.base_url'), '/');
        $this->clientId = config('sipintu.client_id');
        $this->clientSecret = config('sipintu.client_secret');
    }

    /**
     * Get common headers for Server-to-Server Gateway request
     */
    protected function getHeaders(): array
    {
        return [
            'Accept'          => 'application/json',
            'X-Client-ID'     => $this->clientId,
            'X-Client-Secret' => $this->clientSecret,
        ];
    }

    /**
     * Heartbeat / Ping Check
     * GET /api/v1/ping?client_id=...
     */
    public function ping(): array
    {
        try {
            $response = Http::timeout(5)->get("{$this->baseUrl}/api/v1/ping", [
                'client_id' => $this->clientId,
            ]);

            return [
                'success' => $response->successful(),
                'status'  => $response->status(),
                'data'    => $response->json(),
            ];
        } catch (\Throwable $e) {
            Log::error('SiPintu API Ping Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error'   => $e->getMessage(),
            ];
        }
    }

    /**
     * Validate Client Credentials & Connection
     * POST /api/v1/validate-client
     */
    public function validateClient(): array
    {
        try {
            $response = Http::timeout(5)->post("{$this->baseUrl}/api/v1/validate-client", [
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
            ]);

            return [
                'success' => $response->successful(),
                'status'  => $response->status(),
                'data'    => $response->json(),
            ];
        } catch (\Throwable $e) {
            Log::error('SiPintu API Validate Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error'   => $e->getMessage(),
            ];
        }
    }

    /**
     * Fetch SIJUNA Students Data
     * GET /api/v1/sijuna/students
     */
    public function getStudents(?string $nis = null, ?string $search = null): array
    {
        try {
            $params = array_filter([
                'nis'    => $nis,
                'search' => $search,
            ]);

            $response = Http::timeout(5)->withHeaders($this->getHeaders())
                ->get("{$this->baseUrl}/api/v1/sijuna/students", $params);

            return [
                'success' => $response->successful(),
                'status'  => $response->status(),
                'data'    => $response->json(),
            ];
        } catch (\Throwable $e) {
            Log::error('SiPintu Fetch Students Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error'   => $e->getMessage(),
            ];
        }
    }

    /**
     * Fetch SIJUNA Teachers Data
     * GET /api/v1/sijuna/teachers
     */
    public function getTeachers(?string $nip = null, ?string $search = null): array
    {
        try {
            $params = array_filter([
                'nip'    => $nip,
                'search' => $search,
            ]);

            $response = Http::timeout(5)->withHeaders($this->getHeaders())
                ->get("{$this->baseUrl}/api/v1/sijuna/teachers", $params);

            return [
                'success' => $response->successful(),
                'status'  => $response->status(),
                'data'    => $response->json(),
            ];
        } catch (\Throwable $e) {
            Log::error('SiPintu Fetch Teachers Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error'   => $e->getMessage(),
            ];
        }
    }

    /**
     * Generate OAuth SSO Authorization Redirect URL
     */
    public function getAuthorizationUrl(string $redirectUri, string $state = ''): string
    {
        $queryParams = http_build_query([
            'client_id'     => $this->clientId,
            'redirect_uri'  => $redirectUri,
            'response_type' => 'code',
            'state'         => $state,
        ]);

        return "{$this->baseUrl}/oauth/authorize?{$queryParams}";
    }

    /**
     * Exchange OAuth Authorization Code for Access Token
     * POST /oauth/token
     */
    public function exchangeAuthorizationCode(string $code, string $redirectUri): array
    {
        try {
            $response = Http::timeout(5)->asForm()->post("{$this->baseUrl}/oauth/token", [
                'grant_type'    => 'authorization_code',
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'code'          => $code,
                'redirect_uri'  => $redirectUri,
            ]);

            return [
                'success' => $response->successful(),
                'status'  => $response->status(),
                'data'    => $response->json(),
            ];
        } catch (\Throwable $e) {
            Log::error('SiPintu Token Exchange Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error'   => $e->getMessage(),
            ];
        }
    }

    /**
     * Fetch User Profile using Bearer Access Token
     * GET /api/v1/user
     */
    public function getUserProfile(string $accessToken): array
    {
        try {
            $response = Http::timeout(5)->withToken($accessToken)
                ->withHeaders(['Accept' => 'application/json'])
                ->get("{$this->baseUrl}/api/v1/user");

            return [
                'success' => $response->successful(),
                'status'  => $response->status(),
                'data'    => $response->json(),
            ];
        } catch (\Throwable $e) {
            Log::error('SiPintu User Profile Error: ' . $e->getMessage());
            return [
                'success' => false,
                'error'   => $e->getMessage(),
            ];
        }
    }
}
