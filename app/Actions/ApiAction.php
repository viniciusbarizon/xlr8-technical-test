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

    private function getClient(): Client
    {
        return new Client();
    }

    private function request(): void
    {
        try {
            for ($sourceId = 1; ; $sourceId++) {
                $res = $this->getClient()->request(
                    'GET',
                    self::BASE_URL . 'source_' . $sourceId . '.json'
                );

                $this->hotels[$sourceId] = json_decode($res->getBody(), true);
            }
        } catch (ClientException $e) {
            return;
        }
    }
}
