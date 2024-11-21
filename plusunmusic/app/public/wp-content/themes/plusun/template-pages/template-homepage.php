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

    /* 중앙 정렬 및 스냅 */
.service-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh; /* 섹션 전체 높이를 뷰포트 높이로 설정 */
  overflow-y: scroll; /* 세로 스크롤 활성화 */
  scroll-snap-type: y mandatory; /* 스냅 활성화 */
  scrollbar-width: none; /* 스크롤바 숨기기 (Firefox) */
}

.service-container::-webkit-scrollbar {
  display: none; /* 스크롤바 숨기기 (Chrome) */
}

/* 각 div를 스냅 포인트로 설정 */
.service-item {
  flex: 0 0 100%; /* 각 항목 높이를 뷰포트 크기로 설정 */
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  scroll-snap-align: center; /* 중앙에서 스냅 */
  min-height: 100vh; /* 최소 높이 */
  transition: transform 0.5s ease-in-out; /* 부드러운 이동 애니메이션 */
}

.service-item h3,
.service-item p {
  text-align: center;
}

  </style>
</head>

<main id="primary" class="site-main scrollable-sections">
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

    <section class="section" id="service-details">
  <div class="service-container">
    <?php
    if (have_rows('section-service-details')): 
      while (have_rows('section-service-details')): the_row();
        $services = get_sub_field('service');
        if (is_array($services) && !empty($services)):
          foreach ($services as $index => $service): ?>
            <div class="service-item" data-index="<?= esc_attr($index) ?>">
              <h3><?= esc_html($service['title']); ?></h3>
              <p><?= wp_kses_post($service['content']); ?></p>
            </div>
          <?php endforeach;
        else: ?>
          <p>No services found.</p>
        <?php endif;
      endwhile;
    endif;
    ?>
  </div>
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
</main>

<!-- Initialize fullPage.js -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    new fullpage('#fullpage', {
      autoScrolling: true,
      navigation: true,
      navigationPosition: 'right',
      scrollOverflow: true,
      lazyLoading: true,
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const serviceContainer = document.querySelector('.service-container');
    const serviceCards = document.querySelectorAll('.service-card');
    const MIN_SCALE = 0.20;

    if (!serviceContainer || !serviceCards.length) return;

    const calculateScale = (distance, maxDistance) => {
      return Math.max(MIN_SCALE, 1 - (distance / maxDistance) * 0.5);
    };

    const updateCardScales = () => {
      const containerRect = serviceContainer.getBoundingClientRect();
      const containerCenter = containerRect.top + (containerRect.height * 0.5);
      const maxDistance = containerRect.height * 0.5;

      requestAnimationFrame(() => {
        serviceCards.forEach((card) => {
          if (card.classList.contains('active')) return;

          const cardRect = card.getBoundingClientRect();
          const cardCenter = cardRect.top - (cardRect.height * 0.5);
          const distance = Math.abs(cardCenter - containerCenter);
          const scale = calculateScale(distance, maxDistance);

          card.style.transform = `scale(${scale.toFixed(3)})`;
        });
      });
    };

    const activateCard = (index) => {
      serviceCards.forEach((card, i) => {
        if (i === index) {
          card.classList.add('active');
          card.style.transform = 'scale(1)';
        } else {
          card.classList.remove('active');
        }
      });
      updateCardScales();
    };

    const findActiveCard = () => {
      const containerRect = serviceContainer.getBoundingClientRect();
      const centerZone = {
        top: containerRect.height * 0.40,
        bottom: containerRect.height * 0.45
      };

      let activeCard = null;

      serviceCards.forEach((card, index) => {
        const cardRect = card.getBoundingClientRect();
        const cardCenter = cardRect.top - containerRect.top + (cardRect.height / 2);

        if (cardCenter >= centerZone.top && cardCenter <= centerZone.bottom) {
          activeCard = index;
        }
      });

      return activeCard;
    };

    let scrollTimeout;

    const handleScroll = () => {
      if (scrollTimeout) {
        cancelAnimationFrame(scrollTimeout);
        scrollTimeout = null;
      }
      scrollTimeout = requestAnimationFrame(() => {
        const activeCardIndex = findActiveCard();
        if (activeCardIndex !== null) {
          activateCard(activeCardIndex);
        }
      });
    };

    window.addEventListener('scroll', handleScroll);
    updateCardScales();
  });

  document.addEventListener('DOMContentLoaded', () => {
  const serviceContainer = document.querySelector('.service-container');
  const serviceItems = document.querySelectorAll('.service-item');
  let currentIndex = 0;

  const scrollToIndex = (index) => {
    if (index < 0 || index >= serviceItems.length) return; // 범위를 벗어난 경우 처리하지 않음
    serviceItems[index].scrollIntoView({ behavior: 'smooth' }); // 부드럽게 이동
    currentIndex = index;
  };

  const handleScroll = (e) => {
    e.preventDefault();

    // 휠 이벤트 감지 (deltaY 기준)
    if (e.deltaY > 0) {
      // 스크롤 아래로 이동
      scrollToIndex(currentIndex + 1);
    } else if (e.deltaY < 0) {
      // 스크롤 위로 이동
      scrollToIndex(currentIndex - 1);
    }
  };

  const handleKeyDown = (e) => {
    if (e.key === 'ArrowDown') {
      scrollToIndex(currentIndex + 1); // 아래 화살표 키
    } else if (e.key === 'ArrowUp') {
      scrollToIndex(currentIndex - 1); // 위 화살표 키
    }
  };

  // 스크롤 및 키보드 이벤트 등록
  serviceContainer.addEventListener('wheel', handleScroll, { passive: false });
  document.addEventListener('keydown', handleKeyDown);
});

</script>
