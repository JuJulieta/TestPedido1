<?php
/**
 * Single Blog Post
 */

while ( have_posts() ) : the_post();
?>

<div class="blog-post-wrapper">

  <div class="container">

    <article id="entry-<?php echo get_the_ID(); ?>" class="entry">

      <div class="entry__thumbnail">
        <?php the_post_thumbnail( 'large' ); ?>
      </div>

      <header class="entry__header">
        <h2 class="entry__title"><?php the_title(); ?></h2>
      </header>

      <div class="entry__content">
        <?php the_content(); ?>
      </div>

    </article>

  </div><!-- .container -->
</div><!-- .blog-post-wrapper -->

<?php endwhile; ?>
