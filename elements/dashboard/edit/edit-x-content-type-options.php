<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \A3020\HttpHeaders\Header\XXssProtection $header */
?>
<div class="form-group">
    <?php
    echo $form->label('value', t('Value'));
    echo $form->text('value', 'nosniff', [
        'readonly' => 1,
    ]);
    ?>
</div>

<div class="text-muted" style="margin-top: 30px; border-top: 1px solid #ccc; padding-top: 20px;">
    <i class="fa fa-question-circle"></i>
    <?php
    echo t('Prevents Internet Explorer and Google Chrome from MIME-sniffing a response away from the declared content-type. This also applies to Google Chrome, when downloading extensions. This reduces exposure to drive-by download attacks and sites serving user uploaded content that, by clever naming, could be treated by MSIE as executable or dynamic HTML files.');
    ?>
</div>
