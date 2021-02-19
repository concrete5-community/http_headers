<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \A3020\HttpHeaders\Header\AbstractHeader $header */
/** @var string $extendedEdit */
?>
<div class="ccm-dashboard-content-inner">
    <form method="post" action="<?php echo $this->action('save'); ?>">
        <?php
        /** @var \Concrete\Core\Validation\CSRF\Token $token */
        echo $token->output('http_headers.edit');

        echo $form->hidden('identifier', $header->getIdentifier());
        ?>

        <div class="form-group">
            <?php
            echo $form->label('dummy', t('Name'));
            echo $form->text('dummy', $header->getName(), [
                'readonly' => 1,
                'disabled' => 1,
            ]);
            ?>
        </div>

        <div class="form-group">
            <label class="control-label launch-tooltip"
                   title="<?php echo t('Only enabled headers are added to the server response') ?>"
                   for="enabled">
                <?php
                echo $form->checkbox('enabled', 1, $header->isEnabled());
                ?>
                <?php echo t('Enabled'); ?>
            </label>
        </div>

        <?php
        // This loads an additional form depending on the type of header.
        $this->element($extendedEdit, [
            'form' => $form,
            'header' => $header,
        ], 'http_headers');
        ?>

        <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions">
                <a href="<?php echo $this->action(''); ?>" class="btn btn-default pull-left"><?php echo t('Cancel') ?></a>
                <?php
                echo $form->submit('submit', t('Save'), [
                    'class' => 'btn-primary pull-right'
                ]);
                ?>
            </div>
        </div>
    </form>
</div>
