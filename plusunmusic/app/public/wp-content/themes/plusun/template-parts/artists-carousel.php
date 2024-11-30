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

  <div class="swiper artists-slider">
    <div class="swiper-wrapper">
      <?php foreach ($artists as $artist):
        if (!empty($artist['cover'])):
      ?>
        <div class="swiper-slide">
          <div class="carousel-slide">
            <img
              src="<?php echo esc_url($artist['cover']['sizes']['large']); ?>"
              alt="<?php echo esc_attr($artist['cover']['alt']); ?>"
              class="carousel-image">
          </div>
        </div>
      <?php
        endif;
      endforeach;
      ?>
    </div>

  </div>
</section>

<style>
.artists-carousel {
    width: 100%;
    background: #1a1a1a;
    padding: 4rem 0;
    overflow-x: hidden;
}

.artists-slider {
    height: 80vh;
    margin-top: -80px;
}

.swiper {
    width: 100%;
    position: relative;
    overflow: hidden;
}

.swiper-slide {
    width: auto;
    height: 100%;
    transform-origin: center center;
    transform: scale(1);
    transition: transform 0.2s ease-in z-index 0.2s ease-in-out, filter 0.5s ease-in-out; /* 기본 트랜지션 */
    filter: grayscale(100%) brightness(50%);
    display: flex;
    align-items:center;
    z-index: 1;
}

.carousel-image {
    width: 100%;
    height: 100%;
    object-fit: cover; 
}

.swiper-wrapper {
    display: flex;
    align-items: center;
    transition: transform 0.3s ease-in-out;
}

.swiper-slide.swiper-slide-next, .swiper-slide.swiper-slide-prev{
  transform: scale(3);
  z-index: 3;
}

.swiper-slide.swiper-slide-next{
  /* padding-left : 80px; */
  /* transform: translateX(30px); */
  transform : scale(1.6) translateX(100px) !important;


}

.swiper-slide.swiper-slide-prev{
  /* padding-right : 80px; */
  /* transform: translateX(-30px);
   */
  transform : scale(1.6) translateX(-100px) !important;
}
.swiper-slide.swiper-slide-next + .swiper-slide {
    z-index: 2;
    transform: translateX(150px);

}

.swiper-slide.before-prev {
    z-index: 2;
    /* margin-left: -30px; */
    transform: translateX(-150px);

}



.swiper-slide.swiper-slide-active {
    transform: scale(3);
    z-index: 10 !important ;
    padding: 0px 30px;

    filter: grayscale(0%) brightness(100%);
}


</style>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.artists-slider', {
        loop: true,
        slidesPerView: 5,
        spaceBetween: 120,
        centeredSlides: true,
        slideToClickedSlide: true,
        allowTouchMove: false, 
        mousewheel: {
            forceToAxis: false, // 세로/가로 방향 제한
            releaseOnEdges: true, // 가장자리에서 스크롤 동작 허용
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 5,
            }
        },
        on: {
            slideChangeTransitionEnd: function () {
                // 모든 슬라이드 초기화
                document.querySelectorAll('.swiper-slide').forEach(slide => {
                    slide.classList.remove('before-prev');
                });

                // prev 찾기
                const prevSlide = document.querySelector('.swiper-slide-prev');
                if (prevSlide) {
                    // prev 바로 앞 슬라이드에 클래스 추가
                    const beforePrev = prevSlide.previousElementSibling || document.querySelector('.swiper-wrapper').lastElementChild;
                    beforePrev.classList.add('before-prev');
                }
            },
        },
    });
});


</script>
