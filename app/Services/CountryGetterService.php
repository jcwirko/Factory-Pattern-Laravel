<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class CountryGetterService
{
    private $url;

    public function __construct()
    {
        $this->url = 'https://restcountries.eu/rest/v2/';
    }

    public function getCountryByName(string $name)
    {
        $response = Http::get("{$this->url}name/$name");

        return $response->body();
    }
}
