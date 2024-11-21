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
    <div class="timeline__item <?php echo $isEven ? 'timeline__item--right' : 'timeline__item--left'; ?>">
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
    /* Replace with your line image */
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
    color: #E5E1D6;
    /* Replace with your cream color */
    font-size: 16px;
    line-height: 1.5;
  }

  /* For right-aligned items, float description to the right */
  .timeline__item--right .timeline__description {
    margin-left: 0;
  }

  /* For left-aligned items, float description to the right */
  .timeline__item--left .timeline__description {
    margin-left: auto;
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