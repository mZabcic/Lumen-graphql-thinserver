<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class MenuQuery extends Query
{
    protected $attributes = [
        'name' => 'menus'
    ];
    public function type()
    {
        return Type::listOf(GraphQL::type('Menu'));
    }
    public function args()
    {
        return [
            'slug' => ['name' => 'slug', 'type' => Type::nonNull(Type::string())]
        ];
    }
    public function resolve($root, $args)
    {

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', env('WP_API_MENU_URL') . '/' .  $args['slug'], [
        ]);
        $body = json_decode($res->getBody());
        $body = array($body);
        return $body;
    }
}