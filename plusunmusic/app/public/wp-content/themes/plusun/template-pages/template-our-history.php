<?php

/**
 * Template Name: Notre histoire
 * Template Post Type: page
 */
get_header(); ?>

<main id="primary" class="site-main">

  <?php
  while (have_posts()) :
    the_post();

  ?>

    <div class="bg-gradient-gray">

      <!-- Intro section -->
      <section class="section-full flex flex-col justify-center items-center">
        <div class="content">
          <h2 class="text-center">
            <?php
            get_template_part('template-parts/title', 'bars', array(
              'title' => get_the_title(),
              'color' => 'beige'
            ));
            ?>
          </h2>


          <div class="max-w-[900px] mx-auto mt-24 text-center content-beige">
            <?php the_content(); ?>
          </div>
        </div>
      </section>

      <!-- Timeline section -->
      <section class="timeline">
        <div class="timeline__line"></div>

        <?php
        // Get all date blocks from the repeater field
        $date_blocks = array();

        if (have_rows('date_blocks')):
          while (have_rows('date_blocks')) : the_row();
            $date_blocks[] = array(
              'year' => get_sub_field('year'),
              'description' => get_sub_field('description')
            );
          endwhile;
        endif;

        // Pass the date blocks to the template part
        get_template_part('template-parts/history', 'timeline', array(
          'date_blocks' => $date_blocks
        ));
        ?>
      </section>

      <!-- Values section -->
      <section class="section-full bg-gradient-black pb-12">
        <div class="w-full max-w-[1600px] mx-auto pt-40 px-5">
          <div class="text-center pb-12">
            <p class="between-plus beige inline-block">Nos valeurs</p>
          </div>
          <?php if (have_rows('our_values')): ?>
            <div class="values-container">
              <?php while (have_rows('our_values')) : the_row();
                $title = get_sub_field('title');
                $description = get_sub_field('description');
              ?>
                <div class="value-item p-12 mb-8" data-description="<?php echo esc_attr($description); ?>">
                  <p class="publishing-title font-title text-white uppercase font-medium text-[40px]">
                    <?php echo $title; ?>
                  </p>
                  <div class="grid grid-cols-2">
                    <div></div>
                    <div class="white-content description hidden">
                      <?php echo $description; ?>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>
        </div>
        <style>
          .value-item {
            background: var(--bg-gradient-black);
            cursor: pointer;
          }

          .value-item.active {
            background: linear-gradient(5deg, #F75711 -20.72%, #FFFADE 314.89%);
          }

          .description {
            margin-top: 20px;
            color: white;
          }

          .hidden {
            display: none;
          }
        </style>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            const valueItems = document.querySelectorAll('.value-item');

            valueItems.forEach(item => {
              item.addEventListener('click', function() {
                const description = this.querySelector('.description');
                const wasActive = this.classList.contains('active');

                // Reset all items
                valueItems.forEach(otherItem => {
                  otherItem.classList.remove('active');
                  otherItem.querySelector('.description').classList.add('hidden');
                });

                if (!wasActive) {
                  this.classList.add('active');
                  description.classList.remove('hidden');
                }
              });
            });
          });
        </script>
      </section>


    </div>
  <?php endwhile; ?>

</main>


<?php get_footer(); ?>