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
        $fields = $info->getFieldSelection($depth = 3);

        if (isset($args['id'])) {
            $users = User::where('id', $args['id']);
        } elseif (isset($args['email'])) {
            $users = User::where('email', $args['email']);
        } else {
            $users = User::query();
        }
    
        foreach ($fields as $field => $keys) {
            if ($field === 'comments') {
                $users->with('comments');
            }
        }
    
        return $users->get();
    }
}
