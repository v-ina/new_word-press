<?php

/**
 * Template Name: Publishing
 * Template Post Type: page
 */
get_header(); ?>

<main id="primary" class="site-main">

  <?php
  while (have_posts()) :
    the_post();
    $phone = get_field('phone');
  ?>
    <!-- Intro -->
    <section class="section-full bg-gradient-orange">
      <div class="min-h-screen flex flex-col h-full justify-center items-center">
        <div class="text-center">
          <h2 class="text-center black-content">
            <?php
            get_template_part('template-parts/title', 'bars', array(
              'title' => get_the_title(),
              'color' => 'white'
            ));
            ?>
          </h2>
        </div>
        <div class="max-w-[900px] mx-auto mt-12 text-center white-content">
          <?php the_content(); ?>
        </div>
      </div><!-- .entry-content -->
    </section>

    <!-- Repeater Content section -->
    <section class="section-full bg-gradient-black">
      <div class="w-full max-w-[650px] mx-auto pt-40 ">
        <?php
        if (have_rows('paragraphes')):
          while (have_rows('paragraphes')) : the_row();
            $title = get_sub_field('title');
            $content = get_sub_field('content');
        ?>
          <div class="py-24 ">
            <p class="publishing-title uppercase beige">
              <?= $title ?>
            </p>
            <div class="white-content">
              <?= $content ?>
            </div>
          </div>
        <?php
          endwhile;
        else :
        endif; ?>
      </div>
    </section>


    <!-- Section 4 : Player -->
    <section class="section">
      <div class="header-darked section-full navigable bg-gradient-black pt-[66px]">
        <div class="min-h-[100vh] flex flex-col justify-center">
          <div class="max-w-[900px] flex flex-col items-center justify-center mx-auto">
            <h2 class="service-title between-plus beige inline-block text-center">Publishing</h2>
            <p class="text-center text-white">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
              dolore magna aliqua. Ut enim ad minim veniam.
            </p>
            <div id="player" class="w-[700px] my-12">
              <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/0GfOPX6i7ZH9UUGJq7X2fy?utm_source=generator&theme=0" width="100%" height="400" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endwhile; ?>
  <?php get_footer(); ?>
</main>

<style>
  .publishing-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #fff;
  }
  #player {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease, transform 0.6s ease;
  }
  #player.visible {
    opacity: 1;
    transform: translateY(0);
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const player = document.getElementById('player');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          player.classList.add('visible'); 
          player.classList.remove('hidden'); 
        }
      });
    }, {
      threshold: 0.7 
    });
    observer.observe(player.parentElement); 
  });
</script>