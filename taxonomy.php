<?php get_header(); ?>

<!-- Текущая категория  -->
<?php 
  $getCurrentTerm = get_queried_object()->taxonomy; 
  $getCurrentTermId = get_queried_object()->term_id; 
?>

<main id="primary" class="page-padding">
  <div class="container">
    <div class="welcome w-full h-48 relative mb-10">
      <div class="w-full h-48">
        <img src="https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="<?php single_term_title(); ?>" class="w-full h-full object-cover rounded-xl">
      </div>
      <div class="w-full h-full absolute top-0 left-0 bg-gradient-to-b from-gray-800 to-transparent rounded-xl"></div>
      <div class="w-full h-full flex flex-col justify-center items-center absolute top-0 left-0 text-white z-1 ">
        <div class="text-4xl font-bold mb-6">
          <?php single_term_title(); ?>  
        </div>
        <div class="opacity-75 text-xl italic font-bold">
          <?php _e('Все отели в этом городе', 'odessa'); ?>
        </div>
      </div>
    </div>
    <div class="flex flex-col lg:flex-row lg:-mx-8 mb-12">
      <!-- Основной поток -->
      <div class="w-full lg:w-8/12 px-0 lg:px-8">
        <?php 
          $query = new WP_Query( array( 
            'post_type' => 'hotels', 
            'posts_per_page' => 10,
            'order'    => 'DESC',
            'tax_query' => array(
              array(
                'taxonomy' => $getCurrentTerm,
                'terms' => $getCurrentTermId,
                'field' => 'term_id',
                'include_children' => true,
                'operator' => 'IN'
              )
            ),
          ) );
        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
          <div class="w-full lg:w-3/12 px-0 lg:px-2 mb-6">
            <?php get_template_part('template-parts/hotels/hotel-card'); ?>
          </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </div>
      <!-- END Основной поток -->

      <!-- Сайдбар -->
      <div class="w-full lg:w-4/12 px-0 lg:px-8">
        <?php get_template_part('template-parts/sidebar/sidebar-top'); ?>
        <?php get_template_part('template-parts/sidebar/sidebar-bottom'); ?>
      </div>
      <!-- END Сайдбар -->
    </div>
  </div>
</main>

<?php get_footer(); ?>
