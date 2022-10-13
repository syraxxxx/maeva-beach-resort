<!--Site global modals-->
<?php
$modals = array(
    'search',
);

foreach ($modals as $modal) {
    get_template_part('resources/partials/modals/' . $modal);
}