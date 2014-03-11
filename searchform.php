<?php
/**
 * The template for displaying search forms in Product Pulse
 *
 * @package Product Pulse
 */

$GLOBALS['pulse_search_id_int'] = (isset($GLOBALS['pulse_search_id_int']) ? $GLOBALS['pulse_search_id_int'] + 1 : 0);
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-<?php echo $GLOBALS['pulse_search_id_int']; ?>">
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'product-pulse' ); ?></span>
    </label>
    <div class="form-inner">
        <input id="search-<?php echo $GLOBALS['pulse_search_id_int']; ?>" type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'product-pulse' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
        <span class="submit"><button type="submit" class="search-submit"><span class="glyphicon glyphicon-search"></span></button></span>
    </div>
</form>
