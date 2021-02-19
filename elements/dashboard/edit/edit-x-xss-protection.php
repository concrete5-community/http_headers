<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \A3020\HttpHeaders\Header\XXssProtection $header */
?>
<div class="form-group">
    <?php
    echo $form->label('value', t('Value'));
    echo $form->select('value', [
        '0' => 0,
        '1' => 1,
        '1; mode=block' => '1; mode=block',
        '1; report=' => '1; report=',
    ], $header->getValue());
    ?>
</div>

<div class="form-group report-uri hide">
    <?php
    echo $form->label('report_uri', t('Report URI'));
    echo $form->text('report_uri', $header->getReportUri());
    ?>
</div>

<div class="text-muted" style="margin-top: 30px; border-top: 1px solid #ccc; padding-top: 20px;">
    <i class="fa fa-question-circle"></i>
    <?php
    echo t('This header is used to configure the built in reflective XSS protection found in Internet Explorer, Chrome and Safari (Webkit). Valid settings for the header are 0, which disables the protection, 1 which enables the protection and 1; mode=block which tells the browser to block the response if it detects an attack rather than sanitising the script.') .' ';
    echo t('Visit <a href="%s">mozilla.org</a> and <a href="%s" target="_blank">blog.innerht.ml</a> for more information.', 'https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-XSS-Protection', 'https://blog.innerht.ml/the-misunderstood-x-xss-protection/');
    ?>
</div>

<script>
$(document).ready(function() {
    $('#value').change(function() {
        $('.report-uri').toggleClass('hide', $('#value').val() !== '1; report=');
    }).trigger('change');
});
</script>
