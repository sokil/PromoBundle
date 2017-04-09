<?php

namespace Sokil\PromoBundle\Page;

use Sokil\PromoBundle\Page\Exception\PageNotFoundException;
use Sokil\PromoBundle\Tracking\Campaign;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Resolver implements ContainerAwareInterface
{
    /**
     * @var array
     */
    private $pageServiceIdList = [];

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param array $pageServiceIdList
     */
    public function __construct(array $pageServiceIdList)
    {
        $this->pageServiceIdList = $pageServiceIdList;
    }

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param Campaign $campaign
     * @return AbstractPage
     * @throws PageNotFoundException
     */
    public function resolve(Campaign $campaign)
    {
        $resolvedPageService = null;

        foreach ($this->pageServiceIdList as $pageServiceId) {
            $pageService = $this->container->get($pageServiceId);
            if (!$pageService instanceof AbstractPage) {
                throw new \Exception('Page must be instance of ' . AbstractPage::class);
            }

            if ($pageService->supports($campaign)) {
                $resolvedPageService = $pageService;
                break;
            }
        }

        if (null === $resolvedPageService) {
            throw new PageNotFoundException('Promo page not configured for passed campaign');
        }

        return $resolvedPageService;
    }
}