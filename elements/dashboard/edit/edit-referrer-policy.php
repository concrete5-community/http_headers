<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \A3020\HttpHeaders\Header\DefaultHeader $header */
?>
<div class="form-group">
    <?php
    echo $form->label('value', t('Value'));

    $options = [
        'no-referrer',
        'no-referrer-when-downgrade',
        'same-origin',
        'origin',
        'strict-origin',
        'origin-when-cross-origin',
        'strict-origin-when-cross-origin',
        'unsafe-url',
    ];

    $options = array_combine($options, $options);
    $options = ['' => t('Empty string')] + $options;

    echo $form->select('value', $options, $header->getValue());
    ?>
</div>

<div class="text-muted" style="margin-top: 30px; border-top: 1px solid #ccc; padding-top: 20px;">
    <i class="fa fa-question-circle"></i>
    <?php
    echo t('The Referrer-Policy HTTP header governs which referrer information, sent in the Referer header, should be included with requests made. See <a href="%s" target="_blank">mozilla.org</a> and <a href="%s">scotthelme.co.uk</a> for more information.', 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Referrer-Policy', 'https://scotthelme.co.uk/a-new-security-header-referrer-policy/');
    ?>
</div>
