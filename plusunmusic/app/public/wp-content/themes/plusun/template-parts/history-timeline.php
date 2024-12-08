<?php

/**
 * Template part for displaying history timeline
 * 
 * @param array $args['date_blocks'] Array of date blocks from ACF repeater
 */

// Ensure we have our date blocks
if (!isset($args['date_blocks']) || empty($args['date_blocks'])) {
  return;
}

$date_blocks = $args['date_blocks'];
?>

<section class="timeline">
  <div class="timeline__line"></div>

  <?php foreach ($date_blocks as $index => $block): ?>
    <?php
    $year = $block['year'];
    $description = $block['description'];
    $isEven = ($index + 1) % 2 == 0;
    ?>
    <div class="timeline__item fade-in-timeline <?php echo $isEven ? 'timeline__item--right' : 'timeline__item--left'; ?>">
      <div class="timeline__content content-beige">
        <span class="timeline__year"><?php echo esc_html($year); ?></span>
        <div class="timeline__description content-beige"><?php echo wp_kses_post($description); ?></div>
      </div>
    </div>
  <?php endforeach; ?>
</section>

<style>
  .timeline {
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 0;
  }

  .timeline__line {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    width: 45px;
    background-repeat: repeat-y;
    background-image: url('/wp-content/themes/plusun/assets/img/ruler-timeline.svg');
    transform: translateX(-50%);
  }

  .timeline__item {
    position: relative;
    width: 50%;
    margin-bottom: 60px;
  }

  .timeline__item--left {
    padding-right: 40px;
    text-align: right;
  }

  .timeline__item--right {
    margin-left: 50%;
    padding-left: 40px;
    text-align: left;
  }

  .timeline__content {
    position: relative;
    padding: 20px;
  }

  .timeline__year {
    font-size: 72px;
    font-family: var(--font-title);
    margin-bottom: 15px;
    font-weight: 500;
  }

  .timeline__description {
    color: var(--color-beige);
    font-size: 16px;
    line-height: 1.5;
  }

  .timeline__item--right .timeline__description {
    margin-left: 0;
  }

  .timeline__item--left .timeline__description {
    margin-left: auto;
  }

  .fade-in-timeline {
    opacity: 0;
    transform: translateY(40px);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
  }

  .fade-in-timeline.is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* Responsive Design */
  @media screen and (max-width: 768px) {
    .timeline__line {
      left: 20px;
    }

    .timeline__item {
      width: 100%;
      margin-left: 0;
      padding-left: 50px;
      padding-right: 20px;
      text-align: left;
    }

    .timeline__item--left {
      padding-right: 20px;
      text-align: left;
    }

    .timeline__description {
      margin-left: 0;
    }
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const fadeElements = document.querySelectorAll(".fade-in-timeline");
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target); 
          }
        });
      },
      {
        root: null, 
        threshold: 0, 
        rootMargin: "-30% 0px", 
      }
    );
    fadeElements.forEach((el) => observer.observe(el));
  });
</script>