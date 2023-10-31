<?php

namespace App\Actions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class ApiAction
{
    const BASE_URL = "https://xlr8-interview-files.s3.eu-west-2.amazonaws.com/";

    private array $hotels;

    public function getHotels(): array
    {
        $this->request();

        return $this->hotels;
    }

    private function request(): void
    {
        try {
            for ($i = 1; ; $i++) {
                $res = $this->getClient()->request('GET', $this->getUrl(sourceId: $i));
                $this->hotels[$i] = json_decode($res->getBody(), true);
            }
        } catch (ClientException $e) {
            return;
        }
    }

    private function getClient(): Client
    {
        return new Client();
    }

    private function getUrl(int $sourceId): string
    {
        return self::BASE_URL . 'source_' . $sourceId . '.json';
    }
}
