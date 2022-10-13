<form role="search"
      method="get"
      class="search-form"
      action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search"
           class="form-control"
           placeholder="<?php esc_attr_e('Search...', 'hotello'); ?>"
           value="<?php echo get_search_query(); ?>"
           name="s"/>
    <button type="submit" class="ttc mtc_h"><i class="fa fa-search"></i></button>
</form>