<?php

namespace App\GraphQL\Mutation;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

use App\User;
use JWTAuth;

class UpdateUserPasswordMutation extends Mutation
{
    protected $attributes = [
        // 'name' => 'UpdateUserPasswordMutation',
        // 'description' => 'A mutation'
        'name' => 'updateUserPassword',
    ];

    public function type()
    {
        // return Type::listOf(Type::string());
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::nonNull(Type::string())],
            'password' => ['name' => 'password', 'type' => Type::nonNull(Type::string())]
        ];
    }

    // public function resolve($root, $args, $context, ResolveInfo $info)
    // {
    //     return [];
    // }

    public function resolve($root, $args)
    {
        $user = User::find($args['id']);

        if (!$user) {
            return null;
        }

        $user->password = bcrypt($args['password']);
        $user->save();

        return $user;
    }

    /*
    *   override Field->authenticated()
    */
    public function authenticated($root, $args, $context)
    {
        return JWTAuth::parseToken()->authenticate() ? true : false;
    }
}
