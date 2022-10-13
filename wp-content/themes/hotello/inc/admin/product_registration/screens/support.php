<?php

// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}

$theme = hotello_get_theme_info();
$theme_name = $theme['name'];
?>
<div class="wrap about-wrap stm-admin-wrap  stm-admin-support-screen">
    <?php hotello_get_admin_tabs('support'); ?>
    <div class="stm-admin-important-notice">

        <p class="about-description"><?php printf(wp_kses_post(__('%s comes with 6 months of free support for every license you purchase. Support can be extended through subscriptions via ThemeForest.', 'hotello')), $theme_name); ?></p>
        <p><a href="<?php echo esc_url(hotello_theme_support_url() . 'support/'); ?>"
              class="button button-large button-primary stm-admin-button stm-admin-large-button" target="_blank"
              rel="noopener noreferrer"><?php esc_attr_e('Create A Support Account', 'hotello'); ?></a></p>
    </div>

    <div class="stm-admin-row">
        <div class="stm-admin-two-third">

            <div class="stm-admin-row">

                <div class="stm-admin-one-half">
                    <div class="stm-admin-one-half-inner">
                        <h3>
							<span>
								<img src="<?php echo esc_url(hotello_get_admin_images_url('ticket.svg')); ?>"/>
							</span>
                            <?php _e('Ticket System', 'hotello'); ?>
                        </h3>
                        <p>
                            <?php _e('We offer excellent support through our advanced ticket system. Make sure to register your purchase first to access our support services and other resources.', 'hotello'); ?>
                        </p>
                        <a href="<?php echo esc_url(hotello_theme_support_url() . 'support/'); ?>" target="_blank">
                            <?php esc_html_e('Submit a ticket', 'hotello'); ?>
                        </a>
                    </div>
                </div>

                <div class="stm-admin-one-half">
                    <div class="stm-admin-one-half-inner">
                        <h3>
							<span>
								<img src="<?php echo esc_url(hotello_get_admin_images_url('docs.svg')); ?>"/>
							</span>
                            <?php _e('Documentation', 'hotello'); ?>
                        </h3>
                        <p>
                            <?php printf(wp_kses_post(__('Our online documentaiton is a useful resource for learning the every aspect and features of %s.', 'hotello')), $theme_name); ?>
                        </p>
                        <a href="<?php echo esc_url(hotello_theme_support_url() . 'manuals/hotello/'); ?>" target="_blank">
                            <?php esc_html_e('Learn more', 'hotello'); ?>
                        </a>
                    </div>
                </div>
            </div>

            <div class="stm-admin-row">

                <div class="stm-admin-one-half">
                    <div class="stm-admin-one-half-inner">
                        <h3>
							<span>
								<img src="<?php echo esc_url(hotello_get_admin_images_url('tutorials.svg')); ?>"/>
							</span>
                            <?php _e('Video Tutorials', 'hotello'); ?>
                        </h3>
                        <p>
                            <?php printf(wp_kses_post(__('We recommend you to watch video tutorials before you start the theme customization. Our video tutorials can teach you the different aspects of using %s.', 'hotello')), $theme_name); ?>
                        </p>
                        <a href="https://www.youtube.com/watch?v=T4fq1HBDnk4&feature=youtu.be" target="_blank">
                            <?php esc_html_e('Watch Videos', 'hotello'); ?>
                        </a>
                    </div>
                </div>

                <div class="stm-admin-one-half">
                    <div class="stm-admin-one-half-inner">
                        <h3>
							<span>
								<img src="<?php echo esc_url(hotello_get_admin_images_url('forum.svg')); ?>"/>
							</span>
                            <?php _e('Community Forum', 'hotello'); ?>
                        </h3>
                        <p>
                            <?php printf(wp_kses_post(__('Our forum is the best place for user to user interactions. Ask another %s user or share your experience with the community to help others.', 'hotello')), $theme_name); ?>
                        </p>
                        <a href="<?php echo esc_url(hotello_theme_support_url() . 'forums/'); ?>" target="_blank">
                            <?php esc_html_e('Visit Our Forum', 'hotello'); ?>
                        </a>
                    </div>
                </div>

            </div>

        </div>

        <div class="stm-admin-one-third">
            <a href="https://stylemix.net/?utm_source=dashboard&utm_medium=banner&utm_campaign=hotelwp" target="_blank">
                <img src="<?php echo esc_url(hotello_get_admin_images_url('banner-1.png')); ?>"/>
            </a>
        </div>
    </div>

</div>