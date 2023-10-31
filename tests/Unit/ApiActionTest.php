<?php

namespace Tests\Unit;

use App\Actions\ApiAction;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use PHPUnit\Framework\TestCase;

class ApiActionTest extends TestCase
{
    const BASE_URL = "https://xlr8-interview-files.s3.eu-west-2.amazonaws.com/";

    private array $apiHotels;
    private array $hotels;

    public function test_it_gets_hotels_from_api(): void
    {
        $this->setHotels();
        $this->setApiHotels();

        $this->assertHotels();
    }

    private function setHotels(): void
    {
        $this->hotels = (new ApiAction)->getHotels();
    }

    private function setApiHotels(): void
    {
        try {
            for ($i = 1; ; $i++) {
                $res = $this->getClient()->request('GET', $this->getUrl(sourceId: $i));
                $this->apiHotels[$i] = json_decode($res->getBody(), true);
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

    private function assertHotels(): void
    {
        foreach ($this->apiHotels as $sourceId => $list) {
            $this->assertEquals($list, $this->hotels[$sourceId]);
        }
    }
}
