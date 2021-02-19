<?php

namespace A3020\HttpHeaders\Header;

abstract class AbstractHeader
{
    private $identifier;
    protected $name = 'Unnamed';
    protected $isEnabled = false;
    protected $category = 'Custom';

    public function fromConfig($identifier, $options)
    {
        $this->setIdentifier($identifier);

        if (isset($options['enabled'])) {
            $this->setIsEnabled($options['enabled']);
        }
    }

    public function fromPost($post)
    {
        $this->setIdentifier($post['identifier']);
        $this->setIsEnabled(isset($post['enabled']) ? true : false);
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
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getComputedValue()
    {
        return '';
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'enabled' => $this->isEnabled(),
        ];
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = (string) $identifier;
    }

    /**
     * @param bool $isEnabled
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = (bool) $isEnabled;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = (string) $category;
    }
}
