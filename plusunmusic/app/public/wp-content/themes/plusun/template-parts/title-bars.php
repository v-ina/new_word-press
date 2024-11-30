<?php

/**
 * Title bars template part
 * 
 * @param array $args Contains template parameters:
 *                    - title: The title to display
 *                    - color: Color theme ('beige' or 'black'), defaults to 'beige'
 */

$title = isset($args['title']) ? $args['title'] : '';
$color = isset($args['color']) && $args['color'] === 'black' ? 'black' : 'beige';
?>

<div class="decorated-title-wrapper fade-in">
  <span class="service-title lines-decoration <?php echo esc_attr($color); ?>">
    <span class="top-bars"><i></i></span>
    <?php echo esc_html($title); ?>
    <span class="bottom-bars"><i></i></span>
  </span>
</div>

<style>
  .decorated-title-wrapper {
    width: 100%;
    max-width: 950px;
    margin: 0 auto;
    margin-bottom: 6rem;
  }

  .service-title {
    display: inline-block;
    width: 100%;
    font-size: 82px;
    line-height: 72px;
    text-align: center;
  }

  .lines-decoration {
    position: relative;
    font-family: var(--font-title);
    font-weight: 500;
    text-transform: uppercase;
    padding: 30px 0;
  }

  /* Bars shared styles */
  .lines-decoration .top-bars,
  .lines-decoration .bottom-bars {
    position: absolute;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: space-between;
  }

  .lines-decoration .top-bars {
    top: -20px;
  }

  .lines-decoration .bottom-bars {
    bottom: -20px;
  }

  /* Bar elements */
  .lines-decoration .top-bars::before,
  .lines-decoration .top-bars::after,
  .lines-decoration .top-bars i,
  .lines-decoration .bottom-bars::before,
  .lines-decoration .bottom-bars::after,
  .lines-decoration .bottom-bars i {
    content: "";
    width: 2.5px;
    height: 20px;
    display: block;
  }

  /* Color variants */
  .lines-decoration.beige {
    color: var(--color-beige);
  }

  .lines-decoration.beige .top-bars::before,
  .lines-decoration.beige .top-bars::after,
  .lines-decoration.beige .top-bars i,
  .lines-decoration.beige .bottom-bars::before,
  .lines-decoration.beige .bottom-bars::after,
  .lines-decoration.beige .bottom-bars i {
    background-color: var(--color-beige);
  }

  .lines-decoration.black {
    color: var(--color-black);
  }

  .lines-decoration.black .top-bars::before,
  .lines-decoration.black .top-bars::after,
  .lines-decoration.black .top-bars i,
  .lines-decoration.black .bottom-bars::before,
  .lines-decoration.black .bottom-bars::after,
  .lines-decoration.black .bottom-bars i {
    background-color: var(--color-black);
  }

  @keyframes fadeIn {
  0% {
    opacity: 0;
    transform: translateY(-40px);
  }
  50% {
    opacity: 0.5;
    transform: translateY(-10px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.fade-in {
  opacity: 0;
  animation: fadeIn 1.5s ease-out forwards;
}


  /* Responsive adjustments */
  @media (max-width: 1024px) {
    .service-title {
      font-size: 66px;
      line-height: 1.2;
    }
  }

  @media (max-width: 768px) {
    .service-title {
      font-size: 48px;
    }

    .decorated-title-wrapper {
      margin-bottom: 3rem;
    }
  }
</style>