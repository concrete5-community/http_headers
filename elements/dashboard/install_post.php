<?php

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Support\Facade\Url;
?>
<p><?php echo t('Congratulations, the add-on has been installed!'); ?></p>
<br>

<a class="btn btn-primary" href="<?php echo Url::to('/dashboard/system/http_headers') ?>">
    <?php
    echo t('Open %s', t('HTTP Headers'));
    ?>
</a>
