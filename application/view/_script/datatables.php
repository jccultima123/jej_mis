<script type="text/javascript" charset="utf-8">
        var url = "<?php echo URL; ?>";
        $(document).ready(function() {
            $('table#full').dataTable( {
                "scrollX": true,
                "scrollY": false
            } );
            <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                $('table#sales').dataTable({
                    order: [[7, 'desc']],
                    "columnDefs": [
                        {
                            "targets": [8, 9],
                            "sortable": false
                        }
                    ]
                });
            <?php } else { ?>
                $('table#sales').dataTable({
                    order: [[5, 'desc']],
                    "columnDefs": [
                        {
                            "targets": [7, 8],
                            "sortable": false
                        }
                    ]
                });
            <?php } ?>
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
                        "targets": [6, 7],
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
                "lengthMenu": [[-1, 25, 50, 100, 200], ["All", 25, 50, 100, 200]],
                "stateSave": true
            });
        } );
    </script>