<?php get_header(); ?>
<main class="booking-an-appointment">
    <section class="hero-banner">
        <div class="container">
                <div class="hero-content">
                    <h1>Booking An Appointment</h1>
                    <nav class="breadcrumb">
                            <a href="/">Home</a> / <span>Booking An Appointment</span>
                    </nav>
                </div>
        </div>
    </section>
</main>
<?php
while ( have_posts() ) : the_post();
    the_content(); // This is the magic line that displays [jubha_booking_form]
endwhile;
?>
<?php get_footer(); ?>