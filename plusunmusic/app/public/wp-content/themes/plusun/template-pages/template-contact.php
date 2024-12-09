<?php

/**
 * Template Name: Contact
 * Template Post Type: page
 */
get_header(); ?>

<main id="primary" class="site-main">

  <?php
  while (have_posts()) :
    the_post();
    $phone = get_field('phone');
  ?>
    <div class="contact-page bg-gradient-orange">
      <div class="contact">
        <div class="text-center pt-12">
          <h2 class="service-title between-plus beige inline-block">
            <?php the_title(); ?>
          </h2>
        </div>
        <div class="mt-12">
          <?php the_content(); ?>
        </div>
      </div>
    </div>

  <?php endwhile; ?>

</main>
