<?php

/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package PlusUn_Music
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses plusun_header_style()
 */
function plusun_custom_header_setup()
{
  add_theme_support(
    'custom-header',
    apply_filters(
      'plusun_custom_header_args',
      array(
        'default-image'      => '',
        'default-text-color' => '000000',
        'width'              => 1000,
        'height'             => 250,
        'flex-height'        => true,
        'wp-head-callback'   => 'plusun_header_style',
      )
    )
  );
}
add_action('after_setup_theme', 'plusun_custom_header_setup');

if (! function_exists('plusun_header_style')) :
  /**
   * Styles the header image and text displayed on the blog.
   *
   * @see plusun_custom_header_setup().
   */
  function plusun_header_style()
  {
    $header_text_color = get_header_textcolor();

    /*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
    if (get_theme_support('custom-header', 'default-text-color') === $header_text_color) {
      return;
    }

    // If we get this far, we have custom styles. Let's do this.
?>

<?php
  }
endif;
