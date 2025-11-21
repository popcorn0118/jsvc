<?php 

/* =================================

  關於我們頁面 > 專業醫療團隊 輪播區塊
  "<?php require get_theme_file_path( 'inc/custom-team.php' ); ?>"
  "[astra_custom_layout id=3943]"

 * ================================== */


// 文章列表
$args_column = array(
    'post_type' => 'team',
    'post_status'		=> 'publish',
    'posts_per_page' => -1,
    // 'paged'         => 1,
    "order"     => "desc",
    // 's' => !empty($search_query) ? $search_query : "",
	// 'tax_query'       => array(
	// 	'relation' => 'AND',
	// 	  array(
	// 		'taxonomy' => 'post_tag',
	// 		'field' => 'slug',
	// 		'terms' => array( '首頁精選' ),
	// 	  ),
	// ),
);

$column = get_posts($args_column);

?>

<?php if (!empty($column)): ?>
<ul class="our-team">
	<?php 	
	foreach ($column as $item): 
		$title = $item->post_title;
		$name = $item->post_name;
		$date = strtotime($item->post_date);
		$desc = trim( $item->post_excerpt );
		if ( $desc === '' ) {
			$desc = $item->post_content;
		}
		$desc = wp_strip_all_tags( strip_shortcodes( $desc ) );
		// $category = get_the_terms($item->ID, 'team-type'); // get category
		$img = wp_get_attachment_image_src( get_post_thumbnail_id( $item ), 'full' );
		$img_default = '';
		// $img_default = get_stylesheet_directory_uri() . '/assets/img/img-default.jpg';

		// --- ACF 欄位：英文名 ---
		$name_en   = get_field('name_en',   $item->ID) ?: '';

	?>
	<li class="item">
		<a class="info" href="<?php echo esc_url( home_url( 'team/'.$name ) ); ?>">
			<div class="img">
				<img src="<?php echo !empty($img[0]) ? $img[0] : $img_default; ?>" alt="<?php echo $title; ?>" />
			</div>
			<div class="head">
				<h3 class="name"><?php echo $title; ?></h3>
				<h5 class="name-en"><?php echo $name_en; ?></h5>
			</div>
		</a>
	</li>		

	<?php endforeach; ?>
</ul>
<?php endif; ?>
	