<div class="footer-nav">(C) JEJ CELLMANIA TRADING CORPORATION<br /><a href="<?php echo URL; ?>development">Version <?php echo file_get_contents(URL .'version.txt'); ?></a></div>

    <!-- jQuery, loaded in the recommended protocol-less way -->
    <!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
    <script src="<?php echo URL; ?>js/jquery-1.11.1.min.js"></script>

    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var url = "<?php echo URL; ?>";
    </script>

    <!-- our JavaScript -->
    <script src="<?php echo URL; ?>js/application.js"></script>
</body>
</html>
