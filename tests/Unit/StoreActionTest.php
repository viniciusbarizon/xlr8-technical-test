<?php

namespace Tests\Unit;

use App\Actions\ApiAction;
use PHPUnit\Framework\TestCase;

class ApiActionTest extends TestCase
{
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
        $client = new GuzzleHttp\Client();
        $statusCode = 200;

        while ($statusCode == 200) {
            $sourceId = 1;
            $res = $client->request(
                "GET",
                "https://xlr8-interview-files.s3.eu-west-2.amazonaws.com/source_$sourceId.json"
            );
            $this->apiHotels[$sourceId] = json_decode($res->getBody(), true);
            $statusCode = $res->getStatusCode();
        }
    }

    private function assertHotels(): void
    {
        foreach ($this->apiHotels as $sourceId => $list) {
            $this->assertEquals($list, $this->hotels[$sourceId]);
        }
    }
}
