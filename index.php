<?php
/**
 * The main template file
 *
 * @package Brain Brian
 * @since 0.1.0
 */

get_header(); ?>

        <div id="primary">
          <div id="content" role="main">
            <?php /* Display navigation to next/previous pages when applicable */ ?>
            <?php if($wp_query->max_num_pages > 1): ?>
            <nav id="nav-above">
              <h1 class="section-heading"><?php _e( 'Post navigation', 'brainbrian' ); ?></h1>
              <div class="nav-previous">
                <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'brainbrian' ) ); ?>
              </div>
              <div class="nav-next">
                <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'brainbrian' ) ); ?>
              </div>
            </nav><!-- #nav-above -->
            <?php endif; ?>
            <?php /* Start the Loop */ ?>
            <?php
              while(have_posts()):
                the_post();
                get_template_part('partials/content', get_post_format());
              endwhile;
              /* Display navigation to next/previous pages when applicable */
              if($wp_query->max_num_pages > 1):
            ?>
            <nav id="nav-below">
              <h1 class="section-heading"><?php _e( 'Post navigation', 'brainbrian' ); ?></h1>
              <div class="nav-previous">
                <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'brainbrian' ) ); ?>
              </div>
              <div class="nav-next">
                <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'brainbrian' ) ); ?>
              </div>
            </nav><!-- #nav-below -->
            <?php endif; ?>
          </div><!-- #content -->
        </div><!-- #primary -->

<?php
  dynamic_sidebar('sidebar-blog');
  get_footer();
