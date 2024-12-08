<?php

/**
 * Template Name: Labels Artists Services
 * Template Post Type: page
 */
get_header(); ?>

<main id="primary" class="site-main">

  <?php
  while (have_posts()) :
    the_post();

    // Fetch child pages of the current page's parent or current page itself if it is a top-level page
    $parent_id = wp_get_post_parent_id(get_the_ID()) ? wp_get_post_parent_id(get_the_ID()) : get_the_ID();
    $child_pages = get_children(array(
      'post_parent' => $parent_id,
      'post_type' => 'page',
      'orderby' => 'menu_order',
      'order' => 'ASC'
    ));
  ?>

    <div class="service-page bg-gradient-blue2">
      <div class="service-content">

        <div class="text-center mt-8">
          <h2 class="text-center black-content">
            <?php
            get_template_part('template-parts/title', 'bars', array(
              'title' => get_the_title(),
              'color' => 'black'
            ));
            ?>
          </h2>
        </div>

        <div class="max-w-[900px] mx-auto mt-24 text-center">
          <?php the_content(); ?>
          <div class="mt-8 text-center">
            <a href="/contact" class="btn btn-white">+ Demander un devis +</a>
          </div>
        </div>

        <!-- Child Pages Menu -->
        <nav class="child-pages-menu mt-24">
          <ul class="child-pages-menu__list">
            <?php foreach ($child_pages as $page) : ?>
              <li class="child-pages-menu__item <?php echo ($page->ID == get_the_ID()) ? 'child-pages-menu__item--active' : ''; ?>">
                <a href="<?php echo get_permalink($page->ID); ?>" class="child-pages-menu__link">
                  <?php echo esc_html($page->post_title); ?>
                  <span class="text-white">+</span>
                </a>
              </li>
            <?php endforeach;
            wp_reset_postdata();
            ?>
          </ul>
        </nav>

        <!-- <div class="mt-24 px-24">
          <?php get_template_part('template-parts/graphic', 'waves_white'); ?>
        </div> -->

      </div><!-- .entry-content -->
    </div>
  <?php endwhile; ?>

</main>


<?php get_footer(); ?>