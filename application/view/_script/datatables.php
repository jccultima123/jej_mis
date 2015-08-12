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
                        "width": "60px",
                        "sortable": false
                    }
                ]
            });
            $('table#orders').dataTable({
                "columnDefs": [
                    {
                        "targets": [7, 8],
                        "width": "60px",
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
                        "targets": [5, 6],
                        "sortable": false
                    }
                ]
            });
            $('table#branches').dataTable({
                "columnDefs": [
                    {
                        "targets": [5, 6],
                        "sortable": false
                    }
                ]
            });
            $('table#assets').dataTable({
                "columnDefs": [
                    {
                        "targets": [9],
                        "width": "60px",
                        "sortable": false
                    }
                ]
            });
            $('table#au').dataTable({
                "stateSave": true
            });
        } );
    </script>