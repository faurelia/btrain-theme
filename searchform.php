<form class="form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
    <div class="form-group">
        <label for="search"><?php echo _x( 'Search for:', 'label', 'madtrain' ); ?></label>
        <input type="text" class="form-control" id="search" value="<?php get_search_query(); ?>" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" name="s">
    </div>
    <button type="submit" class="btn btn-warning">Search</button>
</form>
