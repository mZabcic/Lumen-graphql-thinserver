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
            'page' => ['name' => 'slug', 'type' => Type::nonNull(Type::int())],
            'slug' => ['name' => 'slug', 'type' => Type::string()],
            'id' => ['name' => 'id', 'type' => Type::int()],
            'child' => ['name' => 'child', 'type' => Type::int()]
        ];
    }
    public function resolve($root, $args)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', env('WP_API_MENU_URL') . '/' .  $args['slug'] . '?page=' . $args['page'], [
        ]);
        $body = json_decode($res->getBody());
        $total = $res->getHeaderLine('X-WP-Total');
        $total_pages = $res->getHeaderLine('X-WP-TotalPages');
        $body = array($body);
        return $body;
    }
}

