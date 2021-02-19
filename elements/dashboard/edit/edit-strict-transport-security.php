<?php

defined('C5_EXECUTE') or die('Access Denied.');

/** @var \A3020\HttpHeaders\Header\StrictTransportSecurity $header */
?>
<div class="alert alert-warning"><?php echo t('For advanced users! Make sure you know what these settings mean before changing them.'); ?></div>

<div class="form-group">
    <?php
    echo $form->label('max_age', t('Max age'));
    echo $form->select('max_age', [
        '0' => '0 ' . t('Delete entire HSTS Policy'),
        '3600' => t('1 hour'),
        '86400' => t('1 day'),
        '604800' => t('7 days'),
        '2592000' => t('30 days'),
        '7776000' => t('90 days'),
        '31536000' => t('1 year'),
        '63072000' => t('2 years'),
    ], $header->getMaxAge());
    ?>
</div>

<div class="form-group">
    <label class="control-label" for="include_sub_domains">
        <?php
        echo $form->checkbox('include_sub_domains', 1, $header->isIncludeSubDomains());
        ?>
        <?php echo t('Include sub domains'); ?>
    </label>
</div>

<div class="form-group">
    <label class="control-label" for="preload">
        <?php
        echo $form->checkbox('preload', 1, $header->isPreload());
        ?>
        <?php echo t('Preload (be cautious!)') ?>
    </label>
</div>

<div class="text-muted" style="margin-top: 30px; border-top: 1px solid #ccc; padding-top: 20px;">
    <i class="fa fa-question-circle"></i>
    <?php
    echo t('HTTP Strict-Transport-Security (HSTS) enforces secure (HTTP over SSL/TLS) connections to the server. This reduces impact of bugs in web applications leaking session data through cookies and external links and defends against Man-in-the-middle attacks. HSTS also disables the ability for user\'s to ignore SSL negotiation warnings.') . ' ';
    echo t('Visit <a href="%s" target="_blank">OWASP</a> and <a href="%s" target="_blank">hstspreload.org</a> for more information.', 'https://github.com/OWASP/CheatSheetSeries/blob/master/cheatsheets/HTTP_Strict_Transport_Security_Cheat_Sheet.md', 'https://hstspreload.org');
    ?>
</div>
