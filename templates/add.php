<?php
/*
Template Name: ДОБАВИТЬ ОБЪЯВЛЕНИЕ
*/
?>

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
        <div class="content mb-12">
          <?php the_content(); ?>
        </div>
        <!-- Форма -->
        <div>
          <form name="form_order">
            <div class="flex flex-col mb-3">
              <input type="text" name="Название" placeholder="<?php _e('Название отеля', 'odessa'); ?>"  class="custom-input">
              <input type="text" name="Адрес" placeholder="<?php _e('Адрес', 'odessa'); ?>" class="custom-input" required>
              <input type="text" name="Контакты" placeholder="<?php _e('Контакты', 'odessa'); ?>" class="custom-input" required>
              <textarea name="Описание" rows="5" class="custom-input" placeholder="<?php _e('Описание', 'odessa'); ?>"></textarea>
            </div>
            <button type="submit" class="form_order_button custom-btn-dark">
              <span><?php _e('Отправить', 'odessa'); ?></span>
            </button>
          </form>
          <div class="form_order_success hidden text-center px-3 py-2 mt-2">
            <?php _e('Спасибо, мы получили Вашу заявку!', 'odessa'); ?>
          </div>
        </div>
        <!-- END Форма -->
      </div>
    </div>
    
  </div>
</main>

<?php endwhile; else: ?>
  <p><?php _e('Ничего не найдено'); ?></p>
<?php endif; ?>

<?php get_footer(); ?>