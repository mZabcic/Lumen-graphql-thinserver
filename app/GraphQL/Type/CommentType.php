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
       

        return [
            "id" => [
                'type' => Type::nonNull(Type::int()),
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
                'type' => Type::nonNull(Type::string()),
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
            ]
            
            ];
          
    }
}