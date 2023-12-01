<?php 
$blockname = basename(__FILE__, '.php');
$table_with_pdf = get_sub_field('table_with_pdf');
?>
<div class="table-doc">
	<?php 
		foreach ($table_with_pdf as $value) {
			$post_name = $value['post_name'];
			$pdf = $value['upload_document'];?>
			<div class="postname">
				<?php echo $post_name; ?>		
			</div>
			<div class="doc">
				<button>
					<a href="<?php echo $pdf['url']; ?>">
						<?php echo $pdf['title']; ?>
					</a>
				</button>
			</div>
	<?php } ?>
</div>