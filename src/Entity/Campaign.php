<?php

namespace Sokil\PromoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name = "promo_campaigns")
 */
class Campaign
{
    /**
     * @ORM\Id
     * @ORM\Column(type = "string", length=32)
     * @ORM\GeneratedValue(strategy="NONE")
     *
     * @var string
     */
    private $id;

    /**
     * Use utm_source to identify a search engine, newsletter name, or other source.
     *
     * @ORM\Column(type = "string")
     *
     * @var string
     */
    private $source;

    /**
     * Use utm_medium to identify a medium such as email or cost-per- click.
     *
     * @ORM\Column(type = "string", nullable=true)
     *
     * @var string
     */
    private $medium;

    /**
     * Used for keyword analysis. Use utm_campaign to identify a specific product promotion or strategic campaign.
     *
     * @ORM\Column(type = "string", nullable=true)
     *
     * @var string
     */
    private $name;

    /**
     * Used for paid search. Use utm_term to note the keywords for this ad.
     *
     * @ORM\Column(type = "string", nullable=true)
     *
     * @var string
     */
    private $term;

    /**
     * Used for A/B testing and content-targeted ads. Use utm_content to differentiate ads or
     * links that point to the same URL.
     *
     * @ORM\Column(type = "string", nullable=true)
     *
     * @var string
     */
    private $content;

    /**
     * Campaign constructor.
     * @param string $source
     * @param string $medium
     * @param string $name
     * @param string $term
     * @param string $content
     */
    public function __construct(
        $id,
        $source,
        $medium = null,
        $name = null,
        $term = null,
        $content = null
    ) {
        $this->id = $id;
        $this->source = $source;
        $this->medium = $medium;
        $this->name = $name;
        $this->term = $term;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return string
     */
    public function getMedium()
    {
        return $this->medium;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}