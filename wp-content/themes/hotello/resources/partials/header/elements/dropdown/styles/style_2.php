<?php
if (empty($element)) return;

if ($element['value'] == 'wpml') {
    $element['dropdown'] = hotello_get_wpml_langs();
}

$element_id = uniqid();

if (!empty($element['dropdown'])) {
    $dropdown = hotello_get_dropdown($element['dropdown']);
}

if (!empty($dropdown)): ?>
    <div class="dropdown here1">
        <?php if (!empty($dropdown['first'])): ?>
            <div class="dropdown-toggle"
                 id="<?php echo sanitize_text_field($element_id); ?>"
                 data-toggle="dropdown"
                 aria-haspopup="true"
                 aria-expanded="true" ]
                 type="button">
                <?php
                sprintf(esc_html__('%s', 'hotello'), $dropdown['first']['label']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($dropdown['others'])): ?>
            <ul class="dropdown-list tbc"
                aria-labelledby="<?php echo sanitize_text_field($element_id); ?>">
                <?php foreach ($dropdown['others'] as $key => $value): ?>
                    <li>
                        <a href="<?php echo esc_url($value['url']) ?>" class="stm-switcher__option">
                            <?php echo sprintf(esc_html__('%s', 'hotello'), $value['label']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
<?php endif; ?>