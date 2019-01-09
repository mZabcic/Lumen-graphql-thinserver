<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class CategoryQuery extends Query
{
    protected $attributes = [
        'name' => 'categories'
    ];
    public function type()
    {
        return Type::listOf(GraphQL::type('Category'));
    }
    public function args()
    {
        return [
            'slug' => ['name' => 'slug', 'type' => Type::string()],
            'id' => ['name' => 'id', 'type' => Type::int()],
            'child' => ['name' => 'child', 'type' => Type::int()]
        ];
    }
    public function resolve($root, $args)
    {

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', env('WP_API_MENU_URL') . '/' .  $args['slug'] . '?filter[posts_per_page]=-1', [
        ]);
        $body = json_decode($res->getBody());
        $body = array($body);
        return $body;
    }
}

