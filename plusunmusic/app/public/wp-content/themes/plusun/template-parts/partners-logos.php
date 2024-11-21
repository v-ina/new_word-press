<?php

/**
 * Template part for displaying partners section
 * 
 * @param array $args Contains:
 *                    - title: Section title
 *                    - partners: Array of partner objects with logo information
 */

// Ensure we have required data
if (!isset($args['title']) || !isset($args['partners']) || empty($args['partners'])) {
  return;
}

$title = $args['title'];
$partners = $args['partners'];
?>

<section class="header-darked section-full navigable bg-gradient-black pt-[66px]">
  <div class="min-h-[100vh] flex flex-col justify-center">
    <div class="w-full flex flex-col items-center justify-center mx-auto">
      <h2 class="service-title between-plus beige inline-block text-center mb-12">
        <?php echo esc_html($title); ?>
      </h2>

      <div class="partners">
        <?php for ($i = 0; $i < 3; $i++) : ?>
          <div class="partners__line flex gap-24 items-center my-14">
            <?php foreach ($partners as $partner): ?>
              <img
                src="<?php echo esc_url($partner['logo']['sizes']['large']); ?>"
                alt="<?php echo esc_attr($partner['logo']['alt'] ?? ''); ?>">
            <?php endforeach; ?>
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </div>
</section>

<style>
  .partners {
    overflow: hidden;
  }

  .partners__line {
    will-change: transform;
    white-space: nowrap;
    gap: 96px !important;
    /* Maintains consistent gap during animation */
  }

  .partners__line img {
    user-select: none;
    -webkit-user-drag: none;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const lines = document.querySelectorAll('.partners__line');

    function calculateRequiredCopies(line) {
      const viewportWidth = window.innerWidth;
      const lineWidth = Array.from(line.querySelectorAll('img')).reduce((width, img) => {
        return width + img.offsetWidth + 96; // 96px is the gap
      }, 0);

      return Math.ceil(viewportWidth * 3 / lineWidth); // Multiply by 3 to ensure coverage
    }

    // Clone logos enough times to cover viewport
    lines.forEach(line => {
      const originalContent = line.innerHTML;
      const requiredCopies = calculateRequiredCopies(line);
      let newContent = '';

      for (let i = 0; i < requiredCopies; i++) {
        newContent += originalContent;
      }

      line.innerHTML = newContent;
      line.style.display = 'flex';
      line.style.whiteSpace = 'nowrap';
    });

    // Animation settings
    const speeds = {
      line1: 0.5,
      line2: -0.7,
      line3: 1.0
    };

    let positions = {
      line1: 0,
      line2: 0,
      line3: 0
    };

    function animate() {
      lines.forEach((line, index) => {
        const lineWidth = Array.from(line.querySelectorAll('img')).reduce((width, img) => {
          return width + img.offsetWidth + 96; // 96px is the gap
        }, 0) / 3; // Divide by 3 since we tripled the content

        const speedKey = `line${index + 1}`;
        positions[speedKey] += speeds[speedKey];

        if (Math.abs(positions[speedKey]) >= lineWidth) {
          positions[speedKey] = 0;
        }

        line.style.transform = `translateX(${positions[speedKey]}px)`;
      });

      requestAnimationFrame(animate);
    }

    // Ensure images are loaded before starting animation
    Promise.all(Array.from(document.querySelectorAll('.partners__line img'))
        .map(img => {
          if (img.complete) return Promise.resolve();
          return new Promise(resolve => img.addEventListener('load', resolve));
        }))
      .then(() => {
        // Start animation only after all images are loaded
        animate();
      });
  });
</script>