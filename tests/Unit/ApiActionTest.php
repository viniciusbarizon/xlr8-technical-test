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
        $client = new Client();
        $sourceId = 1;

        try {
            $res = $client->request('GET', self::BASE_URL . 'source_' . $sourceId . '.json');
            $this->apiHotels[$sourceId] = json_decode($res->getBody(), true);
            $sourceId++;
        } catch (ClientException $e) {
            return;
        }
    }

    private function assertHotels(): void
    {
        foreach ($this->apiHotels as $sourceId => $list) {
            $this->assertEquals($list, $this->hotels[$sourceId]);
        }
    }
}
