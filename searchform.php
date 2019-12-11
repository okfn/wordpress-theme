<?php
//The default template for rendering the search form in the header, widgets
//and everywhere else.
?>
<form class="search-form" action="<?php esc_url( home_url() ); ?>/" method="get" role="search">
  <input type="text" name="s" class="search-bar_input" value="<?php the_search_query(); ?>" placeholder="<?php _e( 'Search...', 'okfnwp' ); ?>">
  <div class="search-bar_submit">
    <button type="submit" class="search-bar_button">
      <span class="icon-search"></span>
      <span class="sr-only"><?php esc_html_e( 'Submit', 'okfnwp' ); ?></span>
    </button>
  </div>
</form>
