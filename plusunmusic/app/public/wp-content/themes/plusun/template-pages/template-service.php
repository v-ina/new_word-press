<?php

/**
 * Template Name: Service Catégorie
 * Template Post Type: page
 */
get_header(); ?>

<main id="primary" class="site-main">
  <?php while (have_posts()) : the_post(); ?>
    <div class="service-page bg-gradient-black">
      <div class="service-content">
        <!-- Title -->
        <div class="text-center">
          <h2 class="service-title between-plus beige inline-block">
            <?php the_title(); ?>
          </h2>
        </div>

        <!-- Sub Categories Slider -->
        <?php if (have_rows('sous_categorie')): ?>
          <?php
          // Store all titles in an array first
          $all_titles = array();
          while (have_rows('sous_categorie')): the_row();
            $all_titles[] = get_sub_field('title');
          endwhile;
          reset_rows(); // Reset the loop for the main content
          ?>
          <div class="sub-categories-slider">
            <div class="sub-categories-slider__wrapper">
              <?php while (have_rows('sous_categorie')): the_row();
                $title = get_sub_field('title');
                $content = get_sub_field('content');
              ?>
                <div class="sub-categories-slider__slide">
                  <div class="slide">
                    <h3 class="sub-categories-slider__title italic">
                      <span class="font-title uppercase text-beige"><?php the_title(); ?>/</span><?php echo esc_html($title); ?>
                    </h3>
                    <div class="sub-categories-slider__content max-w-[768px] mx-auto text-center">
                      <?php echo $content; ?>
                    </div>
                    <div class="text-center my-12">
                      <a href="/contact" class="btn btn-white">+ NOUS CONTACTER +</a>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>

            <!-- Navigation -->
            <div class="slider-navigation -mt-20">
              <div class="flex items-center justify-center gap-12 relative">
                <button class="sub-categories-slider__prev text-4xl text-beige opacity-50">&lt;</button>
                <div class="navigation-titles relative">
                  <div class="title-wrapper flex items-center justify-center text-center gap-8">
                    <span class="w-[150px] mt-48 slider-prev-title font-title opacity-50 text-white"></span>
                    <span class="w-[150px] mt-32 slider-prev-close-title font-title opacity-70 text-white"></span>
                    <h3 class="w-[150px] current-slide-title font-title text-white leading-[1.2]"><span class="text-white font-title"></span></h3>
                    <span class="w-[150px] mt-32 slider-next-close-title font-title opacity-70 text-white"></span>
                    <span class="w-[150px] mt-48 slider-next-title font-title opacity-50 text-white"></span>
                  </div>
                </div>
                <button class="sub-categories-slider__next text-4xl text-beige opacity-50">&gt;</button>
              </div>
            </div>
          </div>

          <!-- Graphic waves -->
          <div class="-mt-4 px-24">
            <?php get_template_part('template-parts/graphic', 'waves'); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const sliderWrapper = document.querySelector('.sub-categories-slider__wrapper');
        const slides = document.querySelectorAll('.sub-categories-slider__slide');
        const prevButton = document.querySelector('.sub-categories-slider__prev');
        const nextButton = document.querySelector('.sub-categories-slider__next');
        const titles = <?php echo json_encode($all_titles); ?>;
        let currentIndex = 0;

        const prevTitle = document.querySelector('.slider-prev-title');
        const prevCloseTitle = document.querySelector('.slider-prev-close-title');
        const currentTitle = document.querySelector('.current-slide-title span');
        const nextCloseTitle = document.querySelector('.slider-next-close-title');
        const nextTitle = document.querySelector('.slider-next-title');

        function updateSlider() {
          // Update slide position
          sliderWrapper.style.transform = `translateX(-${currentIndex * 100}%)`;

          // Update titles
          currentTitle.textContent = titles[currentIndex];

          // Update previous titles
          if (currentIndex > 1) {
            prevTitle.textContent = titles[currentIndex - 2];
          } else {
            prevTitle.textContent = titles[titles.length - (2 - currentIndex)];
          }

          if (currentIndex > 0) {
            prevCloseTitle.textContent = titles[currentIndex - 1];
          } else {
            prevCloseTitle.textContent = titles[titles.length - 1];
          }

          // Update next titles
          if (currentIndex < titles.length - 2) {
            nextTitle.textContent = titles[currentIndex + 2];
          } else {
            nextTitle.textContent = titles[(currentIndex + 2) % titles.length];
          }

          if (currentIndex < titles.length - 1) {
            nextCloseTitle.textContent = titles[currentIndex + 1];
          } else {
            nextCloseTitle.textContent = titles[0];
          }
        }

        prevButton.addEventListener('click', function() {
          if (currentIndex > 0) {
            currentIndex--;
            updateSlider();
          } else {
            currentIndex = slides.length - 1;
            updateSlider();
          }
        });

        nextButton.addEventListener('click', function() {
          if (currentIndex < slides.length - 1) {
            currentIndex++;
            updateSlider();
          } else {
            currentIndex = 0;
            updateSlider();
          }
        });

        // Initial update
        updateSlider();
      });
    </script>
  <?php endwhile; ?>

  <?php get_footer(); ?>