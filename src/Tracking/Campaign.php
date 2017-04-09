<?php

namespace Sokil\PromoBundle\Tracking;

class Campaign
{
    /**
     * Use utm_source to identify a search engine, newsletter name, or other source.
     *
     * @var string
     */
    private $source;

    /**
     * Use utm_medium to identify a medium such as email or cost-per- click.
     *
     * @var string
     */
    private $medium;

    /**
     * Used for keyword analysis. Use utm_campaign to identify a specific product promotion or strategic campaign.
     *
     * @var string
     */
    private $name;

    /**
     * Used for paid search. Use utm_term to note the keywords for this ad.
     *
     * @var string
     */
    private $term;

    /**
     * Used for A/B testing and content-targeted ads. Use utm_content to differentiate ads or
     * links that point to the same URL.
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
        $source,
        $medium = null,
        $name = null,
        $term = null,
        $content = null
    ) {
        $this->source = $source;
        $this->medium = $medium;
        $this->name = $name;
        $this->term = $term;
        $this->content = $content;
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

    /**
     * @return string
     */
    public function getHash()
    {
        return md5(implode(':', [
            $this->getSource(),
            $this->getMedium(),
            $this->getName(),
            $this->getTerm(),
            $this->getContent(),
        ]));
    }

    public function toArray()
    {
        return [
            'utm_source' => $this->getSource(),
            'utm_medium' => $this->getMedium(),
            'utm_campaign' => $this->getName(),
            'utm_content' => $this->getContent(),
            'utm_term' => $this->getTerm(),
        ];
    }
}