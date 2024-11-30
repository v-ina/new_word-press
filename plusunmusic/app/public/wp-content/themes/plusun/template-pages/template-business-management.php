<?php

/**
 * Template Name: Business Management
 * Template Post Type: page
 */
get_header(); ?>

<main id="primary" class="site-main scrollable-sections">
  <?php while (have_posts()) : the_post(); ?>

    <!-- Section 1 : Intro -->
    <section class="business-content section-full navigable bg-gradient-black">
  <div class="max-w-[950px] mx-auto text-center fade-in">
    <h2 class="text-center">
      <?php
      get_template_part('template-parts/title', 'bars', array(
        'title' => get_the_title(),
        'color' => 'beige'
      ));
      ?>
    </h2>
    <div class="content-beige">
      <?php the_content(); ?>
    </div>
    <div class="mt-12">
      <a href="/contact" class="btn btn-white">+ En savoir plus +</a>
    </div>
  </div>
</section>


    <!-- Section 2 : Service details section -->
    <?php
    if (have_rows('section-service-details')):
      while (have_rows('section-service-details')): the_row();

        $services = get_sub_field('service');
        get_template_part('template-parts/services', 'wheel', array('services' => $services));

      endwhile;
    endif;
    ?>

    <!-- Section 3 : Service details section -->
    <?php
    if (have_rows('artists')):
      $artists = array();
      while (have_rows('artists')) : the_row();
        $artists[] = array(
          'cover' => get_sub_field('cover')
        );
      endwhile;

      get_template_part('template-parts/artists', 'carousel', array('artists' => $artists));
    endif;
    ?>

    <!-- Section 4 : Partenaires -->
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

<style>
  .business-content {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .partners {
    overflow: hidden;
  }

  .partners__line {
    will-change: transform;
    white-space: nowrap;
    gap: 96px !important;
  }

  .partners__line img {
    user-select: none;
    -webkit-user-drag: none;
  }

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-40px); 
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.fade-in {
  opacity: 0;
  transition: opacity 0.5s ease, transform 0.5s ease;
  animation: fadeIn 1.5s ease-out forwards; 
}

</style>


<!-- <?php get_footer(); ?> -->