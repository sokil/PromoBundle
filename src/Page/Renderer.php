<?php

namespace Sokil\PromoBundle\Page;

use Sokil\PromoBundle\Tracking\Campaign;
use Symfony\Component\Templating\EngineInterface;

class Renderer
{
    /**
     * @var Resolver
     */
    private $pageContentResolver;

    /**
     * @var EngineInterface
     */
    private $templatingEngine;

    public function __construct(
        Resolver $pageContentResolver,
        EngineInterface $templatingEngine
    ) {
        $this->pageContentResolver = $pageContentResolver;
        $this->templatingEngine = $templatingEngine;
    }

    public function render(Campaign $campaign)
    {
        $content = $this
            ->pageContentResolver
            ->resolve($campaign);

        return $this->templatingEngine->render(
            $content->getTemplate($campaign),
            $content->getParameters($campaign)
        );
    }
}