<?php

namespace Sokil\PromoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "promo_track")
 * @ORM\HasLifecycleCallbacks
 */
class Tracking
{
    /**
     * @ORM\Column(type = "integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var string
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type = "string")
     */
    private $type;

    /**
     * @var Campaign
     * @ORM\ManyToOne(targetEntity="Sokil\PromoBundle\Entity\Campaign")
     * @ORM\JoinColumn(name="campaign_id", referencedColumnName="id")
     */
    private $campaign;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @param string $type
     * @param Campaign $campaign
     */
    public function __construct($type, Campaign $campaign)
    {
        $this->type = $type;
        $this->campaign = $campaign;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->date = new \DateTime();
    }
}