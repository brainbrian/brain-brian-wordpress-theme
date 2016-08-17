<?php
/**
 * Template Name: Homepage
 * Description: Page with 5 most recent blog entries, custom projects and description
 *
 * @package Brain Brian
 * @since 0.1.0
 */

get_header(); ?>

        <div id="primary" class="full-width">
          <div id="content" role="main">
            <?php the_post(); ?>
            <div class="video-blade">
              <?php get_template_part('partials/content', 'page'); ?>
              <div class="video-blade--video">
                <video loop autoplay>
                  <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/bg-hero.mp4" type="video/mp4">
                </video>
              </div>
            </div>
            <div class="recent-projects">
              <h3>Recent Projects</h3>
              <ul class="project-list">
                <?php
                  $args = array(
                    'post_type' => 'bb_projects',
                    'posts_per_page' => 3,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                  );
                  $loop = new WP_Query( $args );
                  while($loop->have_posts()):
                    $loop->the_post();
                    $slug = $post->post_name;
                    $postImage = get_post_image('full');
                    $url = get_field('bb_project_url');
                ?>
                <li>
                  <a href="<?php echo $url; ?>">
                    <img src="<?php echo $postImage[0]; ?>" width="<?php echo $postImage[1]; ?>" height="<?php echo $postImage[2]; ?>">
                    <h4><?php the_title(); ?></h4>
                    <p><?php echo $url; ?></p>
                  </a>
                  <div class="project-details">
                    <?php the_content(); ?>
                  </div>
                </li>
                <?php
                  endwhile;
                  wp_reset_query();
                ?>
              </ul>
            </div>
            <?php comments_template( '', true ); ?>
          </div><!-- #content -->
        </div><!-- #primary -->
        <div id="secondary" class="widget-area" role="complementary">
          <?php dynamic_sidebar('sidebar-homepage'); ?>
        </div>

<?php get_footer();
