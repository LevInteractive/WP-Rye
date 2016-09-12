<?php
/**
 * Template Name: Custom Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/partials/page-header'); ?>
  <?php get_template_part('templates/partials/content-page'); ?>
<?php endwhile; ?>
