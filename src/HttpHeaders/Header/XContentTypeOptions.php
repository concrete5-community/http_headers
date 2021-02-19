<?php

namespace A3020\HttpHeaders\Header;

class XContentTypeOptions extends DefaultHeader
{
    protected $name = 'X-Content-Type-Options';
    protected $category = 'Security';

    /**
     * @return string
     */
    public function getValue()
    {
        // There's only one valid value for this header.
        return 'nosniff';
    }
}
