<?php 

$blockname = basename(__FILE__, '.php');
$custom_text = get_sub_field('custom_text');
$custom_title = get_sub_field('custom_title');
?>
<div class="mission-wrap">
	<?php if(!empty($custom_text) || !empty($custom_title)) {?>
	<h2 style="text-align: center;">
		<?php echo $custom_text; ?>
	</h2>
	<p style="text-align: center;">
		<?php echo $custom_title; ?>
	</p>
	<?php } ?>
</div>