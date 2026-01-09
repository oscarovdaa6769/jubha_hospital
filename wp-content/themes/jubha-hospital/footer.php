<footer class="site-footer">
      <div class="footer-container">

            <div class="footer-column">
                  <img src="wp-content/themes/jubha-hospital/assets/images/logo.png" alt="" height="100px">
                  <p><?php bloginfo('description'); ?></p>
            </div>

            <div class="footer-column">
                  <h4>Quick Links</h4>
                  <?php
                  wp_nav_menu(array(
                  'theme_location' => 'footer-menu',
                  'container' => false
                  ));
                  ?>
            </div>

            <div class="footer-column">
                  <h4>Contact</h4>
                  <p><i class="fa-solid fa-phone"></i>+855 88 798 0828</p>
                  <p><i class="fa-solid fa-envelope"></i>info@jubhaclinic.com</p>
            </div>

            <div class="footer-column">
                  <h4>Social</h4>
                  <div class="social-icon">
                        <a href="" class="fb">
                              <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="" class="li">
                              <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <a href="" class="ig">
                              <i class="fa-brands fa-instagram"></i>
                        </a>
                  </div>
            </div>

      </div>

      <div class="footer-bottom">
            <p>© <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</p>
      </div>

  <?php wp_footer(); ?>
</footer>
</body>
</html>