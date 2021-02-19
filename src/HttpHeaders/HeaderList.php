<?php

namespace A3020\HttpHeaders;

use A3020\HttpHeaders\Header\DefaultHeader;
use Concrete\Core\Config\Repository\Repository;

class HeaderList
{
    /**
     * @var \Concrete\Core\Config\Repository\Repository
     */
    private $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Get all header objects.
     *
     * @return \A3020\HttpHeaders\Header\AbstractHeader[]
     */
    public function getAll()
    {
        $configHeaders = $this->config->get('http_headers::headers');

        $headers = [];
        foreach ($configHeaders as $identifier => $options) {
            $headers[] = $this->transform($identifier, $options);
        }

        // Move enabled items to the top of the list.
        usort($headers, function($a, $b) {
            return $a->isEnabled() < $b->isEnabled();
        });

        return $headers;
    }

    /**
     * Gets a header instance by its identifier.
     *
     * @param string $identifier
     *
     * @return \A3020\HttpHeaders\Header\AbstractHeader|null
     */
    public function getByIdentifier($identifier)
    {
        foreach ($this->getAll() as $header) {
            if ($header->getIdentifier() === $identifier) {
                return $header;
            }
        }

        return null;
    }

    /**
     * Transforms a config entry to a Header object.
     *
     * @param string $identifier
     * @param array $options
     *
     * @return \A3020\HttpHeaders\Header\AbstractHeader
     */
    private function transform($identifier, $options = [])
    {
        $header = $this->getInstanceByIdentifier($identifier);
        $header->fromConfig($identifier, $options);

        return $header;
    }

    /**
     * Turn an identifier into a Header object.
     *
     * @param string $identifier
     *
     * @return \A3020\HttpHeaders\Header\AbstractHeader
     */
    public function getInstanceByIdentifier($identifier)
    {
        $map = [
            'x-xss-protection' => \A3020\HttpHeaders\Header\XXssProtection::class,
            'strict-transport-security' => \A3020\HttpHeaders\Header\StrictTransportSecurity::class,
            'content-security-policy' => \A3020\HttpHeaders\Header\ContentSecurityPolicy::class,
            'referrer-policy' => \A3020\HttpHeaders\Header\ReferrerPolicy::class,
            'x-content-type-options' => \A3020\HttpHeaders\Header\XContentTypeOptions::class,
        ];

        if (array_key_exists($identifier, $map)) {
            if (class_exists($map[$identifier])) {
                return new $map[$identifier];
            }
        }

        return new DefaultHeader();
    }
}
