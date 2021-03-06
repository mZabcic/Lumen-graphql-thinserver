<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    

    public function posts() {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', env('WP_API_URL') . '/posts', [
        ]);
        $body = json_decode($res->getBody());
        $cat_info = array();
        $authors = array();
        foreach ($body as $element) {
            if (sizeof($element->categories) > 0) {
                $cats = $element->categories;
                $cat_data = [];
                foreach ($cats as $cat_id) {
                    if (array_key_exists($cat_id, $cat_info)) {
                        array_push($cat_data, $cat_info[$cat_id]);
                    }  else {
                        $res_cat = $client->request('GET', env('WP_API_URL') . '/categories/' . $cat_id, [ ]);
                        $cat_body = json_decode($res_cat->getBody());
                        $cat_info[$cat_id] = $cat_body;
                        array_push($cat_data, $cat_body);
                    }
                } 
            }
            $element->cat_list = $cat_data;

            if (array_key_exists($element->author, $authors)) {
                $element->author_object = $authors[$element->author];
            } else {
                $res_user = $client->request('GET', env('WP_API_URL'). '/users/' . $element->author, [ ]);
                $res_body = json_decode($res_user->getBody());
                $element->author_object = $res_body;
                $authors[$element->author] = $res_body;
            }
        }
       
        return $body;
    }
}
