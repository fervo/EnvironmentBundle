<?php

namespace Fervo\EnvironmentBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FervoEnvironmentBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addExpressionLanguageProvider(new ExpressionLanguageProvider());
    }
}
