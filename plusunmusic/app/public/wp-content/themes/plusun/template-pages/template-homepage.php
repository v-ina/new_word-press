<?php

/**
 * Template Name: Accueil
 * Template Post Type: page
 */
get_header();
?>

<main id="fullpage">


  <div class="section-navigation">
    <?php for ($i = 1; $i <= 6; $i++): ?>
      <div class="nav-dot" data-section-index="<?php echo $i; ?>"></div>
    <?php endfor; ?>
  </div>

  <!-- section 1 -->
  <section id='section1' class="home-entry relative" data-section-index="1">
  <div class="flex justify-center items-center w-full h-full">
      <h1 class="font-title text-[82px] text-semibold uppercase mx-auto text-center">plus un music</h1>
    </div>
    <div class="scroll-indicator absolute bottom-12 left-1/2 -translate-x-1/2 flex flex-col items-center animate-bounce -ms-20">
      <span class="text-scroll mt-2 text-sm animate-shake pt-4 ">Scroll</span>
      <div class="chevron">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
      </div>
    </div>
  </section>

  <!-- section 2 -->
  <?php
   if (have_rows('section-heading')):
    while (have_rows('section-heading')): the_row();
      $heading_data = array(
        'intro' => get_sub_field('intro'),
        'title_items' => get_sub_field('title_items'),
        'subtitle' => get_sub_field('subtitle'),
        'action_text' => get_sub_field('action_text')
      );
      $intro = get_sub_field('intro'); 
      $title_items = get_sub_field('title_items') ?? [];
      $subtitle = get_sub_field('subtitle'); 
      $action_text = get_sub_field('action_text');
    endwhile;
    endif;
  ?>
  <script>
    var HeadingData = <?php echo json_encode($heading_data); ?>;
    var HeadingTitles = HeadingData.title_items
  </script>
  <section class="section home-entry" data-section-index="2">
    <div class="min-h-[100vh] w-full max-w-[800px] mx-auto flex flex-col pt-12 items-center justify-center">
      <p class="font-title text-[20px] text-center mb-24 -mt-40">
        <?php echo wp_kses_post($intro); ?>
      </p>
      <div class="flex flex-col justify-center items-center leading-[112px] relative w-full">
        <div class="heading-slide-wrapper">
          <div class="heading-slide-container" id="heading-slides-container">
          </div>
        </div>
        <p class="font-title text-[82px] text-semibold uppercase mb-4">
          <?php echo esc_html($subtitle); ?>
        </p>
        <a href="#" class="btn btn-white">
          + <?php echo esc_html($action_text); ?> +
        </a>
      </div>
    </div>
  </section>

<!-- section 3 -->
  <section class="section w-full" data-section-index="3">
  <?php
    if (have_rows('section-services')):
      while (have_rows('section-services')): the_row();
        $encart_1 = get_sub_field('encart_1');
        $encart_2 = get_sub_field('encart_2');
        $inserts = [$encart_1, $encart_2];
        get_template_part('template-parts/services', 'split', array('inserts' => $inserts));
      endwhile;
    endif;
    ?>
  </section>


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
  <section class="section header-darked section-full navigable bg-gradient-black" id="service-details" data-section-index="4">
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

  <!-- section 5 -->
  <section class="section relative w-full" data-section-index="5">
    <div class="header-darked w-full navigable bg-gradient-black">
      <div class="min-h-[100vh] flex flex-col justify-center">
        <div id="player-container" class="w-[800px] flex flex-col items-center justify-center mx-auto">
          <h2 class="publishing-title between-plus beige inline-block text-center">Publishing</h2>
          <p class="publishing-sub-title text-center text-white">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam.
          </p>
          <div id="player" class="w-[700px] my-12 h-[50px] ">
            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/0GfOPX6i7ZH9UUGJq7X2fy?utm_source=generator&theme=0" width="100%" height="400" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="section" data-section-index="6">
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


  <section class="section" data-section-index="7">
    <div class="navigable bg-gradient-black pt-[30rem] w-full" id="footer-section">
      <?php get_footer(); ?>
    </div>
  </section>
</main>

<script>
  let sectionIndex = 2;
  let firstSectionVisible = true; 
  const section1 = document.getElementById('section1');
  const threshold = 200;

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
  
  let scrollableComponentIndex = 0;
  let scrollableHeadingComponentIndex = 0;
  const sections = document.querySelectorAll('.section');
  const scrollableComponent = document.querySelector('.scrollable-component');
  const activeContent = scrollableComponent.querySelector('.active-content');
  const slides = activeContent.querySelectorAll('div');
  const titlesTop = scrollableComponent.querySelector('.titles-top');
  const titlesBottom = scrollableComponent.querySelector('.titles-bottom');
  let isThrottled = false;
  const throttleDuration = 500;
  const playerDiv = document.getElementById('player');
  const section5 = document.querySelector('[data-section-index="5"]');
  let hasPlayerAppeared = false;
  let iframeVisible = false;
  publishingText = document.querySelector('.publishing-title');
  publishingSubText = document.querySelector('.publishing-sub-title');
  publishingText.style.transition = 'none';
  publishingSubText.style.transition = 'none';
  updateTextPosition();


  // section 4 : prev titles & next titles
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
  

  // section 2 : heading slide
  function updateHeadingSlides() {
    const headingContainer = document.getElementById("heading-slides-container");
    headingContainer.innerHTML = ''; 
    HeadingTitles.forEach((title) => {
      const titleElement = document.createElement("span");
      titleElement.textContent = `     ${title.item}     `;
      titleElement.classList.add("heading-slide");
      headingContainer.appendChild(titleElement);
    });
    requestAnimationFrame(() => {
      const slideHeight = headingContainer.firstElementChild.offsetHeight;
      headingContainer.style.transform = `translateY(-${scrollableHeadingComponentIndex * slideHeight}px)`;
    });
  }
  function moveToNextSlide() {
    const headingContainer = document.getElementById("heading-slides-container");
    const totalSlides = HeadingTitles.length;
    scrollableHeadingComponentIndex = (scrollableHeadingComponentIndex + 1) % totalSlides; 
    requestAnimationFrame(() => {
      const slideHeight = headingContainer.firstElementChild.offsetHeight;
      headingContainer.style.transform = `translateY(-${scrollableHeadingComponentIndex * slideHeight}px)`;
    });
  }
  document.addEventListener("DOMContentLoaded", () => {
    initializeHeadingSlides();
  });

  
  // full page scroll
  function handleScroll(event) {
    if (isThrottled) return;
    const deltaY = event.deltaY;

    if (sectionIndex === 1  && firstSectionVisible && deltaY > 0 && !isThrottled) {
      isThrottled = true; 
      setTimeout(() => isThrottled = false, throttleDuration); 
      firstSectionVisible = false;
      section1.style.transition = 'opacity 0.8s ease-in-out'; 
      section1.style.opacity = '0'; 
      setTimeout(() => {
        section1.classList.add('hidden'); 
      }, 500); 
      scrollableHeadingComponentIndex = 0; 
      return; 
    }
    if ( sectionIndex === 1  && scrollableHeadingComponentIndex === 0 && !firstSectionVisible && deltaY < 0 && !isThrottled) {
      isThrottled = true; 
      setTimeout(() => isThrottled = false, throttleDuration); 
      firstSectionVisible = true;
      section1.style.transition = 'none';
      section1.style.opacity = '0';
      section1.classList.remove('hidden'); 
      requestAnimationFrame(() => {
        section1.style.transition = 'opacity 0.8s ease-in-out'; 
        section1.style.opacity = '1'; 
      });
      return; 
    }

    const player = document.getElementById('player');
    const playerContainer = document.getElementById('player-container'); 
    const publishingText = playerContainer.querySelector('h2'); 
    const publishingSubText = playerContainer.querySelector('p');  

    if (sectionIndex === 1) {
      if (deltaY > 0 && scrollableHeadingComponentIndex < HeadingTitles.length - 1) {
        scrollableHeadingComponentIndex++;
        updateHeadingSlides();
      } else if (deltaY < 0 && scrollableHeadingComponentIndex > 0) {
        scrollableHeadingComponentIndex--;
        updateHeadingSlides();
      } else if (deltaY > 0 && scrollableHeadingComponentIndex === HeadingTitles.length - 1) {
        scrollToSection(sectionIndex + 1); 
      } else if (deltaY < 0 && scrollableHeadingComponentIndex === 0) {
        scrollToSection(sectionIndex - 1);  
      }
    } else if (sectionIndex === 3) {
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
    } else if (sectionIndex === 4) {
  if (deltaY > 0) {
    if (!iframeVisible) {
      requestAnimationFrame(() => {
        player.classList.add('visible');
        iframeVisible = true;
        updateTextPosition();
      });
    } else {
      scrollToSection(sectionIndex + 1);
    }
  } else if (deltaY < 0) {
    if (iframeVisible) {
      requestAnimationFrame(() => {
        player.classList.remove('visible');
        iframeVisible = false;
        updateTextPosition();
      });
    } else {
      scrollToSection(sectionIndex - 1);
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

  document.addEventListener('DOMContentLoaded', function () {
    scrollableHeadingComponentIndex = 0;  
    updateHeadingSlides();
  });
  // section1.classList.remove('hidden');


  // section 5 
  function updateTextPosition() {
  const h2Styles = publishingText.style;
  const pStyles = publishingSubText.style;
  if (!iframeVisible) {
    h2Styles.transition = 'transform 0.5s ease, position 0.5s ease';
    h2Styles.top = '45%';
    pStyles.top = '52%';
  } else {
    h2Styles.transition = 'transform 0.5s ease, position 0.5s ease';
    h2Styles.top = '25%';
    pStyles.top = '35%';
  }
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

  /* section 2 : heading slider */
  .heading-slide-wrapper {
    position: relative;
    width: 100%;
    height: 90px; 
    overflow: hidden; 
  }
  .heading-slide-container {
    display: flex;
    flex-direction: column;
    transition: transform 0.5s ease-in-out;
    will-change: transform;
  }
  .heading-slide {
    height: 90px;
    text-align: center;
    font-size: 82px;
    text-transform: uppercase;
    font-weight: bold;
    white-space: nowrap;
  }
  .heading-slide::before,
  .heading-slide::after {
    content: "+";
    font-size: 70px;
    color: var(--color-black);
    line-height: 0;
  }
  .heading-slide::before{
    margin-left: -20px;
  }
  .heading-slide::after {
    margin-right: -20px;
  }

  /* section 4 : services details */
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
    /* transform: translateX(-50%); */
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

  /* section 5 : spotify plugin */
  #player {
    opacity: 0;
    overflow: hidden;
    transform: translateY(100px);
    transition: opacity 0.5s ease, transform 1s ease;
  }
  #player.visible {
    opacity: 1;
    transform: translateY(0);
    min-height: 400px !important;
    transform: translateY(150px);
  }
  #player-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }
  #player-container.no-iframe {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
  }
  #player-container h2,
  #player-container p {
    transition: transform 0.5s ease, position 0.5s ease; 
  }
  #player-container iframe {
    border-radius: 12px;
    transition: opacity 0.5s ease, transform 0.5s ease; 
  }
  .publishing-title {
    position: absolute;
    left: 50%;
    top: 45%;
    transform: translate(-50%, -50%);
    transition: top 0.5s ease, transform 0.5s ease;
  }
  .publishing-sub-title {
    position: absolute;
    left: 50%;
    top: 52%;
    transform: translate(-50%, -50%);
    transition: top 0.5s ease, transform 0.5s ease;
  }

  /* landing component */
  #section1 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    z-index: 10;
    opacity: 1;
    visibility: visible;
  }
  #section1.hidden {
    opacity: 0;
    visibility: hidden;
  }
</style>