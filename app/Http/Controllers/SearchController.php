<?php

namespace App\Http\Controllers;

use App\Actions\ApiAction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    private array $hotels;

    public function index(): View
    {
        return view("index");
    }

    public function search(): View
    {
        $this->setHotels();

        return view("index");
    }

    private function setHotels(): void
    {
        $this->hotels = (new ApiAction)->getHotels();
    }
}
