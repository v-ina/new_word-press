<?php
/*
 * Initialize required PHP calls here
 */
?>

<div id="dots-indicator" class="dots-indicator"></div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const SCROLL_DELAY = 400; // Increased delay for smoother section transitions
    const sections = document.querySelectorAll('main > section.navigable');
    const dotsContainer = document.getElementById('dots-indicator');
    const mainContainer = document.querySelector('.scrollable-sections');

    let isScrolling = false;
    let currentSectionIndex = 0;
    let lastScrollTime = 0;
    let touchStartY = 0;

    // Create navigation dots for each section
    sections.forEach((_, index) => {
      const dot = document.createElement('div');
      dot.classList.add('dot');
      dot.setAttribute('data-index', index);
      dotsContainer.appendChild(dot);

      // Add click event to each dot for direct section navigation
      dot.addEventListener('click', () => navigateToSection(index));
    });

    const dots = document.querySelectorAll('.dot');

    /*
     * Detects which section is currently in the viewport's center
     * Used for initial page load to highlight the correct navigation dot
     */
    function detectInitialSection() {
      const viewportMiddle = window.innerHeight / 2;
      let closestSection = 0;
      let closestDistance = Infinity;

      sections.forEach((section, index) => {
        const rect = section.getBoundingClientRect();
        const distance = Math.abs(rect.top + rect.height / 2 - viewportMiddle);

        if (distance < closestDistance) {
          closestDistance = distance;
          closestSection = index;
        }
      });

      currentSectionIndex = closestSection;
      updateDots();
    }

    // Smoothly scrolls to the target element using native scroll behavior
    function smoothScrollTo(element) {
      if (!element) return;

      const topOffset = element.offsetTop;
      window.scrollTo({
        top: topOffset,
        behavior: 'smooth'
      });
    }

    // Updates the visual state of navigation dots
    function updateDots() {
      dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSectionIndex);
      });
    }

    /*
     * Handles section navigation:
     * - Prevents concurrent scrolling
     * - Updates current section index
     * - Triggers smooth scroll
     * - Updates navigation dots
     */
    function navigateToSection(index) {
      if (index === currentSectionIndex || isScrolling) return;

      isScrolling = true;
      currentSectionIndex = index;
      smoothScrollTo(sections[currentSectionIndex]);
      updateDots();

      setTimeout(() => {
        isScrolling = false;
        lastScrollTime = Date.now();
      }, SCROLL_DELAY);
    }

    // Manages scroll direction and section navigation
    function handleScroll(direction) {
      const now = Date.now();
      if (isScrolling || now - lastScrollTime < SCROLL_DELAY) return;

      const newIndex = currentSectionIndex + direction;
      if (newIndex >= 0 && newIndex < sections.length) {
        navigateToSection(newIndex);
      }
    }

    // Wheel event handler with accumulator for smoother scrolling
    let wheelAccumulator = 0;
    const WHEEL_THRESHOLD = 100;

    function handleWheel(e) {
      e.preventDefault();

      /*
       * Special handling for services section:
       * If we're in the services section and the services container is scrolling,
       * allow internal scrolling before triggering section navigation
       */
      const currentSection = sections[currentSectionIndex];
      const servicesSection = document.getElementById('service-details');

      if (currentSection === servicesSection) {
        const serviceContainer = currentSection.querySelector('.service-container');
        const scrollTop = serviceContainer.scrollTop;
        const scrollHeight = serviceContainer.scrollHeight;
        const clientHeight = serviceContainer.clientHeight;

        // Allow internal scrolling if not at container boundaries
        if ((e.deltaY > 0 && scrollTop < scrollHeight - clientHeight) || // Scrolling down
          (e.deltaY < 0 && scrollTop > 0)) { // Scrolling up
          serviceContainer.scrollTop += e.deltaY;
          return; // Prevent page scroll
        }
      }

      wheelAccumulator += Math.abs(e.deltaY);
      if (wheelAccumulator >= WHEEL_THRESHOLD) {
        handleScroll(Math.sign(e.deltaY));
        wheelAccumulator = 0;
      }
    }

    // Touch event handlers for mobile support
    function handleTouchStart(e) {
      touchStartY = e.touches[0].clientY;
    }

    function handleTouchEnd(e) {
      const touchEndY = e.changedTouches[0].clientY;
      const diffY = touchEndY - touchStartY;

      if (Math.abs(diffY) > 50) { // Minimum swipe distance threshold
        handleScroll(diffY < 0 ? 1 : -1);
      }
    }

    // Event listeners setup
    mainContainer.addEventListener('wheel', handleWheel, {
      passive: false
    });
    mainContainer.addEventListener('touchstart', handleTouchStart, {
      passive: true
    });
    mainContainer.addEventListener('touchend', handleTouchEnd, {
      passive: true
    });

    // Initialize page state
    detectInitialSection();
    updateDots();
  });
</script>