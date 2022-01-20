<?php get_header(); ?>

<?php 
  $current_id = get_the_ID();
  $countNumber = tutCount($current_id);
  getMeta($current_id);
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <main id="primary" class="page-padding">
    <div class="container" itemscope itemtype="https://schema.org/Hotel">
      <div class="mb-12">
        <div class="text-3xl lg:text-4xl font-bold mb-4" itemprop="name">
          <?php the_title(); ?>  
        </div>
        <!-- Хлебные крошки -->
        <div class="breadcrumbs text-sm opacity-75 mb-4" itemprop="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
          <ul class="flex items-center flex-wrap">
            <li itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem' class="breadcrumbs_item mr-8 pl-8">
              <a itemprop="item" href="<?php echo home_url(); ?>">
                <span itemprop="name"><?php _e( 'Главная', 'odessa' ); ?></span>
              </a>                        
              <meta itemprop="position" content="1">
            </li>
            <li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem' class="breadcrumbs_item mr-8">
              <a itemprop="item" href="<?php echo get_post_type_archive_link('hotels'); ?>">
                <span itemprop="name"><?php _e( 'Отели', 'odessa' ); ?></span>
              </a>                        
              <meta itemprop="position" content="2">
            </li>
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumbs_item" >
              <a itemprop="item" href="<?php the_permalink(); ?>">
                <span itemprop="name"><?php the_title(); ?></span>
              </a>
              <meta itemprop="position" content="3" />
            </li>
          </ul>
        </div>
        <!-- END Хлебные крошки -->
      </div>
      <div class="flex flex-col lg:flex-row lg:-mx-8 mb-12">
        <!-- Основной поток -->
        <div class="w-full lg:w-8/12 px-0 lg:px-8">
          <!-- Город -->
          <div class="mb-6">
            <?php
            $hotel_cities = get_the_terms( $hotels_day_query->ID, 'city' );
            foreach (array_slice($hotel_cities, 0,1) as $hotel_city): ?>
              <div class="uppercase text-blue-700 font-bold"><a href="<?php echo get_term_link($hotel_city); ?>"><?php echo $hotel_city->name; ?></a></div> 
            <?php endforeach; ?>
          </div>
          <!-- END Город -->
          <!-- Статистика -->
          <div class="bg-gray-100 text-sm rounded-lg p-4 mb-6">
            <div class="flex items-center">
              <div class="mr-2"><span class="italic"><?php _e('Рейтинг отеля', 'odessa'); ?></span>: </div>
              <div class="mr-2"><?php get_template_part('template-parts/elements/stars'); ?></div>
              <div>(<?php echo carbon_get_the_post_meta('crb_hotels_rating'); ?>)</div>
            </div>
            <div><span class="italic"><?php _e('Просмотров', 'odessa'); ?></span>: <?php echo $countNumber; ?></div>
            <div><span class="italic"><?php _e('Дата добавления', 'odessa'); ?></span>: <?php echo get_the_date('d.m.Y'); ?></div>
          </div>
          <!-- END Статистика -->
          <!-- Описание -->
          <div class="mb-6">
            <div class="text-2xl font-semibold mb-4"><?php _e('Описание', 'odessa'); ?></div>
            <div class="text-sm" itemprop="description"><?php the_content(); ?></div>
          </div>
          <!-- END Описание -->
          <!-- Контакты -->
          <div class="mb-6">
            <div class="text-2xl font-semibold mb-4"><?php _e('Контакты', 'odessa'); ?></div>

            <div class="text-sm mb-2" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
              <span class="font-semibold"><?php _e('Адрес', 'odessa'); ?>: </span>
              <span itemprop="streetAddress"><?php echo carbon_get_the_post_meta('crb_hotels_address'); ?></span>
            </div>
              <div class="text-sm mb-2">
                <span class="font-semibold" ><?php _e('Телефоны', 'odessa'); ?>: </span>
                <span itemprop="telephone"><?php echo carbon_get_the_post_meta('crb_hotels_phones'); ?></span>
              </div>
          </div>
          <!-- END Контакты -->
          <!-- Удобства -->
          <div class="mb-6">
            <div class="text-2xl font-semibold mb-4"><?php _e('Удобства', 'odessa'); ?></div>
            <div class="flex flex-wrap flex-col lg:flex-row lg:-mx-4">
              <!-- Ванна -->
              <?php if (carbon_get_the_post_meta('crb_hotels_vanna') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M7.5 2a4.5 4.5 0 0 1 4.473 4H14v2H8V6h1.95a2.5 2.5 0 0 0-4.945.336L5 6.5V16h26v2h-2v5a5.001 5.001 0 0 1-3 4.584V30h-2v-2H8v2H6v-2.416a5.002 5.002 0 0 1-2.995-4.349L3 23v-5H1v-2h2V6.5A4.5 4.5 0 0 1 7.5 2zm19.499 16h-22L5 23a3 3 0 0 0 2.65 2.98l.174.015L8 26h16a3 3 0 0 0 2.995-2.824L27 23z"></path></svg></div>
                  <div><?php _e('Ванна', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Ванна -->
              <!-- Фен -->
              <?php if (carbon_get_the_post_meta('crb_hotels_fen') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M14 27l-.005.2a4 4 0 0 1-3.789 3.795L10 31H4v-2h6l.15-.005a2 2 0 0 0 1.844-1.838L12 27zM10 1c.536 0 1.067.047 1.58.138l.38.077 17.448 3.64a2 2 0 0 1 1.585 1.792l.007.166v6.374a2 2 0 0 1-1.431 1.917l-.16.04-13.554 2.826 1.767 6.506a2 2 0 0 1-1.753 2.516l-.177.008H11.76a2 2 0 0 1-1.879-1.315l-.048-.15-1.88-6.769A9 9 0 0 1 10 1zm5.692 24l-1.799-6.621-1.806.378a8.998 8.998 0 0 1-1.663.233l-.331.008L11.76 25zM10 3a7 7 0 1 0 1.32 13.875l.331-.07L29 13.187V6.813L11.538 3.169A7.027 7.027 0 0 0 10 3zm0 2a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"></path></svg></div>
                  <div><?php _e('Фен', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Фен -->
              <!-- Шампунь -->
              <?php if (carbon_get_the_post_meta('crb_hotels_shampoo') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M20 1v2h-3v2h1a2 2 0 0 1 1.995 1.85L20 7v2a4 4 0 0 1 3.995 3.8L24 13v14a4 4 0 0 1-3.8 3.995L20 31h-8a4 4 0 0 1-3.995-3.8L8 27V13a4 4 0 0 1 3.8-3.995L12 9V7a2 2 0 0 1 1.85-1.995L14 5h1V3H8V1zm2 21H10v5a2 2 0 0 0 1.85 1.995L12 29h8a2 2 0 0 0 1.995-1.85L22 27zm0-6H10v4h12zm-2-5h-8a2 2 0 0 0-1.995 1.85L10 13v1h12v-1a2 2 0 0 0-2-2zm-2-4h-4v2h4z"></path></svg></div>
                  <div><?php _e('Шампунь', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Шампунь -->
              <!-- Горячая вода -->
              <?php if (carbon_get_the_post_meta('crb_hotels_hotwater') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M16 32c6.627 0 12-5.373 12-12 0-6.218-3.671-12.51-10.924-18.889L16 .18l-1.076.932C7.671 7.491 4 13.782 4 20c0 6.577 5.397 12 12 12zm0-2c-5.496 0-10-4.525-10-10 0-5.327 3.115-10.882 9.424-16.65l.407-.37.169-.149.576.518c6.043 5.526 9.156 10.855 9.407 15.977l.013.34L26 20c0 5.523-4.477 10-10 10zm-3.452-5.092a8.954 8.954 0 0 1 2.127-4.932l.232-.26.445-.462a6.973 6.973 0 0 0 1.827-4.416l.007-.306-.006-.307-.007-.11a6.03 6.03 0 0 0-2.009-.057 4.979 4.979 0 0 1-1.443 4.008 10.951 10.951 0 0 0-2.87 5.016 6.034 6.034 0 0 0 1.697 1.826zM16 26l.253-.005.25-.016-.003-.137c0-1.32.512-2.582 1.464-3.533a10.981 10.981 0 0 0 3.017-5.656 6.026 6.026 0 0 0-1.803-1.743 8.971 8.971 0 0 1-2.172 5.493l-.228.255-.444.462a6.96 6.96 0 0 0-1.827 4.415l-.006.276c.48.123.982.189 1.499.189z"></path></svg></div>
                  <div><?php _e('Горячая вода', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Горячая вода -->
              <!-- Стиральная машина -->
              <?php if (carbon_get_the_post_meta('crb_hotels_stiralka') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M28 2a2 2 0 0 1 1.995 1.85L30 4v24a2 2 0 0 1-1.85 1.995L28 30H4a2 2 0 0 1-1.995-1.85L2 28V4a2 2 0 0 1 1.85-1.995L4 2zm0 2H4v24h24zM16 7a9 9 0 1 1 0 18 9 9 0 0 1 0-18zm-5.841 7.5c-.342 0-.68.024-1.014.073a7 7 0 0 0 13.107 4.58 8.976 8.976 0 0 1-6.91-2.374l-.236-.23a6.966 6.966 0 0 0-4.947-2.049zM16 9a6.997 6.997 0 0 0-6.066 3.504l.225-.004c2.262 0 4.444.844 6.124 2.407l.237.229a6.979 6.979 0 0 0 4.948 2.05c.493 0 .98-.05 1.456-.151A7 7 0 0 0 16 9zM7 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path></svg></div>
                  <div><?php _e('Стиральная машина', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Стиральная машина -->
              <!-- Полотенца, мыло, бумага -->
              <?php if (carbon_get_the_post_meta('crb_hotels_prostin') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M11 1v7l1.898 20.819.007.174c-.025 1.069-.804 1.907-1.818 1.999a2 2 0 0 1-.181.008h-7.81l-.174-.008C1.86 30.87 1.096 30.018 1.096 29l.002-.09 1.907-21L3.001 1zm6 0l.15.005a2 2 0 0 1 1.844 1.838L19 3v7.123l-2 8V31h-2V18.123l.007-.163.02-.162.033-.16L16.719 11H13V1zm11 0a2 2 0 0 1 1.995 1.85L30 3v26a2 2 0 0 1-1.85 1.995L28 31h-7v-2h7v-2h-7v-2h7v-2h-7v-2h7v-2h-7v-2h7v-2h-7v-2h7v-2h-7V9h7V7h-7V5h7V3h-7V1zM9.088 9h-4.18L3.096 29l.058.002L10.906 29l-.004-.058zM17 3h-2v6h2zM9.002 3H5L5 7h4.004z"></path></svg></div>
                  <div><?php _e('Полотенца, мыло, бумага', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Полотенца, мыло, бумага -->
              <!-- Плечики -->
              <?php if (carbon_get_the_post_meta('crb_hotels_plechiki') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M16 2a5 5 0 0 1 1.661 9.717 1.002 1.002 0 0 0-.653.816l-.008.126v.813l13.23 9.052a3 3 0 0 1 1.299 2.279l.006.197a3 3 0 0 1-3 3H3.465a3 3 0 0 1-1.694-5.476L15 13.472v-.813c0-1.211.724-2.285 1.816-2.757l.176-.07a3 3 0 1 0-3.987-3.008L13 7h-2a5 5 0 0 1 5-5zm0 13.211L2.9 24.175A1 1 0 0 0 3.465 26h25.07a1 1 0 0 0 .565-1.825z"></path></svg></div>
                  <div><?php _e('Плечики', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Плечики -->
              <!-- Постельное белье -->
              <?php if (carbon_get_the_post_meta('crb_hotels_postel') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M19.586 2a2 2 0 0 1 1.284.467l.13.119L29.414 11a2 2 0 0 1 .578 1.238l.008.176V25a5 5 0 0 1-4.783 4.995L25 30H4a2 2 0 0 1-1.995-1.85L2 28V7a5 5 0 0 1 4.783-4.995L7 2zM7 4a3 3 0 0 0-2.995 2.824L4 7v14a3 3 0 0 0 2.824 2.995L7 24h19v2H7a4.978 4.978 0 0 1-3-1v3h21a3 3 0 0 0 2.995-2.824L28 25v-3H6v-2h22v-6h-5a5 5 0 0 1-4.995-4.783L18 9V4zm20.586 8L20 4.415V9a3 3 0 0 0 2.824 2.995L23 12z"></path></svg></div>
                  <div><?php _e('Постельное белье', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Постельное белье -->
              <!-- Жалюзи -->
              <?php if (carbon_get_the_post_meta('crb_hotels_jaluzi') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M1 2V0h30v2h-2v18a2 2 0 0 1-1.85 1.995L27 22H17v2.171a3.001 3.001 0 1 1-2 0V22H5a2 2 0 0 1-1.995-1.85L3 20V2zm15 24a1 1 0 1 0 0 2 1 1 0 0 0 0-2zM27 2H5v18h22z"></path></svg></div>
                  <div><?php _e('Жалюзи', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Жалюзи -->
              <!-- Утюг -->
              <?php if (carbon_get_the_post_meta('crb_hotels_utug') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M12 28a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm4 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm4 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm-6-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm4 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2zM16.027 3l.308.004a12.493 12.493 0 0 1 11.817 9.48l.07.3 1.73 7.782.027.144a2 2 0 0 1-1.83 2.285L28 23H2.247l-.15-.005a2 2 0 0 1-1.844-1.838L.247 21v-7l.004-.217a5 5 0 0 1 4.773-4.778L5.247 9h9V5h-14V3zm11.528 16H2.245l.002 2H28zM16.247 5.002V11h-11l-.177.005a3 3 0 0 0-2.818 2.819L2.247 14l-.001 3H27.11l-.84-3.783-.067-.28a10.494 10.494 0 0 0-9.596-7.921l-.292-.012z"></path></svg></div>
                  <div><?php _e('Утюг', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Утюг -->
              <!-- Телевизор -->
              <?php if (carbon_get_the_post_meta('crb_hotels_tv') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M9 29v-2h2v-2H6a5 5 0 0 1-4.995-4.783L1 20V8a5 5 0 0 1 4.783-4.995L6 3h20a5 5 0 0 1 4.995 4.783L31 8v12a5 5 0 0 1-4.783 4.995L26 25h-5v2h2v2zm10-4h-6v2h6zm7-20H6a3 3 0 0 0-2.995 2.824L3 8v12a3 3 0 0 0 2.824 2.995L6 23h20a3 3 0 0 0 2.995-2.824L29 20V8a3 3 0 0 0-2.824-2.995z"></path></svg></div>
                  <div><?php _e('Телевизор', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Телевизор -->
              <!-- Кондиционер -->
              <?php if (carbon_get_the_post_meta('crb_hotels_conder') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M17 1v4.03l4.026-2.324 1 1.732L17 7.339v6.928l6-3.464V5h2v4.648l3.49-2.014 1 1.732L26 11.381l4.026 2.325-1 1.732L24 12.535l-6 3.464 6 3.465 5.026-2.902 1 1.732L26 20.618l3.49 2.016-1 1.732L25 22.351V27h-2v-5.804l-6-3.465v6.929l5.026 2.902-1 1.732L17 26.97V31h-2v-4.031l-4.026 2.325-1-1.732L15 24.66v-6.929l-6 3.464V27H7v-4.65l-3.49 2.016-1-1.732 3.489-2.016-4.025-2.324 1-1.732 5.025 2.901 6-3.464-6-3.464-5.025 2.903-1-1.732L6 11.38 2.51 9.366l1-1.732L7 9.648V5h2v5.803l6 3.464V7.339L9.974 4.438l1-1.732L15 5.03V1z"></path></svg></div>
                  <div><?php _e('Кондиционер', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Кондиционер -->
              <!-- Отопление -->
              <?php if (carbon_get_the_post_meta('crb_hotels_otoplenie') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M16 0a5 5 0 0 1 4.995 4.783L21 5l.001 12.756.26.217a7.984 7.984 0 0 1 2.717 5.43l.017.304L24 24a8 8 0 1 1-13.251-6.036l.25-.209L11 5A5 5 0 0 1 15.563.019l.22-.014zm0 2a3 3 0 0 0-2.995 2.824L13 5v13.777l-.428.298a6 6 0 1 0 7.062.15l-.205-.15-.428-.298L19 11h-4V9h4V7h-4V5h4a3 3 0 0 0-3-3zm1 11v7.126A4.002 4.002 0 0 1 16 28a4 4 0 0 1-1-7.874V13zm-1 9a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"></path></svg></div>
                  <div><?php _e('Отопление', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Отопление -->
              <!-- Wi-Fi -->
              <?php if (carbon_get_the_post_meta('crb_hotels_wifi') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="m15.9999 20.33323c2.0250459 0 3.66667 1.6416241 3.66667 3.66667s-1.6416241 3.66667-3.66667 3.66667-3.66667-1.6416241-3.66667-3.66667 1.6416241-3.66667 3.66667-3.66667zm0 2c-.9204764 0-1.66667.7461936-1.66667 1.66667s.7461936 1.66667 1.66667 1.66667 1.66667-.7461936 1.66667-1.66667-.7461936-1.66667-1.66667-1.66667zm.0001-7.33323c3.5168171 0 6.5625093 2.0171251 8.0432368 4.9575354l-1.5143264 1.5127043c-1.0142061-2.615688-3.5549814-4.4702397-6.5289104-4.4702397s-5.5147043 1.8545517-6.52891042 4.4702397l-1.51382132-1.5137072c1.48091492-2.939866 4.52631444-4.9565325 8.04273174-4.9565325zm.0001-5.3332c4.9804693 0 9.3676401 2.540213 11.9365919 6.3957185l-1.4470949 1.4473863c-2.1746764-3.5072732-6.0593053-5.8431048-10.489497-5.8431048s-8.31482064 2.3358316-10.48949703 5.8431048l-1.44709488-1.4473863c2.56895177-3.8555055 6.95612261-6.3957185 11.93659191-6.3957185zm-.0002-5.3336c6.4510616 0 12.1766693 3.10603731 15.7629187 7.9042075l-1.4304978 1.4309874c-3.2086497-4.44342277-8.4328305-7.3351949-14.3324209-7.3351949-5.8991465 0-11.12298511 2.89133703-14.33169668 7.334192l-1.43047422-1.4309849c3.58629751-4.79760153 9.31155768-7.9032071 15.7621709-7.9032071z"></path></svg></div>
                  <div><?php _e('Wi-Fi', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Wi-Fi -->
              <!-- Кухня -->
              <?php if (carbon_get_the_post_meta('crb_hotels_kitchen') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M26 1a5 5 0 0 1 5 5c0 6.389-1.592 13.187-4 14.693V31h-2V20.694c-2.364-1.478-3.942-8.062-3.998-14.349L21 6l.005-.217A5 5 0 0 1 26 1zm-9 0v18.118c2.317.557 4 3.01 4 5.882 0 3.27-2.183 6-5 6s-5-2.73-5-6c0-2.872 1.683-5.326 4-5.882V1zM2 1h1c4.47 0 6.934 6.365 6.999 18.505L10 21H3.999L4 31H2zm14 20c-1.602 0-3 1.748-3 4s1.398 4 3 4 3-1.748 3-4-1.398-4-3-4zM4 3.239V19h3.995l-.017-.964-.027-.949C7.673 9.157 6.235 4.623 4.224 3.364l-.12-.07zm19.005 2.585L23 6l.002.31c.045 4.321 1.031 9.133 1.999 11.39V3.17a3.002 3.002 0 0 0-1.996 2.654zm3.996-2.653v14.526C27.99 15.387 29 10.4 29 6a3.001 3.001 0 0 0-2-2.829z"></path></svg></div>
                  <div><?php _e('Кухня', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Кухня -->
              <!-- Микроволновая печь -->
              <?php if (carbon_get_the_post_meta('crb_hotels_microwave') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M29 3a2 2 0 0 1 1.995 1.85L31 5v22a2 2 0 0 1-1.85 1.995L29 29H3a2 2 0 0 1-1.995-1.85L1 27V5a2 2 0 0 1 1.85-1.995L3 3zm0 2H3v22h26zm-6 2v18H5V7zm-2 2H7v14l3 .001a4.975 4.975 0 0 1-.992-2.721L9 20v-3h10v3a4.978 4.978 0 0 1-1 3.001L21 23zm-4 10h-6v1a3 3 0 0 0 2.65 2.98l.174.015L14 23a3 3 0 0 0 2.995-2.824L17 20zm9-8a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-4a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path></svg></div>
                  <div><?php _e('Микроволновая печь', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Микроволновая печь -->
              <!-- Мини-холодильник -->
              <?php if (carbon_get_the_post_meta('crb_hotels_mini_holod') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M27 3a2 2 0 0 1 1.995 1.85L29 5v21a2 2 0 0 1-1.85 1.995L27 28h-1v2h-2v-2H8v2H6v-2H5a2 2 0 0 1-1.995-1.85L3 26V5a2 2 0 0 1 1.85-1.995L5 3zm0 12H5v11h4v-3a2 2 0 0 1 1.85-1.995L11 21v-3h2v3a2 2 0 0 1 1.995 1.85L15 23v3h2v-3a2 2 0 0 1 1.85-1.995L19 21v-3h2v3a2 2 0 0 1 1.995 1.85L23 23v3h4zm-14 8h-2v3h2zm8 0h-2v3h2zm6-18H5v8h22zM8 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path></svg></div>
                  <div><?php _e('Мини-холодильник', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Мини-холодильник -->
              <!-- Электроплита -->
              <?php if (carbon_get_the_post_meta('crb_hotels_plita') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M27 0a2 2 0 0 1 1.995 1.85L29 2v26a2 2 0 0 1-1.85 1.995L27 30H5a2 2 0 0 1-1.995-1.85L3 28V2A2 2 0 0 1 4.85.005L5 0zm0 2H5v26h22zm-3 22a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm-5.333 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm-5.334 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2zM8 24a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm13-10a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm-10 0a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm10 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-10 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM21 4a4 4 0 1 1 0 8 4 4 0 0 1 0-8zM11 4a4 4 0 1 1 0 8 4 4 0 0 1 0-8zm10 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM11 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"></path></svg></div>
                  <div><?php _e('Электроплита', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Электроплита -->
              <!-- Чайник -->
              <?php if (carbon_get_the_post_meta('crb_hotels_chainik') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M26 28v2H6v-2h20zM16 1a8.638 8.638 0 0 1 7.834 5H28a1 1 0 0 1 .997 1.076c-.295 3.873-1.576 6.45-3.894 7.564l.893 10.273a1 1 0 0 1-.88 1.08L25 26H7a1 1 0 0 1-1-.971l.004-.116L7.397 8.887c.026-.3.068-.597.124-.887H5a1 1 0 0 0-.993.883L4 9v10H2V9a3 3 0 0 1 2.824-2.995L5 6h3.165A8.638 8.638 0 0 1 16 1zm6.431 7H9.57a6.647 6.647 0 0 0-.138.7l-.041.36L8.09 24h15.819L22.61 9.06A6.67 6.67 0 0 0 22.431 8zm-5.45 3c-.147 2.02-1.163 4.144-2.7 5.783l-.231.238a6.96 6.96 0 0 0-1.984 3.98h-2.015a8.956 8.956 0 0 1 2.356-5.158l.228-.236c1.304-1.304 2.18-3.034 2.339-4.607h2.007zm4 0c.013.166.019.333.019.5-.001 2.164-1.054 4.508-2.72 6.283l-.23.238A6.967 6.967 0 0 0 16.28 21h-2.064a8.955 8.955 0 0 1 2.191-4.157l.228-.236C18.08 15.163 19 13.196 19 11.499a4.94 4.94 0 0 0-.026-.5h2.008zm5.907-3h-2.409c.04.207.073.418.098.63l.026.257.306 3.518c.98-.792 1.634-2.165 1.946-4.18L26.888 8zM16 3a6.633 6.633 0 0 0-5.552 3h11.104a6.635 6.635 0 0 0-5.043-2.98l-.275-.016L16 3z"></path></svg></div>
                  <div><?php _e('Чайник', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Чайник -->
              <!-- Мини-сейф -->
              <?php if (carbon_get_the_post_meta('crb_hotels_miniseif') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M25 2a5 5 0 0 1 4.995 4.783L30 7v18a5 5 0 0 1-4.783 4.995L25 30H7a5 5 0 0 1-4.995-4.783L2 25V7a5 5 0 0 1 4.783-4.995L7 2zm0 2H7a3 3 0 0 0-2.995 2.824L4 7v4l2-.001V6h20v20H6v-5.001L4 21v4a3 3 0 0 0 2.824 2.995L7 28h18a3 3 0 0 0 2.995-2.824L28 25V7a3 3 0 0 0-2.824-2.995zm-1 4H8v16h16zm-8 3a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6zm-10-.001L4 13v6l2-.001z"></path></svg></div>
                  <div><?php _e('Мини-сейф', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Мини-сейф -->
              <!-- Кроватка -->
              <?php if (carbon_get_the_post_meta('crb_hotels_krovatka') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M3 3v4h26V3h2v18a5.002 5.002 0 0 1-3.999 4.9L27 30h-2v-4H7v4H5v-4.1a5.002 5.002 0 0 1-3.995-4.683L1 21V3zm6 6H7v15h2zm4 0h-2v15h2zm4 0h-2v15h2zm4 0h-2v15h2zm4 0h-2v15h2zM5 9H3v12c0 1.306.835 2.418 2 2.83zm24 0h-2v14.829a3.002 3.002 0 0 0 1.995-2.653L29 21z"></path></svg></div>
                  <div><?php _e('Кроватка', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Кроватка -->
              <!-- Огнетушитель -->
              <?php if (carbon_get_the_post_meta('crb_hotels_ognetushitel') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M7 28H5V15c0-4.997 3.356-9.304 8.061-10.603A3 3 0 0 1 17.69 2.52l2.66-2.28 1.302 1.52L19.036 4H23v2h-4.17A3.008 3.008 0 0 1 17 7.83l.001.242a7.007 7.007 0 0 1 5.982 6.446l.013.24L23 15v15a2 2 0 0 1-1.85 1.995L21 32H11a2 2 0 0 1-1.995-1.85L9 30v-6H7zm9-18c-2.617 0-4.775 2.014-4.983 4.573l-.013.22L11 15v15h10V15.018l-.003-.206A5 5 0 0 0 16 10zm-2.654-3.6a9.002 9.002 0 0 0-6.342 8.327L7 15v7h2v-7.018l.005-.244A7.001 7.001 0 0 1 15 8.071v-.242a3.01 3.01 0 0 1-1.654-1.43zM16 4a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"></path></svg></div>
                  <div><?php _e('Огнетушитель', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Огнетушитель -->
              <!-- Аптечка -->
              <?php if (carbon_get_the_post_meta('crb_hotels_aptechka') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M26 3a5 5 0 0 1 4.995 4.783L31 8v16a5 5 0 0 1-4.783 4.995L26 29H6a5 5 0 0 1-4.995-4.783L1 24V8a5 5 0 0 1 4.783-4.995L6 3zm0 2H6a3 3 0 0 0-2.995 2.824L3 8v16a3 3 0 0 0 2.824 2.995L6 27h20a3 3 0 0 0 2.995-2.824L29 24V8a3 3 0 0 0-2.824-2.995zm-7 4v4h4v6h-4v4h-6v-4.001L9 19v-6l4-.001V9zm-2.001 2h-2L15 14.999h-4.001V17L15 16.998 14.999 21h2L17 17h3.999v-2H17z"></path></svg></div>
                  <div><?php _e('Аптечка', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Аптечка -->
              <!-- Бесплатная парковка -->
              <?php if (carbon_get_the_post_meta('crb_hotels_parkovka') === 'yes'): ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-6">
                <div class="flex items-center">
                  <div class="mr-4"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M26 19a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM7 18a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm20.693-5l.42 1.119C29.253 15.036 30 16.426 30 18v9c0 1.103-.897 2-2 2h-2c-1.103 0-2-.897-2-2v-2H8v2c0 1.103-.897 2-2 2H4c-1.103 0-2-.897-2-2v-9c0-1.575.746-2.965 1.888-3.882L4.308 13H2v-2h3v.152l1.82-4.854A2.009 2.009 0 0 1 8.693 5h14.614c.829 0 1.58.521 1.873 1.297L27 11.151V11h3v2h-2.307zM6 25H4v2h2v-2zm22 0h-2v2h2v-2zm0-2v-5c0-1.654-1.346-3-3-3H7c-1.654 0-3 1.346-3 3v5h24zm-3-10h.557l-2.25-6H8.693l-2.25 6H25zm-15 7h12v-2H10v2z"></path></svg></div>
                  <div><?php _e('Бесплатная парковка', 'odessa'); ?></div>  
                </div>
              </div>
              <?php endif; ?>
              <!-- END Бесплатная парковка -->
            </div>
          </div>
          <!-- END Удобства -->
          <div class="flex items-center bg-blue-100 rounded-lg p-3 mb-6">
            <div class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg></div>
            <div><?php _e('Обязательно сообщите, что нашли номер телефона на сайте', 'odessa'); ?> <span class="font-semibold">hotelodessa-ukraine.com</span></div>
          </div>
          <!-- Оценки отдыхающих -->
          <div>
            <div class="text-2xl font-semibold mb-4"><?php _e('Оценки отдыхающих', 'odessa'); ?></div>
            <div class="mb-12">
              <table class="hotel-rating w-full bg-gray-100  shadow-lg border-b-transparent text-sm lg:text-md">
                <tbody>
                  <thead>
                    <tr>
                      <th class="border-r border-gray-700"><?php _e('Критерий', 'odessa'); ?></th>
                      <th><?php _e('Оценка', 'odessa'); ?></th>
                    </tr>
                  </thead>
                  <tr class="border-b border-gray-300">
                    <td class="key"><span class="mr-2">⭐️</span> <?php _e('Рейтинг отеля', 'odessa'); ?></td>
                    <td class="value" xitemprop="aggregateRating" xitemscope="" xitemtype="http://schema.org/aggregateRating">
                      <?php 
                        $meta_rating_count = 'rating_count_'.$current_id;
                        $rating_value = carbon_get_the_post_meta('crb_hotels_rating'); 
                        $rating_value_width = ($rating_value / 5) * 100;
                      ?>
                      <div class="rating-row relative font-semibold">
                        <div class="flex items-center justify-center text-center">
                          <div class="relative z-1" style="width:<?php echo $rating_value_width; ?>%">
                            <span xitemprop="ratingValue"><?php echo $rating_value ?>/5 - </span> (<?php _e('Оценок', 'odessa'); ?>: <span xitemprop="reviewCount"><?php echo get_post_meta( $current_id, $meta_rating_count, true ); ?></span>)
                          </div>
                          <div class="h-full absolute left-0 top-0 bg-green-300 rounded-xl text-center py-2" style="width:<?php echo $rating_value_width; ?>%"></div>
                        </div>
                      </div>
                    </td>
                  </tr>

                  <!-- Оценка ЧИСТОТА -->
                  <tr class="border-b border-gray-300">
                    <td class="key"><span class="mr-2">🧹</span> <?php _e('Чистота', 'odessa'); ?></td>
                    <td class="value">
                      <?php 
                        $meta_rating_clean = 'rating_clean_'.$current_id;
                        $rating_clean_front = get_post_meta( $current_id, $meta_rating_clean, true );
                        $rating_clean_width = ($rating_clean_front / 5) * 100;
                      ?>
                      <div class="rating-row relative font-semibold">
                        <div class="relative text-center z-1" style="width:<?php echo $rating_clean_width; ?>%"><?php echo $rating_clean_front; ?></div>
                        <div class="h-full absolute left-0 top-0 bg-green-300 rounded-xl text-center py-2" style="width:<?php echo $rating_clean_width; ?>%"></div>
                      </div>
                    </td>
                  </tr>
                  <!-- END Оценка ЧИСТОТА -->

                  <!-- Оценка ТЕРРИТОРИЯ -->
                  <tr class="border-b border-gray-300">
                    <td class="key"><span class="mr-2">🏡</span> <?php _e('Территория', 'odessa'); ?></td>
                    <td class="value">
                      <?php 
                        $meta_rating_territoria = 'rating_territoria_'.$current_id;
                        $rating_territoria_front = get_post_meta( $current_id, $meta_rating_territoria, true );
                        $rating_territoria_width = ($rating_territoria_front / 5) * 100;
                      ?>
                      <div class="rating-row relative font-semibold">
                        <div class="relative text-center z-1" style="width:<?php echo $rating_territoria_width; ?>%"><?php echo $rating_territoria_front; ?></div>
                        <div class="h-full absolute left-0 top-0 bg-green-300 rounded-xl text-center py-2" style="width:<?php echo $rating_territoria_width; ?>%"></div>
                      </div>
                    </td>
                  </tr>
                  <!-- END Оценка ТЕРРИТОРИЯ -->

                  <!-- Оценка ПЕРСОНАЛ -->
                  <tr class="border-b border-gray-300">
                    <td class="key"><span class="mr-2">💁‍♀️</span> <?php _e('Персонал', 'odessa'); ?></td>
                    <td class="value">
                      <?php 
                        $meta_rating_personal = 'rating_personal_'.$current_id;
                        $rating_personal_front = get_post_meta( $current_id, $meta_rating_personal, true );
                        $rating_personal_width = ($rating_personal_front / 5) * 100;
                      ?>
                      <div class="rating-row relative font-semibold">
                        <div class="relative text-center z-1" style="width:<?php echo $rating_personal_width; ?>%"><?php echo $rating_personal_front; ?></div>
                        <div class="h-full absolute left-0 top-0 bg-green-300 rounded-xl text-center py-2" style="width:<?php echo $rating_personal_width; ?>%"></div>
                      </div>
                    </td>
                  </tr>
                  <!-- END Оценка ПЕРСОНАЛ -->

                  <!-- Оценка СТОИМОСТЬ -->
                  <tr>
                    <td class="key"><span class="mr-2">💸</span> <?php _e('Соотношение цена/качество', 'odessa'); ?></td>
                    <td class="value">
                      <?php 
                        $meta_rating_price = 'rating_price_'.$current_id;
                        $rating_price_front = get_post_meta( $current_id, $meta_rating_price, true );
                        $rating_price_width = ($rating_price_front / 5) * 100;
                      ?>
                      <div class="rating-row relative font-semibold">
                        <div class="relative text-center z-1" style="width:<?php echo $rating_price_width; ?>%"><?php echo $rating_price_front; ?></div>
                        <div class="h-full absolute left-0 top-0 bg-green-300 rounded-xl text-center py-2" style="width:<?php echo $rating_price_width; ?>%"></div>
                      </div>
                    </td>
                  </tr>
                  <!-- END Оценка СТОИМОСТЬ -->

                </tbody>
              </table>
            </div>
          </div>
          <!-- END Оценки отдыхающих -->
          <!-- Комментарии -->
          <div class="mb-10 pb-10">
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