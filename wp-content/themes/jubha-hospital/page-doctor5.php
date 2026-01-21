<?php get_header(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
<div class="back-button">
    <button>
        <a href="/find-a-doctor/">< Back</a>
    </button>
</div>
<div class="hero-doctor">
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor7.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor2.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor3.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor4.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
</div>


<div class="hero-doctor">
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor5.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor6.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor8.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor1.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
</div>


<div class="hero-doctor">
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor9.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor10.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor11.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor12.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
</div>

<div class="hero-doctor">
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor5.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor6.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor8.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor1.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
</div>


<div class="hero-doctor">
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor5.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor6.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor8.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
  <div class="doctor-profile">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/doctor1.jpg" alt="Doctor">
    <div class="doctor-info">
      <h3>Dr. John Doe</h3>
      <p>Cardiologist</p>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Place all your code inside here
  document.querySelectorAll('.doctor-profile').forEach(card => {
    card.addEventListener('click', () => {
      const modal = document.getElementById('doctorModal');
      // ... the rest of your code
      modal.style.display = 'flex';
    });
  });

  document.querySelector('.close-modal').onclick = () => {
    document.getElementById('doctorModal').style.display = 'none';
  };
});
</script>




<?php get_footer(); ?>  