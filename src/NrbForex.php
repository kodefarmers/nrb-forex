<?php

namespace KodeFarmers\NrbForex;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use KodeFarmers\NrbForex\Exceptions\NrbForexException;

class NrbForex
{
    protected Collection $rates;
    protected string $toCurrency;

    public function __construct()
    {
        $this->rates = collect([]);
        $this->toCurrency = config('nrbforex.currency');
    }

    private function fetchRates(): Collection
    {
        try {
            $response = Http::get(config('nrbforex.url') . 'app-rate');
            $data = $response->json();

            if ($response->failed()) {
                throw new NrbForexException('Failed to fetch forex rates.');
            }

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
        } catch(NrbForexException $e) {
            throw new NrbForexException($e->getMessage());
        }
    }

    public function getRate(string $currency): int|float
    {
        try {
            $rate = $this->rates->firstWhere('currency', $currency);

            if (!$rate) {
                throw new NrbForexException('Rate not found for currency: ' . $currency);
            }

            return $rate['rate'];
        } catch (NrbForexException $e) {
            throw new NrbForexException($e->getMessage());
        }
    }

    public function from(string $currency): NrbForex
    {
        $this->toCurrency = $currency;
        return $this;
    }

    public function convert(int|float $amount): int|float
    {
        $this->rates = $this->fetchRates();
        return $amount * $this->getRate($this->toCurrency);
    }

    public function currencies()
    {
        try {
            $response = Http::get(config('nrbforex.url') . 'app-rate');
            $data = $response->json();

            if ($response->failed()) {
                throw new NrbForexException('Failed to fetch forex rates.');
            }

            return collect($data)->map(function ($rate) {
                return [
                    'currency' => $rate['iso3'],
                    'name' => $rate['name'],
                ];
            });
        } catch(NrbForexException $e) {
            throw new NrbForexException($e->getMessage());
        }
    }
}
