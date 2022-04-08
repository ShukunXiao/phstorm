<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gamayun_01
 */
?>
<div class="w3-sidebar w3-theme-d5 w3-opacity-09 w3-animate-right" id="mySidebar" style="display:none";>
<aside id="secondary" class="widget-area">
        <?php 
                if( is_active_sidebar('sidebar-1') ) {
                        dynamic_sidebar('sidebar-1');
                } else {
                echo '<div class="sidebar-no widgets">' .esc_html__( 'No widgets are assigned to this sidebar. Go to your Dashboard > Widgets > Assign widgets to Sidebar', 'gamayun' ). '</div>';
                }
        ?>
</aside><!-- #secondary -->
        <button id="close-sidebar" class="w3-button w3-black w3-xxxlarge w3-display-topright"
            style="padding:0 12px; top:1em">
            <span class="icon-cross"></span>
</button>
        <!-- Content Navigation: -->

</div>
