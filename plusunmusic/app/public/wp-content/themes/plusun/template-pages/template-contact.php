<?php

/**
 * Template Name: Contact
 * Template Post Type: page
 */

get_header(); ?>

<main id="fullpage">
  <section class="section home-entry relative" data-section-index="1">
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
  <section class="section" data-section-index="2">
  <?php
    if (have_rows('section-heading')):
      while (have_rows('section-heading')): the_row();
        $heading_data = array(
          'intro' => get_sub_field('intro'),
          'title_items' => get_sub_field('title_items'),
          'subtitle' => get_sub_field('subtitle'),
          'action_text' => get_sub_field('action_text')
        );
        get_template_part('template-parts/homepage', 'heading', $heading_data);
      endwhile;
    endif;
    ?>
  </section>
  <section class="section" data-section-index="3">
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
  <section class="section" data-section-index="4">
    <div class="scrollable-component">
      <!-- Top titles container -->
      <div class="titles-top"></div>

      <!-- Active content container -->
      <div class="active-content">
        <div>
          <h2>Item 1</h2>
          <p>1Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ea, debitis?</p>
        </div>

      </div>

      <!-- Bottom titles container -->
      <div class="titles-bottom"></div>
    </div>
  </section>
  <section class="section" data-section-index="5">
    <div class="header-darked section-full navigable bg-gradient-black pt-[66px]">
      <div class="min-h-[100vh] flex flex-col justify-center">
        <div id="player-container" class="w-[900px] max-w-[900px] flex flex-col items-center justify-center mx-auto">
          <h2 class="service-title between-plus beige inline-block text-center">Publishing</h2>
          <p class="service-sub-title text-center text-white">
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
    <div class="navigable bg-gradient-black pt-[66px]" id="footer-section">
      <?php get_footer(); ?>
    </div>
  </section>
</main>

<style>
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
      background: #f0f0f0;
      border-bottom: 1px solid #ddd;
    }

    .section:nth-child(odd) {
      background: #dfefff;
    }

    .scrollable-component {
      position: relative;
      width: 100%;
      height: 60%;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    .titles-top,
    .titles-bottom {
      flex: 2;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 20%;
    }

    .titles-top h2,
    .titles-bottom h2 {
      opacity: 0.5;
      font-size: 1.2rem;
      margin: 0.2rem 0;
      overflow: visible; 
    }

    .active-content {
      flex: 2;
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 30%;
    }

    .active-content div {
      position: absolute;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      transition: top 0.5s ease;
    }

    .active-content div.active {
      top: 0;
      background-color: white;
      border-radius: 20px;
      padding: 30px;
      left: 50%; 
      transform: translateX(-50%);
      width: 600px ;
    }

    .active-content div.previous {
      top: -170%;
    }

    .active-content div.next {
      top: 170%;
    }


    #player {
      opacity: 0;
      transform: translateY(50px);
      transition: opacity 0.5s ease, transform 0.5s ease;
    }

    #player.visible {
      opacity: 1;
      transform: translateY(0);
    }

    #player-container {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      height: 100%; 
    }

    #player-container.no-iframe {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    #player-container h2,
    #player-container p {
      transition: transform 0.5s ease, position 0.5s ease; 
    }

    #player-container.no-iframe h2,
    #player-container.no-iframe p {
      max-width: 100%; 
    }

    #player-container iframe {
      border-radius: 12px;
      transition: opacity 0.5s ease, transform 0.5s ease; 
    }

    #player-container p {
      transition: opacity 0.5s ease, transform 0.5s ease; /* 트랜지션 추가 */
      opacity: 0; /* 초기 상태에서 투명하게 */
    }

    #player-container p.visible {
      opacity: 1; /* 나타날 때 완전히 보이게 */
      transform: translateY(0); /* 원래 위치로 이동 */
    }

    /* 이미 정의된 클래스에도 opacity 추가 */
    #player-container h2,
    #player-container p {
      transition: transform 0.5s ease, opacity 0.5s ease; /* 트랜지션에 opacity 추가 */
    }

    #player-container.no-iframe h2,
    #player-container.no-iframe p {
      opacity: 1; /* iframe이 없을 때 텍스트 항상 보이도록 */
    }



    /* fade in */
    .fade-in {
  opacity: 1;
  transition: opacity 0.5s ease;
}

.section {
  opacity: 0;
  transition: opacity 0.5s ease;
}

</style>

<script>
  let sectionIndex = 1;
  let scrollableComponentIndex = 0;
  const sections = document.querySelectorAll('.section');
  const scrollableComponent = document.querySelector('.scrollable-component');
  const activeContent = scrollableComponent.querySelector('.active-content');
  const slides = activeContent.querySelectorAll('div');
  const titlesTop = scrollableComponent.querySelector('.titles-top');
  const titlesBottom = scrollableComponent.querySelector('.titles-bottom');

  // Throttle variable
  let isThrottled = false;

  // Throttle duration in milliseconds
  const throttleDuration = 500;

  function updateTitles() {
    // Clear titles
    titlesTop.innerHTML = '';
    titlesBottom.innerHTML = '';

    // Populate top titles
    for (let i = 0; i < scrollableComponentIndex; i++) {
      const title = document.createElement('h2');
      title.textContent = `Item ${i + 1}`;
      titlesTop.appendChild(title);
    }

    // Populate bottom titles
    for (let i = scrollableComponentIndex + 1; i < slides.length; i++) {
      const title = document.createElement('h2');
      title.textContent = `Item ${i + 1}`;
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

    // Update titles
    updateTitles();
  }

  function scrollToSection(index) {
    if (index < 1 || index > sections.length) return;
    sections[index - 1].scrollIntoView({ behavior: 'smooth' });
    sectionIndex = index;
  }

  function handleScroll(event) {
  if (isThrottled) return; 

  const deltaY = event.deltaY;
  const player = document.getElementById('player');
  const playerContainer = document.getElementById('player-container'); 
  const publishingText = playerContainer.querySelector('h2'); 
  const publishingSubText = playerContainer.querySelector('p');


  const section1 = document.querySelector('[data-section-index="1"]');
  const section2 = document.querySelector('[data-section-index="2"]');

  // Fade-in logic for section 1 to section 2
  if (sectionIndex === 1) {
    if (deltaY > 0) { // Scrolling down
      section1.classList.remove('fade-in');
      section2.classList.add('fade-in');
      scrollToSection(2);
      return; // Skip further processing for this scroll event
    }
  } else if (sectionIndex === 2) {
    if (deltaY < 0) { // Scrolling up
      section2.classList.remove('fade-in');
      section1.classList.add('fade-in');
      scrollToSection(1);
      return; // Skip further processing for this scroll event
    }
  }

  if (sectionIndex === 5) {
    if (deltaY > 0) {
      if (!player.classList.contains('visible')) {
        player.classList.add('visible');
        publishingText.style.position = 'static'; 
    publishingText.style.transform = 'translateY(0)';
    publishingSubText.style.position = 'static'; 
      } else {
        scrollToSection(sectionIndex + 1);
      }
    } else if (deltaY < 0) {
      if (player.classList.contains('visible')) {
        player.classList.remove('visible');
        playerContainer.classList.add('no-iframe');
    publishingText.style.position = 'absolute';
    publishingText.style.top = '45%'; 
    publishingText.style.transform = 'translateY(-50%)'; 
    publishingSubText.style.position = 'absolute';
    publishingSubText.style.top = '52%'; 
    publishingSubText.style.transform = 'translateY(50%)'; 
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

// Function to scroll to a specific section
function scrollToSection(index) {
  if (index < 1 || index > sections.length) return; // Prevent out-of-bounds indices
  sections[index - 1].scrollIntoView({ behavior: 'smooth' });
  sectionIndex = index; // Update the current section index
}

// Initialize visibility for section 5's player
document.addEventListener('DOMContentLoaded', () => {
  const player = document.getElementById('player');
  player.classList.remove('visible'); // Ensure it's hidden initially
});

document.addEventListener('DOMContentLoaded', () => {
  const player = document.getElementById('player');
  const playerContainer = document.getElementById('player-container');
  const publishingText = playerContainer.querySelector('h2'); 
  const publishingSubText = playerContainer.querySelector('p'); 

  player.classList.remove('visible');
  
  if (!player.src || player.src.trim() === '') {
    playerContainer.classList.add('no-iframe');
    publishingText.style.position = 'absolute';
    publishingText.style.top = '45%'; 
    publishingText.style.transform = 'translateY(-50%)'; 
    publishingSubText.style.position = 'absolute';
    publishingSubText.style.top = '52%'; 
    publishingSubText.style.transform = 'translateY(50%)'; 
  } else {
    playerContainer.classList.remove('no-iframe');
    publishingText.style.position = 'static';
    publishingText.style.transform = 'translateY(0)'; 
    publishingSubText.style.position = 'static'; 
  }
});




  // Initialize slides and titles
  updateSlides();

  // Attach throttled scroll handler
  window.addEventListener('wheel', handleScroll);

</script>

<?php get_footer(); ?>
