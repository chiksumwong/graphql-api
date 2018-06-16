<?php

namespace App\GraphQL\Mutation;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;

use App\User;

class SignupMutation extends Mutation
{
    protected $attributes = [
        // 'name' => 'SignupMutation',
        // 'description' => 'A mutation'
        'name' => 'Signup',
        'description' => 'A mutation for user sign up'
    ];

    public function type()
    {
        // return Type::listOf(Type::string());
        return GraphQL::type('User');
    }

    public function args()
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::nonNull(Type::string())],
            'email' => ['name' => 'email', 'type' => Type::nonNull(Type::string())],
            'password' => ['name' => 'password', 'type' => Type::nonNull(Type::string())]
        ];
    }


    public function rules()
    {
        return [
            'name' => ['required', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
        ];
    }


    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $user = new User();
        $user->name = $args['name'];
        $user->email = $args['email'];
        $user->password = bcrypt($args['password']);
        $user->save();
        return $user;
    }
}
