<?php

namespace A3020\HttpHeaders;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Single;

final class Installer implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    /**
     * @param \Concrete\Core\Package\Package $pkg
     */
    public function install($pkg)
    {
        $this->dashboardPages($pkg);
    }

    private function dashboardPages($pkg)
    {
        $pages = [
            '/dashboard/system/http_headers' => 'HTTP Headers',
            '/dashboard/system/http_headers/settings' => 'Settings',
            '/dashboard/system/http_headers/test' => 'Test',
        ];

        foreach ($pages as $path => $name) {
            /** @var Page $page */
            $page = Page::getByPath($path);
            if ($page && !$page->isError()) {
                continue;
            }

            $singlePage = Single::add($path, $pkg);
            $singlePage->update([
                'cName' => $name,
            ]);
        }
    }
}
