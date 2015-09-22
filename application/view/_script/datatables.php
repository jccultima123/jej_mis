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
            <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                $('table#orders').dataTable({
                    order: [[5, 'desc']],
                    "columnDefs": [
                        {
                            "targets": [7, 8],
                            "width": "60px",
                            "sortable": false
                        }
                    ]
                });
            <?php } else { ?>
                $('table#orders').dataTable({
                    order: [[5, 'desc']],
                    "columnDefs": [
                        {
                            "targets": [7, 8],
                            "width": "60px",
                            "sortable": false
                        }
                    ]
                });
            <?php } ?>
            $('table#customers').dataTable({
                order: [[2, 'desc']],
                "columnDefs": [
                    {
                        "targets": [4],
                        "sortable": false
                    }
                ]
            });
            $('table#feedbacks').dataTable({
                order: [[5, 'desc']],
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
                        "targets": [7, 8],
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
                order: [[8, 'desc']],
                //"scrollY": "300px",
                //"scrollCollapse": true,
                "columnDefs": [
                    {
                        "targets": [11],
                        "sortable": false,
                    }
                ]
            });
            $('table#au').dataTable({
                "lengthMenu": [[-1, 5, 25, 50, 100, 200], ["All", 5, 25, 50, 100, 200]],
                "pageLength": 5
            });
        } );
    </script>