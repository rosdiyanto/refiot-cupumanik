<?php

use App\Modules\Admin\Models\PegawaiModel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

if (!function_exists('upsertPegawaiMassal')) {
    function upsertPegawaiMassal(int $batchSize = 200): array
    {
        $apiKey = getenv('SIMASN_API_KEY');
        if (!$apiKey) return ['insert' => 0, 'update' => 0];

        $model = new PegawaiModel();
        $totalInsert = 0;
        $totalUpdate = 0;
        $offset = 0;

        $client = new Client();

        while (true) {
            try {
                $response = $client->request(
                    'GET',
                    "https://simasn.subang.go.id/simasn/refiot_api/data_utama?limit={$batchSize}&offset={$offset}&api_key={$apiKey}",
                    ['timeout' => 10]
                );
                $json = json_decode($response->getBody()->getContents(), true);
                $pegawaiData = $json['result']['data'] ?? [];
            } catch (RequestException $e) {
                log_message('error', "SIMASN API Error at offset {$offset}: " . $e->getMessage());
                break;
            }

            if (empty($pegawaiData)) break;

            foreach ($pegawaiData as $pegawai) {
                $existing = $model->where('nip_baru', $pegawai['nip_baru'])->first();
                if ($existing) {
                    $model->update($existing['id'], $pegawai);
                    $totalUpdate++;
                } else {
                    $model->insert($pegawai);
                    $totalInsert++;
                }
            }

            $offset += $batchSize;
        }

        return ['insert' => $totalInsert, 'update' => $totalUpdate];
    }
}
