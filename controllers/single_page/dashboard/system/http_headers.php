<?php

namespace Concrete\Package\HttpHeaders\Controller\SinglePage\Dashboard\System;

use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Routing\Redirect;

final class HttpHeaders extends DashboardPageController
{
    public function view()
    {
        return Redirect::to('/dashboard/system/http_headers/settings');
    }
}
