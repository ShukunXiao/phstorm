<?php 

	/*---------------------------Width -------------------*/

	$nutrition_diet_custom_style= "";
	
	$nutrition_diet_theme_width = get_theme_mod( 'nutrition_diet_width_options','full_width');

    if($nutrition_diet_theme_width == 'full_width'){

		$nutrition_diet_custom_style .='body{';

			$nutrition_diet_custom_style .='max-width: 100%;';

		$nutrition_diet_custom_style .='}';

	}else if($nutrition_diet_theme_width == 'container'){

		$nutrition_diet_custom_style .='body{';

			$nutrition_diet_custom_style .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';

		$nutrition_diet_custom_style .='}';

	}else if($nutrition_diet_theme_width == 'container_fluid'){

		$nutrition_diet_custom_style .='body{';

			$nutrition_diet_custom_style .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';

		$nutrition_diet_custom_style .='}';
	}

	/*----------------------------------------------*/

	$nutrition_diet_sticky_header = get_theme_mod('nutrition_diet_sticky_header');

	if($nutrition_diet_sticky_header != true){

		$nutrition_diet_custom_style .='.menu_header.fixed{';

			$nutrition_diet_custom_style .='position: static;';
			
		$nutrition_diet_custom_style .='}';
	}

	/*---------------------------Scroll-top-position -------------------*/
	
	$nutrition_diet_scroll_options = get_theme_mod( 'nutrition_diet_scroll_options','right_align');

    if($nutrition_diet_scroll_options == 'right_align'){

		$nutrition_diet_custom_style .='.scroll-top button{';

			$nutrition_diet_custom_style .='';

		$nutrition_diet_custom_style .='}';

	}else if($nutrition_diet_scroll_options == 'center_align'){

		$nutrition_diet_custom_style .='.scroll-top button{';

			$nutrition_diet_custom_style .='right: 0; left:0; margin: 0 auto; top:85% !important';

		$nutrition_diet_custom_style .='}';

	}else if($nutrition_diet_scroll_options == 'left_align'){

		$nutrition_diet_custom_style .='.scroll-top button{';

			$nutrition_diet_custom_style .='right: auto; left:5%; margin: 0 auto';

		$nutrition_diet_custom_style .='}';
	}

	//------------------------------------------------------------------------------

	$nutrition_diet_logo_max_height = get_theme_mod('nutrition_diet_logo_max_height');

	if($nutrition_diet_logo_max_height != false){

		$nutrition_diet_custom_style .='.custom-logo-link img{';

			$nutrition_diet_custom_style .='max-height: '.esc_html($nutrition_diet_logo_max_height).'px;';
			
		$nutrition_diet_custom_style .='}';
	}