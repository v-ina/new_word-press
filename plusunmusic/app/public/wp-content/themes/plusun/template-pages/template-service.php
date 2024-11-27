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
              <?php 
                $index = 0; 

              while (have_rows('sous_categorie')): the_row();
                $title = get_sub_field('title');
                $content = get_sub_field('content');
              ?>
                  <div class="sub-categories-slider__slide index-<?php echo $index; ?>">

                <!-- <div class="sub-categories-slider__slide"> -->
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
              <?php $index++; endwhile; ?>
            </div>

            <!-- Navigation -->
            <div class="slider-navigation -mt-20">
  <div class="swiper-container nav-slider">
    <div class="swiper-wrapper">
      <?php foreach ($all_titles as $title): ?>
        <div class="swiper-slide">
          <h3 class="font-title text-center text-white"><?php echo esc_html($title); ?></h3>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="flex items-center justify-center gap-12 mt-4">
    <button class="swiper-button-prev text-4xl text-beige opacity-50"></button>
    <button class="swiper-button-next text-4xl text-beige opacity-50"></button>
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

<style>

  .slider-navigation{
    margin-top: 50px !important;
  }

  .swiper-container{
    margin-top: 100px !important;
    margin-bottom: 80px !important;
    font-size: 16px;
  }
  .nav-slider .swiper-slide {
  text-align: center;
  opacity: 0.8; /* 기본 슬라이드 투명도 */
  transition: transform 0.3s ease-in-out; /* 전환 속도를 0.8초로 조정 */
  
}

.swiper-wrapper {
  transition: transform 0.3s ease-in-out; /* 전환 속도를 0.8초로 조정 */

}

.nav-slider .swiper-slide.swiper-slide-active {
  opacity: 1; /* 활성화된 슬라이드 */
  font-size: 24px;
  /* margin: 0 20px !important; */

}

.nav-slider {
  max-width: 900px;
  margin: 0 auto;
}

.nav-slider {
  max-width: 800px; /* 네비게이션 컨테이너의 최대 너비 설정 */
  margin: 0 auto;
}

.swiper-initialized {
  overflow: hidden !important;
  margin-top: 0 !important;
  margin-bottom: 0 !important;
    height: 200px;
}




.swiper-slide-prev{
  transform: translate(-50px ,70px);

}

.swiper-slide-next{
  transform: translate( 50px ,70px);

}

/* 활성 슬라이드에서 세 칸 왼쪽 */
.swiper-slide.before-before-prev {
  transform: translate(-30px ,200px);
  opacity: 0.3; /* 필요하면 투명도를 조정 */
}

/* 활성 슬라이드에서 세 칸 오른쪽 */
.swiper-slide.next-next-slide-next {
  transform: translate(30px ,200px);
  opacity: 0.3; /* 필요하면 투명도를 조정 */
}

/* 활성 슬라이드에서 두 칸 오른쪽 */
.swiper-slide.next-next {
  transform: translateY(130px);
}

/* 활성 슬라이드에서 두 칸 왼쪽 */
.swiper-slide.before-prev {
  transform: translateY(130px);
}

/* 활성 슬라이드에서 네 칸 오른쪽 */
.swiper-slide.next-next-next-slide-next {
  transform: translateY(300px);
  opacity: 0.1; /* 필요하면 투명도를 조정 */
}

/* 활성 슬라이드에서 네 칸 왼쪽 */
.swiper-slide.before-before-before-prev {
  transform: translateY(300px);
  opacity: 0.1; /* 필요하면 투명도를 조정 */
}
.swiper-slide-duplicate-active, .swiper-slide-duplicate-next{
  transform: translateY(300px);
  opacity: 0.1; /* 필요하면 투명도를 조정 */
  }

  .swiper-button-prev{
    transform: translate(35vw, -60px);
    border: none;
  }

  .swiper-button-prev:after{
    font-size: 25px;
  }

  .swiper-button-next:after{
    font-size: 25px;
  }


  .swiper-button-next{
    transform : translate(-35vw, -60px);
    border: none;
  }

</style>

    <script>

document.addEventListener('DOMContentLoaded', function () {
  const navSlider = new Swiper('.nav-slider', {
    slidesPerView: 5,
    centeredSlides: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    loop: true,
    spaceBetween: 60,
    speed: 300,
    on: {
      init: function () {
        updateSlideClasses(this);
      },
      slideChangeTransitionStart: function () {
        updateSlideClasses(this);
      },
    },
  });

function updateSlideClasses(swiper) {
  const slides = document.querySelectorAll('.nav-slider .swiper-slide');
  slides.forEach((slide) => {
    slide.classList.remove(
      'before-prev',
      'before-before-prev',
      'before-before-before-prev',
      'next-next-slide-next',
      'next-next',
      'next-next-next-slide-next'
    ); // 모든 상태 초기화
  });

  const activeIndex = swiper.activeIndex;
  const slidesCount = slides.length;

  // `before-prev` 슬라이드 (활성화된 슬라이드의 두 칸 왼쪽)
  let beforePrevIndex = (activeIndex - 2 + slidesCount) % slidesCount;
  slides[beforePrevIndex].classList.add('before-prev');

  // `before-before-prev` 슬라이드 (활성화된 슬라이드의 세 칸 왼쪽)
  let beforeBeforePrevIndex = (activeIndex - 3 + slidesCount) % slidesCount;
  slides[beforeBeforePrevIndex].classList.add('before-before-prev');

  // `before-before-before-prev` 슬라이드 (활성화된 슬라이드의 네 칸 왼쪽)
  let beforeBeforeBeforePrevIndex = (activeIndex - 4 + slidesCount) % slidesCount;
  slides[beforeBeforeBeforePrevIndex].classList.add('before-before-before-prev');

  // `next-next` 슬라이드 (활성화된 슬라이드의 두 칸 오른쪽)
  let nextNextIndex = (activeIndex + 2) % slidesCount;
  slides[nextNextIndex].classList.add('next-next');

  // `next-next-slide-next` 슬라이드 (활성화된 슬라이드의 세 칸 오른쪽)
  let nextNextSlideNextIndex = (activeIndex + 3) % slidesCount;
  slides[nextNextSlideNextIndex].classList.add('next-next-slide-next');

  // `next-next-next-slide-next` 슬라이드 (활성화된 슬라이드의 네 칸 오른쪽)
  let nextNextNextSlideNextIndex = (activeIndex + 4) % slidesCount;
  slides[nextNextNextSlideNextIndex].classList.add('next-next-next-slide-next');



}

});



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
