<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \A3020\HttpHeaders\Header\ContentSecurityPolicy $header */
?>
<div class="alert alert-warning"><?php echo t('For advanced users! Make sure you know what these settings mean before changing them.'); ?></div>

<div class="form-group">
    <?php
    echo $form->label('value', t('Value'));
    echo $form->textarea('value', $header->getValue(), [
        'autofocus' => 1,
    ]);
    ?>
</div>

<div class="text-muted" style="margin-top: 30px; border-top: 1px solid #ccc; padding-top: 20px;">
    <i class="fa fa-question-circle"></i>
    <?php
    echo t('Content Security Policy is an effective measure to protect your site from XSS attacks. By whitelisting sources of approved content, you can prevent the browser from loading malicious assets.') .' ';
    echo t('You can use <a href="%s" target="_blank">report-uri.com</a> or <a href="%s" target="_blank">cspisawesome.com</a> to generate a CSP.', 'https://report-uri.com/home/generate', 'https://www.cspisawesome.com');
    ?>
</div>
