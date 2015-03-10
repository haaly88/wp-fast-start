<?php

// WordPress SEO active?
if ( ! defined( 'WPSEO_VERSION' ) ) {
	return;
}

// Register the column as editable
add_filter( 'cac/editable/is_column_editable/column=wpseo-title', '__return_true' );
add_filter( 'cac/editable/is_column_editable/column=wpseo-metadesc', '__return_true' );

// Set the editable properties
function cac_wordpress_seo_column_editable_settings( $editable_data, $model ) {

	$editable_data['wpseo-title']['default_column'] = true;
	$editable_data['wpseo-title']['type'] = 'text';
	$editable_data['wpseo-title']['placeholder'] = __( 'Enter your SEO Title', 'cpac' );

	$editable_data['wpseo-metadesc']['default_column'] = true;
	$editable_data['wpseo-metadesc']['type'] = 'textarea';
	$editable_data['wpseo-metadesc']['placeholder'] = __( 'Enter your SEO Meta Description', 'cpac' );

	return $editable_data;
}
add_filter( 'cac/editable/editables_data', 'cac_wordpress_seo_column_editable_settings', 10, 2 );

// Retrieve the value that should be used for editing
function cac_wordpress_seo_title_column_value( $value, $column, $id, $model ) {
	return get_post_meta( $id, '_yoast_wpseo_title', true );
}
add_filter( 'cac/editable/column_value/column=wpseo-title', 'cac_wordpress_seo_title_column_value', 10, 4 );

function cac_wordpress_seo_metadesc_column_value( $cac_wordpress_seo_description_column_value, $column, $id, $model ) {
	return get_post_meta( $id, '_yoast_wpseo_metadesc', true );
}
add_filter( 'cac/editable/column_value/column=wpseo-metadesc', 'cac_wordpress_seo_metadesc_column_value', 10, 4 );

// Store the value that has been entered with inline-edit to the database
function cac_wordpress_seo_title_column_save( $result, $column, $id, $value, $model ) {
	update_post_meta( $id, '_yoast_wpseo_title', $value );
}
add_filter( 'cac/editable/column_save/column=wpseo-title', 'cac_wordpress_seo_title_column_save', 10, 5 );

function cac_wordpress_seo_metadesc_column_save( $result, $column, $id, $value, $model ) {
	update_post_meta( $id, '_yoast_wpseo_metadesc', $value );
}
add_filter( 'cac/editable/column_save/column=wpseo-metadesc', 'cac_wordpress_seo_metadesc_column_save', 10, 5 );