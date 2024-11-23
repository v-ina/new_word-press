<?php

/**
 * Template part for displaying split services section
 * 
 * @param array $args['inserts'] Contains two service panels data:
 * - $args['inserts'][0] : First service panel (encart_1)
 * - $args['inserts'][1] : Second service panel (encart_2)
 */

// Ensure we have our arguments
if (!isset($args['inserts']) || count($args['inserts']) !== 2) {
  return;
}

// Extract service panels data
$encart_1 = $args['inserts'][0];
$encart_2 = $args['inserts'][1];
?>

<section class="services section-full navigable">
  <div class="services__container">
    <?php if ($encart_1) : ?>
      <div class="services__half services__half--left" id="leftHalf">
        <div class="services__content bg-gradient-blue">
          <?php if (!empty($encart_1['title'])) : ?>
            <p class="services__title font-title">
              <?php echo esc_html($encart_1['title']); ?>
            </p>
          <?php endif; ?>
          <div class="services__hidden-content">
            <?php if (!empty($encart_1['content'])) : ?>
              <p class="services__description">
                <?php echo wp_kses_post($encart_1['content']); ?>
              </p>
            <?php endif; ?>
            <?php if (!empty($encart_1['action_text'])) : ?>
              <a href="<?php echo esc_url('/labels-artists-services/'); ?>" class="btn btn-white">
                <?php echo esc_html($encart_1['action_text']); ?>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($encart_2) : ?>
      <div class="services__half services__half--right" id="rightHalf">
        <div class="services__content bg-gradient-black">
          <?php if (!empty($encart_2['title'])) : ?>
            <p class="services__title font-title">
              <?php echo esc_html($encart_2['title']); ?>
            </p>
          <?php endif; ?>
          <div class="services__hidden-content">
            <?php if (!empty($encart_2['content'])) : ?>
              <p class="services__description">
                <?php echo wp_kses_post($encart_2['content']); ?>
              </p>
            <?php endif; ?>
            <?php if (!empty($encart_2['action_text'])) : ?>
              <a href="<?php echo esc_url('/plus-un-business-management/'); ?>" class="btn btn-white">
                <?php echo esc_html($encart_2['action_text']); ?>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const rightHalf = document.querySelector('.services__half--right');
    const leftHalf = document.querySelector('.services__half--left');

    if (rightHalf && leftHalf) {
      rightHalf.addEventListener('mouseenter', () => {
        leftHalf.classList.add('shrink');
      });

      rightHalf.addEventListener('mouseleave', () => {
        leftHalf.classList.remove('shrink');
      });
    }
  });
</script>

<style>
  .services__container {
    display: flex;
    height: 100vh;
    width: 100%;
  }

  .services__half {
    width: 50%;
    transition: width 0.35s ease-in-out;
    position: relative;
  }

  .services__content {
    height: 100%;
    padding: 2rem;
    transition: padding 0.35s ease-in-out;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .services__title {
    transition: transform 0.25s ease-in-out,
      opacity 0.15s ease-in-out,
      font-size 0.25s ease-in-out;
    transform-origin: center left;
    margin: 0;
    color: #ffffff;
    font-size: 68px;
    line-height: 1.2;
    text-transform: uppercase;
    color: var(--color-beige);
    text-align: center;
  }

  .services__hidden-content {
    opacity: 0;
    transition: opacity 0.35s ease-in-out;
  }

  .services__description {
    color: var(--color-beige);
    font-size: 1.125rem;
    text-align: center;
    margin: 0 auto;
    margin-top: 1.5rem;
    margin-bottom: 2rem;
    width: 60%;
  }

  /* Hover effects */
  .services__half:hover {
    width: 75%;
  }

  .services__half:hover .services__hidden-content {
    opacity: 1;
  }

  .services__hidden-content {
    display: none;
    text-align: center;
  }

  .services__half:hover .services__hidden-content {
    display: block;
  }

  /* Left side effects */
  .services__half--left:hover+.services__half--right {
    width: 25%;
  }

  .services__half--left:hover+.services__half--right .services__title {
    transform: rotate(-90deg);
    font-size: 32px;
    transform-origin: center;
  }

  /* Right side effects */
  .services__half--right:hover {
    width: 75%;
  }

  .services__half--left.shrink {
    width: 25%;
  }

  .services__half--left.shrink .services__title {
    transform: rotate(-90deg);
    font-size: 32px;
    transform-origin: center;
  }

  /* Animation */
  @keyframes rotateFade {
    0% {
      opacity: 1;
      transform: rotate(0deg);
      font-size: inherit;
    }

    50% {
      opacity: 0;
      transform: rotate(-45deg);
    }

    51% {
      font-size: 32px;
    }

    100% {
      opacity: 1;
      transform: rotate(-90deg);
      font-size: 32px;
    }
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .services__container {
      flex-direction: column;
    }

    .services__half {
      width: 100%;
    }

    .services__half:hover,
    .services__half.shrink {
      width: 100%;
    }

    .services__title {
      transform: none !important;
      font-size: 24px !important;
    }

    .services__hidden-content {
      opacity: 1;
    }
  }
</style>