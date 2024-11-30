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
          <div class="partners__line <?php echo $i === 1 ? 'second-parallel' : ($i === 0 ? 'first-parallel' : 'third-parallel'); ?> flex gap-24 items-center my-14">
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
  }

  .partners__line img {
    user-select: none;
    -webkit-user-drag: none;
  }

  .header-darked {
  overflow-x: hidden;
  }

  .partners {
    overflow: hidden; 
    position: relative;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const pTag1 = document.querySelector('.first-parallel');
    const pTag2 = document.querySelector('.second-parallel');
    const pTag3 = document.querySelector('.third-parallel');

    const partners1 = Array.from(pTag1.querySelectorAll('img'));
    const partners2 = Array.from(pTag2.querySelectorAll('img'));
    const partners3 = Array.from(pTag3.querySelectorAll('img'));

    let count1 = 0;
    let count2 = 0;
    let count3 = 0;

    function marqueeText(count, element, partners, direction, speed) {
      const elementWidth = element.scrollWidth;
      count += speed;
      if (count > partners.length * 2.13 ) { 
        count = 0;  
      }
      const logoWidth = partners[0].offsetWidth + 96;  
      element.style.transform = `translateX(${direction * count * logoWidth}px)`;
      return count;
    }
    function animate() {
      const speed = 0.01; 
      count1 = marqueeText(count1, pTag1, partners1, -1, speed); 
      count2 = marqueeText(count2, pTag2, partners2, 1, speed); 
      count3 = marqueeText(count3, pTag3, partners3, -1, speed); 
      window.requestAnimationFrame(animate); 
    }
    function extendLineWithLogos(line, direction) {
      const logos = Array.from(line.querySelectorAll('img'));
      const logoWidth = logos[0].offsetWidth + 96;
      const requiredCopies = Math.ceil(window.innerWidth / logoWidth) * 2; 
      let originalContent = line.innerHTML;
      let newContent = originalContent;
      for (let i = 0; i < requiredCopies; i++) {
        newContent += originalContent;
      }
      line.innerHTML = newContent;
      line.style.display = 'flex';
      line.style.whiteSpace = 'nowrap';
          if (direction === 'right') {
        line.style.transform = `translateX(-${logoWidth * 2}px)`; // 오른쪽으로 늘리기
      } else if (direction === 'left') {
        line.style.transform = `translateX(${logoWidth * 2}px)`; // 왼쪽으로 늘리기
      }
    }
    extendLineWithLogos(pTag1, 'right'); 
    extendLineWithLogos(pTag2, 'left');  
    extendLineWithLogos(pTag3, 'right'); 

    animate(); 
  });
</script>
