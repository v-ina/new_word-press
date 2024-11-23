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
  <style>
    /* Custom dot navigation styles */
    .fp-nav {
      right: 10px; /* 위치 조정 */
      top: 50%; /* 수직 가운데 정렬 */
      transform: translateY(-50%);
    }
    .fp-nav ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }
    .fp-nav li {
      margin: 5px 0; /* 점 사이 간격 */
    }
    .fp-nav a {
      width: 15px; /* 점 크기 */
      height: 15px; /* 점 크기 */
      background-color: transparent; /* 배경 투명 */
      border: 2px solid #fff; /* 테두리 색상 */
      border-radius: 50%; /* 원형 */
      display: block;
      transition: background-color 0.3s, transform 0.3s;
    }
    .fp-nav a.active {
      background-color: #f0b34d; /* 활성화된 점 색상 */
      transform: scale(1.2); /* 크기 변화 */
    }
    .fp-nav a:hover {
      background-color: #f0b34d; /* 호버 색상 */
    }
    /* 텍스트 제거 */
    .fp-tooltip {
      display: none !important;
    }
    /* Use similar style to .service-title for dot hover/focus */
    .fp-nav a.active, .fp-nav a:hover {
      border: 2px solid #f0b34d; /* 호버/활성화된 점의 테두리 색 */
    }
  </style>
</head>

<main id="primary" class="site-main scrollable-sections">
  <!-- FullPage Wrapper -->
  <div id="fullpage">

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

  </div> <!-- End of fullPage wrapper -->

  <!-- Activate stop scroll -->
  <?php get_template_part('template-parts/utils', 'stopscroll'); ?>
</main>
<!-- Initialize fullPage.js -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    new fullpage('#fullpage', {
      autoScrolling: true, // 자동 스크롤 활성화
      scrollHorizontally: false, // 수평 스크롤 비활성화
      navigation: true, // 내비게이션 버튼 활성화
      navigationPosition: 'right', // 내비게이션 위치
      navigationTooltips: [' ', ' ', ' ', ' ', ' ', ' '], // 각 섹션에 대한 툴팁 제거 (빈 문자열로)
      showActiveTooltip: false, // 활성화된 툴팁 표시 비활성화
      slidesNavigation: true, // 슬라이드 내비게이션
      scrollOverflow: true, // 스크롤이 넘칠 경우 자동으로 스크롤 가능
      lazyLoading: true, // 지연 로딩 활성화
    });
  });
</script>
