<?php

namespace Fervo\EnvironmentBundle;

use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;

/**
 * Define some ExpressionLanguage functions.
 *
 * To get an environment variable, use env('YOUR_VARIABLE').
 */
class ExpressionLanguageProvider implements ExpressionFunctionProviderInterface
{
    public function getFunctions()
    {
        return array(
            new ExpressionFunction('env', function ($arg) {
                return sprintf('getenv(%s)', $arg);
            }, function (array $variables, $value) {
                return getenv($value);
            }),
        );
    }
}
