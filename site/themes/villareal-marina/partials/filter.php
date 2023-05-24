<?php
/**
 * Filter
 */

if( ! defined( 'WPINC' ) ) {
    header( 'Location: /' );
    exit;
}

?>

<section class="filter" id="filter">
    <div class="filter__box">
        <div class="container">
            <span class="icon-close">
                <svg>
                    <use xlink:href="<?= theme_url('public/sprite/sprite.svg#icon__close__filter'); ?>"/>
                </svg>
            </span>
            <span class="icon-open">
                <p>Reservar Agora</p>
            </span>
            <div class="filter__box__content">
                <div class="date" id="date-input">
                    <?php $date = date("d/m/Y"); ?>
                    <input name="checkin" placeholder="<?= $date; ?>" id="date-input-checkin" data-date="<?= $date; ?>" type="text" data-dd-format="d/m/Y" class="input left datedropper-init checkin">
                    <input name="checkout" placeholder="<?= $date; ?>" id="date-input-checkout"  data-date="" type="text" data-dd-format="d/m/Y" class="input right datedropper-init checkout">
                </div>
                <div class="select">
                    <select name="" id="adult">
                        <option value="">Adultos</option>
                        <option value="1">1 - Adulto</option>
                        <option value="2">2 - Adultos</option>
                        <option value="3">3 - Adultos</option>
                        <option value="4">4 - Adultos</option>
                    </select>
                    <select name="" id="children">
                        <option value="0">Crianças</option>
                        <option value="1">1 - Criança</option>
                        <option value="2">2 - Crianças</option>
                    </select>
                </div>
                <div class="box-age">
                    <input type="text" name="age-children" disabled class="age" id="age-children" placeholder="Idades">
                    <span class="mask-shadow"></span>
                    <div class="box-age__modal">
                        <div class="box-age__modal__one">
                            <label>Idade 1:</label>
                            <select name="" id="age-1">
                                <option value="0">--</option>
                                <?php for ($i=1; $i <= 17; $i++) : ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="box-age__modal__two">
                            <label>Idade 2:</label>
                            <select name="" id="age-2">
                                <option value="0">--</option>
                                <?php for ($i=1; $i <= 17; $i++) : ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="btn-ok">
                            <button>OK</button>
                        </div>
                    </div>
                </div>
                <a href="" target="_blank" class="click-reserva">Reservar Agora</a>
            </div>
        </div>
    </div>
</section>