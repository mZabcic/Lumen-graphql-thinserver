<?php
namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
use GraphQL\Type\Definition\ObjectType;


class MenuType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Menu',
        'description' => 'WP menu type'
    ];


 
    
    public function fields()
    {
        $menu_item = new ObjectType([
            'name' => 'Menu_item',
            'description' => 'Menu item details',
            'fields' => [
                "ID"  => [
                    'type' => Type::nonNull(Type::int())
                ],
                "post_author" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "post_date" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "post_date_gmt" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "post_content" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "post_title" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "post_excerpt" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "post_status" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "comment_status" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "ping_status" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "post_password" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "post_name" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "to_ping" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "pinged" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "post_modified" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "post_modified_gmt" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "post_content_filtered" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "post_parent" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "guid" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "menu_order" => [
                    'type' => Type::nonNull(Type::int())
                ],
                "post_type" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "post_mime_type" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "comment_count" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "filter" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "db_id" => [
                    'type' => Type::nonNull(Type::int())
                ],
                "menu_item_parent" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "object_id" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "object" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "type" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "type_label" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "title" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "url" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "target" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "attr_title" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "description" => [
                    'type' => Type::nonNull(Type::string()),
                ],
                "classes" => [
                    'type' => Type::listOf(Type::string()),
                ],
                "xfn" => [
                    'type' => Type::nonNull(Type::string()),
                ]
            ]
        ]);

        return [
            "term_id" => [
                'type' => Type::nonNull(Type::int())
            ],
            "name" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "slug" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "term_group" => [
                'type' => Type::nonNull(Type::int()),
            ],
            "term_taxonomy_id" => [
                'type' => Type::nonNull(Type::int()),
            ],
            "taxonomy"  => [
                'type' => Type::nonNull(Type::string()),
            ],
            "description" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "parent" => [
                'type' => Type::nonNull(Type::int()),
            ],
            "count" => [
                'type' => Type::nonNull(Type::int()),
            ],
            "filter" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "items" => [
                'type' => Type::listOf($menu_item)
            ]
            
            ];
          
    }
}