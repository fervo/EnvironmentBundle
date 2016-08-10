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
            new ExpressionFunction('env', function ($arg, $default = null) {
                if (2 > func_num_args()) {
                    return sprintf('\\Fervo\\EnvironmentBundle\\ExpressionLanguageProvider::getEnvironmentVariable(%s)', $arg);
                }

                return sprintf('\\Fervo\\EnvironmentBundle\\ExpressionLanguageProvider::getEnvironmentVariable(%s, %s)', $arg, $default);
            }, function (array $variables, $value, $default = null) {
                if (3 > func_num_args()) {
                    return ExpressionLanguageProvider::getEnvironmentVariable($value);
                }

                return ExpressionLanguageProvider::getEnvironmentVariable($value, $default);
            }),
        );
    }

    public static function getEnvironmentVariable($name, $default = null)
    {
        if (isset($_ENV[$name])) {
            return $_ENV[$name];
        }

        if (false !== $value = getenv($name)) {
            return $value;
        }

        if (2 > func_num_args()) {
            throw new \InvalidArgumentException("Environment variable $name not found.");
        }

        return $default;
    }
}
