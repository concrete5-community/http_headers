<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \A3020\HttpHeaders\Header\DefaultHeader $header */

// This is the form for simple headers that don't require
// specific configuration and just need a single text box.
?>
<div class="form-group">
    <?php
    echo $form->label('value', t('Value'));
    echo $form->text('value', $header->getValue(), [
        'autofocus' => 1,
    ]);
    ?>
</div>
