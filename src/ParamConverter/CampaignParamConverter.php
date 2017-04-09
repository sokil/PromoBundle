<?php

namespace Sokil\PromoBundle\ParamConverter;

use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sokil\PromoBundle\Tracking\Campaign;
use Symfony\Component\HttpFoundation\Request;

class CampaignParamConverter implements ParamConverterInterface
{
    function apply(Request $request, ParamConverter $configuration)
    {
        // Use utm_source to identify a search engine, newsletter name, or other source.
        $campaignSource = $request->get('utm_source', 'direct');

        // Use utm_medium to identify a medium such as email or cost-per-click.
        $campaignMedium = $request->get('utm_medium');

        // Used for keyword analysis. Use utm_campaign to identify a specific product promotion or strategic campaign.
        $campaignName = $request->get('utm_campaign');

        // Used for paid search. Use utm_term to note the keywords for this ad.
        $campaignTerm = $request->get('utm_term');

        // Used for A/B testing and content-targeted ads. Use utm_content to differentiate ads or
        // links that point to the same URL.
        $campaignContent = $request->get('utm_content');

        // create campaign
        $campaign = new Campaign(
            $campaignSource,
            $campaignMedium,
            $campaignName,
            $campaignTerm,
            $campaignContent
        );

        // set attribute
        $request->attributes->set(
            $configuration->getName(),
            $campaign
        );
    }

    function supports(ParamConverter $configuration)
    {
        if (null === $configuration->getClass()) {
            return false;
        }

        return true;
    }
}