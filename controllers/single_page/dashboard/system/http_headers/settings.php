<?php

namespace Concrete\Package\HttpHeaders\Controller\SinglePage\Dashboard\System\HttpHeaders;

use A3020\HttpHeaders\HeaderList;
use A3020\HttpHeaders\StoreHeader;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Routing\Redirect;

final class Settings extends DashboardPageController
{
    protected $helpers = ['form', 'text'];

    public function view()
    {
        $this->set('pageTitle', t('HTTP Headers'));
        $this->set('headers', $this->getHeaderList()->getAll());
    }

    public function edit($identifier)
    {
        $header = $this->getHeaderList()->getByIdentifier($identifier);
        if (!$header) {
            $this->flash('error', t("This item doesn't exist (anymore)."));

            return $this->action('view');
        }

        // Check if there is a special edit template for this header.
        $extendedEdit = 'dashboard/edit/edit-default';
        if (file_exists(DIR_PACKAGES . '/http_headers/elements/dashboard/edit/edit-' . $header->getIdentifier() . '.php')) {
            $extendedEdit = 'dashboard/edit/edit-' . $header->getIdentifier();
        }

        $this->set('header', $header);
        $this->set('extendedEdit', $extendedEdit);

        $this->render('/dashboard/system/http_headers/settings/edit');
    }

    public function save()
    {
        if (!$this->token->validate('http_headers.edit')) {
            $this->flash('error', $this->token->getErrorMessage());

            return Redirect::to($this->action(''));
        }

        $header = $this->getHeaderList()->getByIdentifier($this->request->request->get('identifier'));
        if (!$header) {
            $this->flash('error', t("This item doesn't exist (anymore)."));

            return $this->action('view');
        }

        if ($this->request->request->has('name')) {
            $header->setName($this->request->request->get('name'));
        }

        $post = $this->request->request->all();
        $post['name'] = $header->getName();

        $newHeader = $this->getHeaderList()->getInstanceByIdentifier($this->request->request->get('identifier'));
        $newHeader->fromPost($post);

        $this->getStoreHeader()->store($newHeader);

        $this->flash('success', t('Your settings have been saved.'));

        return Redirect::to($this->action('view'));
    }

    /**
     * @return \A3020\HttpHeaders\HeaderList
     */
    private function getHeaderList()
    {
        return $this->app->make(HeaderList::class);
    }

    /**
     * @return \A3020\HttpHeaders\StoreHeader
     */
    private function getStoreHeader()
    {
        return $this->app->make(StoreHeader::class);
    }
}
