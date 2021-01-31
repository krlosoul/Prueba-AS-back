<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as Client;

class TestController extends Controller
{

    protected $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function index(Request $request)
    {
        $response = $this->client->request('GET', "");
        $data = json_decode($response->getBody()->getContents());

        $currentPage = $request->page;
        $perPage = $request->size;
        
        $currentElements = array_slice($data, $perPage * ($currentPage - 1), $perPage);
        
        $res = $currentElements;

        return [
            'data' => $res,
            'total' => sizeof($data)
          ];
    }
}
