<?php

/**
 * Template Name: Business Management
 * Template Post Type: page
 */
get_header(); ?>

<main id="primary" class="site-main scrollable-sections">

  <!-- navigation dots -->
  <div class="section-navigation">
    <?php for ($i = 1; $i <= 5; $i++): ?>
      <div class="nav-dot" data-section-index="<?php echo $i; ?>"></div>
    <?php endfor; ?>
  </div>


  <!-- Section 1 : Intro -->
  <section class="section business-content section-full navigable bg-gradient-black" data-section-index="1">
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
    $serviceDetailData = [];
    if (have_rows('section-service-details')) {
      while (have_rows('section-service-details')) {
        the_row();
        $services = get_sub_field('service'); 
        $serviceDetailData[] = $services;
      }
    }
  ?>
  <script>
    var serviceDetailData = <?php echo json_encode($serviceDetailData); ?>;
    var titles = serviceDetailData[0].map(function(item) {
    return item.title;
  });
  </script>
  <section class="section header-darked section-full navigable bg-gradient-black" id="service-details" data-section-index="2">
    <div class="scrollable-component">
      <!-- Top titles container -->
      <div class="titles-top font-title text-[28px] font-medium uppercase text-center text-white"></div>
      <!-- Active container -->
      <div class="active-content">
        <?php if (!empty($serviceDetailData)): ?>
          <?php foreach ($serviceDetailData as $services): ?>
            <?php if (is_array($services)): ?>
              <?php foreach ($services as $index => $service): ?>
                <div class="bg-beige p-12 rounded-[20px] transition-all duration-300">
                  <h2 class="text-[46px] font-medium uppercase text-center text-orange"><?php echo htmlspecialchars($service['title'] ) ?></h2>
                  <p class="text-center text-[14px] text-orange mb-8"><?php echo htmlspecialchars($service['content']); ?></p>
                  <a href="#" class="btn btn-orange">+ EN SAVOIR PLUS +</a>
                  </div>
              <?php endforeach; ?>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
      <!-- Bottom titles container -->
      <div class="titles-bottom font-title text-[28px] font-medium uppercase text-center text-white"></div>
    </div>
  </section>


  <!-- Section 3 : Service details section -->
  <?php
  if (have_rows('artists')):
    $artists = array();
    while (have_rows('artists')) : the_row();
      $artists[] = array(
        'cover' => get_sub_field('cover')
      );
    endwhile;
  endif;
  ?>
  <section class="section artists-carousel section-full navigable flex-col" data-section-index="3">
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


  <!-- Section 4 : Partenaires -->
  <section class="section" data-section-index="4">
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
  </section>


  <!-- Section 5 : Footer -->
  <section class="section" data-section-index="5">
    <div class="navigable bg-gradient-black pt-[30rem] w-full" id="footer-section">
      <?php get_footer(); ?>
    </div>
  </section>
</main>

<style>
   /* globals */
   * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  body {
    font-family: Arial, sans-serif;
    overflow: hidden;
  }
  .section {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    border-bottom: 1px solid #ddd;
  }

  /* navigation dots */
  .section-navigation {
    position: fixed;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
    display: flex;
    flex-direction: column;
    gap: 10px;
    z-index: 999;
  }
  .section-navigation .nav-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.5); 
    cursor: pointer;
    transition: transform 0.3s ease, background-color 0.3s ease;
  }
  .section-navigation .nav-dot.active {
    background-color: #000; 
    transform: scale(1.5); 
  }

  /* section 1 */
    .business-content {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  .fade-in {
    opacity: 0;
    transition: opacity 0.5s ease, transform 0.5s ease;
    animation: fadeIn 1.5s ease-out forwards;
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

  /* section 2  */
  .scrollable-component {
    position: relative;
    width: 100%;
    height: 60%;
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }
  .titles-top {
    flex: 2;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: center;
    margin-bottom:30px;
  }
  .titles-bottom {
    flex: 2;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    margin-top: 30px;
  }
  .titles-top h2,
  .titles-bottom h2 {
    opacity: 0.5;
    font-size: 1.2rem;
    margin: 0.2rem 0;
    overflow: visible; 
    color: var(--color-beige);
  }
  .active-content {
    flex: 2;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 240px;
  }
  .active-content div {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: 800px !important;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    transition: top 0.3s ease, opacity 0.3s ease;
    opacity: 0;
    width: 600px ;
  }
  .active-content div.active {
    top: 0;
    opacity: 1;
    background-color: var(--color-main);
    border-radius: 20px;
    padding: 30px;
    left: 50%; 
    width: 600px ;
    z-index: 100;
    color: var(--color-orange);
  }
  .active-content div.active h2,
  .active-content div.active p {
    color: var(--color-orange);
  }
  .active-content div.active::before,  
  .active-content div.active::after {
    content: "+";
    position: absolute;
    top: 50%;
    left: -72px;
    width: 20px;
    height: 20px;
    font-size: 90px;
    color: var(--color-main);
    line-height: 0;
  }
  .active-content div.active::after {
    left: auto;
    right: -44px;
  }
  .active-content div.previous {
    top: -70px;
    opacity: 0;
  }
  .active-content div.next {
    top: 70px;
  }

  /* section 4 */
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

  /* artist carousel */
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
    transform: scale(2.2);
    z-index: 3;
  }
  .swiper-slide.swiper-slide-next{
    transform : scale(1.6) translateX(100px) !important;
  }
  .swiper-slide.swiper-slide-prev{
    transform : scale(1.6) translateX(-100px) !important;
  }
  .swiper-slide.swiper-slide-next + .swiper-slide {
    z-index: 2;
    transform: translateX(150px);
  }
  .swiper-slide.before-prev {
    z-index: 2;
    transform: translateX(-150px);
  }
  .swiper-slide.swiper-slide-active {
    transform: scale(2.4);
    z-index: 10 !important ;
    padding: 0px 30px;
    filter: grayscale(0%) brightness(100%);
  }
</style>

<script>
  let sectionIndex = 1;

  // navigation dots
  document.addEventListener('DOMContentLoaded', function () {
    const navDots = document.querySelectorAll('.section-navigation .nav-dot');
    const sections = document.querySelectorAll('.section');
      function updateNavDots() {
      const currentSectionIndex = Array.from(sections).findIndex(section =>
        section.getBoundingClientRect().top >= 0 &&
        section.getBoundingClientRect().top < window.innerHeight / 2
      );
      navDots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSectionIndex);
      });
      if (currentSectionIndex !== -1) {
        sectionIndex = currentSectionIndex + 1; 
      }
    }
    function handleDotClick(event) {
      const index = parseInt(event.target.getAttribute('data-section-index'), 10);
      if (index >= 1 && index <= sections.length) {
        sectionIndex = index; 
        sections[sectionIndex - 1].scrollIntoView({ behavior: 'smooth' }); 
        updateNavDots(); 
      }
    }
    navDots.forEach(dot => {
      dot.addEventListener('click', handleDotClick);
    });
    window.addEventListener('scroll', updateNavDots);
    updateNavDots();
  });

  let carouselSwiper;
  let scrollableComponentIndex = 0;
  const sections = document.querySelectorAll('.section');
  const scrollableComponent = document.querySelector('.scrollable-component');
  const activeContent = scrollableComponent.querySelector('.active-content');
  const slides = activeContent.querySelectorAll('div');
  const titlesTop = scrollableComponent.querySelector('.titles-top');
  const titlesBottom = scrollableComponent.querySelector('.titles-bottom');
  let isThrottled = false;
  const throttleDuration = 500;

  // section 2 : prev titles & next titles
  function updateTitles() {
    titlesTop.innerHTML = '';
    titlesBottom.innerHTML = '';
    const titles = serviceDetailData[0].map(item => item.title || `Untitled`);
    for (let i = 0; i < scrollableComponentIndex; i++) {
      const title = document.createElement('h2');
      title.textContent = titles[i];
      if (Math.abs(scrollableComponentIndex - i) <= 2) {
        title.style.opacity = '1';
        title.style.fontSize = '1.8rem'; 
      } else {
        title.style.opacity = '0.5'; 
        title.style.fontSize = '1.2rem'; 
      }
      titlesTop.appendChild(title);
    }
    for (let i = scrollableComponentIndex + 1; i < titles.length; i++) {
      const title = document.createElement('h2');
      title.textContent = titles[i];
      if (Math.abs(scrollableComponentIndex - i) <= 2) {
        title.style.opacity = '1';
        title.style.fontSize = '1.8rem'; 
      } else {
        title.style.opacity = '0.5'; 
        title.style.fontSize = '1.2rem'; 
      }
      titlesBottom.appendChild(title);
    }
  }
  function updateSlides() {
    slides.forEach((slide, index) => {
      slide.classList.remove('active', 'previous', 'next');
      if (index === scrollableComponentIndex) {
        slide.classList.add('active');
      } else if (index < scrollableComponentIndex) {
        slide.classList.add('previous');
      } else {
        slide.classList.add('next');
      }
    });
    updateTitles();
  }

  // section 3 carousel
  document.addEventListener('DOMContentLoaded', function () {
    carouselSwiper = new Swiper('.artists-slider', {
      loop: false,
      slidesPerView: 5,
      spaceBetween: 120,
      centeredSlides: true,
      slideToClickedSlide: true,
      allowTouchMove: false, 
      mousewheel: {
        forceToAxis: true, 
        releaseOnEdges: true, 
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
          document.querySelectorAll('.swiper-slide').forEach(slide => {
            slide.classList.remove('before-prev');
          });
          const prevSlide = document.querySelector('.swiper-slide-prev');
          if (prevSlide) {
            const beforePrev = prevSlide.previousElementSibling || document.querySelector('.swiper-wrapper').lastElementChild;
            beforePrev.classList.add('before-prev');
          }
        },
      },
    });
  });
  
  // full page scroll
  function handleScroll(event) {
    if (isThrottled) return;
    const deltaY = event.deltaY;
    if (sectionIndex === 2) {
      if (deltaY > 0 && scrollableComponentIndex < slides.length - 1) {
        scrollableComponentIndex++;
        updateSlides();
      } else if (deltaY < 0 && scrollableComponentIndex > 0) {
        scrollableComponentIndex--;
        updateSlides();
      } else if (deltaY > 0 && scrollableComponentIndex === slides.length - 1) {
        scrollToSection(sectionIndex + 1);
      } else if (deltaY < 0 && scrollableComponentIndex === 0) {
        scrollToSection(sectionIndex - 1);
      }
    }  else if (sectionIndex === 3) {
    if (deltaY > 0) {
      if (
        carouselSwiper.activeIndex ===
        carouselSwiper.slides.length - 1
      ) {
        scrollToSection(sectionIndex + 1);
      } else {
        carouselSwiper.slideNext();
      }
    } else {
      if (carouselSwiper.activeIndex === 0) {
        scrollToSection(sectionIndex - 1);
      } else {
        carouselSwiper.slidePrev();
      }
    }
  } else {
      if (deltaY > 0) {
        scrollToSection(sectionIndex + 1);
      } else {
        scrollToSection(sectionIndex - 1);
      }
    }
    isThrottled = true;
    setTimeout(() => {
      isThrottled = false;
    }, throttleDuration);
  }

  // section scroll function
  function scrollToSection(index) {
    if (index < 1 || index > sections.length) return;
    sections[index - 1].scrollIntoView({ behavior: 'smooth' });
    sectionIndex = index;
  }

  // initialisation function
  function initializeSlides() {
    updateSlides();
    window.addEventListener('wheel', handleScroll);
  }
  initializeSlides();
</script>
