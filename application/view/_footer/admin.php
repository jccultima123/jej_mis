        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

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
    
    <script type="text/javascript" charset="utf-8">
        var url = "<?php echo URL; ?>";
        $(document).ready(function() {
            $('table#full').dataTable( {
                "scrollX": true,
                "scrollY": false,
            } );
            $('table#sales').dataTable({
                "columnDefs": [
                    {
                        "targets": [7, 8],
                        "sortable": false
                    }
                ]
            });
            $('table#feedbacks').dataTable({
                "columnDefs": [
                    {
                        "targets": [6],
                        "sortable": false
                    }
                ]
            });
            $('table#products').dataTable({
                "columnDefs": [
                    {
                        "targets": [6, 7],
                        "sortable": false
                    }
                ]
            });
        } );
    </script>

</body>
</html>
