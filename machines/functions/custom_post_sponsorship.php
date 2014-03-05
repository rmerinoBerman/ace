<?php

// REGISTER CUSTOM POST TYPE
	add_action( 'init', 'register_post_type_sponsorships');
	function register_post_type_sponsorships(){

		$labels = array(
			'name' => 'Sponsorships',
			'singular_name' => 'Sponsorship',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Sponsorship',
			'edit_item' => 'Edit Sponsorship',
			'new_item' => 'New Sponsorship',
			'view_item' => 'View Sponsorship',
			'search_items' => 'Search Sponsorships',
			'not_found' => 'Nothing found',
			'not_found_in_trash' => 'Nothing found in trash',
			'parent_item_colon' => ''
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title', 'editor')
		);

		register_post_type( 'sponsorships', $args);

	}

// DEFINE META BOXES
	$sponsorshipsMetaBoxArray = array(
	    "sponsorships_price_meta" => array(
	    	"id" => "sponsorships_price_meta",
	        "name" => "Price",
	        "post_type" => "sponsorships",
	        "position" => "side",
	        "priority" => "low",
	        "callback_args" => array(
	        	"input_type" => "input_text",
	        	"input_name" => "price"
	        )
	    ),
	);

// ADD META BOXES
	add_action( "admin_init", "admin_init_sponsorships" );
	function admin_init_sponsorships(){
		global $sponsorshipsMetaBoxArray;
		generateMetaBoxes($sponsorshipsMetaBoxArray);
	}

// SAVE POST TO DATABASE
	add_action('save_post', 'save_sponsorships');
	function save_sponsorships(){
		global $sponsorshipsMetaBoxArray;
		savePostData($sponsorshipsMetaBoxArray, $post, $wpdb);
	}

// SORTING CUSTOM SUBMENU

	add_action('admin_menu', 'register_sortable_sponsorships_submenu');

	function register_sortable_sponsorships_submenu() {
		add_submenu_page('edit.php?post_type=sponsorships', 'Sort Sponsorships', 'Sort', 'edit_pages', 'sponsorships_sort', 'sort_sponsorships');
	}

	function sort_sponsorships() {
		
		echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
			echo '<h2>Sort Sponsorships</h2>';
		echo '</div>';

		listSponsorships('sort');
	}

// CUSTOM COLUMNS

	// add_action("manage_posts_custom_column",  "sponsorships_custom_columns");
	// add_filter("manage_edit-sponsorships_columns", "sponsorships_edit_columns");

	// function sponsorships_edit_columns($columns){
	// 	$columns = array(
	// 		"full_name" => "Sponsorship Name",
	// 	);

	// 	return $columns;
	// }
	// function sponsorships_custom_columns($column){
	// 	global $post;

	// 	switch ($column) {
	// 		case "full_name":
	// 			$custom = get_post_custom();
	// 			echo "<a href='post.php?post=" . $post->ID . "&action=edit'>" . $custom["first_name"][0] . " " . $custom["last_name"][0] . "</a>";
	// 		break;
	// 	}
	// }

// LISTING FUNCTION
	function listSponsorships($context, $idArray = null){
		global $post;
		global $sponsorshipsMetaBoxArray;
		
		switch ($context) {
			case 'sort':
				$args = array(
					'post_type'  => 'sponsorships',
					'order'   => 'ASC',
					'meta_key'  => 'custom_order',
					'orderby'  => 'meta_value_num',
					'nopaging' => true
				);
				$loop = new WP_Query($args);

				echo '<ul class="sortable">';
				while ($loop->have_posts()) : $loop->the_post(); 
					$output = get_post_meta($post->ID, 'first_name', true) . " " . get_post_meta($post->ID, 'last_name', true);
					include(get_template_directory() . '/views/item_sortable.php');
				endwhile;
				echo '</ul>';
			break;
			
			case 'json':
				$args = array(
					'post_type'  => 'sponsorships',
					'order'   => 'ASC',
					'meta_key'  => 'custom_order',
					'orderby'  => 'meta_value_num',
					'nopaging' => true
				);
				returnData($args, $sponsorshipsMetaBoxArray, 'json', 'sponsorships_data');
			break;

			case 'array':
				$args = array(
					'post_type'  => 'sponsorships',
					'order'   => 'ASC',
					'meta_key'  => 'custom_order',
					'orderby'  => 'meta_value_num',
					'nopaging' => true
				);
				return returnData($args, $sponsorshipsMetaBoxArray, 'array');
			break;

			case 'rest':
				$args = array(
					'post_type'  => 'sponsorships',
					'order'   => 'ASC',
					'meta_key'  => 'custom_order',
					'orderby'  => 'meta_value_num',
					'nopaging' => true,
					'post__in' => $idArray
				);
				return returnData($args, $sponsorshipsMetaBoxArray, 'array');
			break;

			case 'checkbox':
				$args = array(
					'post_type'  => 'sponsorships',
					'order'   => 'ASC',
					'meta_key'  => 'custom_order',
					'orderby'  => 'meta_value_num',
					'nopaging' => true
				);

				$outputArray = returnData($args, $sponsorshipsMetaBoxArray, 'array');

				$field_options = array();
				foreach ($outputArray as $key => $value) {
					$checkBoxOption = array(
						"id" => $value['post_id'],
						"name" => $value['the_title'],
					);
					$field_options[] = $checkBoxOption;
				}

				return $field_options;

			break;

			case 'select':
				$args = array(
					'post_type'  => 'sponsorships',
					'order'   => 'ASC',
					'meta_key'  => 'custom_order',
					'orderby'  => 'meta_value_num',
					'nopaging' => true
				);

				$outputArray = returnData($args, $sponsorshipsMetaBoxArray, 'array');

				$field_options = array();
				foreach ($outputArray as $key => $value) {
					$checkBoxOption = array(
						"id" => $value['post_id'],
						"name" => html_entity_decode($value['the_title'])
					);
					$field_options[] = $checkBoxOption;
				}

				return $field_options;

			break;
		}
	}

?>
