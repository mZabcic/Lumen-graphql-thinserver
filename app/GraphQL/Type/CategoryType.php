<?php
namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
use GraphQL\Type\Definition\ObjectType;


class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'WP category type'
    ];


 
    
    public function fields()
    {
        
        return [
            "id" => [
                'type' => Type::nonNull(Type::int())
            ],
        "count" => [
            'type' => Type::nonNull(Type::int())
        ],
        "description" => [
            'type' => Type::nonNull(Type::string()),
        ],
        "link" => [
            'type' => Type::nonNull(Type::string()),
        ],
        "name" => [
            'type' => Type::nonNull(Type::string()),
        ],
        "slug" => [
            'type' => Type::nonNull(Type::string()),
        ],
        "taxonomy" => [
            'type' => Type::nonNull(Type::string()),
        ],
        "parent" => [
            'type' => Type::nonNull(Type::int())
        ]
        ];
    }
}