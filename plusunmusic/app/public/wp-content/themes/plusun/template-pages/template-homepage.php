<?php
/**
 * Template Name: Accueil
 * Template Post Type: page
 */
get_header();
?>

<!-- Add fullPage.js CDN -->
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/3.1.2/fullpage.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/3.1.2/fullpage.min.js"></script>
</head>

<main id="primary" class="site-main scrollable-sections">
  <!-- FullPage Wrapper -->
  <div id="fullpage">

    <!-- Section 0 : Accueil -->
      <section class="section home-entry relative">
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

    <!-- Section 1 : Heading -->
    <section class="section">
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

    <!-- Section 2 : Services -->
    <section class="section">
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

    <!-- Section 3 : Service details section -->
    <section class="section">
      <?php
      if (have_rows('section-service-details')):
        while (have_rows('section-service-details')): the_row();
          $services = get_sub_field('service');
          get_template_part('template-parts/services', 'wheel', array('services' => $services));
        endwhile;
      endif;
      ?>
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

    <!-- Section 5 : Partenaires -->
    <section class="section">
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

    <!-- Section 6 : Footer -->
    <section class="section">
      <div class="navigable bg-gradient-black pt-[66px]" id="footer-section">
        <?php get_footer(); ?>
      </div>
    </section>

  </div> 

  <!-- Activate stop scroll -->
  <?php get_template_part('template-parts/utils', 'stopscroll'); ?>
</main>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    new fullpage('#fullpage', {
      autoScrolling: true, 
      scrollHorizontally: false, 
      navigation: true, 
      navigationPosition: 'right', 
      navigationTooltips: [' ', ' ', ' ', ' ', ' ', ' '], 
      showActiveTooltip: false, 
      slidesNavigation: true, 
      scrollOverflow: true, 
      lazyLoading: true, 
      afterLoad: function (origin, destination, direction) {
      const section = document.querySelectorAll('.section')[destination.index];
      const fadeElements = section.querySelectorAll('.fade-element');
      
      fadeElements.forEach((element) => {
        element.classList.add('fade-in');  
      });
    },
    onLeave: function (origin, destination, direction) {
      const section = document.querySelectorAll('.section')[origin.index];
      const fadeElements = section.querySelectorAll('.fade-element');
      fadeElements.forEach((element) => {
        element.classList.remove('fade-in');  
      });
    }
    });
  });
</script>

<style>
  /* Custom dot navigation styles */
  .fp-nav {
    right: 10px; 
    top: 50%; 
    transform: translateY(-50%);
  }
  .fp-nav ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
  }
  .fp-nav li {
    margin: 5px 0; 
  }
  .fp-nav a {
    width: 15px; 
    height: 15px; 
    background-color: transparent; 
    border: 2px solid #fff; 
    border-radius: 50%; 
    display: block;
    transition: background-color 0.3s, transform 0.3s;
  }
  .fp-nav a.active {
    background-color: #f0b34d; 
    transform: scale(1.2); 
  }
  .fp-nav a:hover {
    background-color: #f0b34d; 
  }
  .fp-tooltip {
    display: none !important;
  }
  .fp-nav a.active, .fp-nav a:hover {
    border: 2px solid #f0b34d; 
  }
  .fade-element {
    opacity: 0;
    transition: opacity 1s ease-in-out;
  }
  .fade-element.fade-in {
    opacity: 1;
  }
</style>