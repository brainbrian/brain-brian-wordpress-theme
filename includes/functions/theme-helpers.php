<?php
// get the featured image of a post in a specified size, if no featured image set grab 1st image in post, if no image return default
function get_post_image($imageSize="full", $imageName="") {
  global $post;
  if($imageName==""){
    // just getting default thumbnail for post
    if ( has_post_thumbnail() ) {
      $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $imageSize);
    }else{
      $files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image');
      if($files){
        $keys = array_reverse(array_keys($files));
        $j=0;
        $num = $keys[$j];
        $image = wp_get_attachment_image_src($num, $imageSize, false);
      }else if($imageSize == "blog-thumb"){
        $image = array(get_bloginfo('template_url')."/_/img/blog-stock-thumb-medium.jpg",300,170);
      }else{
        // if no image is found and size is anything but the blog-thumb, default to the small thumbnail
        $image = array(get_bloginfo('template_url')."/_/img/blog-stock-thumb.jpg",98,98);
      }
    }
  } else {
    // getting a specific image for the post
    $image = get_post_meta($post->ID, $imageName, true);
    $image = wp_get_attachment_image_src($image, $imageSize, false);
  }
  return $image;
}
