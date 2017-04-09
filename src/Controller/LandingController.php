<?php

namespace Sokil\PromoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sokil\PromoBundle\Tracking\Campaign;

class LandingController extends Controller
{
    /**
     * @ParamConverter("campaign", converter="promo_campaign_converter")
     * @return Response
     */
    public function indexAction(Campaign $campaign)
    {
        // track view
        $this->get('promo.tracking.engine')->track('view', $campaign);

        // render landing
        $landingHtmlContent = $this->get('promo.page.renderer')->render($campaign);

        // show response
        $response = new Response();
        $response->setContent($landingHtmlContent);
        return $response;
    }

    /**
     * @ParamConverter("campaign", converter="promo_campaign_converter")
     *
     * @param Request $request
     * @param Campaign $campaign
     *
     * @return Response
     */
    public function awayAction(Request $request, Campaign $campaign = null)
    {
        // is away available
        if (false === $this->getParameter('promo.away.allowed')) {
            return $this->redirect('/');
        }

        // get url
        $url = $request->get('url');
        if (empty($url)) {
            return $this->redirect('/');
        }

        // check white list of domains for external urls
        if ('/' !== substr($url, 0, 1)) {
            $domainWhiteList = $this->getParameter('promo.away.domainWhiteList');
            if (!empty($domainWhiteList)) {
                $isAllowedUrl = false;
                foreach ($domainWhiteList as $domain) {
                    if (0 === strpos($url, $domain)) {
                        $isAllowedUrl = true;
                        break;
                    }
                }

                if (false === $isAllowedUrl) {
                    return $this->redirect('/');
                }
            }
        }

        // track redirect
        if (true === $this->getParameter('promo.away.track')) {
            if (!empty($campaign)) {
                $this->get('promo.tracking.engine')->track('away', $campaign);
            }
        }

        // go to target site
        return $this->redirect($url);
    }
}
