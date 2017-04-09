<?php

namespace Sokil\PromoBundle\Tracking\Engine;

use Sokil\PromoBundle\Tracking\Campaign;
use Sokil\PromoBundle\Entity\Campaign as CampaignEntity;
use Doctrine\ORM\EntityManager;
use Sokil\PromoBundle\Entity\Tracking;

class DoctrineOrmTrackingEngine implements TrackingEngineInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $type type of track (click, view, conversion, etc)
     * @param Campaign $campaign bunch of utm parameters
     */
    public function track($type, Campaign $campaign)
    {
        // persist company
        $campaignEntity = $this->entityManager
            ->getRepository('PromoBundle:Campaign')
            ->find($campaign->getHash());

        if (!$campaignEntity) {
            $campaignEntity = new CampaignEntity(
                $campaign->getHash(),
                $campaign->getSource(),
                $campaign->getMedium(),
                $campaign->getName(),
                $campaign->getTerm(),
                $campaign->getContent()
            );

            $this->entityManager->persist($campaignEntity);
        }

        $tracking = new Tracking(
            $type,
            $campaignEntity
        );

        $this->entityManager->persist($tracking);
        $this->entityManager->flush();
    }
}