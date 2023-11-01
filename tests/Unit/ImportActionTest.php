<?php

namespace Tests\Unit;

use App\Actions\ApiAction;
use App\Actions\ImportAction;
use App\Models\Hotel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImportActionTest extends TestCase
{
    use RefreshDatabase;

    private array $hotels;

    public function test_it_imports_the_hotels(): void
    {
        $this->setHotels();
        $this->setNow();

        $this->import();

        $this->assertCreatedAt();
    }

    private function setHotels(): void
    {
        $this->hotels = (new ApiAction)->getHotels();
    }

    private function setNow(): void
    {
        $this->now = now();
    }

    private function import(): void
    {
        (new ImportAction)->import(hotels: $this->hotels);
    }

    private function assertCreatedAt(): void
    {
        $this->assertFalse(Hotel::where('created_at', '<', $this->now)->exists());
    }
}
