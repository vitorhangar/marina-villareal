<?php
/**
 * Popup
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

?>

<div class="background-popup"></div>
<div class="popup">
    <div class="popup__header">
        <button class="popup__close-btn">
            <img src="<?= theme_url('public/images/svg/close.svg'); ?>" alt="close">
        </button>
    </div>
    <div class="popup__main">
        <div>
            <img src="<?= theme_url('public/images/svg/popup-key.svg'); ?>" alt="key">
        </div>
        <h3>Em breve estaremos <span>em operação</span>.</h3>
    </div>
</div>