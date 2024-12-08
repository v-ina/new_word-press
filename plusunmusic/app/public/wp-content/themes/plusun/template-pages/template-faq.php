<?php

/**
 * Template Name: FAQ
 * Template Post Type: page
 */
get_header();
?>

<main id="primary" class="site-main">
  <div class="faq-page bg-gradient-black">

    <?php get_template_part('template-parts/nav', 'secondary'); ?>

    <div class="faq-page__container">
      <div class="faq-page__header">
        <div class="faq-page__title">
          <h2 class="between-plus beige inline-block">
            <?php the_title(); ?>
          </h2>
        </div>

        <!-- <div class="faq-page__filters">
          <select class="faq-page__select" id="faqCategory">
            <option value="">Toutes</option>
            <option value="gestion-juridique">Gestion Juridique</option>
            <option value="gestion-administrative">Gestion Administrative</option>
            <option value="gestion-financiere">Gestion Financière</option>
            <option value="royalties">Royalties</option>
            <option value="editions">Éditions</option>
            <option value="gestion-de-projet">Gestion de Projet</option>
          </select>
          <input type="text" class="faq-page__search" id="faqSearch" placeholder="Recherche">
        </div> -->
      </div>

      <div class="faq-page__content">
        <?php
        $categories = get_terms(array(
          'taxonomy' => 'question_type',
          'hide_empty' => false,
        ));

        foreach ($categories as $category) :
          $questions = new WP_Query(array(
            'post_type' => 'question',
            'tax_query' => array(
              array(
                'taxonomy' => 'question_type',
                'field' => 'term_id',
                'terms' => $category->term_id,
              ),
            ),
          ));
        ?>
          <div class="faq-category" data-category="<?php echo esc_attr($category->slug); ?>">
            <div class="text-center">
              <h2 class="faq-category__title between-plus beige inline-block"><?php echo esc_html($category->name); ?></h2>
            </div>
            <?php while ($questions->have_posts()) : $questions->the_post(); ?>
              <div class="faq-item">
                <h3 class="faq-item__question"><?php the_title(); ?></h3>
                <div class="faq-item__answer"><?php the_content(); ?></div>
              </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</main>



<script>
  document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item__question');
    const categorySelect = document.getElementById('faqCategory');
    const searchInput = document.getElementById('faqSearch');

    faqItems.forEach(item => {
      item.addEventListener('click', () => {
        item.classList.toggle('active');
        const answer = item.nextElementSibling;
        answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
      });
    });

    function filterFAQ() {
      const category = categorySelect.value;
      const searchTerm = searchInput.value.toLowerCase();

      document.querySelectorAll('.faq-category').forEach(cat => {
        const shouldShowCategory = category === '' || cat.dataset.category === category;
        cat.style.display = shouldShowCategory ? 'block' : 'none';

        if (shouldShowCategory) {
          cat.querySelectorAll('.faq-item').forEach(item => {
            const question = item.querySelector('.faq-item__question').textContent.toLowerCase();
            const answer = item.querySelector('.faq-item__answer').textContent.toLowerCase();
            const matchesSearch = question.includes(searchTerm) || answer.includes(searchTerm);
            item.style.display = matchesSearch ? 'block' : 'none';
          });
        }
      });
    }

    categorySelect.addEventListener('change', filterFAQ);
    searchInput.addEventListener('input', filterFAQ);
  });
</script>

<?php get_footer(); ?>