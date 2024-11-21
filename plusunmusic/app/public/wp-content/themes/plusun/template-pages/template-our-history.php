<?php

/**
 * Template Name: Notre histoire
 * Template Post Type: page
 */
get_header(); ?>

<main id="primary" class="site-main">

  <?php
  while (have_posts()) :
    the_post();

  ?>

    <div class="bg-gradient-gray">

      <!-- Intro section -->
      <section class="section-full flex flex-col justify-center items-center">
        <div class="content">
          <h2 class="text-center">
            <?php
            get_template_part('template-parts/title', 'bars', array(
              'title' => get_the_title(),
              'color' => 'beige'
            ));
            ?>
          </h2>


          <div class="max-w-[900px] mx-auto mt-24 text-center content-beige">
            <?php the_content(); ?>
          </div>
        </div>
      </section>

      <!-- Timeline section -->
      <section class="timeline">
        <div class="timeline__line"></div>

        <?php
        // Get all date blocks from the repeater field
        $date_blocks = array();

        if (have_rows('date_blocks')):
          while (have_rows('date_blocks')) : the_row();
            $date_blocks[] = array(
              'year' => get_sub_field('year'),
              'description' => get_sub_field('description')
            );
          endwhile;
        endif;

        // Pass the date blocks to the template part
        get_template_part('template-parts/history', 'timeline', array(
          'date_blocks' => $date_blocks
        ));
        ?>
      </section>

      <!-- Values section -->
      <section>
      </section>
    </div>
  <?php endwhile; ?>

</main>


<?php get_footer(); ?>