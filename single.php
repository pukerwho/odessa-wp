<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <main id="primary" class="page-padding">
    <div class="container">
      <div class="mb-12">
        <div class="text-3xl lg:text-4xl font-bold">
          <?php the_title(); ?>  
        </div>
      </div>
      <div class="flex flex-col lg:flex-row lg:-mx-8 mb-12">
        <!-- Основной поток -->
        <div class="w-full lg:w-8/12 px-0 lg:px-8">
          <div class="content mb-6">
            <?php the_content(); ?>
          </div>
          <!-- Комментарии -->
          <div>
            <div class="relative overflow-hidden mb-6">
              <h2 class="inline-block relative bg-white uppercase font-bold z-1 pr-2">📝  <?php _e('Комментарии', 'odessa'); ?></h2>
              <div class="h-line"></div>
            </div>
            <?php comments_template(); ?>
          </div>
          <!-- END Комментарии -->
        </div>
        <!-- Сайдбар -->
        <div class="w-full lg:w-4/12 px-0 lg:px-8">
          <?php get_template_part('template-parts/sidebar/sidebar-top'); ?>
          <?php get_template_part('template-parts/sidebar/sidebar-bottom'); ?>
        </div>
        <!-- END Сайдбар -->
      </div>
    </div>
  </main>

<?php endwhile; endif; wp_reset_postdata(); ?>

<?php get_footer();