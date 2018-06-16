<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

use App\User;

class UserQueryById extends Query
{
    protected $attributes = [
        'name' => 'QueryUserById',
        'description' => 'A query'
    ];

    public function type()
    {
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        if (empty($args['id'])) {
            throw new \InvalidArgumentException('Please enter user ID !');
        }
        $user = User::find($args['id']);
        return $user;
    }
}
