<div class="bg-gray-100">
  <!-- Title -->
  <div class="bg-gray-800 text-lg text-white text-center uppercase px-4 py-2"><?php _e('Cамые лучшие', 'odessa'); ?></div>
  <!-- END Title -->

  <div class="px-6 py-4">
    <!-- Subtitle Карпаты -->
    <div>
      <div class="relative overflow-hidden mb-3">
        <div class="inline-block relative text-sm bg-gray-100 uppercase font-bold z-1 pr-2"><?php _e('Лучшие отели в Карпатах', 'odessa'); ?></div>
        <div class="h-line"></div>
      </div>
    </div>
    <!-- END Subtitle -->

    <!-- List -->
    <ul class="ml-6 text-sm mb-8">
      <?php $custom_query = new WP_Query( array( 
        'post_type' => 'hotels', 
        'posts_per_page' => 10,
        'orderby' => 'meta_value_num',
        'meta_key' => '_crb_hotels_rating',
        'order' => 'DESC',
        'tax_query' => array(
          array(
            'taxonomy' => 'region',
            'field'    => 'slug',
            'terms'    => 'karpaty',
          ),
        ),
      ));
      if ($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
        <li class="bullet bullet-blue">
          <a href="<?php the_permalink(); ?>" class="text-gray-800"><?php the_title(); ?></a>
        </li>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </ul>
    <!-- END List -->

    <!-- Subtitle Черное море -->
    <div>
      <div class="relative overflow-hidden mb-3">
        <div class="inline-block relative text-sm bg-gray-100 uppercase font-bold z-1 pr-2"><?php _e('Лучшие отели на Черном море', 'odessa'); ?></div>
        <div class="h-line"></div>
      </div>
    </div>
    <!-- END Subtitle -->

    <!-- List -->
    <ul class="ml-6 text-sm mb-8">
      <?php $custom_query = new WP_Query( array( 
        'post_type' => 'hotels', 
        'posts_per_page' => 10,
        'orderby' => 'meta_value_num',
        'meta_key' => '_crb_hotels_rating',
        'order' => 'DESC',
        'tax_query' => array(
          array(
            'taxonomy' => 'region',
            'field'    => 'slug',
            'terms'    => 'chernoe-more',
          ),
        ),
      ));
      if ($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
        <li class="bullet bullet-blue">
          <a href="<?php the_permalink(); ?>" class="text-gray-800"><?php the_title(); ?></a>
        </li>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </ul>
    <!-- END List -->

    <!-- Subtitle Азовское море -->
    <div>
      <div class="relative overflow-hidden mb-3">
        <div class="inline-block relative text-sm bg-gray-100 uppercase font-bold z-1 pr-2"><?php _e('Лучшие отели на Азовском море', 'odessa'); ?></div>
        <div class="h-line"></div>
      </div>
    </div>
    <!-- END Subtitle -->

    <!-- List -->
    <ul class="ml-6 text-sm mb-8">
      <?php $custom_query = new WP_Query( array( 
        'post_type' => 'hotels', 
        'posts_per_page' => 10,
        'orderby' => 'meta_value_num',
        'meta_key' => '_crb_hotels_rating',
        'order' => 'DESC',
        'tax_query' => array(
          array(
            'taxonomy' => 'region',
            'field'    => 'slug',
            'terms'    => 'azovskoe-more',
          ),
        ),
      ));
      if ($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
        <li class="bullet bullet-blue">
          <a href="<?php the_permalink(); ?>" class="text-gray-800"><?php the_title(); ?></a>
        </li>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </ul>
    <!-- END List -->
  </div>
</div>