<?php

/**
 * Template part for displaying hero heading section
 * 
 * @param array $args Contains:
 *                    - intro: Introduction text
 *                    - title_items: Title items array
 *                    - subtitle: Subtitle text
 *                    - action_text: CTA button text
 */

// Ensure we have our data
if (!isset($args['intro']) || !isset($args['subtitle']) || !isset($args['action_text'])) {
  return;
}

$intro = $args['intro'];
$title_items = $args['title_items'] ?? [];
$subtitle = $args['subtitle'];
$action_text = $args['action_text'];
?>

<section id="home-entry" class="section-full navigable">
  <div class="min-h-[100vh] w-full max-w-[768px] mx-auto flex flex-col pt-12 items-center justify-center">
    <p class="font-title text-[20px] text-center mb-24 -mt-40">
      <?php echo wp_kses_post($intro); ?>
    </p>

    <div class="flex flex-col justify-center items-center leading-[112px]">
      <p class="alternate-titles between-plus font-title text-[82px] text-semibold uppercase">
        <?php
        if (!empty($title_items)) {
          echo esc_html($title_items[0]['item']);
        }
        ?>
      </p>

      <p class="font-title text-[82px] text-semibold uppercase mb-4">
        <?php echo esc_html($subtitle); ?>
      </p>

      <a href="#" class="btn btn-white">
        + <?php echo esc_html($action_text); ?> +
      </a>
    </div>
  </div>
</section>

<style>
  .alternate-titles {
    opacity: 1;
    will-change: opacity;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Get the title items from PHP and convert to JavaScript array
    const titleItems = <?php echo json_encode(array_map(function ($item) {
                          return $item['item'];
                        }, $title_items)); ?>;

    if (!titleItems || titleItems.length === 0) return;

    // Get the element where we'll display the titles
    const titleElement = document.querySelector('.alternate-titles');
    if (!titleElement) return;

    // Animation settings
    const settings = {
      duration: 1500,
      fadeTime: 600,
      currentIndex: 0
    };

    // Add CSS for fade transitions
    titleElement.style.transition = `opacity ${settings.fadeTime}ms ease-in-out`;

    function updateTitle() {
      // Fade out
      titleElement.style.opacity = '0';

      // Wait for fade out, then update text and fade in
      setTimeout(() => {
        titleElement.textContent = titleItems[settings.currentIndex];
        titleElement.style.opacity = '1';

        // Update index for next iteration
        settings.currentIndex = (settings.currentIndex + 1) % titleItems.length;
      }, settings.fadeTime);
    }

    // Start the interval if we have more than one item
    if (titleItems.length > 1) {
      setInterval(updateTitle, settings.duration + settings.fadeTime);
    }

    // Set initial text
    titleElement.textContent = titleItems[0];
    titleElement.style.opacity = '1';
  });
</script>