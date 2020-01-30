<?php

if( !isset( $station_link ) && empty( $station_link) ){
    $station_link = get_permalink();
}

// the thumbnail image (if we're using one)
if ($thumb == 'small') {
	$img_location = ! empty( $instance['image_align'] ) ? $instance['image_align'] : 'left';
	$img_attr = array( 'class' => $img_location . '-align' );
	$img_attr['class'] .= " attachment-small";
	?>
		<a href="<?php echo $station_link; ?>"><?php echo get_the_post_thumbnail( get_the_ID(), '60x60', $img_attr); ?></a>
	<?php
} elseif ($thumb == 'medium') {
	$img_location = ! empty( $instance['image_align'] ) ? $instance['image_align'] : 'left';
	$img_attr = array('class' => $img_location . '-align');
	$img_attr['class'] .= " attachment-thumbnail";
	?>
		<a href="<?php echo $station_link; ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'post-thumbnail', $img_attr); ?></a>
	<?php
} elseif ($thumb == 'large') {
	$img_attr = array();
	$img_attr['class'] = " attachment-large";
	?>
		<a href="<?php echo $station_link; ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'large', $img_attr); ?></a>
    <?php
}

// the station name and the link to their website
?>
<div class="member-stations-content">
    <h4>
        <?php echo get_the_title(); ?>
    </h4>
    <h5>
        <a href="<?php echo $station_link; ?>"><?php _e( 'Visit Website', 'ipbs' ); ?></a>
    </h5>
</div>
