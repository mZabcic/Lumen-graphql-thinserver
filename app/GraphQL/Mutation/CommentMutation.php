<?php
namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\User;

class CommentMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newComment'
    ];

    public function type()
    {
        return GraphQL::type('Comment');
    }

    public function args()
    {
        return [
            'post' => ['name' => 'post', 'type' => Type::nonNull(Type::int())],
            'author_name' => ['name' => 'author_name', 'type' => Type::string()],
            'parent' => ['name' => 'parent', 'type' => Type::int()],
            'content' => ['name' => 'content', 'type' => Type::nonNull(Type::string())],
        ];
    }


    public function resolve($root, $args)
    {
        if (!isset($args['author_name'])) {
            $args['author_name'] = "";
        }
        if (!isset($args['parent'])) {
            $args['parent'] = 0;
        }
        $client = new \GuzzleHttp\Client();
        $res = $client->request('POST', env('WP_API_URL') . '/comments', [
            'multipart' => [
                [
                    'name'     => 'post',
                    'contents' => $args['post']
                ],
                [
                    'name'     => 'author_name',
                    'contents' => $args['author_name']
                ],
                [
                    'name'     => 'parent',
                    'contents' => $args['parent']
                ],
                [
                    'name'     => 'content',
                    'contents' => $args['content']
                ]
            ]
        ]);
        
        $body = json_decode($res->getBody());

        return $body;
    }
}