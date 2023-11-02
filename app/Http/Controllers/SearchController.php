<?php

namespace App\Http\Controllers;

use App\Actions\ApiAction;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SearchController extends Controller
{
    private Collection $hotels;
    private float $latitude;
    private float $longitude;
    private string $orderBy;

    public function index(): View
    {
        return view("index");
    }

    public function search(): RedirectResponse
    {
        $this->latitude = request()->latitude;
        $this->longitude = request()->longitude;
        $this->orderBy = request()->order_by;

        $this->setHotels();

        session()->flash('hotels', $this->hotels);

        return back()->withInput();
    }

    private function setHotels(): void
    {
        $this->hotels = Hotel::select(
            '*',
            DB::raw("
                ST_Distance_Sphere(
                    point(longitude, latitude),
                    point($this->longitude, $this->latitude)
                ) / 1000 AS proximity"
            )
        )
        ->orderByRaw("ISNULL($this->orderBy), $this->orderBy ASC")
        ->get();
    }
}
