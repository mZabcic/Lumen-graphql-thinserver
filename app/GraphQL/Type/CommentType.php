<?php
namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
use GraphQL\Type\Definition\ObjectType;


class CommentType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Comment',
        'description' => 'WP comment type'
    ];

    


 
    
    public function fields()
    {
        $paginationType = new ObjectType([
            'name' => 'CommentPagination',
            'description' => 'Comment pagination data',
            'fields' => [
                'totalPages' => [
                    'type' => Type::int(),
                ],
                'total' => [
                    'type' => Type::int(),
                ]
            ]
        ]);

        return [
            "id" => [
                'type' => Type::int(),
            ],
            "post" => [
                'type' => Type::int(),
            ],
            "parent" => [
                'type' => Type::int(),
            ],
            "author" => [
                'type' => Type::int(),
            ],
            "author_name" => [
                'type' => Type::string(),
            ],
            "author_url" => [
                'type' => Type::string(),
            ],
            "date" => [
                'type' => Type::string(),
            ],
            "date_gmt" => [
                'type' => Type::string(),
            ],
            "content" => [
                'type' => Type::string(),
                'resolve' => function($post, $args) {
                    return $post->content->rendered;
                }
            ],
            "link" => [
                'type' =>  Type::string(),
                'resolve' => function($post, $args) {
                    return str_replace(env('WP_URL'),"", $post->link);  
                }
            ],
            "status" => [
                'type' => Type::string(),
            ],
            "type" => [
                'type' => Type::string(),
            ],
            "meta" => [
                'type' => Type::listOf(Type::string()),
            ],
            "children" => [
                    'type' => Type::listOf(GraphQL::type('Comment')),
                    'description' => 'Children object',
                    'resolve' => function($post, $args) {
                        $client = new \GuzzleHttp\Client();
                        $res = $client->request('GET', env('WP_API_URL') . '/comments?parent=' . $post->id, [ ]);
                        return json_decode($res->getBody());
                    }
                ],
                'pagination' => [
                    'type' => $paginationType,
                    'description' => 'Total number'
                ]
            
            
            ];
          
    }
}