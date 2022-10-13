<?php
add_action('init', 'hotello_images_gallery_with_categories_VC');


function hotello_images_gallery_with_categories_VC()
{


    vc_map(array(
        'name' => esc_html__('Images Gallery With Categories', 'hotello'),
        'base' => 'stm_images_gallery_with_categories',
        'icon' => 'stmicon-post',
        'category' => array(
            esc_html__('Content', 'hotello'),
            esc_html__('hotel', 'hotello'),
        ),
        'description' => esc_html__('Images gallery grid with categories', 'hotello'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'hotello'),
                'param_name' => 'title'
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__('Images', 'hotello'),
                'param_name' => 'images',
                'value' => urlencode(json_encode(array(
                    array(
                        'label' => esc_html__('Images Category', 'hotello'),
                        'admin_label' => true
                    ),
                    array(
                        'label' => esc_html__('Select images', 'hotello'),
                        'admin_label' => false
                    ),
                ))),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Images category', 'hotello'),
                        'param_name' => 'category',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'attach_images',
                        'heading' => esc_html__('Select images', 'hotello'),
                        'param_name' => 'images_array',
                        'admin_label' => false,
                    ),
                ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Enable "Load more button"', 'hotello'),
                'param_name' => 'load_more_button',
                'std' => 'true'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Show number', 'hotello'),
                'param_name' => 'number',
                'std' => 9,
                'dependency' => array(
                    'element' => 'load_more_button',
                    'not_empty' => true
                )
            ),

            array(
                'type' => 'textfield',
                'heading' => esc_html__('Image size', 'hotello'),
                'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'hotello'),
                'param_name' => 'img_size',
                'value' => '350x240',
                'std' => '350x240'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom class', 'hotello'),
                'param_name' => 'custom_class',
                'std' => ''
            ),
            hotello_load_styles(1, 'style', true),
            vc_map_add_css_animation(),
            hotello_vc_add_css_editor_param(),
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Images_Gallery_With_Categories extends WPBakeryShortCode
    {
        public $style;
        public $img_size;
        public $css;
        public $css_animation;
        public $images_data;
        public $items;
        public $load_more;
        public $custom_class;

        public function __construct($settings)
        {
            parent::__construct($settings);
            $this->enqueue();
        }

        public function enqueue()
        {
            wp_enqueue_style('hotello-owl-carousel');
            wp_enqueue_script('hotello-owl-carousel');
            wp_enqueue_script('hotel_images_gallery_with_categories/gallery');
            wp_enqueue_script('lightgallery');
            wp_enqueue_style('lightgallery');
        }


        public function set_vars($atts)
        {
            $atts = vc_map_get_attributes($this->getShortcode(), $atts);
            $this->style = $atts['style'];
            $this->img_size = $atts['img_size'];
            $this->css = $atts['css'];
            $this->css_animation = $atts['css_animation'];
            $this->images_data = $atts['images'];
            $this->items = $atts['number'];
            $this->load_more = $atts['load_more_button'];
            $this->custom_class = $atts['custom_class'];

            hotello_add_element_style('images_gallery_with_categories', $this->style);
        }

        public function get_element_classes()
        {
            $classes = array('stm_images_gallery_with_categories');
            $classes[] = 'stm_images_gallery_with_categories_' . $this->style;
            $classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($this->css, ' '));
            $classes[] = $this->getCSSAnimation($this->css_animation);
            if (!empty($this->custom_class)) {
                $classes[] = $this->custom_class;
            }

            return $classes;
        }

        public function get_images_array()
        {
            $images = vc_param_group_parse_atts($this->images_data);

            return $images;
        }

        public function load_more_button($images_count)
        {
            if ($this->load_more && $images_count > $this->items) :
                ?>
                <button class="btn btn_outline btn_primary stm-load-more">
                    <?php esc_html_e('Show more', 'hotello'); ?>
                </button>
            <?php
            endif;
        }

        public function print_gallery()
        {
            $galleries_array = $this->get_images_array();
            $gallery_data = array(
                esc_html__('All photos', 'hotello') => array()
            );
            foreach ($galleries_array as $gallery_item) {
                $images = explode(',', $gallery_item['images_array']);
                array_splice($gallery_data[esc_html__('All photos', 'hotello')], count($gallery_data[esc_html__('All photos', 'hotello')]) - 1, 0, $images);
                if (!isset($gallery_data[$gallery_item['category']])) {
                    $gallery_data[$gallery_item['category']] = $images;
                } else {
                    array_push($gallery_data[$gallery_item['category']], $images);
                }
            }
            $gallery_data[esc_html__('All photos', 'hotello')] = array_values(array_unique($gallery_data[esc_html__('All photos', 'hotello')]));

            if (!empty(array_values($gallery_data))) :
                ?>

                <div class="<?php echo implode(' ', $this->get_element_classes()) ?>"
                     data-size="<?php echo esc_js($this->img_size); ?>"
                     data-number="<?php echo esc_js($this->items); ?>">
                    <div class="stm-images__categories">
                        <ul class="list-unstyled">
                            <?php $c = 0;
                            foreach ($gallery_data as $category => $images_ids) : ?>
                                <li class="stm-images__category" role="presentation">
                                    <a href="#<?php echo esc_attr(sanitize_html_class($category)); ?>"
                                       class="mbdc"
                                       aria-controls="<?php echo esc_attr(sanitize_html_class($category)); ?>"
                                       role="tab"
                                       data-toggle="tab">
                                        <?php echo wp_kses_post($category); ?>
                                    </a>
                                </li>
                                <?php $c++; endforeach; ?>
                        </ul>
                    </div>
                    <div class="stm-images__tabs tab-content">
                        <?php
                        $i = 0;
                        foreach ($gallery_data as $category => $images_ids) :
                            if (!empty($images_ids)) :

                                ?>
                                <div role="tabpanel"
                                     class="tab-pane stm-images__tab fade<?php echo esc_attr($i === 0 ? ' active in' : '') ?>"
                                     id="<?php echo esc_attr(sanitize_html_class($category)); ?>"
                                     data-load-more="<?php echo esc_js($this->load_more); ?>"
                                     data-page="1"
                                     data-images='<?php echo esc_js(implode(',', $images_ids)); ?>'>
                                    <div class="stm-images__container stm_lightgallery">

                                    </div>
                                    <?php $this->load_more_button(count($images_ids)); ?>
                                    <div class="stm-preloader mbc"></div>
                                </div>


                            <?php
                            endif;
                            $i++;
                        endforeach; ?>
                    </div>
                </div>
            <?php
            else:
                echo esc_html__('No images selected', 'hotello');
            endif;
        }
    }
}