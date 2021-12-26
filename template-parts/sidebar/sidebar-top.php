<div>
  <div class="relative overflow-hidden mb-6">
    <h2 class="inline-block relative bg-white uppercase font-bold z-1 pr-2">➕ <?php _e('Добавить отель', 'odessa'); ?></h2>
    <div class="h-line"></div>
  </div>
  <div class="mb-6">
    <div class="italic opacity-75 mb-3"><?php _e('Вы можете самостоятельно добавить отель на наш сайт', 'odessa'); ?> 👇</div>
    <div>
      <a href="<?php home_url(); ?>/add" class="w-full block custom-btn-dark"><?php _e('Добавить', 'odessa'); ?></a>
    </div>
  </div>
  <div class="bg-gray-100 rounded-lg p-4 mb-6">
    <div><?php _e('Отелей в каталоге', 'odessa'); ?>: <span class="font-semibold"><?php $count_posts = wp_count_posts('hotels'); $published_posts = $count_posts->publish; echo $published_posts/2; ?></span></div>
    <div><?php _e('Последнее объявление', 'odessa'); ?>: <span class="font-semibold"><?php $today = date("d/m/Y"); echo $today; ?></span></div>
  </div>
  <?php if ( !is_post_type_archive('hotels') ) { ?>
  <div class="relative overflow-hidden mb-6">
    <h2 class="inline-block relative bg-white uppercase font-bold z-1 pr-2">👁️ <?php _e('Сейчас смотрят эти города', 'odessa'); ?></h2>
    <div class="h-line"></div>
  </div>
  <div class="flex flex-wrap -mx-2 mb-6">
    <?php $sidebar_region_rand = get_terms( array( 
      'taxonomy' => 'city', 
      'hide_empty' => false,
    ));
    shuffle( $sidebar_region_rand );
    foreach ( array_slice($sidebar_region_rand, 0, 6) as $sidebar_region ): ?>
      <div class="w-1/2 h-40 px-2 mb-4">
        <div class="h-full relative overflow-x-hidden rounded-lg">
          <a href="<?php echo get_term_link($sidebar_region); ?>" class="absolute-link"></a>
          <img src="<?php echo carbon_get_term_meta($sidebar_region->term_id, 'crb_city_img' ); ?>" alt="<?php echo $sidebar_region->name ?>" loading="lazy" class="w-full h-full object-cover ">
          <div class="absolute bottom-4 left-0 right-0 text-white text-center text-sm font-bold z-1">
            <?php echo $sidebar_region->name ?>
          </div>
          <div class="w-full h-full absolute top-0 left-0 bg-gradient-to-b from-transparent to-gray-900"></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <?php } ?>
  <?php if ( is_post_type_archive('hotels') ) { ?>
  <div class="relative overflow-hidden mb-6">
    <h2 class="inline-block relative bg-white uppercase font-bold z-1 pr-2">📍 <?php _e('Все курорты', 'odessa'); ?></h2>
    <div class="h-line"></div>
  </div>
  <ul class="ml-6 mb-6">
  <?php $sidebar_cities = get_terms( array( 
    'taxonomy' => 'city', 
    'hide_empty' => false,
  ));
  shuffle( $sidebar_cities );
  foreach ( $sidebar_cities as $sidebar_city ): ?>
    <li class="bullet bullet-blue">
      <a href="<?php echo get_term_link($sidebar_city); ?>" class="text-gray-800"><?php echo $sidebar_city->name ?></a>
    </li>
  <?php endforeach; ?>
  </ul>
  <?php } ?>
  <div class="mb-12">
    <div class="relative overflow-hidden mb-6">
      <h2 class="inline-block relative bg-white uppercase font-bold z-1 pr-2">🔝 <?php _e('Самые популярные отели', 'odessa'); ?></h2>
      <div class="h-line"></div>
    </div>
    <div>
      <ol>
        <?php $iterator_popular_query = 1; ?>
        <?php 
          $hotels_popular_query = new WP_Query( array( 
            'post_type' => 'hotels', 
            'posts_per_page' => 10,
          ) );
          if ($hotels_popular_query->have_posts()) : while ($hotels_popular_query->have_posts()) : $hotels_popular_query->the_post(); 
        ?>
          <li class="mb-4"><a href="<?php the_permalink(); ?>" class="flex items-center text-sm hover:text-red-700"><span class="number-iterator"><?php echo $iterator_popular_query; ?></span><?php the_title(); ?></a></li>
          <?php $iterator_popular_query = $iterator_popular_query + 1; ?>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </ol>
    </div>
  </div>
  <div class="mb-6">
    <div class="relative overflow-hidden mb-6">
      <h2 class="inline-block relative bg-white uppercase font-bold z-1 pr-2">🔝 <?php _e('Самые лучшие отели', 'odessa'); ?></h2>
      <div class="h-line"></div>
    </div>
    <div>
      <ol>
        <?php $iterator_popular_query = 1; ?>
        <?php 
          $hotels_popular_query = new WP_Query( array( 
            'post_type' => 'hotels', 
            'posts_per_page' => 10,
            'orderby' => 'meta_value_num',
            'meta_key' => '_crb_hotels_rating',
            'order' => 'DESC',
          ) );
          if ($hotels_popular_query->have_posts()) : while ($hotels_popular_query->have_posts()) : $hotels_popular_query->the_post(); 
        ?>
          <li class="mb-4"><a href="<?php the_permalink(); ?>" class="flex items-center text-sm hover:text-red-700"><span class="number-iterator"><?php echo $iterator_popular_query; ?></span><?php the_title(); ?></a></li>
          <?php $iterator_popular_query = $iterator_popular_query + 1; ?>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </ol>
    </div>
  </div>
</div>