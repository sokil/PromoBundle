<?php

namespace Sokil\PromoBundle\Tracking\Engine;

use Sokil\PromoBundle\Tracking\Campaign;

interface TrackingEngineInterface
{
    /**
     * @param string $type type of track (click, view, conversion, etc)
     * @param Campaign $campaign bunch of utm parameters
     */
    public function track($type, Campaign $campaign);
}