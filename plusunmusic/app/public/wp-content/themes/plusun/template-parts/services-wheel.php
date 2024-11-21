<?php
/*
 * Service Details Section Template Part
 * 
 * Displays a vertical scrollable list of services with expanding cards
 * and scaling animations based on scroll position.
 * 
 * @param array $args['services'] Array of service objects with:
 *                               - title: Service name
 *                               - content: Service description
 *                               - action_text: CTA button text
 */

// Get services from passed arguments
$services = $args['services'];
?>

<section class="header-darked section-full navigable bg-gradient-black" id="service-details">
  <!-- Main scrollable container for service cards -->
  <div class="service-container">
    <div id="services-accordion" class="w-full max-w-[800px] mx-auto px-24">
      <?php foreach ($services as $index => $service): ?>
        <div class="service-card" data-index="<?= esc_attr($index) ?>">
          <!-- Expanded state of the service card -->
          <div class="service-expanded bg-beige p-12 rounded-[20px] transition-all duration-300">
            <p class="font-title text-[46px] font-medium uppercase text-center text-orange">
              <?= esc_html($service['title']); ?>
            </p>
            <div class="service-content">
              <p class="text-center text-[14px] text-orange mb-8">
                <?= wp_kses_post($service['content']); ?>
              </p>
              <div class="text-center">
                <a href="#" class="btn btn-orange">+ <?= esc_html($service['action_text']); ?> +</a>
              </div>
            </div>
          </div>
          <!-- Collapsed state of the service card -->
          <div class="service-collapsed rounded-[20px] transition-all duration-100">
            <p class="font-title text-[28px] font-medium uppercase text-center text-white">
              <?= esc_html($service['title']); ?>
            </p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
  /* Main container styles */
  .service-container {
    overflow-y: auto;
    -ms-overflow-style: none;
    scrollbar-width: none;
    height: 100vh;
    position: relative;
  }

  /* Hide scrollbar for Webkit browsers */
  .service-container::-webkit-scrollbar {
    display: none;
  }

  /* Service card base styles */
  .service-card {
    scroll-snap-align: center;
    margin: 14px 0;
    height: 30px;
    transition: all ease 0.2s;
    will-change: transform;
    position: relative;
  }

  /* Active card state */
  .service-card.active {
    margin: 0;
    height: auto;
  }

  /* Expanded state styles */
  .service-card .service-expanded {
    display: none;
    opacity: 0;
    transition: opacity 0.3s ease-out;
  }

  .service-card.active .service-expanded {
    display: block;
    opacity: 1;
    position: relative;
  }

  /* Plus symbols for active expanded state */
  .service-card.active .service-expanded::before,
  .service-card.active .service-expanded::after {
    content: "+";
    position: absolute;
    top: 50%;
    left: -72px;
    width: 20px;
    height: 20px;
    font-size: 90px;
    color: #fff;
    line-height: 0;
  }

  .service-card.active .service-expanded::after {
    left: auto;
    right: -44px;
  }

  /* Collapsed state styles */
  .service-card .service-collapsed {
    display: block;
    opacity: 1;
    transition: opacity 0.3s ease-out;
  }

  .service-card.active .service-collapsed {
    display: none;
  }

  /* Accordion container spacing */
  #services-accordion {
    padding: 40vh 0;
    margin-bottom: 20vh;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    #services-accordion {
      padding-left: 1rem;
      padding-right: 1rem;
    }

    .service-card .service-expanded,
    .service-card .service-collapsed {
      padding: 1.5rem;
    }
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    /*
     * Initialize service cards animation system
     * Handles scaling of cards based on scroll position and
     * manages active/inactive states
     */
    const serviceContainer = document.querySelector('.service-container');
    const serviceCards = document.querySelectorAll('.service-card');
    const MIN_SCALE = 0.20; // Minimum scale for inactive cards
    let isFirstEntry = true;

    if (!serviceContainer || !serviceCards.length) return;

    // Calculate scale based on distance from center
    const calculateScale = (distance, maxDistance) => {
      return Math.max(MIN_SCALE, 1 - (distance / maxDistance) * 0.5);
    };

    // Update scale of all inactive cards
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

    // Set active state for selected card
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

    // Find which card should be active based on scroll position
    const findActiveCard = () => {
      const containerRect = serviceContainer.getBoundingClientRect();
      // Define center zone for activation (40-45% of container height)
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

    // Initialize first card on section entry
    const sectionObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && isFirstEntry) {
          serviceContainer.scrollTop = 0;
          activateCard(0);
          isFirstEntry = false;
        }
      });
    }, {
      threshold: 0.1
    });

    sectionObserver.observe(document.getElementById('service-details'));

    // Optimized scroll handling
    let scrollTimeout;

    const handleScroll = () => {
      if (scrollTimeout) {
        cancelAnimationFrame(scrollTimeout);
      }

      scrollTimeout = requestAnimationFrame(() => {
        const activeIndex = findActiveCard();
        if (activeIndex !== null) {
          const activeCard = serviceCards[activeIndex];
          const containerRect = serviceContainer.getBoundingClientRect();
          const cardRect = activeCard.getBoundingClientRect();

          activateCard(activeIndex);
        }
      });
    };

    // Event listeners setup
    serviceContainer.addEventListener('scroll', handleScroll, {
      passive: true
    });
    window.addEventListener('resize', updateCardScales, {
      passive: true
    });

    // Initial setup with slight delay to ensure proper rendering
    setTimeout(() => {
      activateCard(0);
      updateCardScales();
    }, 100);
  });
</script>