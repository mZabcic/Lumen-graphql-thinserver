<?php
namespace App\GraphQL\Type;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class PostType extends BaseType
{
    protected $attributes = [
        'name' => 'Post',
        'description' => 'WP post type'
    ];
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int())
            ],
            'date' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'date_gmt' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'guid' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'modified'  => [
                'type' => Type::nonNull(Type::string()),
            ],
            "modified_gmt" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "slug" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "status" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "type" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "link" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "title" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "content" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "excerpt" => [
                    'type' => Type::nonNull(Type::string()),
            ],
            "author" => [
                'type' => Type::nonNull(Type::int()),
            ],
            "featured_media" => [
                'type' => Type::nonNull(Type::int()),
            ],
            "comment_status" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "ping_status" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "sticky" => [
                'type' => Type::nonNull(Type::boolean()),
            ],
            "template" => [
                'type' => Type::string(),
            ],
            "format" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "meta" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "categories" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "tags" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "_links" => [
                'type' => Type::nonNull(Type::string()),
            ]
        ];
    }
}