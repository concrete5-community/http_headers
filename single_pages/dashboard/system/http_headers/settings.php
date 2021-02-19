<?php

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Support\Facade\Url;

/** @var \Concrete\Core\Utility\Service\Text $text */
/** @var \A3020\HttpHeaders\Header\AbstractHeader[] $headers */
?>

<div class="ccm-dashboard-header-buttons btn-group">
    <a class="btn btn-default" href="<?php echo Url::to('/dashboard/system/http_headers/test') ?>">
        <?php echo t('Test') ?>
    </a>
</div>

<div class="ccm-dashboard-content-inner">
    <table class="table table-hover">
        <thead>
            <tr>
                <th style="width: 150px;"><?php echo t('Category'); ?></th>
                <th style="min-width: 200px;"><?php echo t('Header'); ?></th>
                <th><?php echo t('Value'); ?></th>
                <th style="width: 120px"><?php echo t('Status'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($headers as $header) {
                ?>
                <tr>
                    <td>
                        <?php
                        echo h($header->getCategory());
                        ?>
                    </td>
                    <td>
                        <a href="<?php echo $this->action('edit', $header->getIdentifier()) ?>">
                            <?php
                            echo h($header->getName());
                            ?>
                        </a>
                    </td>
                    <td>
                        <?php
                        if ($header->isEnabled()) {
                            echo h($text->shorten($header->getComputedValue(), 150));
                        }
                        ?>
                    </td>
                    <td>
                        <span class="label label-<?php echo $header->isEnabled() ? 'success' : 'danger' ?>">
                            <?php
                            echo $header->isEnabled()
                                ? '<i class="fa fa-check"></i> ' . t('Enabled')
                                : '<i class="fa fa-close"></i> ' . t('Disabled');
                            ?>
                        </span>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

