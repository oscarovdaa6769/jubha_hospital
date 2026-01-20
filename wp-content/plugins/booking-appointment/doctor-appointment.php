<?php
/*
Plugin Name: Jubha Hospital Appointment Booker
Description: Fixed system that shows on the front-end website.
Version: 2.3
*/

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. DATABASE SETUP
function jubha_setup_database() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $sql1 = "CREATE TABLE {$wpdb->prefix}jubha_patients (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        patient_name varchar(100) NOT NULL,
        dob date, 
        email varchar(100),
        phone varchar(20),
        PRIMARY KEY  (id)
    ) $charset_collate;";

    $sql2 = "CREATE TABLE {$wpdb->prefix}jubha_doctors (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        doctor_name varchar(100) NOT NULL,
        specialty varchar(100),
        PRIMARY KEY  (id)
    ) $charset_collate;";

    $sql3 = "CREATE TABLE {$wpdb->prefix}jubha_appointments (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        patient_id mediumint(9) NOT NULL,
        doctor_id mediumint(9) NOT NULL,
        app_date date NOT NULL,
        status varchar(20) DEFAULT 'pending',
        PRIMARY KEY  (id)
    ) $charset_collate;";

    dbDelta( array($sql1, $sql2, $sql3) );
}
register_activation_hook( __FILE__, 'jubha_setup_database' );

// 2. ADMIN MENU
function jubha_admin_menu() {
    add_menu_page('Jubha Bookings', 'Bookings', 'manage_options', 'jubha-bookings', 'jubha_bookings_page', 'dashicons-calendar-alt');
    add_submenu_page('jubha-bookings', 'Patients', 'Patients', 'manage_options', 'jubha-patients', 'jubha_patients_page');
    add_submenu_page('jubha-bookings', 'Doctors', 'Doctors', 'manage_options', 'jubha-doctors', 'jubha_doctors_page');
}
add_action('admin_menu', 'jubha_admin_menu');

// Admin page for bookings (improved to show list)
function jubha_bookings_page() {
    global $wpdb;
    echo '<div class="wrap"><h1>Jubha Appointments</h1>';
    
    $appointments = $wpdb->get_results("
        SELECT a.id, a.app_date, a.status, p.patient_name, d.doctor_name 
        FROM {$wpdb->prefix}jubha_appointments a
        JOIN {$wpdb->prefix}jubha_patients p ON a.patient_id = p.id
        JOIN {$wpdb->prefix}jubha_doctors d ON a.doctor_id = d.id
        ORDER BY a.app_date DESC
    ");
    
    if ($appointments) {
        echo '<table class="widefat"><thead><tr><th>ID</th><th>Date</th><th>Patient</th><th>Doctor</th><th>Status</th></tr></thead><tbody>';
        foreach ($appointments as $app) {
            echo "<tr><td>{$app->id}</td><td>{$app->app_date}</td><td>" . esc_html($app->patient_name) . "</td><td>" . esc_html($app->doctor_name) . "</td><td>{$app->status}</td></tr>";
        }
        echo '</tbody></table>';
    } else {
        echo '<p>No appointments yet.</p>';
    }
    
    echo '<p>Check front-end page with [jubha_booking_form] shortcode to book appointments.</p></div>';
}

// Simple admin page to manage patients
function jubha_patients_page() {
    global $wpdb;
    echo '<div class="wrap"><h1>Manage Patients</h1>';
    
    if (isset($_POST['add_patient'])) {
        $name = sanitize_text_field($_POST['patient_name']);
        $dob = sanitize_text_field($_POST['dob']);
        $email = sanitize_email($_POST['email']);
        $phone = sanitize_text_field($_POST['phone']);
        
        if (!empty($name)) {
            $wpdb->insert($wpdb->prefix . 'jubha_patients', [
                'patient_name' => $name,
                'dob' => $dob,
                'email' => $email,
                'phone' => $phone
            ]);
            echo '<div class="updated"><p>Patient added.</p></div>';
        }
    }
    
    echo '<form method="post"><h2>Add Patient</h2>';
    echo 'Name: <input type="text" name="patient_name" required><br>';
    echo 'DOB: <input type="date" name="dob"><br>';
    echo 'Email: <input type="email" name="email"><br>';
    echo 'Phone: <input type="text" name="phone"><br>';
    echo '<input type="submit" name="add_patient" value="Add Patient"></form>';
    
    $patients = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}jubha_patients");
    if ($patients) {
        echo '<h2>Patients List</h2><table class="widefat"><thead><tr><th>ID</th><th>Name</th><th>DOB</th><th>Email</th><th>Phone</th></tr></thead><tbody>';
        foreach ($patients as $p) {
            echo "<tr><td>{$p->id}</td><td>" . esc_html($p->patient_name) . "</td><td>{$p->dob}</td><td>" . esc_html($p->email) . "</td><td>" . esc_html($p->phone) . "</td></tr>";
        }
        echo '</tbody></table>';
    }
    echo '</div>';
}

// Simple admin page to manage doctors
function jubha_doctors_page() {
    global $wpdb;
    echo '<div class="wrap"><h1>Manage Doctors</h1>';
    
    if (isset($_POST['add_doctor'])) {
        $name = sanitize_text_field($_POST['doctor_name']);
        $specialty = sanitize_text_field($_POST['specialty']);
        
        if (!empty($name)) {
            $wpdb->insert($wpdb->prefix . 'jubha_doctors', [
                'doctor_name' => $name,
                'specialty' => $specialty
            ]);
            echo '<div class="updated"><p>Doctor added.</p></div>';
        }
    }
    
    echo '<form method="post"><h2>Add Doctor</h2>';
    echo 'Name: <input type="text" name="doctor_name" required><br>';
    echo 'Specialty: <input type="text" name="specialty"><br>';
    echo '<input type="submit" name="add_doctor" value="Add Doctor"></form>';
    
    $doctors = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}jubha_doctors");
    if ($doctors) {
        echo '<h2>Doctors List</h2><table class="widefat"><thead><tr><th>ID</th><th>Name</th><th>Specialty</th></tr></thead><tbody>';
        foreach ($doctors as $d) {
            echo "<tr><td>{$d->id}</td><td>" . esc_html($d->doctor_name) . "</td><td>" . esc_html($d->specialty) . "</td></tr>";
        }
        echo '</tbody></table>';
    }
    echo '</div>';
}

// 3. THE BOOKING FORM FUNCTION (with fixes)
function jubha_booking_form_html() {
    global $wpdb;
    $output = '';
    $message = '';

    if (isset($_POST['save_appointment'])) {
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'jubha_book_appointment')) {
            $message = '<div style="color:red; padding:10px; background:#ffe6e6;">Invalid request. Please try again.</div>';
        } else {
            $p_id     = isset($_POST['p_id'])     ? absint($_POST['p_id']) : 0;
            $d_id     = isset($_POST['d_id'])     ? absint($_POST['d_id']) : 0;
            $app_date = isset($_POST['app_date']) ? sanitize_text_field(trim($_POST['app_date'])) : '';

            // Validation
            if (!$p_id || !$d_id || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $app_date)) {
                $message = '<div style="color:red; padding:10px; background:#ffe6e6;">Invalid input. Please fill all fields correctly.</div>';
            } elseif (strtotime($app_date) < strtotime('today')) {
                $message = '<div style="color:red; padding:10px; background:#ffe6e6;">Cannot book past dates.</div>';
            } else {
                // Check if doctor is already booked on that date (assuming one per day)
                $exists = $wpdb->get_var($wpdb->prepare(
                    "SELECT COUNT(*) FROM {$wpdb->prefix}jubha_appointments 
                     WHERE doctor_id = %d AND app_date = %s",
                    $d_id, $app_date
                ));

                if ($exists > 0) {
                    $message = '<div style="color:orange; padding:10px; background:#fff4e6;">This doctor is already booked on that date.</div>';
                } else {
                    $result = $wpdb->insert(
                        $wpdb->prefix . 'jubha_appointments',
                        [
                            'patient_id' => $p_id,
                            'doctor_id'  => $d_id,
                            'app_date'   => $app_date,
                            'status'     => 'pending'
                        ],
                        ['%d', '%d', '%s', '%s']
                    );

                    if ($result !== false) {
                        $message = '<div style="color:green; padding:10px; background:#e6ffe6;">Appointment booked successfully!</div>';
                    } else {
                        $message = '<div style="color:red; padding:10px; background:#ffe6e6;">Error booking appointment. Please try again.</div>';
                    }
                }
            }
        }
    }

    $output .= $message;

    $patients = $wpdb->get_results("SELECT id, patient_name FROM {$wpdb->prefix}jubha_patients ORDER BY patient_name");
    $doctors = $wpdb->get_results("SELECT id, doctor_name FROM {$wpdb->prefix}jubha_doctors ORDER BY doctor_name");

    $output .= '<div style="background:#f4f4f4; padding:20px; color:#333; margin: 20px 0; max-width: 600px;">';
    $output .= '<h3>Book Your Appointment</h3>';
    $output .= '<form method="post">';
    $output .= wp_nonce_field('jubha_book_appointment', '_wpnonce', true, false);
    $output .= 'Patient: <select name="p_id" style="width:100%; margin-bottom:10px;" required>';
    foreach ($patients as $p) { $output .= "<option value='{$p->id}'>" . esc_html($p->patient_name) . "</option>"; }
    $output .= '</select><br>';
    $output .= 'Doctor: <select name="d_id" style="width:100%; margin-bottom:10px;" required>';
    foreach ($doctors as $d) { $output .= "<option value='{$d->id}'>" . esc_html($d->doctor_name) . "</option>"; }
    $output .= '</select><br>';
    $output .= 'Date: <input type="date" name="app_date" min="' . date('Y-m-d') . '" style="width:100%; margin-bottom:10px;" required><br>';
    $output .= '<input type="submit" name="save_appointment" value="Book Now" style="background:#004d57; color:white; padding:10px 20px; border:none;">';
    $output .= '</form></div>';
    
    return $output;
}

// 4. REGISTER THE SHORTCODE
function register_jubha_shortcode() {
    add_shortcode('jubha_booking_form', 'jubha_booking_form_html');
}
add_action('init', 'register_jubha_shortcode');