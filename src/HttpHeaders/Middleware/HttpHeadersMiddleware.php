<?php

namespace A3020\HttpHeaders\Middleware;

use A3020\HttpHeaders\HeaderList;
use Concrete\Core\Config\Repository\Repository;
use Concrete\Core\Http\Middleware\DelegateInterface;
use Concrete\Core\Http\Middleware\MiddlewareInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HttpHeadersMiddleware implements MiddlewareInterface
{
    /**
     * @var \Concrete\Core\Config\Repository\Repository
     */
    private $config;

    /**
     * @var \A3020\HttpHeaders\HeaderList
     */
    private $headerList;

    public function __construct(Repository $config, HeaderList $headerList)
    {
        $this->config = $config;
        $this->headerList = $headerList;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Concrete\Core\Http\Middleware\DelegateInterface $frame
     *
     * @return Response
     */
    public function process(Request $request, DelegateInterface $frame)
    {
        $response = $frame->next($request);

        $this->applyResponseHeaders($response);

        return $response;
    }

    /**
     * @param Response $response
     */
    private function applyResponseHeaders($response)
    {
        // Loop through all headers from the config.
        foreach ($this->headerList->getAll() as $header) {
            // Skip headers that are not enabled.
            if (!$header->isEnabled()) {
                continue;
            }

            $computedValue = $header->getComputedValue();

            // Skip headers that are not configured correctly.
            if ($computedValue === null) {
                continue;
            }

            // Skip headers that already exist.
            if ($response->headers->has($header->getName())) {
                continue;
            }

            $response->headers->set($header->getName(), $computedValue);
        }
    }
}
