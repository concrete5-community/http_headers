<?php

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Support\Facade\Url;

/** @var \Zend\Http\Headers|null $headers */
?>
<div class="ccm-dashboard-header-buttons btn-group">
    <a class="btn btn-default" href="<?php echo Url::to('/dashboard/system/http_headers/settings') ?>">
        <?php echo t('Settings') ?>
    </a>
</div>

<div class="ccm-dashboard-content-inner">
    <form method="post" action="<?php echo $this->action('runTest') ?>">
        <?php
        /** @var \Concrete\Core\Validation\CSRF\Token $token */
        echo $token->output('http_headers.test');
        ?>


        <div class="form-group">
            <label class="control-label launch-tooltip"
               title="<?php echo t('By default the login page is requested because full page caching should be disabled for that page.') ?>"
               for="url">
                <?php
                echo t('URL');
                ?>
            </label>
            <?php
            echo $form->text('url', Url::to('/login'), [
                'autofocus' => 1,
            ]);
            ?>
        </div>

         <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions">
                <?php
                echo $form->submit('submit', t('Test'), [
                    'class' => 'btn-primary pull-right'
                ]);
                ?>
            </div>
        </div>
    </form>

    <?php
    if (isset($headers)) {
        ?>
        <table class="table table-hover">
            <?php
            foreach ($headers as $header) {
                ?>
                <tr>
                    <td>
                        <?php
                        echo h($header->getFieldName());
                        ?>
                    </td>
                    <td>
                        <?php
                        echo h($header->getFieldValue());
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    ?>
</div>
