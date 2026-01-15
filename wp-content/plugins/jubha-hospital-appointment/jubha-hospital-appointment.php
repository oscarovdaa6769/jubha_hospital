<?php 
/*
Plugin Name: Jubha Hospital Appointment Booker
Description: Advanced booking system with Force-Display and Admin Delete.
Version: 1.6
*/

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. DATABASE: Setup table
register_activation_hook(__FILE__, 'jubha_final_db');
function jubha_final_db() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hospital_appointments';
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        patient_name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        phone varchar(20) NOT NULL,
        department varchar(50) NOT NULL,
        appointment_date date NOT NULL,
        PRIMARY KEY  (id)
    ) {$wpdb->get_charset_collate()};";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// 2. THE FORM: Using a function we can call anywhere
function jubha_get_appointment_form() {
    global $wpdb;
    $msg = '';

    if (isset($_POST['jubha_submit_final'])) {
        $wpdb->insert($wpdb->prefix . 'hospital_appointments', array(
            'patient_name' => sanitize_text_field($_POST['p_name']),
            'email' => sanitize_email($_POST['p_email']),
            'phone' => sanitize_text_field($_POST['p_phone']),
            'department' => sanitize_text_field($_POST['p_dept']),
            'appointment_date' => sanitize_text_field($_POST['p_date'])
        ));
        $msg = '<div style="background:#d4edda; color:#155724; padding:15px; border-radius:10px; margin-bottom:20px; text-align:center;">Success! Appointment Booked.</div>';
    }

    $form = '
    <div id="jubha-form-container" style="background:#fff; padding:30px; border-radius:15px; box-shadow:0 10px 30px rgba(0,0,0,0.1); max-width:450px; margin:20px auto; font-family:sans-serif;">
        '.$msg.'
        <h2 style="color:#0a2540; text-align:center;">Book Appointment</h2>
        <form method="POST">
            <input type="text" name="p_name" placeholder="Full Name" required style="width:100%; padding:12px; margin-bottom:15px; border:1px solid #ddd; border-radius:8px;">
            <input type="email" name="p_email" placeholder="Email Address" required style="width:100%; padding:12px; margin-bottom:15px; border:1px solid #ddd; border-radius:8px;">
            <input type="tel" name="p_phone" placeholder="Phone Number" required style="width:100%; padding:12px; margin-bottom:15px; border:1px solid #ddd; border-radius:8px;">
            <select name="p_dept" required style="width:100%; padding:12px; margin-bottom:15px; border:1px solid #ddd; border-radius:8px;">
                <option value="">Choose Department</option>
                <option value="Cardiology">Cardiology</option>
                <option value="Orthopedics">Orthopedics</option>
                <option value="General">General Medicine</option>
            </select>
            <input type="date" name="p_date" required style="width:100%; padding:12px; margin-bottom:15px; border:1px solid #ddd; border-radius:8px;">
            <button type="submit" name="jubha_submit_final" style="width:100%; background:#0a2540; color:#fff; padding:15px; border:none; border-radius:30px; font-weight:bold; cursor:pointer;">Confirm Booking</button>
        </form>
    </div>';
    return $form;
}

// Register shortcode
add_shortcode('jubha_appointment_form', 'jubha_get_appointment_form');

// 3. ADMIN: Bookings list with DELETE button
add_action('admin_menu', 'jubha_admin_setup');
function jubha_admin_setup() {
    add_menu_page('Appointments', 'Bookings', 'manage_options', 'jubha-bookings', 'jubha_admin_view', 'dashicons-calendar-alt', 6);
}

function jubha_admin_view() {
    global $wpdb;
    $table = $wpdb->prefix . 'hospital_appointments';

    // Delete Logic
    if (isset($_GET['del'])) {
        $wpdb->delete($table, array('id' => intval($_GET['del'])));
        echo '<div class="updated"><p>Record Deleted!</p></div>';
    }

    $data = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC");
    echo '<div class="wrap"><h1>Appointment List</h1><table class="wp-list-table widefat fixed striped">
    <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Dept</th><th>Date</th><th>Action</th></tr></thead><tbody>';
    foreach ($data as $row) {
        $del_url = admin_url('admin.php?page=jubha-bookings&del=' . $row->id);
        echo "<tr>
            <td>{$row->patient_name}</td>
            <td>{$row->email}</td>
            <td>{$row->phone}</td>
            <td>{$row->department}</td>
            <td>{$row->appointment_date}</td>
            <td><a href='{$del_url}' class='button button-link-delete' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
        </tr>";
    }
    echo '</tbody></table></div>';
}