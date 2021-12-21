<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package G-Info
 */

get_header();
?>

	<main id="primary" class="page-padding">
		<div class="container">
			<div class="mb-8 lg:mb-12">
				<h1><?php _e('Каталог лучших отелей Украины', 'odessa'); ?> 🇺🇦</h1>
			</div>
			<div class="flex flex-wrap lg:-mx-8">
				<!-- Основной поток -->
				<div class="w-full lg:w-8/12 px-0 lg:px-8">

					<!-- Отель дня -->
					<div class="mb-10 pb-10">
						<div class="relative overflow-hidden mb-6">
							<h2 class="inline-block relative bg-white uppercase font-bold z-1 pr-2">🔥  <?php _e('Отель дня', 'odessa'); ?></h2>
							<div class="h-line"></div>
						</div>

						<?php 
							$hotels_day_query = new WP_Query( array( 
								'post_type' => 'hotels', 
								'posts_per_page' => 1,
							) );
							if ($hotels_day_query->have_posts()) : while ($hotels_day_query->have_posts()) : $hotels_day_query->the_post(); 
						?>
						<!-- Item -->
						<div class="custom-shadow rounded-xl p-4 lg:p-10">
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
										<?php _e('Рейтинг', 'odessa'); ?>: <span class="font-semibold">4</span>
									</div>
									<div>
										<?php _e('Просмотров', 'odessa'); ?>: <span class="font-semibold"><?php echo get_post_meta( get_the_ID(), 'place_count', true ); ?></span>
									</div>
								</div>
							</div>
						</div>
						<?php endwhile; endif; wp_reset_postdata(); ?>
						<!-- END Item -->
					</div>
					<!-- END Отель дня -->

					<!-- Новые отели -->
					<div class="mb-10">
						<div class="relative overflow-hidden mb-6">
							<h2 class="inline-block relative bg-white uppercase font-bold z-1 pr-2">🆕 <?php _e('Недавно добавленные', 'odessa'); ?></h2>
							<div class="h-line"></div>
						</div>
						<div>
							<?php 
								$hotels_new_query = new WP_Query( array( 
									'post_type' => 'hotels', 
									'posts_per_page' => 6,
								) );
								if ($hotels_new_query->have_posts()) : while ($hotels_new_query->have_posts()) : $hotels_new_query->the_post(); 
							?>
								<?php get_template_part('template-parts/hotels/hotel-card'); ?>
							<?php endwhile; endif; wp_reset_postdata(); ?>
						</div>
					</div>
					<!-- END Новые отели -->

					
				</div>
				<!-- END Основной поток -->

				<!-- Сайдбар -->
				<div class="w-full lg:w-4/12 px-0 lg:px-8">
					<?php get_template_part('template-parts/sidebar/sidebar-top'); ?>
				</div>
				<!-- END Сайдбар -->
			</div>
	
			<!-- Добавить отель -->
			<div class="mb-10">
				<div class="bg-gray-800 text-white text-center rounded-xl px-4 py-8">
					<div class="text-2xl font-bold mb-4"><?php _e('Добавьте свой отель прямо сейчас!', 'odessa'); ?></div>
					<div class="text-xl mb-6">❗<span class="italic opacity-75 "><?php _e('Это абсолютно бесплатно', 'odessa'); ?></span>❗</div>
					<a href="#" class="inline-block bg-blue-700 rounded-xl px-6 py-2"><?php _e('Добавить отель за 5 минут', 'odessa'); ?></a>
				</div>
			</div>
			<!-- END Добавить отель -->

			<!-- Направления -->
			<div class="flex flex-wrap flex-col lg:flex-row lg:-mx-4 mb-16">
				<div class="w-full lg:w-1/3 lg:px-4">
					<div class="custom-shadow rounded-xl p-5">
						<div class="text-lg font-semibold uppercase mb-4"><?php _e('Карпаты', 'odessa'); ?></div>
						<div class="mb-8">
							<?php 
								$karpaty_terms = get_terms( array( 
									'taxonomy' => 'city', 
									'parent' => 0, 
									'hide_empty' => false,
									'meta_key' => '_crb_city_region',
								  'meta_value' => 'karpaty'
								) );
							?>
							<?php foreach ($karpaty_terms as $karpaty_term): ?>
							<div class="flex mb-2">
								<div class="mr-2">
									<img src="<?php echo carbon_get_term_meta($karpaty_term->term_id, 'crb_city_img' ); ?>" alt="" class="w-[40px] h-[40px] object-cover">
								</div>
								<div class="flex flex-col justify-between text-sm">
									<div class="font-semibold"><a href="<?php echo get_term_link($karpaty_term); ?>"><?php echo $karpaty_term->name; ?></a></div>
									<div class="opacity-75"><?php _e('Отелей', 'odessa'); ?>: <?php echo $karpaty_term->count; ?></div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
						<div class="flex justify-center">
							<a href="#" class="custom-btn-dark"><?php _e('Посмотреть все', 'odessa'); ?></a>
						</div>
					</div>
				</div>
				<div class="w-full lg:w-1/3 lg:px-4">
					<div class="custom-shadow rounded-xl p-5">
						<div class="text-lg font-semibold uppercase mb-4"><?php _e('Черное море', 'odessa'); ?></div>
						<div class="mb-8">
							<?php 
								$blacksea_terms = get_terms( array( 
									'taxonomy' => 'city', 
									'parent' => 0, 
									'hide_empty' => false,
									'meta_key' => '_crb_city_region',
								  'meta_value' => 'blacksea'
								) );
							?>
							<?php foreach ($blacksea_terms as $blacksea_term): ?>
							<div class="flex mb-2">
								<div class="mr-2">
									<img src="<?php echo carbon_get_term_meta($blacksea_term->term_id, 'crb_city_img' ); ?>" alt="" class="w-[40px] h-[40px] object-cover">
								</div>
								<div class="flex flex-col justify-between text-sm">
									<div class="font-semibold"><a href="<?php echo get_term_link($blacksea_term); ?>"><?php echo $blacksea_term->name; ?></a></div>
									<div class="opacity-75"><?php _e('Отелей', 'odessa'); ?>: <?php echo $blacksea_term->count; ?></div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
						<div class="flex justify-center">
							<a href="#" class="custom-btn-dark"><?php _e('Посмотреть все', 'odessa'); ?></a>
						</div>
					</div>
				</div>
				<div class="w-full lg:w-1/3 lg:px-4">
					<div class="custom-shadow rounded-xl p-5">
						<div class="text-lg font-semibold uppercase mb-4"><?php _e('Азовское море', 'odessa'); ?></div>
						<div class="mb-8">
							<?php 
								$azovsea_terms = get_terms( array( 
									'taxonomy' => 'city', 
									'parent' => 0, 
									'hide_empty' => false,
									'meta_key' => '_crb_city_region',
								  'meta_value' => 'azovsea'
								) );
							?>
							<?php foreach ($azovsea_terms as $azovsea_term): ?>
							<div class="flex mb-2">
								<div class="mr-2">
									<img src="<?php echo carbon_get_term_meta($azovsea_term->term_id, 'crb_city_img' ); ?>" alt="" class="w-[40px] h-[40px] object-cover">
								</div>
								<div class="flex flex-col justify-between text-sm">
									<div class="font-semibold"><a href="<?php echo get_term_link($azovsea_term); ?>"><?php echo $azovsea_term->name; ?></a></div>
									<div class="opacity-75"><?php _e('Отелей', 'odessa'); ?>: <?php echo $azovsea_term->count; ?></div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
						<div class="flex justify-center">
							<a href="#" class="custom-btn-dark"><?php _e('Посмотреть все', 'odessa'); ?></a>
						</div>
					</div>
				</div>
			</div>
			<div>
				<div class="px-4 mb-16 border-b-2 border-blue-700"></div>
			</div>
			<!-- END Направления -->

			<div class="flex flex-wrap lg:-mx-8 mb-16">
				<!-- Основной поток -->
				<div class="w-full lg:w-8/12 px-0 lg:px-8">
					<?php 
						$hotels_new_query = new WP_Query( array( 
							'post_type' => 'hotels', 
							'posts_per_page' => 10,
							'offset' => 6
						) );
						if ($hotels_new_query->have_posts()) : while ($hotels_new_query->have_posts()) : $hotels_new_query->the_post(); 
					?>
						<?php get_template_part('template-parts/hotels/hotel-card'); ?>
					<?php endwhile; endif; wp_reset_postdata(); ?>
				</div>
				<div class="w-full lg:w-4/12 px-0 lg:px-8">
					<?php get_template_part('template-parts/sidebar/sidebar-bottom'); ?>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
