<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

use App\GraphQL\Fields\PictureField;

class UserType extends BaseType
{
    protected $attributes = [
        // 'name' => 'UserType',
        // 'description' => 'A type'
        'name' => 'User',
        'description' => 'A User'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of the user'
            ],
            'comments' => [
                'type' => Type::listOf(GraphQL::type('Comment')),
                'description' => 'The comments by the user'
            ],
            'picture' => PictureField::class
        ];
    }

    protected function resolveEmailField($root, $args)
    {
        return strtolower($root->email);
    }

    protected function resolveCommentsField($root, $args)
    {
        if (isset($args['id'])) {
            return $root->comments->where('id', $args['id']);
        }

        return $root->comments;
    }

}
