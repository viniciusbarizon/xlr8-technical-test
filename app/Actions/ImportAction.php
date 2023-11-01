<?php

namespace App\Actions;

use Illuminate\Support\Arr;
use App\Models\Hotel;

class ImportAction
{
    private array $hotels;

    public function import(array $hotels): void
    {
        $this->hotels = $hotels;

        $this->truncate();
        $this->insert();
    }

    private function truncate(): void
    {
        Hotel::truncate();
    }

    private function insert(): void
    {
        foreach ($this->hotels as $hotel) {
            Hotel::create($this->addKeys($hotel));
        }
    }

    private function addKeys(array $hotel): array
    {
        return [
            'name' => $hotel[0],
            'latitude' => $hotel[1],
            'longitude' => $hotel[2],
            'price_per_night' => $hotel[3],
        ];
    }
}
