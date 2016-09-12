<?php get_header(); ?>

<?php get_template_part('templates/partials/page-header'); ?>

<div class="alert alert-warning">
  <?php _e('Sorry, but the page you were trying to view does not exist.', 'rye'); ?>
</div>

<?php get_search_form(); ?>

<?php get_footer(); ?>
