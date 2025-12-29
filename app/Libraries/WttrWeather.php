<?php

namespace App\Libraries;

class WttrWeather
{
    public function currentByCity(string $city, ?string $country = null): array
    {
        $q = trim($city);

        // optional: add country code like "Isulan,PH"
        if (!empty($country)) {
            $q .= ',' . strtoupper(trim($country));
        }

        $url = 'https://wttr.in/' . rawurlencode($q) . '?format=j1';

        try {
            $http = service('curlrequest');

            $res = $http->get($url, [
                'http_errors' => false,
                'timeout'     => 10,
                'headers'     => [
                    'User-Agent' => 'CI4 Weather Demo',
                ],
            ]);

            $status = $res->getStatusCode();
            $data   = json_decode($res->getBody(), true) ?? [];

            if ($status < 200 || $status >= 300) {
                return ['ok' => false, 'error' => 'HTTP ' . $status];
            }

            $current = $data['current_condition'][0] ?? null;

            if (!$current) {
                return ['ok' => false, 'error' => 'No current_condition data'];
            }

            return [
                'ok'   => true,
                'data' => [
                    'tempC'    => $current['temp_C'] ?? null,
                    'feelsC'   => $current['FeelsLikeC'] ?? null,
                    'humidity' => $current['humidity'] ?? null,
                    'windKmph' => $current['windspeedKmph'] ?? null,
                    'desc'     => $current['weatherDesc'][0]['value'] ?? null,
                    'icon'     => $current['weatherIconUrl'][0]['value'] ?? null,
                ],
            ];
        } catch (\Throwable $e) {
            return ['ok' => false, 'error' => $e->getMessage()];
        }
    }
}
