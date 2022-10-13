<?php
function hotello_theme_options()
{ ?>
    <div class="stm-theme-options-admin-wrapper">
        <?php hotello_output_vars(); ?>
        <div ng-app="theme_options">
            <app-root></app-root>
        </div>
    </div>
<?php }

function hotello_theme_options_export()
{ ?>
    <div class="stm_export_settings">
        <a href="<?php echo esc_url(add_query_arg('export_settings', '1', '?page=hotel-theme-options-export')); ?>"
           class="button button-primary">
            <?php esc_html_e('Get my settings', 'hotello'); ?>
        </a>
    </div>
<?php }

/*Export settings*/
function hotello_export_settings()
{
    if (!empty($_GET['export_settings'])) {
        $options = get_option('stm_theme_options');

        header('Content-disposition: attachment; filename=file.json');
        header('Content-type: application/json');
        echo json_encode($options);
        exit();
    }
}

add_action('init', 'hotello_export_settings');



