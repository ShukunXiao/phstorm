<?php
/**
 * Displays footer site info
 *
 * @subpackage Fitmeal Dietitian
 * @since 1.0
 * @version 1.4
 */

?>
<div class="site-info py-4 text-center">
    <?php
        echo esc_html( get_theme_mod( 'nutrition_diet_footer_text' ) );
        printf(
            /* translators: %s: Dietitian WordPress Theme. */
            esc_html__( ' %s ', 'fitmeal-dietitian' ),
            'Dietitian WordPress Theme'
        );
    ?>
</div>
