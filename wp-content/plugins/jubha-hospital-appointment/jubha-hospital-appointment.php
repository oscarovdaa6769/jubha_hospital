<?php
/*
Plugin Name: Jubha Hospital Appointment Booker
Description: Fixed booking system with admin management and public frontend shortcode
Version: 1.9
Author: Oudomveasna
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ====================
// DATABASE SETUP
// ====================
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

// ====================
// ADMIN MENU
// ====================
function jubha_admin_menu() {
    add_menu_page(
        'Jubha Bookings',
        'Bookings',
        'manage_options',
        'jubha-bookings',
        'jubha_bookings_page',
        'dashicons-calendar-alt'
    );

    add_submenu_page(
        'jubha-bookings',
        'Create Patient',
        'Create Patient',
        'manage_options',
        'jubha-add-patient',
        'jubha_add_patient_page'
    );

    add_submenu_page(
        'jubha-bookings',
        'Create Doctor',
        'Create Doctor',
        'manage_options',
        'jubha-add-doctor',
        'jubha_add_doctor_page'
    );

    add_submenu_page(
        'jubha-bookings',
        'Create Appointment',
        'Create Appointment',
        'manage_options',
        'jubha-add-appointment',
        'jubha_create_appointment_page'
    );
}
add_action( 'admin_menu', 'jubha_admin_menu' );

// ====================
// ADMIN: CREATE PATIENT
// ====================
function jubha_add_patient_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'You do not have permission to access this page.' );
    }

    global $wpdb;
    $message = '';

    if ( isset( $_POST['save_patient'] ) && check_admin_referer( 'jubha_save_patient' ) ) {
        $result = $wpdb->insert(
            $wpdb->prefix . 'jubha_patients',
            array(
                'patient_name' => sanitize_text_field( $_POST['p_name'] ?? '' ),
                'dob'          => sanitize_text_field( $_POST['p_dob'] ?? '' ),
                'phone'        => sanitize_text_field( $_POST['p_phone'] ?? '' ),
                'email'        => sanitize_email( $_POST['p_email'] ?? '' )
            )
        );

        if ( $result !== false ) {
            $message = '<div class="notice notice-success is-dismissible"><p>Patient Registered Successfully!</p></div>';
        } else {
            $message = '<div class="notice notice-error is-dismissible"><p>Error saving patient.</p></div>';
        }
    }

    ?>
    <div class="wrap">
        <h1>Create New Patient</h1>
        <?php echo $message; ?>
        <form method="post">
            <?php wp_nonce_field( 'jubha_save_patient' ); ?>
            <table class="form-table">
                <tr>
                    <th>Full Name</th>
                    <td><input name="p_name" type="text" class="regular-text" required></td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td><input name="p_dob" type="date" class="regular-text" required></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><input name="p_phone" type="text" class="regular-text"></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input name="p_email" type="email" class="regular-text"></td>
                </tr>
            </table>
            <p>
                <input type="submit" name="save_patient" class="button button-primary" value="Save Patient">
            </p>
        </form>
    </div>
    <?php
}

// ====================
// ADMIN: CREATE DOCTOR
// ====================
function jubha_add_doctor_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'You do not have permission to access this page.' );
    }

    global $wpdb;
    $message = '';

    if ( isset( $_POST['save_doctor'] ) && check_admin_referer( 'jubha_save_doctor' ) ) {
        $result = $wpdb->insert(
            $wpdb->prefix . 'jubha_doctors',
            array(
                'doctor_name' => sanitize_text_field( $_POST['doctor_name'] ?? '' ),
                'specialty'   => sanitize_text_field( $_POST['specialty'] ?? '' )
            )
        );

        if ( $result !== false ) {
            $message = '<div class="notice notice-success is-dismissible"><p>Doctor successfully added!</p></div>';
        } else {
            $message = '<div class="notice notice-error is-dismissible"><p>Error adding doctor.</p></div>';
        }
    }

    ?>
    <div class="wrap">
        <h1>Create New Doctor</h1>
        <?php echo $message; ?>
        <form method="post">
            <?php wp_nonce_field( 'jubha_save_doctor' ); ?>
            <table class="form-table">
                <tr>
                    <th>Doctor Name</th>
                    <td><input type="text" name="doctor_name" class="regular-text" required></td>
                </tr>
                <tr>
                    <th>Specialty</th>
                    <td>
                        <select name="specialty" class="regular-text">
                            <option value="">-- Select Specialty --</option>
                            <option value="Neurology">Neurology</option>
                            <option value="Oncology">Oncology</option>
                            <option value="Orthopedics">Orthopedics</option>
                        </select>
                    </td>
                </tr>
            </table>
            <p>
                <input type="submit" name="save_doctor" class="button button-primary" value="Save Doctor">
            </p>
        </form>
    </div>
    <?php
}

// ====================
// ADMIN: CREATE APPOINTMENT (Manual)
// ====================
function jubha_create_appointment_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'You do not have permission to access this page.' );
    }

    global $wpdb;
    $message = '';

    if ( isset( $_POST['save_appointment'] ) && check_admin_referer( 'jubha_save_appointment' ) ) {
        $result = $wpdb->insert(
            $wpdb->prefix . 'jubha_appointments',
            array(
                'patient_id' => absint( $_POST['p_id'] ?? 0 ),
                'doctor_id'  => absint( $_POST['d_id'] ?? 0 ),
                'app_date'   => sanitize_text_field( $_POST['app_date'] ?? '' ),
                'status'     => 'pending'
            )
        );

        if ( $result !== false ) {
            $message = '<div class="notice notice-success is-dismissible"><p>Appointment booked successfully!</p></div>';
        } else {
            $message = '<div class="notice notice-error is-dismissible"><p>Error booking appointment.</p></div>';
        }
    }

    $patients = $wpdb->get_results( "SELECT id, patient_name FROM {$wpdb->prefix}jubha_patients ORDER BY patient_name" );
    $doctors  = $wpdb->get_results( "SELECT id, doctor_name FROM {$wpdb->prefix}jubha_doctors ORDER BY doctor_name" );

    ?>
    <div class="wrap">
        <h1>Schedule Appointment (Admin)</h1>
        <?php echo $message; ?>
        <form method="post">
            <?php wp_nonce_field( 'jubha_save_appointment' ); ?>
            <table class="form-table">
                <tr>
                    <th>Select Patient</th>
                    <td>
                        <select name="p_id" required class="regular-text">
                            <option value="">-- Select Patient --</option>
                            <?php foreach ( $patients as $p ) : ?>
                                <option value="<?php echo esc_attr( $p->id ); ?>">
                                    <?php echo esc_html( $p->patient_name ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Select Doctor</th>
                    <td>
                        <select name="d_id" required class="regular-text">
                            <option value="">-- Select Doctor --</option>
                            <?php foreach ( $doctors as $d ) : ?>
                                <option value="<?php echo esc_attr( $d->id ); ?>">
                                    <?php echo esc_html( $d->doctor_name ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td><input type="date" name="app_date" min="<?php echo esc_attr( date('Y-m-d') ); ?>" required class="regular-text"></td>
                </tr>
            </table>
            <p>
                <input type="submit" name="save_appointment" class="button button-primary" value="Book Appointment">
            </p>
        </form>
    </div>
    <?php
}

// ====================
// ADMIN: VIEW ALL BOOKINGS
// ====================
function jubha_bookings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'You do not have permission to access this page.' );
    }

    global $wpdb;

    if ( isset( $_GET['action'] ) && $_GET['action'] === 'delete' && isset( $_GET['id'] ) && check_admin_referer( 'jubha_delete_appointment' ) ) {
        $wpdb->delete(
            $wpdb->prefix . 'jubha_appointments',
            array( 'id' => absint( $_GET['id'] ) )
        );
        echo '<div class="notice notice-success is-dismissible"><p>Appointment deleted.</p></div>';
    }

    $bookings = $wpdb->get_results(
        "SELECT app.id, p.patient_name, d.doctor_name, app.app_date, app.status 
         FROM {$wpdb->prefix}jubha_appointments app
         JOIN {$wpdb->prefix}jubha_patients p ON app.patient_id = p.id
         JOIN {$wpdb->prefix}jubha_doctors d ON app.doctor_id = d.id
         ORDER BY app.app_date ASC"
    );

    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">Scheduled Appointments</h1>
        <?php if ( $bookings ) : ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $bookings as $row ) : ?>
                        <tr>
                            <td><?php echo esc_html( $row->id ); ?></td>
                            <td><strong><?php echo esc_html( $row->patient_name ); ?></strong></td>
                            <td><?php echo esc_html( $row->doctor_name ); ?></td>
                            <td><?php echo esc_html( $row->app_date ); ?></td>
                            <td><?php echo esc_html( $row->status ); ?></td>
                            <td>
                                <a href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=jubha-bookings&action=delete&id=' . $row->id ), 'jubha_delete_appointment' ); ?>" 
                                   onclick="return confirm('Are you sure you want to delete this appointment?');">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No appointments found.</p>
        <?php endif; ?>
    </div>
    <?php
}

// ====================
// FRONTEND: PUBLIC BOOKING FORM SHORTCODE
// Use: [jubha_booking_form]
// ====================
function jubha_frontend_booking_form() {
    global $wpdb;
    $output = '';
    $message = '';

    if ( isset( $_POST['jubha_save_booking'] ) && isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'jubha_book_appointment' ) ) {
        $patient_id = absint( $_POST['patient_id'] ?? 0 );
        $doctor_id  = absint( $_POST['doctor_id'] ?? 0 );
        $date       = sanitize_text_field( $_POST['app_date'] ?? '' );

        if ( $patient_id <= 0 || $doctor_id <= 0 || empty( $date ) || ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $date ) ) {
            $message = '<div class="jubha-message jubha-error">Please fill all fields correctly.</div>';
        } elseif ( strtotime( $date ) < strtotime( 'today' ) ) {
            $message = '<div class="jubha-message jubha-error">Cannot book past dates.</div>';
        } else {
            // Check if doctor is already booked on that date (1 appointment per day per doctor)
            $exists = $wpdb->get_var( $wpdb->prepare(
                "SELECT COUNT(*) FROM {$wpdb->prefix}jubha_appointments 
                 WHERE doctor_id = %d AND app_date = %s",
                $doctor_id, $date
            ) );

            if ( $exists > 0 ) {
                $message = '<div class="jubha-message jubha-warning">This doctor is already booked on the selected date.</div>';
            } else {
                $result = $wpdb->insert(
                    $wpdb->prefix . 'jubha_appointments',
                    array(
                        'patient_id' => $patient_id,
                        'doctor_id'  => $doctor_id,
                        'app_date'   => $date,
                        'status'     => 'pending'
                    ),
                    array( '%d', '%d', '%s', '%s' )
                );

                if ( $result !== false ) {
                    $message = '<div class="jubha-message jubha-success">Appointment booked successfully! (Pending confirmation)</div>';
                } else {
                    $message = '<div class="jubha-message jubha-error">Error booking appointment. Please try again.</div>';
                }
            }
        }
    }

    $patients = $wpdb->get_results( "SELECT id, patient_name FROM {$wpdb->prefix}jubha_patients ORDER BY patient_name ASC" );
    $doctors  = $wpdb->get_results( "SELECT id, doctor_name FROM {$wpdb->prefix}jubha_doctors ORDER BY doctor_name ASC" );

    if ( empty( $patients ) || empty( $doctors ) ) {
        return '<p style="color: red; padding: 20px;">No patients or doctors available yet. Please add them from the admin panel.</p>';
    }

    ob_start();
    ?>
    <div class="jubha-booking-container">
        <h2>Book Your Appointment</h2>

        <?php if ( $message ) echo $message; ?>

        <form method="post" class="jubha-booking-form">
            <?php wp_nonce_field( 'jubha_book_appointment', '_wpnonce' ); ?>

            <div class="form-group">
                <label for="patient_id">Patient <span class="required">*</span></label>
                <select name="patient_id" id="patient_id" required>
                    <option value="">-- Select Patient --</option>
                    <?php foreach ( $patients as $p ) : ?>
                        <option value="<?php echo esc_attr( $p->id ); ?>"><?php echo esc_html( $p->patient_name ); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="doctor_id">Doctor <span class="required">*</span></label>
                <select name="doctor_id" id="doctor_id" required>
                    <option value="">-- Select Doctor --</option>
                    <?php foreach ( $doctors as $d ) : ?>
                        <option value="<?php echo esc_attr( $d->id ); ?>"><?php echo esc_html( $d->doctor_name ); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="app_date">Preferred Date <span class="required">*</span></label>
                <input type="date" name="app_date" id="app_date" min="<?php echo esc_attr( date( 'Y-m-d' ) ); ?>" required>
            </div>

            <div class="form-submit">
                <input type="submit" name="jubha_save_booking" value="Book Appointment" class="jubha-submit-btn">
            </div>
        </form>
    </div>

    <style>
        .jubha-booking-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        .jubha-booking-container h2 {
            margin-top: 0;
            color: #333;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        .form-group select,
        .form-group input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .required { color: red; }
        .jubha-submit-btn {
            background: #0073aa;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        .jubha-submit-btn:hover {
            background: #005177;
        }
        .jubha-message {
            padding: 12px;
            margin: 1rem 0;
            border-radius: 4px;
        }
        .jubha-success { background: #e6ffe6; color: #006600; border: 1px solid #99cc99; }
        .jubha-error   { background: #ffe6e6; color: #990000; border: 1px solid #cc9999; }
        .jubha-warning { background: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode( 'jubha_booking_form', 'jubha_frontend_booking_form' );