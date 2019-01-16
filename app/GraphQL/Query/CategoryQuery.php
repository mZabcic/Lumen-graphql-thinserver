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
                'page' => ['name' => 'page', 'type' => Type::int()],
                'slug' => ['name' => 'slug', 'type' => Type::string()],
                'exclude' => ['name' => 'exclude', 'type' => Type::string()],
                'search' => ['name' => 'search', 'type' => Type::string()],
                'per_page' => ['name' => 'per_page', 'type' => Type::int()],
                'post' => ['name' => 'post', 'type' => Type::int()],
                'parent' => ['name' => 'parent', 'type' => Type::int()],
                'hide_empty' => ['name' => 'hide_empty', 'type' => Type::int()],
                'order' => ['name' => 'order', 'type' => Type::string()],
                'orderby' => ['name' => 'orderby', 'type' => Type::string()],
                'include' => ['name' => 'include', 'type' => Type::string()],
            ];
        
    }
    public function resolve($root, $args)
    {
        $args['page'] = array_key_exists ("page" , $args ) ? $args['page'] : 1;
        $queryParams = "";
        foreach ($args as $key => $value) {
            if ($key != 'page')
                $queryParams .= "&" . $key . "=" . $value;
        } 
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', env('WP_API_URL') . '/categories?page=' . $args['page'] . $queryParams, [
        ]);
        $body = json_decode($res->getBody());
        return $body;
    }
}

