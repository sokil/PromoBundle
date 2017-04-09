<?php

namespace Sokil\PromoBundle\Page;

use Sokil\PromoBundle\Tracking\Campaign;

abstract class AbstractPage
{
    /**
     * @return string
     */
    abstract public function getTemplate(Campaign $campaign);

    /**
     * @return array
     */
    public function getParameters(Campaign $campaign)
    {
        return [];
    }

    /**
     * @param Campaign $campaign
     * @return bool
     */
    abstract public function supports(Campaign $campaign);
}