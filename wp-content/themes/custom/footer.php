    <footer id="colophon" class="site-footer">
        <div class="site-info">
            <nav class="footer-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_id'        => 'footer-menu',
                ));
                ?>
            </nav>
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>

</body>
</html>