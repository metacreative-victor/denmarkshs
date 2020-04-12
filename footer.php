<!-- SITE FOOTER -->
<footer id="site-footer">
    <div class="footer-widgets">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-contact">
                        <a href="<?php echo home_url('/'); ?>" class="logo">
                            <img src="<?php echo SEN_THEME_URL; ?>assets/images/logo-white.png" alt="logo" width="200" height="70">
                        </a>
                        <?php
                        $phone = get_field( 'phone', 'option' );
                        $email = get_field( 'email', 'option' );
                        $address = get_field( 'address', 'option' );
                        if( !empty( $phone ) ) {
                            echo '<p><span>Call</span> ' .$phone. '</p>';
                        }
                        if( !empty( $email ) ) {
                            echo '<p><span>Email</span> <a href="mailto:' .$email. '">' .$email. '</a></p>';
                        }
                        if( !empty( $address ) ) {
                            echo '<p><span>Address</span> ' .$address. '</p>';
                        }
                        ?>
                        <ul class="socials">
                            <?php
                            $facebook_url = get_field( 'facebook_url', 'option' );
                            if( !empty( $facebook_url ) ) {
                                echo '<li><a href="' .esc_url( $facebook_url ). '" target="_blank"><img src="' .SEN_THEME_URL. 'assets/images/facebook-icon.png" alt="facebook" width="50" height="45"></a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- .footer-contact -->
                </div>
                <div class="col-md-6">
                    <div id="footer-map"></div>
                </div>
            </div>
            <!-- .row -->
            <div class="footer-menu">
                <?php
                if( has_nav_menu('footer') ) {
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'menu_class' => 'menu',
                        'container' => ''
                    ));
                }
                ?>
            </div>
            <!-- .footer-menu -->
        </div>
        <!-- .container -->
    </div>
    <!-- .footer-widgets -->
    <div class="footer-copyright">
        <div class="container text-center text-md-left">
            <div class="row">
                <div class="col-md-6">
                    <p>Copyright Denmark SHS <?php echo date('Y'); ?></p>
                </div>
                <div class="col-md-6 text-md-right">
                    <p>School website by <a href="https://metacreative.com.au/" target="_blank">Meta Creative</a></p>
                </div>
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .footer-copyright -->
</footer>
<!-- END SITE FOOTER -->

<?php
wp_footer();

$tracking_code = get_field( 'footer_code', 'option' );

if( !empty( $tracking_code ) ) {
    echo $tracking_code;
}
?>

<?php
$gmap_api = get_field( 'gmap_api', 'option' );
$latitude = get_field( 'latitude', 'option' );
$longitude = get_field( 'longitude', 'option' );

if( !empty( $gmap_api ) && !empty( $latitude ) && !empty( $longitude ) ) {
    ?>
    <!-- GOOGLE MAPS -->
    <script>
    function initMap() {
        var isDraggable = window.innerWidth > 767 ? true : false;

        // Google Maps loader
        google.maps.event.addDomListener(window, 'load', init);
        function init() {
            var map = new google.maps.Map(document.getElementById('footer-map'), {
                zoom: 17,
                center: new google.maps.LatLng( '<?php echo $latitude; ?>', '<?php echo $longitude; ?>' ),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true,
                scrollwheel: false,
                zoomControl: true,
                navigationControl: false,
                mapTypeControl: true,
                scaleControl: true,
                draggable: isDraggable,
                styles: []
            });

            // create markers in google maps
            marker = new google.maps.Marker({
                position: new google.maps.LatLng( '<?php echo $latitude; ?>', '<?php echo $longitude; ?>' ),
                map: map
            });
        }
    }
    </script>
    <script src="//maps.googleapis.com/maps/api/js?key=<?php echo $gmap_api; ?>&callback=initMap" async="" defer="defer"></script>
    <!-- END GOOGLE MAPS -->
<?php } ?>
</body>
</html>