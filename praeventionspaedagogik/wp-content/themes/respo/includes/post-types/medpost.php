<h2> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <div class="meta">
			<?php the_time('M j, y') ?> &bull; 
            <?php the_category(', ') ?> &bull; 
            <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
    </div> 
    <a href="<?php the_permalink(); ?>">
    <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'folio-image'); ?>
    <img class="bags" src="<?php echo get_template_directory_uri(); ?>/js/timthumb.php?src=<?php echo $image[0]; ?>&amp;w=200&amp;h=150" alt="<?php the_title(); ?>"/></a>
		<p><?php echo pov_excerpt( get_the_excerpt(), '620'); ?></p>