
    <div role="navigation" class="navbar visible-print" id="print-footer">
        <div class="container">
            <div class="pull-right" style="width: 300px;">
                Recieved By:<br /><br />
                _________________________________________
                <center><?php echo COM_RECIEVED_BY; ?></center>
            </div>
            <div class="pull-right" style="width: 300px;">
                Approved By:<br /><br />
                _________________________________________
                <center><?php echo COM_GENERAL_MANAGER; ?></center>
            </div>
        </div>
    </div>

    <!-- OTHERS -->
    <script src="<?php echo URL; ?>assets_new/js/ajax.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/application.js" type="text/javascript"></script>
    <!-- EXPORT -->
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/FileSaver/FileSaver.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/html2canvas/html2canvas.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/jsPDF/jspdf.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>assets_new/js/tableExport.min.js"></script>
    
    <?php require VIEWS_PATH . '_script/datatables.php'; ?>
    
    <script type="text/javascript">
        $("document").ready(function(){
            setTimeout(function(){
                $(".processing").hide();
            }, 4000);
        });
    </script>

</div>
    
</body>
</html>
