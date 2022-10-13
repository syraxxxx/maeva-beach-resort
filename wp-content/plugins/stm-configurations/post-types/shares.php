<?php
function stm_get_image_url($id, $size = 'full')
{
	$url = '';
	if (!empty($id)) {
		$image = wp_get_attachment_image_src($id, $size, false);
		if (!empty($image[0])) {
			$url = $image[0];
		}
	}

	return $url;
}

function stm_get_shares()
{

	$link = get_the_permalink();
	$image = stm_get_image_url(get_post_thumbnail_id());

	$socials = array();

	$socials['facebook'] = "https://www.facebook.com/sharer/sharer.php?u={$link}";
	$socials['twitter'] = "https://twitter.com/home?status={$link}";
	$socials['google-plus'] = "https://plus.google.com/share?url={$link}";
	$socials['linkedin'] = "https://www.linkedin.com/shareArticle?mini=true&url={$link}&title=&summary=&source=";
	$socials['pinterest'] = "https://pinterest.com/pin/create/button/?url={$link}&media={$image}&description=";
	ob_start();
	?>

    <div class="stm_share stm_js__shareble">
		<?php foreach ($socials as $social => $url): ?>
            <a href="#"
               class="__icon icon_12px stm_share_<?php echo esc_attr($social); ?>"
               data-share="<?php echo esc_url($url); ?>"
               data-social="<?php echo esc_attr($social); ?>">
                <i class="fa fa-<?php echo esc_attr($social); ?>"></i>
            </a>
		<?php endforeach; ?>
    </div>

	<?php echo ob_get_clean();
}

function stm_get_ga_code()
{
	$options = get_option('stm_theme_options');
	$ga = !empty($options['ga']) ? $options['ga'] : false;
	if (!empty($ga)): ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga); ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '<?php echo esc_attr($ga); ?>');
        </script>
	<?php endif;
}