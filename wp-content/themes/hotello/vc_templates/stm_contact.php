<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes = array('stm_contact');
$classes[] = 'stm_contact_' . $style;
$classes[] = (empty($name)) ? 'stm_contact_noname' : '';
hotello_add_element_style('contact', $style);

$image = hotello_get_VC_attachment_img_safe($image, $image_size);
$classes[] = (empty($name)) ? 'nameless' : 'named';
?>

<div class="<?php echo esc_attr(implode(' ', $classes)) ?>">
    <?php if( ! empty( $image ) ){ ?>
        <div class="stm_contact__image">
            <?php echo html_entity_decode( $image); ?>
        </div>
    <?php } ?>
    <div class="stm_contact__info">
        <h5 class="stm_contact__info__title no_line stm_mgb_5"><?php echo sanitize_text_field( $name ); ?></h5>
        <?php if( $job ){ ?>
            <div class="h6"><?php echo sanitize_text_field( $job ); ?></div>
        <?php } ?>
        <?php if( $phone ){ ?>
            <div class="stm_contact__row stm_contact__row_phone heading_font_family">
                <span><?php _e( 'Phone: ', 'hotello' ); ?></span><strong class="mtc"><?php echo sanitize_text_field( $phone ); ?></strong>
            </div>
        <?php } ?>
        <?php if( $email ){ ?>
            <div class="stm_contact__row stm_contact__row_email">
                <span><?php _e( 'Email: ', 'hotello' ); ?></span>
                <a href="mailto:<?php echo sanitize_text_field( $email ); ?>">
                    <?php echo sanitize_text_field( $email ); ?>
                </a>
            </div>
        <?php } ?>
        <?php if( $skype ){ ?>
            <div class="stm_contact__row stm_contact__row_skype">
                <span class="mtc"><?php _e( 'Skype: ', 'hotello' ); ?></span><?php echo sanitize_text_field( $skype ); ?>
            </div>
        <?php } ?>
    </div>
</div>
