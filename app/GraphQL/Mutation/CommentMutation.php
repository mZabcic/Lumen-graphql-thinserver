<?php
namespace App\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use App\User;

class CommentMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Comment'
    ];

    public function type()
    {
        return GraphQL::type('Comment');
    }

    public function args()
    {
        return [
            'post_id' => ['name' => 'post_id', 'type' => Type::int()],
            'author_name' => ['name' => 'author_name', 'type' => Type::string()],
            'parent' => ['name' => 'parent', 'type' => Type::int()],
            'content' => ['name' => 'content', 'type' => Type::string()],
        ];
    }

    public function rules()
    {
        return [
            'post_id' => ['required'],
            'content' => ['required']
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
            ['body' => [
                'post_id' => $args['post_id'],
                'author_name' => $args['author_name'],
                'parent' => $args['required'],
                'content' => $args['content'],
            ]]
        ]);
        $body = json_decode($res->getBody());

        return $body;
    }
}