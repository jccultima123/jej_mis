
    <div role="navigation" class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <div class="btn-group pull-right no-print" style="padding-top: 10px; margin-right: -15px;">
                <a class="btn btn-danger" href="javascript:void(0)" onclick="window.print();"><span class="glyphicon glyphicon-print"></span> Generate / Finalize Report</a>
                <a class="btn btn-default" href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><span class="glyphicon glyphicon-remove"></span> Close</a>
            </div>
        </div>
    </div>

    <!-- EXPORT -->
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/FileSaver/FileSaver.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/html2canvas/html2canvas.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/jsPDF/jspdf.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/tableExport.min.js"></script>
    <!-- OTHERS -->
    <script src="<?php echo URL; ?>assets_new/js/ajax.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/DataTables.bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/animate.js" type="text/javascript"></script>
    
    <?php require VIEWS_PATH . '_script/datatables.php'; ?>
    
    <script type="text/javascript">
        $("document").ready(function(){
            setTimeout(function(){
                $(".processing").hide();
            }, 4000);
        });
    </script>

</body>
</html>
