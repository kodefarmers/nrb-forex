<?php

namespace KodeFarmers\NrbForex;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class NrbForex
{
    protected $rates;
    protected $toCurrency;

    public function __construct()
    {
        $this->rates = collect([]);
        $this->toCurrency = config('nrbforex.currency');
    }

    private function fetchRates(): Collection
    {
        $response = Http::get(config('nrbforex.url') . 'app-rate');
        $data = $response->json();

        return collect($data)->map(function ($rate) {
            return [
                'currency' => $rate['iso3'],
                'name' => $rate['name'],
                'buy' => $rate['buy'],
                'sell' => $rate['sell'],
                'unit' => $rate['unit'],
                'rate' => $rate['buy'] / $rate['unit'],
            ];
        });
    }

    public function getRate(string $currency): int|float
    {
        $rate = $this->rates->firstWhere('currency', $currency);
        if (!$rate) {
            // Handle rate not found error
            // For now, we'll just set the rate to 0
            return 0;
        }

        return $rate['rate'];
    }

    public function from($currency): NrbForex
    {
        $this->toCurrency = $currency;
        return $this;
    }

    public function convert($amount): int|float
    {
        $this->rates = $this->fetchRates();
        return $amount * $this->getRate($this->toCurrency);
    }

}
