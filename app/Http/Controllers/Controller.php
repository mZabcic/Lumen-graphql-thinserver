<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    
    public function test() {
    $client = new \GuzzleHttp\Client();
    $res = $client->request('GET', 'http://graphql.localhost/wp-json/wp/v2/posts', [
    ]);
    return json_decode($res->getBody());
    }
}
