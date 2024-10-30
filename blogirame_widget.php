<?php
/*
Plugin Name: Blogirame.mk Widget
Plugin URI: http://kuzmanov.info/blogirame-widget
Description: Blogirame.mk Widget додатокот ги прикажува најпопуларните и најнови блог написи од блоговите кои ги агрегира Blogirame.mk.
Author: Boris Kuzmanov
Version: 1.0
Author URI: http://kuzmanov.info
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
 
 
class BlogirameWidget extends WP_Widget {
	function BlogirameWidget() {
		$widget_ops = array('classname' => 'BlogirameWidget', 'description' => 'Најпопуларните и најнови написи на Blogirame.mk' );
		$this->WP_Widget('BlogirameWidget', 'Блогираме.мк Виџет', $widget_ops);
	}
 
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
	?>
	
	<p><label for="<?php echo $this->get_field_id('title'); ?>">Наслов: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>

	<?php
	}
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		return $instance;
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
		if (!empty($title))
			echo $before_title . $title . $after_title;;

		echo "<iframe scrolling='no' frameborder='0' src='http://blogirame.mk/api/top/' style='display:block; width:100%; height:300px;'></iframe>";
		echo $after_widget;
	}
}

add_action('widgets_init', create_function('', 'return register_widget("BlogirameWidget");'));
?>