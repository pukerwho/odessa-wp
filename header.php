<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package G-Info
 */

$current_title = wp_get_document_title();
if ( is_singular( 'hotels' ) ) {
	//Название заведения
	$place_title = get_the_title();
	//Город
	$current_cities = wp_get_post_terms(  get_the_ID() , 'city', array( 'parent' => 0 ) );
  foreach (array_slice($current_cities, 0,1) as $city) {
	  if ($city) {
	  	$current_city = $city->name;
	  }	
  } 
  //SEO
  if (get_locale() === 'ru_RU') {
  	$after_title = 'Отзывы, контакты, телефоны';
  } else {
  	$after_title = 'Відгуки, контакти, телефони';
  }
	
	$current_title = $place_title . ' (' . $current_city . ') - ' . $after_title;
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php echo $current_title; ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<?php echo carbon_get_theme_option('crb_google_analytics'); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

	<header class="header w-full fixed left-0 top-0 z-2">
		<div class="bg-blue-700 text-sm lg:text-md text-white text-center py-2 lg:py-4">
			✨  <?php _e('Вы можете самостоятельно добавить объявление на наш сайт', 'odessa'); ?>
		</div>
		<div class="bg-gray-100 leading-max">
			<div class="container">
				<div class="flex justify-between items-center">
					<div>
						<div class="logo py-2 lg:py-0">
							<a href="<?php echo home_url(); ?>">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg" alt="LOGO" class="h-6 relative top-[2px]">
							</a>
						</div>	
					</div>
					<div class="hidden lg:block">
						<div class="header_menu">
							<?php wp_nav_menu([
		            'theme_location' => 'header',
		            'container' => 'div',
		            'menu_class' => 'flex'
		          ]); ?> 
						</div>	
					</div>
					<div>
						<!-- Переключатель языка -->
						<div class="hidden lg:flex lang text-sm">
	            <?php if (function_exists('pll_the_languages')) { 
	              pll_the_languages(); 
	            } ?>
						</div>
						<!-- END Переключатель языка -->
						<!-- Гамбургер -->
						<div class="hamburger-toggle relative block lg:hidden -mt-2">
							<span class="w-7 h-0.5 absolute bg-gray-600 top-0 right-0"></span>
							<span class="w-7 h-0.5 absolute bg-gray-600 top-2 right-0"></span>
							<span class="w-7 h-0.5 absolute bg-gray-600 top-4 right-0"></span>
						</div>
						<!-- END Гамбургер -->
					</div>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->

	<div class="mobile-menu hidden h-full w-full fixed left-0 top-24 bg-gray-100 py-4 px-2">
		<div>
			<?php wp_nav_menu([
	      'theme_location' => 'mobile',
	      'container' => 'div',
	      'menu_class' => 'flex flex-col'
	    ]); ?> 
		</div>
	</div>

