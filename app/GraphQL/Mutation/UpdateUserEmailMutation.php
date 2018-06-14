<?php

namespace App\GraphQL\Mutation;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

use App\User;

class UpdateUserEmailMutation extends Mutation
{
    protected $attributes = [
        // 'name' => 'UpdateUserEmailMutation',
        // 'description' => 'A mutation'
        'name' => 'updateUserEmailMutation',
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
            'email' => ['name' => 'email', 'type' => Type::nonNull(Type::string())]
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

        $user->email = $args['email'];
        $user->save();

        return $user;
    }

    public function rules()
    {
        return [
            'id' => 'required',
            'email' => ['required', 'email']
        ];
    }
}
