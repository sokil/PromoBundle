<?php

namespace Sokil\PromoBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class PromoExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        // load app config
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // set parameters
        $isAwayAllowed = !empty($config['away']['allowed']);
        $awayDomainWhiteList = [];
        $isTrackingAllowed = false;
        if ($isAwayAllowed) {
            // white list of domains
            if (!empty($config['away']['domainWhiteList'])) {
                $awayDomainWhiteList = (array)$config['away']['domainWhiteList'];
            }
            // allow tracking
            if (!empty($config['away']['track'])) {
                $isTrackingAllowed = true;
            }
        }
        $container->setParameter('promo.away.allowed', $isAwayAllowed);
        $container->setParameter('promo.away.domainWhiteList', $awayDomainWhiteList);
        $container->setParameter('promo.away.track', $isTrackingAllowed);

        // load services
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $this->registerTrackingService(
            $config['tracking']['engine'],
            $container
        );
    }

    /**
     * @param string $trackingEngineName
     * @param ContainerBuilder $container
     */
    private function registerTrackingService($trackingEngineName, ContainerBuilder $container)
    {
        $configuredTrackingEngineServiceId = null;

        // find tracking service
        foreach ($container->findTaggedServiceIds('promo.tracking.engine') as $trackingServiceId => $trackingServiceTags)
        {
            foreach ($trackingServiceTags as $trackingServiceTag) {
                if ($trackingServiceTag['alias'] === $trackingEngineName) {
                    $configuredTrackingEngineServiceId = $trackingServiceId;
                }
            }
        }

        if (null === $configuredTrackingEngineServiceId) {
            $configuredTrackingEngineServiceId = 'promo.tracking.engine.blackhole';
        }

        // create tracking service alias
        $container->setAlias('promo.tracking.engine', $configuredTrackingEngineServiceId);
    }
}
