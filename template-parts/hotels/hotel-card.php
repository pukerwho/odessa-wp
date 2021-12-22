<div class="pb-10 mb-10 border-b border-gray-200">
  <?php
  $hotels_day_region = get_the_terms( $hotels_day_query->ID, 'region' );
  foreach (array_slice($hotels_day_region, 0,1) as $hotel_day_region): ?>
    <div class="uppercase text-blue-700 font-bold"><?php echo $hotel_day_region->name; ?></div> 
  <?php endforeach; ?>
  <div class="text-gray-800 text-2xl font-bold mb-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
  <div class="text-sm mb-4">
    <?php 
      $content_text = wp_strip_all_tags( get_the_content() );
      echo mb_strimwidth($content_text, 0, 300, '...');
    ?>
  </div>
  <div class="flex flex-col-reverse lg:flex-row lg:justify-between">
    <div class="flex">
      <?php
      $hotels_day_city = get_the_terms( $hotels_day_query->ID, 'city' );
      foreach (array_slice($hotels_day_city, 0,1) as $hotel_day_city){ ?>
      <div class="h-10 mr-2">
        <img src="<?php echo carbon_get_term_meta($hotel_day_city->term_id, 'crb_city_img' ); ?>" alt="<?php echo $hotel_day_city->name ?>" loading="lazy" width="40" height="100%" class="h-full rounded-full object-cover">
      </div>
      <div>
        <div class="uppercase text-sm text-blue-700 font-bold"><?php echo $hotel_day_city->name; ?>
        </div>
        <div class="text-sm text-gray-700 opacity-95">
          <?php _e('Добавлено', 'odessa'); ?>: <?php echo get_the_date('d/m/Y'); ?>
        </div>
      </div>
      <?php } ?>
    </div>
    <div class="flex flex-col lg:items-end text-sm text-gray-700 opacity-95 mb-4 lg:mb-0">
      <div>
        <?php _e('Рейтинг', 'odessa'); ?>: <span class="font-semibold"><?php echo carbon_get_post_meta('crb_hotels_rating'); ?></span>
      </div>
      <div>
        <?php _e('Просмотров', 'odessa'); ?>: <span class="font-semibold"><?php echo get_post_meta( get_the_ID(), 'place_count', true ); ?></span>
      </div>
    </div>
  </div>
</div>