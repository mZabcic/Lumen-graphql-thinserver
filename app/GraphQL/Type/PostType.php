<?php
namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use GraphQL;
use GraphQL\Type\Definition\ObjectType;


class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Post',
        'description' => 'WP post type'
    ];


 
    
    public function fields()
    {
        $contentType = new ObjectType([
            'name' => 'Content',
            'description' => 'Post content data',
            'fields' => [
                'rendered' => [
                    'type' => Type::string(),
                ],
                'protected' => [
                    'type' => Type::string(),
                ]
            ]
        ]);

        $catType = null;

        $catType = new ObjectType([
            'name' => 'Category',
            'description' => 'Category object',
            'fields' => function() use (&$catType) { 
                return [
                'id' => [
                    'type' => Type::int(),
                ],
                'count' => [
                    'type' => Type::int(),
                ],
                'description' => [
                    'type' => Type::string(),
                ],
                'link' => [
                    'type' =>  Type::string(),
                ],
                'name' => [
                    'type' =>  Type::string(),
                ],
                'slug' => [
                    'type' =>  Type::string(),
                ],
                'taxonomy' => [
                    'type' =>  Type::string(),
                ],
                'parent' => [
                    'type' =>  Type::int(),
                ],
                'meta' => [
                    'type' => Type::listOf(Type::int()),
                ],
                '_links' => [
                    'type' =>  Type::string(),
                ],
                'parent_object' => [
                    'type' => $catType,
                    'resolve' => function($cat, $args) {
                        $client = new \GuzzleHttp\Client();
                        if ($cat->parent > 0) {
                            $res_cat = $client->request('GET', env('WP_API_URL') . '/categories/' . $cat->parent, [ ]);
                            return json_decode($res_cat->getBody());
                        }
                    }
                ]
            ];
        }
        ]);

        $userType = new ObjectType([
            'name' => 'User',
            'description' => 'User object',
            'fields' => [
                'id' => [
                    'type' => Type::int(),
                ],
                'description' => [
                    'type' => Type::string(),
                ],
                'url' => [
                    'type' =>  Type::string(),
                ],
                'name' => [
                    'type' =>  Type::string(),
                ],
                'link' => [
                    'type' =>  Type::string(),
                ],
                'slug' => [
                    'type' =>  Type::string(),
                ],
                'avatar_url' => [
                    'type' => Type::listOf($catType),
                ],
                'meta' => [
                    'type' =>  Type::listOf(Type::string()),
                ],
                '_links' => [
                    'type' =>  Type::string(),
                ]
            ]
        ]);

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
                'type' => $contentType,
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
                'type' => Type::listOf(Type::int()),
            ],
            "categories" => [
                'type' => Type::listOf(Type::int()),
            ],
            "tags" => [
                'type' => Type::nonNull(Type::string()),
            ],
            "_links" => [
                'type' => Type::nonNull(Type::string()),
            ],
            'cat_list' => [
                'type' => Type::listOf($catType),
                'description' => 'List of categoies post is in',
                'resolve' => function($post, $args) {
                    $client = new \GuzzleHttp\Client();
                    $cat_data = [];
                    foreach ($post->categories as $cat_id) {
                        $res_cat = $client->request('GET', env('WP_API_URL') . '/categories/' . $cat_id, [ ]);
                        $cat_body = json_decode($res_cat->getBody());
                        array_push($cat_data, $cat_body);
                    }
                    return $cat_data;
                }
            ],
            'author_object' => [
                'type' => $userType,
                'description' => 'Author object',
                'resolve' => function($post, $args) {
                    $client = new \GuzzleHttp\Client();
                    $res = $client->request('GET', env('WP_API_URL') . '/users/' . $post->author, [ ]);
                    return json_decode($res->getBody());
                }
            ]
        ];
    }
}