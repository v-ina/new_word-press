<?php

/**
 * Template Name: Accueil
 * Template Post Type: page
 */
get_header();
?>

<main id="primary" class="site-main scrollable-sections">
  <?php while (have_posts()) : the_post(); ?>
    <!-- Section 1 : Heading -->
    <?php
    if (have_rows('section-heading')):
      while (have_rows('section-heading')): the_row();

        $heading_data = array(
          'intro' => get_sub_field('intro'),
          'title_items' => get_sub_field('title_items'),
          'subtitle' => get_sub_field('subtitle'),
          'action_text' => get_sub_field('action_text')
        );
        get_template_part('template-parts/homepage', 'heading', $heading_data);

      endwhile;
    endif;
    ?>



    <!-- Section 2 : Services -->
    <?php
    if (have_rows('section-services')):
      while (have_rows('section-services')): the_row();

        $encart_1 = get_sub_field('encart_1');
        $encart_2 = get_sub_field('encart_2');
        $inserts = [$encart_1, $encart_2];
        get_template_part('template-parts/services', 'split', array('inserts' => $inserts));

      endwhile;
    endif; ?>

    <!-- Section 3 : Service details section -->
    <?php
    if (have_rows('section-service-details')):
      while (have_rows('section-service-details')): the_row();

        $services = get_sub_field('service');
        get_template_part('template-parts/services', 'wheel', array('services' => $services));

      endwhile;
    endif;
    ?>

    <!-- Section 4 : Player -->
    <section class="header-darked section-full navigable bg-gradient-black pt-[66px]">
      <div class="min-h-[100vh] flex flex-col justify-center">
        <d class="max-w-[900px] flex flex-col items-center justify-center mx-auto">
          <h2 class="service-title between-plus beige inline-block text-center">
            Publishing
          </h2>
          <p class="text-center text-white">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam.Lorem ipsum dolor sit amet, consectetur adipiscing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
          </p>
          <div id="player" class="w-[700px] my-12">
            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/0GfOPX6i7ZH9UUGJq7X2fy?utm_source=generator&theme=0" width="100%" height="400" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
          </div>
        </d>
      </div>
    </section>

    <!-- Section 5 : Partenaires -->
    <?php

    if (have_rows('section-partners')):
      while (have_rows('section-partners')): the_row();
        $partners_data = array(
          'title' => get_sub_field('title'),
          'partners' => get_sub_field('partners')
        );

        get_template_part('template-parts/partners', 'logos', $partners_data);
      endwhile;
    endif;
    ?>


    <!-- Section 5 : Footer -->
    <section class="navigable bg-gradient-black pt-[66px]" id="footer-section">
      <?php get_footer(); ?>
    </section>

  <?php endwhile; ?>

  <!-- Activate stop scroll -->
  <?php get_template_part('template-parts/utils', 'stopscroll'); ?>
</main>