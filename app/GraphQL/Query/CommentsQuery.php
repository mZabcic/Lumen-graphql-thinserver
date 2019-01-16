<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class CommentsQuery extends Query
{
    protected $attributes = [
        'name' => 'comments'
    ];
    public function type()
    {
        return Type::listOf(GraphQL::type('Comment'));
    }
    public function args()
    {
        return [
            'page' => ['name' => 'page', 'type' => Type::int()],
            'id' => ['name' => 'id', 'type' => Type::int()],
            'slug' => ['name' => 'slug', 'type' => Type::string()],
            'status' => ['name' => 'status', 'type' => Type::string()],
            'type' => ['name' => 'type', 'type' => Type::string()],
            'categories' => ['name' => 'categories', 'type' => Type::string()],
            'search' => ['name' => 'search', 'type' => Type::string()],
            'per_page' => ['name' => 'per_page', 'type' => Type::int()],
            'categories_exclude' => ['name' => 'categories_exclude', 'type' => Type::string()],
            'parent_exclude' => ['name' => 'parent_exclude', 'type' => Type::string()],
            'after' => ['name' => 'after', 'type' => Type::string()],
            'order' => ['name' => 'order', 'type' => Type::string()],
            'orderby' => ['name' => 'orderby', 'type' => Type::string()],
            'offset' => ['name' => 'offset', 'type' => Type::string()],
            'include' => ['name' => 'include', 'type' => Type::string()],
            'post' => ['name' => 'post', 'type' => Type::string()],
            'before' => ['name' => 'before', 'type' => Type::string()],
            'author_email' => ['name' => 'author_email', 'type' => Type::string()],
            'author_exclude' => ['name' => 'author_exclude', 'type' => Type::string()],
            'author' => ['name' => 'author', 'type' => Type::string()],
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
        $res = $client->request('GET', env('WP_API_URL') . '/comments?page=' . $args['page'] . $queryParams, [
        ]);
        $body = json_decode($res->getBody());
        return $body;
    }
}