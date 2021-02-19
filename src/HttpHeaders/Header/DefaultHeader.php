<?php

namespace A3020\HttpHeaders\Header;

class DefaultHeader extends AbstractHeader
{
    protected $value;

    public function fromConfig($name, $options)
    {
        parent::fromConfig($name, $options);

        if (isset($options['value'])) {
            $this->setValue($options['value']);
        }
    }

    public function fromPost($post)
    {
        parent::fromPost($post);

        $this->setValue($post['value']);
    }
    
    public function toArray()
    {
        $array = parent::toArray();

        return $array + [
            'value' => $this->getValue(),
        ];
    }

    /**
     * @return string
     */
    public function getComputedValue()
    {
        return $this->getValue();
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = (string) $value;
    }
}
