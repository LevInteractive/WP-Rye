<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/partials/content-single', get_post_type()); ?>
<?php endwhile; ?>
