<?php 
function daa_create_tables() {

global $wpdb; $charset = $wpdb->get_charset_collate();

dbDelta ("CREATE TABLE {$wpdb->prefix}daa_doctors id INT AUTO INCREMENT PRIMARY KEY, name VARCHAR(100), specialty VARCHAR(100) ) $charset;");

dbDelta("CREATE TABLE {$wpdb->prefix}daa_patient id INT AUTO INCREMENT PRIMARY KEY, name VARCHAR(100), phone VARCHAR(50) ) $charset;");

dbDelta("CREATE TABLE {$wpdb->prefix}daa_appoint id INT AUTO INCREMENT PRIMARY KEY, doctor_id INT, patient id INT, appointment date DATETIME ) $charset;");
}