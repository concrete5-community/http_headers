<?php

namespace A3020\HttpHeaders\Header;

class StrictTransportSecurity extends DefaultHeader
{
    protected $name = 'Strict-Transport-Security';
    protected $category = 'Security';

    /** @var int in seconds */
    private $maxAge = 0;

    /** @var bool */
    private $includeSubDomains = false;

    /** @var bool */
    private $preload = false;

    public function fromConfig($name, $options)
    {
        parent::fromConfig($name, $options);

        if (isset($options['max_age'])) {
            $this->setMaxAge($options['max_age']);
        }

        if (isset($options['include_sub_domains'])) {
            $this->setIncludeSubdomains($options['include_sub_domains']);
        }

        if (isset($options['preload'])) {
            $this->setPreload($options['preload']);
        }
    }

    public function fromPost($post)
    {
        parent::fromPost($post);

        $this->setMaxAge($post['max_age']);
        $this->setIncludeSubdomains($post['include_sub_domains']);
        $this->setPreload($post['preload']);
    }

    /**
     * @return string
     */
    public function getComputedValue()
    {
        $value = 'max-age=' . $this->getMaxAge() .'; ';
        if ($this->includeSubDomains) {
            $value .= 'includeSubDomains; ';
        }

        if ($this->isPreload()) {
            $value .= 'preload';
        }

        return rtrim(trim($value), ';');
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        return $array + [
            'max_age' => $this->getMaxAge(),
            'include_sub_domains' => $this->isIncludeSubDomains(),
            'preload' => $this->isPreload(),
        ];
    }

    /**
     * @return int
     */
    public function getMaxAge()
    {
        return $this->maxAge;
    }

    /**
     * @param int $maxAge
     */
    public function setMaxAge($maxAge)
    {
        $this->maxAge = (int) $maxAge;
    }

    /**
     * @return bool
     */
    public function isIncludeSubDomains()
    {
        return $this->includeSubDomains;
    }

    /**
     * @param bool $includeSubDomains
     */
    public function setIncludeSubDomains($includeSubDomains)
    {
        $this->includeSubDomains = (bool) $includeSubDomains;
    }

    /**
     * @return bool
     */
    public function isPreload()
    {
        return $this->preload;
    }

    /**
     * @param bool $preload
     */
    public function setPreload($preload)
    {
        $this->preload = (bool) $preload;
    }
}
