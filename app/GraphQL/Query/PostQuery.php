<?php

namespace App\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Closure;

class PostQuery extends Query
{
    protected $attributes = [
        'name' => 'posts'
    ];
    public function type()
    {
        return Type::listOf(GraphQL::type('Post'));
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
            'tags' => ['name' => 'tags', 'type' => Type::string()],
            'tags_exclude' => ['name' => 'tags_exclude', 'type' => Type::string()],
            'order' => ['name' => 'order', 'type' => Type::string()],
            'orderby' => ['name' => 'orderby', 'type' => Type::string()],
            'offset' => ['name' => 'offset', 'type' => Type::string()],
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
        $res = $client->request('GET', env('WP_API_URL') . '/posts?page=' . $args['page'] . $queryParams, [
        ]);
        $body = json_decode($res->getBody());
        /*foreach ($body as $element) {
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
            } */
            //$element->cat_list = $cat_data;

          /*  if (array_key_exists($element->author, $authors)) {
                $element->author_object = $authors[$element->author];
            } else {
                $res_user = $client->request('GET', env('WP_API_URL') . '/users/' . $element->author, [ ]);
                $res_body = json_decode($res_user->getBody());
                $element->author_object = $res_body;
                $authors[$element->author] = $res_body;
            } 
        } */
        foreach ($body as &$value) {
            $value->pagination = [
                'totalPages' => $res->getHeaderLine('X-WP-TotalPages'),
                'total' => $res->getHeaderLine('X-WP-Total')
            ];
        }

        
        return $body;
    }
}