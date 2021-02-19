<?php

namespace A3020\HttpHeaders;

use A3020\HttpHeaders\Header\AbstractHeader;
use Concrete\Core\Config\Repository\Repository;

class StoreHeader
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
     * Stores a header to the config file.
     *
     * @param \A3020\HttpHeaders\Header\AbstractHeader $header
     */
    public function store(AbstractHeader $header)
    {
        $headers = $this->config->get('http_headers::headers');

        $headers[$header->getIdentifier()] = $header->toArray();

        $this->config->save('http_headers::headers', $headers);
    }
}
