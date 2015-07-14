    <!-- JS -->
    <script src="<?php echo URL; ?>assets_new/js/jquery-2.1.3.min.js"></script>
    <!-- TRANSITIONS ARE MUST IN THE FOOTER. This will ensure that all needed files are already loaded -->
    <!--[if lt IE 9]>
        <script src="<?php echo URL; ?>assets_new/js/html5shiv.js"></script>
        <script src="<?php echo URL; ?>assets_new/js/h5f.min.js"></script>
        <script src="<?php echo URL; ?>assets_new/js/respond.min.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
        <script src="<?php echo URL; ?>assets_new/js/html5shiv.js"></script>
        <script src="<?php echo URL; ?>assets_new/js/h5f.min.js"></script>
        <script src="<?php echo URL; ?>assets_new/js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" charset="utf-8">
        var url = "<?php echo URL; ?>";
        $(document).ready(function() {
            $('table#full').dataTable( {
                "scrollX": true,
                "scrollY": false,
                "stateSave": true
            } );
        } );
    </script>
    
    <!-- EXPORT -->
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/FileSaver/FileSaver.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/html2canvas/html2canvas.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/jsPDF/jspdf.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/tableExport.min.js"></script>
    <!-- OTHERS -->
    <script src="<?php echo URL; ?>assets_new/js/ajax.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/nod.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/validator.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/DataTables.bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/bootstrap-table.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/bootstrap-table-en-US.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/animate.js" type="text/javascript"></script>

</body>
</html>
