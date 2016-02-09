<?php

/*
Plugin Name: Dasheroo KPIs
Plugin URI: http://github.com/tunapanda/wp-dasheroo-kpis
GitHub Plugin URI: https://github.com/tunapanda/wp-dasheroo-kpis
Description: Aggregate information about posts and pages, and present them in a format consumable by dasheroo.com.
Version: 0.0.2
*/

/**
 * Create the admin menu.
 */
function dashkpis_admin_menu() {
	add_options_page(
		'Dasheroo KPIs',
		'Dasheroo KPIs',
		'manage_options',
		'dashkpis_settings',
		'dashkpis_create_settings_page'
	);
}

/**
 * Create settings page.
 */
function dashkpis_create_settings_page() {
	wp_enqueue_style("dashkpis",plugins_url()."/wp-dasheroo-kpis/style.css");

	$label="Wordpress stats";
	$type="any";
	$state="any";
	$publishedWithinDays="";
	$updatedWithinDays="";
	$showData=FALSE;
	$formUrl=admin_url("options-general.php");

	if (isset($_REQUEST["submit"])) {
		$label=$_REQUEST["label"];
		$type=$_REQUEST["type"];
		$state=$_REQUEST["state"];
		$publishedWithinDays=$_REQUEST["publishedWithinDays"];
		$updatedWithinDays=$_REQUEST["updatedWithinDays"];

		$showData=TRUE;
		$query=http_build_query(array(
			"label"=>$label,
			"type"=>$type,
			"state"=>$state,
			"publishedWithinDays"=>$publishedWithinDays,
			"updatedWithinDays"=>$updatedWithinDays,
		));

		$url=get_site_url()."/wp-content/plugins/wp-dasheroo-kpis/kpis.php?$query";

		ob_start();
		require __DIR__."/kpis.php";
		$data=ob_get_contents();
		ob_end_clean();
	}

	require __DIR__."/admin.php";
}

add_action('admin_menu','dashkpis_admin_menu');
