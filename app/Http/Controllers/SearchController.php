<?php

namespace App\Http\Controllers;

use App\Actions\ApiAction;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    private Collection $hotels;
    private string $orderBy;

    public function index(): View
    {
        return view("index");
    }

    public function search(): View
    {
        $this->orderBy = request()->order_by;

        $this->setHotels();

        return view("index")->with('hotels', $this->hotels);
    }

    private function setHotels(): void
    {
        $this->hotels = Hotel::orderBy($this->orderBy)->get();
    }
}
