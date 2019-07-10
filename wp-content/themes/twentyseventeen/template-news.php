<?php
/*Template Name: News*/
get_header();
query_posts(array(
   'post_type' => 'news'
)); ?>
<?php
while (have_posts()) : the_post(); 
get_template_part( 'template-parts/post/content', get_post_format() );

 endwhile;
query_posts(array(
   'post_type' => 'post'
)); ?>
<?php
while (have_posts()) : the_post(); 
get_template_part( 'template-parts/post/content', get_post_format() );

 endwhile;
get_footer();
?>