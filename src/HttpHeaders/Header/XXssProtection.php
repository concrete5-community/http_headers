<?php

namespace A3020\HttpHeaders\Header;

class XXssProtection extends DefaultHeader
{
    protected $name = 'X-XSS-Protection';
    protected $category = 'Security';

    private $reportUri;

    public function fromConfig($name, $options)
    {
        parent::fromConfig($name, $options);

        if (isset($options['report_uri'])) {
            $this->setReportUri($options['report_uri']);
        }
    }

    public function fromPost($post)
    {
        parent::fromPost($post);

        $this->setReportUri($post['report_uri']);
    }

    /**
     * @return string
     */
    public function getReportUri()
    {
        return $this->reportUri;
    }

    /**
     * @param string $reportUri
     */
    public function setReportUri($reportUri)
    {
        $this->reportUri = $reportUri;
    }

    /**
     * @return string
     */
    public function getComputedValue()
    {
        if ($this->getValue() === '1; report=') {
            return $this->getValue() . $this->getReportUri();
        }

        return $this->getValue();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        return $array + [
            'report_uri' => $this->getReportUri(),
        ];
    }
}
