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
                  <h4>Sign up to receive the top stories you need to know right now.</h4>
                  <form action="" class="newsletter-form">
                        <div class="input-group">
                              <input type="email" class="email-form" placeholder="Enter your email" required>
                              <button type="submit" class="subscribe-btn">
                                    <i class="fa-solid fa-paper-plane"></i>
                              </button>
                        </div>
                  </form>
            </div>

      </div>

      <div class="footer-bottom">
            <div class="container">
                  <p>© <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</p>
                  <div class="footer-bottom-container">
                        <div class="footer-legal">
                              <a href="#">Terms & Conditions</a>
                              <span class="divider">|</span>
                              <a href="#">Privacy Policy</a>
                              <span class="divider">|</span>
                              <a href="#">Disclaimer</a>
                        </div>
                        <div class="footer-social">
                              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                              <a href="#"><i class="fa-brands fa-instagram"></i></a>
                              <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                              <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                              <a href="#"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                  </div>
            </div>
      </div>

  <?php wp_footer(); ?>
</footer>
</body>
</html>