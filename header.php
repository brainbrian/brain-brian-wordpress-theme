<?php
/**
 * The template for displaying the header.
 *
 * @since 0.1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <title><?php
      // Print the <title> tag based on what is being viewed.
      global $page, $paged;
      wp_title('|', true, 'right');
      // Add the blog name.
      bloginfo('name');
      // Add the blog description for the home/front page.
      $site_description = get_bloginfo('description', 'display');
      if ($site_description && (is_home() || is_front_page())) {
          echo " | $site_description";
      }
      // Add a page number if necessary:
      if ($paged >= 2 || $page >= 2) {
          echo ' | '.sprintf(__('Page %s', 'brainbrian'), max($paged, $page));
      }
    ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <meta name="copyright" content="Copyright (c) <?php echo date(Y); ?> Brian Behrens. All Rights Reserved." />
    <meta name="author" content="Brian Behrens, http://www.brainbrian.com" />
    <meta name="description" content="This is the personal portfolio of Brian Behrens. This site serves as a representaton of his professional and personal work since 2002 as an interactive developer." />
    <meta name="google-site-verification" content="TDkdpgdElFiFg58-ZaeS32jhIdYh2uvnH0DfZMVPKyo" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
    <?php
      if (is_singular() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
      }
    ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div id="page" class="hfeed">
      <div class="absolute-header">
        <header class="site-header" role="banner">
          <hgroup>
            <h1 class="site-header--title"><span><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></span></h1>
            <h2 class="site-header--description"><?php bloginfo('description'); ?></h2>
          </hgroup>
          <nav class="site-navigation" role="navigation">
            <h1 class="section-heading"><?php _e('Main menu', 'brainbrian'); ?></h1>
            <div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e('Skip to content', 'brainbrian'); ?>"><?php _e('Skip to content', 'brainbrian'); ?></a></div>
            <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
          </nav>
        </header>
      </div>
      <div id="main">
