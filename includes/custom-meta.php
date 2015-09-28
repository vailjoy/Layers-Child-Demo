<?php 
/** Custom Post Meta
/*
* http://docs.layerswp.com/how-to-add-custom-fields-to-posts-and-pages/
**/

/*
* Add Meta Box
* http://docs.layerswp.com/how-to-add-custom-fields-to-posts-and-pages/#custom-fields-in-the-editor
*/
function layers_child_add_meta_box() {

  $screens = array('post');
  foreach ( $screens as $screen ) {

	  add_meta_box(
		'layers_child_meta_sectionid',
		__( 'My Theme Options', 'layerswp' ),
		'layers_child_meta_box_callback',
		$screen,
			'normal',
			'high'
	   );
  	}
}
add_action( 'add_meta_boxes', 'layers_child_add_meta_box' );

/*
* Create Meta Callback - Prints the box content.
* @param WP_Post $post The object for the current post/page.
*/
function layers_child_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'layers_child_meta_box', 'layers_child_meta_box_nonce' );
	
	/*
	* Use get_post_meta() to retrieve an existing value
	* from the database and use the value for the form.
	*/
	$credit_name = get_post_meta( $post->ID, 'my_photo_credit', true );
	$credit_url = get_post_meta( $post->ID, 'my_credit_url', true ); 


if( class_exists( 'Layers_Form_Elements' ) ) {
	$form_elements = new Layers_Form_Elements();
	// Source 
	echo '<p class="layers-form-item">';
	echo '<label>'.__('Photo Source URL', 'layerswp').'</label> ';
		echo $form_elements->input( 
			array(
				'type' => 'text',
				'name' => 'my_photo_credit',
				'id' => 'my_photo_credit',
				'label' => 'Label',
				'placeholder' => __( 'Photo Source', 'layerswp' ),
				'value' => ( isset( $credit_name ) ? $credit_name : '' ),
				'class' => 'layers-text'
			)
		);
	echo '</p>';
	// Source URL
	echo '<p class="layers-form-item">';
	echo '<label>'.__('Photo Source URL', 'layerswp').'</label> ';
	echo $form_elements->input( 
		array(
			'type' => 'text',
			'name' => 'my_credit_url',
			'id' => 'my_credit_url',
			'placeholder' => __( 'Photo Credit URL', 'layerswp' ),
			'value' => ( isset( $credit_url ) ? $credit_url : '' ),
			'class' => 'layers-text'
		)
	);
	echo '</p>';
	// Number
	echo $form_elements->input( array(
			'type' => 'number',
			'name' => 'my_number_input',
			'id' => 'my-number-input',
			'placeholder' => __( '20', 'layerswp' ),
			'value' => ( isset( $my_number_input ) ? (int) $my_number_input : '' ),
			'min' => 0,
			'max' => 100,
			'step' => 10,
			'class' => 'layers-text',
			'label' => __( 'Number' , 'layerswp' )
	));
	 echo $form_elements->input( array(
			'type' => 'range',
			'name' => 'my_range_input',
			'id' => 'my-range-input',
			'placeholder' => __( '20', 'layerswp' ),
			'value' => ( isset( $my_range_input ) ? (int) $my_range_input : '' ),
			'min' => 0,
			'max' => 100,
			'step' => 10,
			'class' => 'layers-text'
	));
	// Icon
	echo '<p class="layers-form-item">';
	echo $form_elements->input( 
		array(
			'type' => 'upload',
			'name' => 'my_icon',
			'id' => 'my_icon',
			'button_label' => __( 'Select or Upload File', 'layerswp' ),
			'value' => ( isset( $meta_icon ) ? $meta_icon : '' )
		)
	);
	echo '</p>';
	// Color
	echo '<p class="layers-form-item">';
	echo $form_elements->input( 
		array(
			'type' => 'color',
			'name' => 'my_color_name',
			'id' => 'my-color-id',
			'value' => ( isset( $color ) ? $color : '' )
		) 
	);
	echo '</p>';
	// Checkbox
	echo '<p class="layers-form-item">';
	echo $form_elements->input( array(
		'type' => 'checkbox',
		'name' => 'my_checkbox_input',
		'id' => 'my-checkbox-input',
		'label' => __( 'My Checkbox', 'layerswp' ),
		'class' => 'layers-checkbox',
		'value' => ( isset( $my_checkbox_input ) ? TRUE : FALSE )
	));
	echo '</p>';
	// Text Area

	echo '<p class="layers-form-item">';
	echo '<label>'.__('Photo Description', 'layerswp').'</label> ';
	echo $form_elements->input( array(
		 'type' => 'textarea',
		 'name' => 'my_textarea_name',
		 'id' => 'my-textarea-id',
		 'placeholder' => __( 'Enter in your value', 'layerswp' ),
		 'value' => ( isset( $my_textarea_name ) ? $my_textarea_name : '' ),
		 'class' => 'layers-textarea'
	) );
		echo '</p>';
	// RTE
	$photo_description = get_post_meta( $post->ID, 'wpop_photo_desc', true );

    /* Add WP Editor as replacement of textarea */
	echo '<p class="layers-form-item">';
	echo '<label>'.__('Photo Description', 'layerswp').'</label> ';
    wp_editor( $photo_description, 'my_photo_desc', array(
        'wpautop'       => true,
        'media_buttons' => false,
        'textarea_name' => 'my_photo_desc',
        'textarea_rows' => 10,
        'teeny'         => true
    ) );
	echo '</p>';
  }
}

/*
* Save the Meta (we are only saving our photo credit and photo url fields in this example)
* http://docs.layerswp.com/how-to-add-custom-fields-to-posts-and-pages/#saving-meta-data
*/
function layers_child_save_meta_box_data( $post_id ) {

	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'layers_child_meta_box_nonce' ] ) && wp_verify_nonce( $_POST[ 'layers_child_meta_box' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
	
	// Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
	return;
	}
	
	// Checks for input and sanitizes/saves if needed
	if( isset( $_POST[ 'my_photo_credit' ] ) ) {
	update_post_meta( $post_id, 'my_photo_credit', sanitize_text_field( $_POST[ 'my_photo_credit' ] ) );
	}
	if( isset( $_POST[ 'my_credit_url' ] ) ) {
	update_post_meta( $post_id, 'my_credit_url', sanitize_text_field( $_POST[ 'my_credit_url' ] ) );
	}
}
add_action( 'save_post', 'layers_child_save_meta_box_data' );