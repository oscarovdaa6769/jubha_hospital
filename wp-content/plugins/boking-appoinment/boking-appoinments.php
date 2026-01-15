<?php
/*
plugin name: boking-appoinment
decription: used by ob_end_clean
version: 1.0.0
author: Chork Bora
*/


add_action('admin_menu', 'boking_appionment_add_menu');

function boking_appionment_add_menu() {
    add_menu_page(
        'Booking Appointment',        // Page title
        'Booking Appointment',        // Menu title (shown in menu)
        'manage_options',             // Capability
        'boking-appionment',           // Menu slug
        'boking_appionment_page',      // Callback function
        'dashicons-calendar-alt',      // Icon
        25                             // Position
    );
}

function boking_appionment_page() {
    ?>
    <div class="wrap">
        <h1>Booking Appointment</h1>
        <p>This is the Booking Appointment plugin page.</p>
    </div>
    <?php
}
