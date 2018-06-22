<?php

namespace App\GraphQL\Mutation;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

use JWTAuth;

class LogoutMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Logout',
        'description' => 'A mutation for user logout'
    ];

    public function type()
    {
        return Type::listOf(Type::string());
    }

    public function args()
    {
        return [
            'Authorization' => ['name' => 'Authorization', 'type' => Type::nonNull(Type::string())],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $Authorization = $args['Authorization'];
        JWTAuth::invalidate($Authorization);
        return ["User Logged out Successfully"];
    }
}
