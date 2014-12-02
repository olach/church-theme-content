<?php/** * EDD License Handling * * Add-ons can register themselves in order to leverage Easy Digital Downloads Software Licensing features. * * See add-ons.php for the ctc_register_add_on() function. A registered add-on benefits from: * * 1. License Key field and ability to activate/deactivate buttons in Settings * 2. One-click updates via a store using Easy Digital Downloads Software Licensing * 3. Admin notice when add-on license is inactive, expiring soon or expired * * @package    Church_Theme_Content * @subpackage Admin * @copyright  Copyright (c) 2014, churchthemes.com * @link       https://github.com/churchthemes/church-theme-content * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html * @since      1.2 */// No direct accessif ( ! defined( 'ABSPATH' ) ) exit;/************************************************* * LICENSE SETTINGS *************************************************//** * Add license key fields to settings page * * A field for each registered add-on will be added to the settings page * * @since 1.2 * @param array $fields Settings fields in the section * @return array Modified setting fields with license key fields inserted */function ctc_add_license_settings( $section ) {	// Get registered add-ons	$add_ons = ctc_get_add_ons();	// Any add-ons registered?	if ( $add_ons ) {		// Loop add-ons		$fields = array();		foreach ( $add_ons as $add_on ) {			// Setting key			$key = 'license_key-'. $add_on['plugin_dir'];			// Add setting field			$fields[$key] = array(									   /* translators: %1$s is add-on name */				'name'				=> sprintf( __( '%1$s License Key', 'church-theme-content' ), $add_on['name_short'] ),				'desc'				=> '',				'type'				=> 'text', // text, textarea, checkbox, radio, select, number				'checkbox_label'	=> '', //show text after checkbox //show text after checkbox				'options'			=> array(), // array of keys/values for radio or select				'default'			=> '', // value to pre-populate option with (before first save or on reset)				'no_empty'			=> false, // if user empties value, force default to be saved instead				'allow_html'		=> false, // allow HTML to be used in the value				'class'				=> '', // classes to add to input				'custom_sanitize'	=> '', // function to do additional sanitization				'custom_content'	=> '' // function for custom display of field input			);		}		// Add fields to section		$section['fields'] = $fields;	}	// No add-ons, show a message	else {		// Create new line if have description already		if ( ! empty( $section['desc'] ) ) {			$section['desc'] .= "<br /><br />";		} else {			$section['desc'] = '';		}		// Append message saying no add-ons installed		$section['desc'] .= '<i>' . sprintf(								/* translators: %1$s is URL to Add-ons */								__( 'No add-ons for the Church Theme Content plugin have been installed.', 'church-theme-content' ),								'http://churchthemes.com/plugins/?utm_source=ctc&utm_medium=plugin&utm_campaign=add-ons&utm_content=settings'							) . '</i>';	}	return $section;}add_filter( 'ctps_section-licenses', 'ctc_add_license_settings' );