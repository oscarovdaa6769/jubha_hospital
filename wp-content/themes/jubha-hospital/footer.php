<footer class="site-footer">
      <div class="footer-container">

            <div class="footer-column">
                  <h4><?php bloginfo('name'); ?></h4>
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
                        <a href="">
                              <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a href="">
                              <i class="fa-brands fa-linkedin"></i>
                        </a>
                        <a href="">
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