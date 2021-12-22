<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package G-Info
 */

?>

<footer class="bg-gray-100 border-t-8 border-blue-700 py-12 lg:py-20">
  <div class="container">
    <div class="flex flex-wrap flex-col lg:flex-row lg:-mx-4">
      <div class="w-full lg:w-3/5 lg:px-4 mb-4 lg:mb-0">
        <div class="logo mb-4">
          <a href="<?php echo home_url(); ?>">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.svg" alt="LOGO" class="h-10 relative">
          </a>
        </div>
        <div class="w-full lg:w-3/4 opacity-75">
          <?php _e('Данный сайт является информационной площадкой - мы не бронируем номера и не сдаем жилье. Мы следим, чтобы на сайте была только актуальная и правдивая информация, но иногда мы можем что-то упустить. Поэтому будем рады помощи с вашей стороны.', 'odessa'); ?>
        </div>
      </div>
      <div class="w-full lg:w-1/5 lg:px-4 mb-4 lg:mb-0">
        <div class="font-bold uppercase mb-2"><?php _e('Информация', 'odessa'); ?></div>
        <div class="text-sm text-blue-700">
          <?php wp_nav_menu([
            'theme_location' => 'footer_info',
            'container' => 'div',
          ]); ?> 
        </div>
      </div>
      <div class="w-full lg:w-1/5 lg:px-4">
        <div class="font-bold uppercase mb-2"><?php _e('Мы в соцсетях', 'odessa'); ?></div>
        <div class="text-sm text-blue-700">
          <div><a href="#">Facebook</a></div>
          <div><a href="#">Instagram</a></div>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- not use -->
<div class="current-lang"></div>
<!-- END not use -->

<?php wp_footer(); ?>

</body>
</html>
