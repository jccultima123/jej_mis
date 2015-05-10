    <!-- TRANSITIONS ARE MUST IN THE FOOTER. This will ensure that all needed files are already loaded -->
    <script src="<?php echo URL; ?>assets_new/js/animation_top.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/animation.js" type="text/javascript"></script>

    <div role="navigation" class="navbar navbar-default navbar-fixed-bottom" id="footer">
        <p class="navbar-text" style="text-align: center; float: none;">
            (C) JEJ CELLMANIA TRADING CORPORATION<br />
            System Version: <a id="load" href="<?php echo URL; ?>development"><?php echo file_get_contents(URL .'version'); ?></a>
        </p>
    </div>

</body>
</html>
