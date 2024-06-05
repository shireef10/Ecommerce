    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src=".././assets/plugins/respond.min.js"></script>  
    <![endif]-->
    <script src=".././assets/plugins/jquery.min.js" type="text/javascript"></script>
    <script src=".././assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src=".././assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src=".././assets/corporate/scripts/back-to-top.js" type="text/javascript"></script>
    <script src=".././assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src=".././assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src=".././assets/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
    <script src='.././assets/plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
    <script src=".././assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->

    <script src=".././assets/corporate/scripts/layout.js" type="text/javascript"></script>
    <script src=".././assets/pages/scripts/bs-carousel.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
            Layout.initImageZoom();
            Layout.initTouchspin();
            Layout.initTwitter();
        });
    </script><script>
    $(document).ready(function() {
        // Define the interval (in milliseconds) for auto-sliding
        var interval = 5000;

        // Find the carousel element by its ID
        var $carousel = $('#carousel-example-generic');

        // Start the carousel with the 'carousel' method
        $carousel.carousel();

        // Set an interval to slide the carousel automatically
        setInterval(function() {
            $carousel.carousel('next'); // Move to the next slide
        }, interval);
    });


        // Get the current year
    var currentYear = new Date().getFullYear();

    // Update the content of the "current-year" element with the current year
    document.getElementById("current-year").textContent = currentYear;

</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const advancedSearchToggle = document.getElementById("advancedSearchToggle");
        const advancedSearchForm = document.getElementById("advancedSearchForm");

        advancedSearchToggle.addEventListener("click", function() {
            if (advancedSearchForm.style.display === "none" || advancedSearchForm.style.display === "") {
                advancedSearchForm.style.display = "block";
                advancedSearchToggle.textContent = "Hide Advanced Search";
            } else {
                advancedSearchForm.style.display = "none";
                advancedSearchToggle.textContent = "Advanced Search";
            }
        });
    });
</script>


    <!-- END PAGE LEVEL JAVASCRIPTS -->