<?php
/**
 * The sidebar containing the main footer widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lyndascore
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
    return;
}
?>

<div id="secondary" class="widget-area footer-widgets" role="complementary">
    <?php dynamic_sidebar( 'sidebar-2' ); ?>
</div><!-- #secondary -->