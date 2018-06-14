<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
// use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

use App\User;

class UserQuery extends Query
{
    protected $attributes = [
        // 'name' => 'UserQuery',
        // 'description' => 'A query'
        'name' => 'users',
    ];

    public function type()
    {
        // return Type::listOf(Type::string());
        return Type::listOf(GraphQL::type('User'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'email' => ['name' => 'email', 'type' => Type::string()] 
        ];
    }

    // public function resolve($root, $args, $context, ResolveInfo $info)
    // {
    //     return [];
    // }

    public function resolve($root, $args)
    {
        if (isset($args['id'])) {
            return User::where('id', $args['id'])->get();
        } elseif (isset($args['email'])) {
            return User::where('email', $args['email'])->get();
        } else {
            return User::all();
        }
    }
}
