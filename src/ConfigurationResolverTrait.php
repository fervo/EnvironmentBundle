<?php

namespace Fervo\EnvironmentBundle;

use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\DependencyInjection\Reference;

trait ConfigurationResolverTrait
{
    protected function resolve($value)
    {
        if (is_string($value) && strlen($value) > 0 && $value[0] == '@') {
            if (strlen($value) > 1 && $value[1] == '=') {
                return new Expression(substr($value, 2));
            } else {
                return new Reference(substr($value, 1));
            }
        }

        return $value;
    }
}
