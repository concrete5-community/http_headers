<?php

namespace Concrete\Package\HttpHeaders;

use A3020\HttpHeaders\Installer;
use A3020\HttpHeaders\Middleware\HttpHeadersMiddleware;
use Concrete\Core\Http\ServerInterface;
use Concrete\Core\Package\Package;

final class Controller extends Package
{
    protected $pkgHandle = 'http_headers';
    protected $appVersionRequired = '8.3.1';
    protected $pkgVersion = '1.0.1';
    protected $pkgAutoloaderRegistries = [
        'src/HttpHeaders' => '\A3020\HttpHeaders',
    ];

    public function getPackageName()
    {
        return t('HTTP Headers');
    }

    public function getPackageDescription()
    {
        return t('Lets you extend the HTTP response headers, for example to harden security.');
    }

    public function on_start()
    {
        $this->app->extend(ServerInterface::class, function(ServerInterface $server) {
            return $server->addMiddleware($this->app->make(HttpHeadersMiddleware::class));
        });
    }

    public function install()
    {
        $pkg = parent::install();

        /** @var Installer $installer */
        $installer = $this->app->make(Installer::class);
        $installer->install($pkg);
    }
}
