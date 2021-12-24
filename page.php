<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <main id="primary" class="page-padding">
    <div class="container">
      <div class="mb-12">
        <div class="text-3xl lg:text-4xl text-center font-bold">
          <?php the_title(); ?>  
        </div>
      </div>
      <div class="flex flex-col lg:flex-row lg:-mx-8 mb-12">
        <!-- Основной поток -->
        <div class="w-full lg:w-8/12 justify-center px-0 lg:px-8 mx-auto">
          <div class="content">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </div>
  </main>

<?php endwhile; endif; wp_reset_postdata(); ?>

<?php get_footer();