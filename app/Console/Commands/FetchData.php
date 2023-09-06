<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Province;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class FetchData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $this->province();
       $this->city();
    }

    protected function province()
    {
        $client = new Client();
        $response = $client->get('https://api.rajaongkir.com/starter/province?key=0df6d5bf733214af6c6644eb8717c92c');

        $result = $response->getBody()->getContents();
        $insertProvince = [];
        foreach (json_decode($result)->rajaongkir->results as $province) {
            $insertProvince[] = [
                'province_id' => $province->province_id,
                'province' => $province->province,
            ];
        }
        Province::insert($insertProvince);
    }

    protected function city()
    {
        $client = new Client();
        $response = $client->get('https://api.rajaongkir.com/starter/city?key=0df6d5bf733214af6c6644eb8717c92c');

        $result = $response->getBody()->getContents();
        $insertCity = [];
        foreach (json_decode($result)->rajaongkir->results as $city) {
            $insertCity[] = [
                'city_id' => $city->city_id,
                'province_id' => $city->province_id,
                'type' => $city->type,
                'city_name' => $city->city_name,
                'postal_code' => $city->postal_code,
            ];
        }
        City::insert($insertCity);
    }
}
