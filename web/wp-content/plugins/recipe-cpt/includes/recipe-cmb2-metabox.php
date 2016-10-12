<?php
namespace ataylorme\recipes_cpt_cmb2_metabox;

/**
 * Metabox for recipe details
 */
function register_recipe_metabox() {
	$prefix = 'recipe_';

	$recipe_details_metabox = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Recipe Details', 'ataylorme' ),
		'object_types' => array( 'recipe', ), // Post type(s)
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
	) );


	$recipe_details_metabox->add_field( array(
		'name' => esc_html__( 'Description', 'ataylorme' ),
		'id'   => $prefix . 'desc',
		'type' => 'textarea_small',
	) );

	$recipe_details_metabox->add_field( array(
		'name'       => esc_html__( 'Type', 'ataylorme' ),
		'id'         => $prefix . 'type',
		'type'       => 'taxonomy_select',
		'taxonomy'   => 'recipe_type', // Taxonomy Slug
		'default'    => 'main-dish',
		'attributes' => array(
			'required' => 'required',
		),
	) );

	$recipe_details_metabox->add_field( array(
		'name'       => esc_html__( 'Main Ingredient', 'ataylorme' ),
		'id'         => $prefix . 'main_ingredient',
		'type'       => 'taxonomy_select',
		'taxonomy'   => 'recipe_main_ingredient', // Taxonomy Slug
		'attributes' => array(
			'required' => 'required',
		),
	) );

	$recipe_details_metabox->add_field( array(
		'name' => esc_html__( 'Preparation Duration', 'ataylorme' ),
		'desc' => esc_html__( 'Time it takes to prepare the recipe, NOT including cooking time', 'ataylorme' ),
		'id'   => $prefix . 'prep_duration',
		'type' => 'time_duration',
	) );

	$recipe_details_metabox->add_field( array(
		'name'    => esc_html__( 'Preparation Instructions', 'ataylorme' ),
		'desc'    => '',
		'id'      => $prefix . 'prep_instructions',
		'type'    => 'wysiwyg',
		'options' => array(
			// use wpautop?
			'wpautop'       => true,
			// show insert/upload button(s)
			'media_buttons' => false,
			// set the textarea name to something different, square brackets [] can be used here
			'textarea_name' => 'prep_instructions',
			// rows="..."
			'textarea_rows' => get_option( 'default_post_edit_rows', 10 ),
			'tabindex'      => '',
			// intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
			'editor_css'    => '',
			// add extra class(es) to the editor textarea
			'editor_class'  => '',
			// output the minimal editor config used in Press This
			'teeny'         => false,
			// replace the default fullscreen with DFW (needs specific css)
			'dfw'           => false,
			// load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
			'tinymce'       => true,
			// load Quicktags, can be used to pass settings directly to Quicktags using an array()
			'quicktags'     => false
		),
	) );

	$recipe_details_metabox->add_field( array(
		'name' => esc_html__( 'Cooking Duration', 'ataylorme' ),
		'desc' => esc_html__( 'Time it takes to cook the recipe, NOT including preparation time', 'ataylorme' ),
		'id'   => $prefix . 'cooking_duration',
		'type' => 'time_duration',
	) );

	$recipe_details_metabox->add_field( array(
		'name'    => esc_html__( 'Cooking Instructions', 'ataylorme' ),
		'desc'    => '',
		'id'      => $prefix . 'cooking_instructions',
		'type'    => 'wysiwyg',
		'options' => array(
			// use wpautop?
			'wpautop'       => true,
			// show insert/upload button(s)
			'media_buttons' => false,
			// set the textarea name to something different, square brackets [] can be used here
			'textarea_name' => 'cooking_instructions',
			// rows="..."
			'textarea_rows' => get_option( 'default_post_edit_rows', 10 ),
			'tabindex'      => '',
			// intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
			'editor_css'    => '',
			// add extra class(es) to the editor textarea
			'editor_class'  => '',
			// output the minimal editor config used in Press This
			'teeny'         => false,
			// replace the default fullscreen with DFW (needs specific css)
			'dfw'           => false,
			// load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
			'tinymce'       => true,
			// load Quicktags, can be used to pass settings directly to Quicktags using an array()
			'quicktags'     => false
		),
	) );


	$recipe_details_metabox->add_field( array(
		'name'      => esc_html__( 'Source URL', 'ataylorme' ),
		'desc'      => esc_html__( 'Attributes the recipe to the original author', 'ataylorme' ),
		'id'        => $prefix . 'source_url',
		'type'      => 'text_url',
		'protocols' => array( 'http', 'https' ), // Array of allowed protocols
		// 'repeatable' => true,
	) );

	$recipe_details_metabox->add_field( array(
		'id'          => $prefix . 'ingredients',
		'type'        => 'group',
		'description' => '',
		'options'     => array(
			// since version 1.1.4, {#} gets replaced by row number
			'group_title'   => __( 'Ingredient {#}', 'ataylorme' ),
			'add_button'    => '<span class="dashicons dashicons-plus" style="position: relative; top: 4px;"></span>' . __( 'Add Another Ingredient', 'ataylorme' ),
			'remove_button' => '<span class="dashicons dashicons-minus" style="position: relative; top: 3px;"></span>' . __( 'Remove Ingredient', 'ataylorme' ),
			// sortable feature is in beta
			'sortable'      => false,
		),
		/**
		 * Fields array works the same, except id's only need
		 * to be unique for this group. Prefix is not needed.
		 */
		'fields'      => array(
			array(
				'name'        => __( 'Name', 'ataylorme' ),
				'description' => '',
				'id'          => 'name',
				'type'        => 'text',
				'attributes'  => array(
					'required' => 'required',
				),
			),
			array(
				'name'        => __( 'Amount', 'ataylorme' ),
				'description' => '',
				'id'          => 'amount',
				'type'        => 'text_number',
				'attributes'  => array(
					'required' => 'required',
					'min'      => 0,
					'max'      => 60,
					'step'     => '0.25',
				),
			),
			array(
				'name'    => __( 'Unit of Measure', 'ataylorme' ),
				'desc'    => '',
				'id'      => $prefix . 'unit',
				'type'    => 'select',
				'options' => array(
					'cups'        => __( 'Cups', 'ataylorme' ),
					'ounces'      => __( 'Ounces', 'ataylorme' ),
					'pounds'      => __( 'Pounds', 'ataylorme' ),
					'teaspoons'   => __( 'Teaspoons', 'ataylorme' ),
					'tablespoons' => __( 'Tablespoons', 'ataylorme' ),
					'grams' => __( 'Grams', 'ataylorme' ),
					'milligrams' => __( 'Milligrams', 'ataylorme' ),
					'dash'        => __( 'Pinch/Dash', 'ataylorme' ),
					'taste'       => __( 'To Taste', 'ataylorme' ),
				),
			),

		),
	) );

}

add_action( 'cmb2_admin_init', __NAMESPACE__ . '\register_recipe_metabox' );