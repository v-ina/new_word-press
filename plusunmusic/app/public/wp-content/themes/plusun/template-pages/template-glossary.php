<?php

/**
 * Template Name: Lexique
 * Template Post Type: page
 */
get_header(); ?>

<main id="primary" class="site-main">

  <?php while (have_posts()) : the_post(); ?>
    <div class="lexique-page bg-gradient-black">

      <?php get_template_part('template-parts/nav', 'secondary'); ?>

      <div class="lexique">

        <div class="lexique__title">
          <h2 class="service-title between-plus beige inline-block">
            <?php the_title(); ?>
          </h2>
        </div>

        <nav class="lexique__nav">
          <?php
          $alphabet = range('A', 'Z');
          foreach ($alphabet as $letter) {
            echo "<a href='#letter-{$letter}' class='lexique__nav-link'>{$letter}</a>";
          }
          echo "<a href='#letter-#' class='lexique__nav-link'>#</a>";
          ?>
        </nav>

        <div class="lexique__content">
          <?php
          $terms = get_posts([
            'post_type' => 'terme',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
          ]);

          $terms_by_letter = [];
          foreach ($terms as $term) {
            $first_letter = mb_strtoupper(mb_substr($term->post_title, 0, 1, 'UTF-8'), 'UTF-8');
            if ($first_letter === 'É') {
              $first_letter = 'E';
            } elseif (!ctype_alpha($first_letter)) {
              $first_letter = '#';
            }
            if (!isset($terms_by_letter[$first_letter])) {
              $terms_by_letter[$first_letter] = [];
            }
            $terms_by_letter[$first_letter][] = $term;
          }

          // Sort the array keys alphabetically, but ensure '#' is at the end
          uksort($terms_by_letter, function ($a, $b) {
            if ($a === '#') return 1;
            if ($b === '#') return -1;
            return $a <=> $b;
          });

          echo "<div class='lexique__grid'>";
          $column = 0;
          foreach ($terms_by_letter as $letter => $letter_terms) {
            $letter_low = strtolower($letter);
            echo "<div class='lexique__column'>";
            echo "<div id='letter-{$letter}' class='lexique__section'>";
            echo "<h2 class='lexique__letter'>{$letter}/{$letter_low}</h2>";
            foreach ($letter_terms as $term) {
              echo "<div class='lexique__term'>";
              echo "<a href='#' class='lexique__term-link' data-term-id='{$term->ID}'>{$term->post_title}</a>";
              echo "</div>";
            }
            echo "</div>";
            echo "</div>";

            $column++;
            if ($column >= 3) {
              $column = 0;
            }
          }
          echo "</div>";
          ?>
        </div>
      </div>
    </div>

    <div class="lexique__popup" id="termPopup">
      <div class="lexique__popup-content bg-gradient-blue2">
        <div class="text-center mb-6">
          <h3 class="lexique__popup-title between-plus" id="popupTitle"></h3>
        </div>
        <div class="lexique__popup-definition" id="popupDefinition"></div>
        <button class="lexique__popup-close" id="popupClose">Retour au lexique</button>
      </div>
    </div>

  <?php endwhile; ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Smooth scrolling
      document.querySelectorAll('.lexique__nav-link').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          e.preventDefault();
          const targetId = this.getAttribute('href');
          if (targetId !== '#') {
            document.querySelector(targetId).scrollIntoView({
              behavior: 'smooth'
            });
          }
        });
      });

      // Popup functionality
      const popup = document.getElementById('termPopup');
      const popupTitle = document.getElementById('popupTitle');
      const popupDefinition = document.getElementById('popupDefinition');
      const popupClose = document.getElementById('popupClose');

      document.querySelectorAll('.lexique__term-link').forEach(link => {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          const termId = this.getAttribute('data-term-id');

          // AJAX request to get term definition
          fetch(`/wp-json/wp/v2/terme/${termId}`)
            .then(response => response.json())
            .then(data => {
              popupTitle.textContent = data.title.rendered;
              popupDefinition.innerHTML = data.content.rendered;
              popup.style.display = 'block';
            });
        });
      });

      popupClose.addEventListener('click', function() {
        popup.style.display = 'none';
      });

      window.addEventListener('click', function(e) {
        if (e.target == popup) {
          popup.style.display = 'none';
        }
      });
    });
  </script>
</main>

<?php get_footer(); ?>