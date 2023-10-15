<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Produk;
use App\Status;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function getDataFromAPI(Request $request)
    {
        $url = 'https://recruitment.fastprint.co.id/tes/api_tes_programmer';

        $client = new Client();

        $data = [
            'form_params' => [
                'username' => 'tesprogrammer151023C00',
                'password' => 'd51a4610cb8f3e514ee3bec94323daab',
            ],
        ];

        try {
            $response = $client->post($url, $data);

            $statusCode = $response->getStatusCode();
            $result = $response->getBody();
            $data = json_decode($result);

            foreach ($data->data as $product) {
                $Status = Status::where('nama_status', $product->status)->first();
                $Kategori = Kategori::where('nama_kategori', $product->kategori)->first();
                Produk::create([
                    "nama_produk" => $product->nama_produk,
                    "harga" => $product->harga,
                    "status_id" => $Status->id_status,
                    "kategori_id" => $Kategori->id_kategori
                ]);
            }

            return response()->json(json_decode($result), $statusCode);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle exceptions here
            return response()->json(['error' => $e->getMessage()], 500); // Change the status code as needed
        }
    }

    public function getDataFromAPI2(Request $request)
    {
        $url = 'https://recruitment.fastprint.co.id/tes/api_tes_programmer';

        $client = new Client();

        $data = [
            'form_params' => [
                'username' => 'tesprogrammer151023C00',
                'password' => 'd51a4610cb8f3e514ee3bec94323daab',
            ],
        ];

        try {
            $response = $client->post($url, $data);

            $statusCode = $response->getStatusCode();
            $result = $response->getBody();

            $data = json_decode($result);

            $categories = [];
            $statuses = [];

            foreach ($data->data as $product) {
                $categories[] = $product->kategori;
                $statuses[] = $product->status;
            }

            // Mengambil nilai unik dari kategori dan status
            $uniqueCategories = array_unique($categories);
            $uniqueStatuses = array_unique($statuses);

            foreach ($uniqueCategories as $key => $value) {
                Kategori::create([
                    'nama_kategori' => $value
                ]);
            }
            foreach ($uniqueStatuses as $key => $value) {
                Status::create([
                    'nama_status' => $value
                ]);
            }
            return response()->json([
                'categories' => $uniqueCategories,
                'statuses' => $uniqueStatuses,
            ]);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle exceptions here
            return response()->json(['error' => $e->getMessage()], 500); // Change the status code as needed
        }
    }
}
