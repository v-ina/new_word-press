<?php

/**
 * Template part for displaying artists carousel
 * 
 * @param array $args['artists'] Array of artists with their cover images
 */

if (!isset($args['artists']) || empty($args['artists'])) {
  return;
}

$artists = $args['artists'];
?>

<section class="artists-carousel section-full navigable">
  <h3 class="service-title between-plus beige inline-block text-center mt-12 mb-24">
    Nos artistes
  </h3>

  <div class="carousel-wrapper">
    <div class="carousel-track">
      <?php foreach ($artists as $artist):
        if (!empty($artist['cover'])):
      ?>
          <div class="carousel-slide">
            <img
              src="<?php echo esc_url($artist['cover']['sizes']['large']); ?>"
              alt="<?php echo esc_attr($artist['cover']['alt']); ?>"
              class="carousel-image">
          </div>
      <?php
        endif;
      endforeach;
      ?>
    </div>

    <!-- Navigation -->
    <div class="slider-navigation mt-8">
      <div class="flex items-center justify-center gap-12 relative">
        <button class="carousel-prev text-4xl text-beige opacity-50">&lt;</button>
        <button class="carousel-next text-4xl text-beige opacity-50">&gt;</button>
      </div>
    </div>
  </div>
</section>

<style>
  .artists-carousel {
    width: 100%;
    height: 70vh;
    background: #1a1a1a;
    padding: 4rem 0;
  }

  .carousel-wrapper {
    height: 100%;
    max-width: 100%;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
  }

  .carousel-track {
    display: flex;
    align-items: flex-start;
    height: 67%;
    transition: transform 0.5s ease;
    padding: 0 15%;
  }

  .carousel-slide {
    min-width: 35%;
    padding: 0 2rem;
    transition: opacity 0.3s ease;
    opacity: 0.3;
  }

  .carousel-slide.active {
    opacity: 1;
  }

  .carousel-image {
    width: 100%;
    height: auto;
    max-height: 100%;
    object-fit: contain;
    display: block;
  }

  .carousel-prev,
  .carousel-next {
    cursor: pointer;
    transition: opacity 0.3s ease;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
  }

  .carousel-prev {
    left: 5%;
  }

  .carousel-next {
    right: 5%;
  }

  .carousel-prev:hover,
  .carousel-next:hover {
    opacity: 1;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const track = document.querySelector('.carousel-track');
    const slides = document.querySelectorAll('.carousel-slide');
    const prevButton = document.querySelector('.carousel-prev');
    const nextButton = document.querySelector('.carousel-next');
    let currentIndex = 0;

    function updateSlider() {
      // Update transform
      const slideWidth = slides[0].offsetWidth;
      const offset = slideWidth * currentIndex;
      track.style.transform = `translateX(-${offset}px)`;

      // Update active states
      slides.forEach((slide, index) => {
        if (index === currentIndex) {
          slide.classList.add('active');
        } else {
          slide.classList.remove('active');
        }
      });
    }

    prevButton.addEventListener('click', function() {
      if (currentIndex > 0) {
        currentIndex--;
      } else {
        currentIndex = slides.length - 1;
      }
      updateSlider();
    });

    nextButton.addEventListener('click', function() {
      if (currentIndex < slides.length - 1) {
        currentIndex++;
      } else {
        currentIndex = 0;
      }
      updateSlider();
    });

    // Initial update
    updateSlider();

    // Update on window resize
    window.addEventListener('resize', updateSlider);
  });
</script>