<?php

namespace Concrete\Package\HttpHeaders\Controller\SinglePage\Dashboard\System\HttpHeaders;

use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Routing\Redirect;

final class Test extends DashboardPageController
{
    public function on_before_render()
    {
        parent::on_before_render();

        $this->set('pageTitle', t('Test response headers'));
    }
    
    public function runTest()
    {
        if (!$this->token->validate('http_headers.test')) {
            $this->flash('error', $this->token->getErrorMessage());

            return Redirect::to($this->action(''));
        }
        
        /** @var \Concrete\Core\Http\Client\Client $client */
        $client = $this->app->make('http/client');

        $client->setUri($this->request->request->get('url'));

        $response = $client->send();

        $this->set('headers', $response->getHeaders());
    }
}
