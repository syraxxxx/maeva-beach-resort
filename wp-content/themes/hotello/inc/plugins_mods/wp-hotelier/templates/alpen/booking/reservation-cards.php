<?php
if ($cards) : ?>
    <div id="reservation-cards" class="booking__section booking__section--cards">
        <header class="section-header">
            <h3 class="section-header__title"><?php esc_html_e('Accepted credit cards', 'hotello'); ?></h3>
        </header>
        <ul class="credit-cards__list">
            <?php foreach ($cards as $card) : ?>
                <li class="credit-cards__icon credit-cards__icon--<?php echo esc_attr($card); ?>"><?php echo esc_html(ucfirst($card)); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>


