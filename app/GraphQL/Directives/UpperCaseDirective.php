<?php

namespace App\GraphQL\Directives;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\Directive;
use Nuwave\Lighthouse\Support\Contracts\FieldMiddleware;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UpperCaseDirective implements Directive, FieldMiddleware
{

    public function name() : string
    {
        return 'upperCase';
    }


    public function handleField(FieldValue $fieldValue, \Closure $next)
    {
        $previousResolver = $fieldValue->getResolver();
        $wrappedResoler = function($root, array $args, GraphQLContext $context, ResolveInfo $info) use ($previousResolver): string {
            $result = $previousResolver($root, $args, $context, $info);
            return strtoupper($result);
        };


        //dd($fieldValue);
        $fieldValue->setResolver($wrappedResoler);

        return $next($fieldValue);
    }
}