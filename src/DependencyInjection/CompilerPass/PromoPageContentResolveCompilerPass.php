<?php

namespace Sokil\PromoBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class PromoPageContentResolveCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        // find page services
        $pageServiceIdList = [];
        foreach ($container->findTaggedServiceIds('sokil.promo.page') as $pageServiceId => $pageServiceTags) {
            foreach ($pageServiceTags as $pageServiceTag) {
                $pageServiceIdList[] = $pageServiceId;
            }
        }

        // set services to resolver
        $resolverDefinition = $container->getDefinition('promo.page.resolver');
        $resolverDefinition->replaceArgument(0, $pageServiceIdList);
    }

}