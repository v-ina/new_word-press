<?php

/**
 * Template Name: Service Catégorie
 * Template Post Type: page
 */
get_header(); ?>

<link href="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.6.2/dist/css/glide.core.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.6.2/dist/glide.min.js"></script>

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

          <div class="glide" id="subcategories-content-slider">
            <div class="glide__track" data-glide-el="track">
              <ul class="glide__slides">
                <?php 
                $index = 0; 
                while (have_rows('sous_categorie')): the_row();
                  $title = get_sub_field('title');
                  $content = get_sub_field('content');
                ?>
                  <li class="glide__slide">
                    <div class="slide mt-12">
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
                  </li>
                <?php $index++; endwhile; ?>
              </ul>
            </div>
          </div>

          <!-- Glide.js Categories Titles Slider -->
          <div class="glide" id="category-titles-slider">
            <div class="glide__track mt-12" data-glide-el="track">
              <ul class="glide__slides">
                <?php 
                $index = 0; 
                while (have_rows('sous_categorie')): the_row();
                  $title = get_sub_field('title');
                ?>
                  <li class="glide__slide slide-index-<?php echo $index; ?>">
                    <h3 class="font-title text-center text-white"><?php echo esc_html($title); ?></h3>
                  </li>
                <?php $index++; endwhile; ?>
              </ul>
            </div>
          </div>

          <!-- Glide.js Subcategories Content Slider -->
        
          <!-- Navigation -->
          <div class="slider-navigation -mt-20">
            <div class="flex items-center justify-center gap-60 mt-4">
              <button class="glide__arrow glide__arrow--left text-4xl text-beige opacity-50" data-glide-dir="<">
                &lt;
              </button>
              <button class="glide__arrow glide__arrow--right text-4xl text-beige opacity-50" data-glide-dir=">">
                &gt;
              </button>
            </div>
          </div>

        </div>

        <!-- Graphic waves -->
        <div class="-mt-4 px-24 mt-12">
          <?php get_template_part('template-parts/graphic', 'waves'); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <style>
    .slider-navigation {
      transform: translateY(-48px);
    }

    .glide__arrow {
      border: none;
      font-weight: 200;
    }

    .glide__slide {
      transition: transform 0.2s ease, translateY 0.2s ease;
    }


    #category-titles-slider {
  max-width: 40%; 
  margin: 0 auto; 
  transform: translateY(-20px); 
}

#category-titles-slider .glide__slides {
  display: flex;
  align-items: center; 
  justify-content: center;
  min-height: 150px; 

}

#category-titles-slider .glide__slide h3 {
  font-size: 1.2rem; 
  padding: 10px; 
}



  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
  var glideTitles = new Glide('#category-titles-slider', {
    type: 'slider',
    startAt: 0,
    perView: 3,
    focusAt: 'center',
    gap: 10,
    animationDuration: 600,
    rewind: true,
    bound: true, 
  }).mount();

  var glideContent = new Glide('#subcategories-content-slider', {
    type: 'slider',
    startAt: 0,
    perView: 1,
    focusAt: 'center',
    gap: 10,
    animationDuration: 600,
    rewind: true,
    bound: true,
  }).mount();

  function updateSlidePositions() {
    const currentIndex = glideContent.index; 
    const slides = document.querySelectorAll('#category-titles-slider .glide__slide');

    slides.forEach((slide, index) => {
      const offset = Math.abs(index - currentIndex); 
      const translateY = offset * 50; 
      slide.style.transform = `translateY(${translateY}px)`; 
    });
  }

  glideContent.on(['move', 'updated'], function () {
    updateSlidePositions();
  });

  updateSlidePositions();

  const prevButton = document.querySelector('.glide__arrow--left');
  const nextButton = document.querySelector('.glide__arrow--right');

  prevButton.addEventListener('click', function () {
    glideTitles.go('<');
    glideContent.go('<');
  });

  nextButton.addEventListener('click', function () {
    glideTitles.go('>');
    glideContent.go('>');
  });
});

  </script>

  <?php endwhile; ?>

  <?php get_footer(); ?>
