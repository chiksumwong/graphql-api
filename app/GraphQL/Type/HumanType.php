<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
// use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;
use Folklore\GraphQL\Support\Type as GraphQLType;

class HumanType extends GraphQLType
{
    protected $attributes = [
        // 'name' => 'HumanType',
        // 'description' => 'A type'
        'name' => 'Human',
        'description' => 'A human.'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the human.',
            ],
            'appearsIn' => [
                'type' => Type::nonNull(Type::listOf(GraphQL::type('Episode'))),
                'description' => 'A list of episodes in which the human has an appearance.'
            ],
            'totalCredits' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The total amount of credits this human owns.'
            ]
        ];
    }

    /*
    *   接口的實現並不是通過 implement 關鍵字，而是通過interfaces（）方法：
    */
    public function interfaces() {
        return [
            GraphQL::type('Character')
        ];
    }


}
