<?php
/**
 * Template Name: Blog
 */

while ( have_posts() ) : the_post();
?>

<section id="blog-list" class="blog-list">

  <div class="bg-orange">
    <div class="container">
      <h2><?php the_title(); ?></h2>
    </div>
  </div><!-- .bg-orange -->

  <?php
  $query_args = [
    'post_type'      => 'whq-blog-post',
    'posts_per_page' => 9,
  ];

  $loop = new WP_Query( $query_args );

  if ( $loop->have_posts() ) :
  ?>

  <div class="container">
    <div class="row">

      <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

        <div class="col-md-4">

          <article class="blog-post" id="blog-post-<?php echo get_the_ID(); ?>">
            <div class="blog-post__thumbnail">
              <?php the_post_thumbnail( 'large' ); ?>
            </div>

            <header class="blog-post__header">
              <h4 class="blog-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            </header>

            <div class="blog-post__excerpt">
              <?php the_excerpt(); ?>
            </div>
          </article>

        </div><!-- /col -->

    <?php endwhile; wp_reset_postdata(); ?>

    </div><!-- .row -->
  </div><!-- .container -->

  <div class="pagination-wrapper">
    <div class="container">

      <?php wp_pagenavi( ['query' => $loop ] ); ?>

    </div><!-- .container -->
  </div><!-- .pagination-wrapper -->

  <?php endif; ?>

</section><!-- #blog-list -->

<?php endwhile; ?>
