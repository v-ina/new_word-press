<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PlusUn_Music
 */
// plusun_post_thumbnail();
?>

<article id="post-<?php the_ID(); ?>">
	<div class="min-h-[100vh] bg-gradient-black pt-24">
		<div class="max-w-[1024px] mx-auto">

			<h2 class="text-center mt-12">
				<?php
				get_template_part('template-parts/title', 'bars', array(
					'title' => get_the_title(),
					'color' => 'beige'
				));
				?>
			</h2>

			<div class="content-beige mt-12">
				<?php
				the_content();
				?>
			</div>
		</div><!-- .entry-content -->
	</div>

</article><!-- #post-<?php the_ID(); ?> -->