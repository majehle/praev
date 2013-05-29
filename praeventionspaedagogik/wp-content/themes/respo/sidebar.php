<div id="sidebar"> 
<?php if (get_option('themnific_dis_tabs') <> "true") { ?>
	<?php get_template_part('/includes/uni-tabs');?>
<?php } ?>   
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sidebar") ) : ?>
	<?php endif; ?>	
<div style="clear: both;"></div>	
</div><!-- /#sidebar -->