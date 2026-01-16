<?php 
/*
Plugin Name: Jubha Hospital Appointment Booker
Description: Fixed booking system with unique menus and corrected database columns.
Version: 1.8
*/

// No spaces or code should be above the opening <?php tag

if ( ! defined( 'ABSPATH' ) ) exit;

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

function jubha_admin_menu() {
    add_menu_page('Jubha Bookings', 'Bookings', 'manage_options', 'jubha-bookings', 'jubha_bookings_page', 'dashicons-calendar-alt');
    add_submenu_page('jubha-bookings', 'Add Patient', 'Create Patient', 'manage_options', 'jubha-add-patient', 'jubha_add_patient_page');
    add_submenu_page('jubha-bookings', 'Add Doctor', 'Create Doctor', 'manage_options', 'jubha-add-doctor', 'jubha_add_doctor_page');
    add_submenu_page('jubha-bookings', 'Add Appointment', 'Create Appointment', 'manage_options', 'jubha-add-appointment', 'jubha_create_appointment_page');
}
add_action('admin_menu', 'jubha_admin_menu');

function jubha_add_patient_page() {
    global $wpdb;
    if (isset($_POST['save_patient'])) {
        $wpdb->insert($wpdb->prefix . 'jubha_patients', array(
            'patient_name' => sanitize_text_field($_POST['p_name'] ?? ''),
            'dob'          => sanitize_text_field($_POST['p_dob'] ?? ''), 
            'phone'        => sanitize_text_field($_POST['p_phone'] ?? ''),
            'email'        => sanitize_email($_POST['p_email'] ?? '')
        ));
        echo '<div class="updated"><p>Patient Registered Successfully!</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>Create New Patient</h1>
        <form method="post">
            <table class="form-table">
                <tr><th>Full Name</th><td><input name="p_name" type="text" class="regular-text" required></td></tr>
                <tr><th>Date of Birth</th><td><input name="p_dob" type="date" class="regular-text" required></td></tr>
                <tr><th>Phone</th><td><input name="p_phone" type="text" class="regular-text"></td></tr>
                <tr><th>Email</th><td><input name="p_email" type="email" class="regular-text"></td></tr>
            </table>
            <input type="submit" name="save_patient" class="button button-primary" value="Save Patient">
        </form>
    </div>
    <?php
}

function jubha_add_doctor_page() {
    global $wpdb;
    if (isset($_POST['save_doctor'])) {
        $wpdb->insert($wpdb->prefix . 'jubha_doctors', array(
            'doctor_name' => sanitize_text_field($_POST['doctor_name']),
            'specialty'   => sanitize_text_field($_POST['specialty'])
        ));
        echo '<div class="updated"><p>Doctor successfully added!</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>Create New Doctor</h1>
        <form method="post">
            <table class="form-table">
                <tr><th>Doctor Name</th><td><input type="text" name="doctor_name" class="regular-text" required></td></tr>
                <tr><th>Specialty</th><td>
                    <select name="specialty">
                        <option value="Neurology">Neurology</option>
                        <option value="Oncology">Oncology</option>
                        <option value="Orthopedics">Orthopedics</option>
                    </select>
                </td></tr>
            </table>
            <input type="submit" name="save_doctor" class="button button-primary" value="Save Doctor">
        </form>
    </div>
    <?php
}

function jubha_create_appointment_page() {
    global $wpdb;
    if (isset($_POST['save_appointment'])) {
        $wpdb->insert($wpdb->prefix . 'jubha_appointments', array(
            'patient_id' => intval($_POST['p_id']),
            'doctor_id'  => intval($_POST['d_id']),
            'app_date'   => sanitize_text_field($_POST['app_date']),
            'status'     => 'pending'
        ));
        echo '<div class="updated"><p>Appointment booked successfully!</p></div>';
    }
    $patients = $wpdb->get_results("SELECT id, patient_name FROM {$wpdb->prefix}jubha_patients");
    $doctors = $wpdb->get_results("SELECT id, doctor_name FROM {$wpdb->prefix}jubha_doctors");
    ?>
    <div class="wrap">
        <h1>Schedule Appointment</h1>
        <form method="post">
            <table class="form-table">
                <tr><th>Select Patient</th><td>
                    <select name="p_id" required>
                        <?php foreach ($patients as $p) echo "<option value='{$p->id}'>".esc_html($p->patient_name)."</option>"; ?>
                    </select>
                </td></tr>
                <tr><th>Select Doctor</th><td>
                    <select name="d_id" required>
                        <?php foreach ($doctors as $d) echo "<option value='{$d->id}'>".esc_html($d->doctor_name)."</option>"; ?>
                    </select>
                </td></tr>
                <tr><th>Date</th><td><input type="date" name="app_date" required></td></tr>
            </table>
            <input type="submit" name="save_appointment" class="button button-primary" value="Book Appointment">
        </form>
    </div>
    <?php
}

function jubha_bookings_page() {
    global $wpdb;
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $wpdb->delete($wpdb->prefix . 'jubha_appointments', array('id' => intval($_GET['id'])));
        echo '<div class="updated"><p>Appointment deleted.</p></div>';
    }
    $query = "SELECT app.id, p.patient_name, d.doctor_name, app.app_date, app.status 
              FROM {$wpdb->prefix}jubha_appointments app
              JOIN {$wpdb->prefix}jubha_patients p ON app.patient_id = p.id
              JOIN {$wpdb->prefix}jubha_doctors d ON app.doctor_id = d.id
              ORDER BY app.app_date ASC";
    $bookings = $wpdb->get_results($query);
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Scheduled Appointments</h1>
        <table class="wp-list-table widefat fixed striped">
            <thead><tr><th>ID</th><th>Patient Name</th><th>Doctor Name</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                <?php if ($bookings): foreach ($bookings as $row): ?>
                    <tr>
                        <td><?php echo $row->id; ?></td>
                        <td><strong><?php echo esc_html($row->patient_name); ?></strong></td>
                        <td><?php echo esc_html($row->doctor_name); ?></td>
                        <td><?php echo esc_html($row->app_date); ?></td>
                        <td><?php echo esc_html($row->status); ?></td>
                        <td><a href="?page=jubha-bookings&action=delete&id=<?php echo $row->id; ?>" onclick="return confirm('Delete?')">Delete</a></td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="6">No appointments found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}