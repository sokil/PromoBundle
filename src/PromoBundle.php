<?php

namespace Sokil\PromoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Sokil\PromoBundle\DependencyInjection\CompilerPass\PromoPageContentResolveCompilerPass;

class PromoBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new PromoPageContentResolveCompilerPass());
    }
}
