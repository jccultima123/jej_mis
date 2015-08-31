$(document).ready(function() {
    var oTable=$('#table1').dataTable( {
    initComplete: function () {
        this.api().columns().every( function () {
            var column = this;
            var select = $('<select class="form-control selectpicker show-tick" title="More" data-header="Filter this column by" data-container="body" data-size="5" data-live-search="true"><option hidden value="" title="">None<option></select>')
                .appendTo( $(column.footer()).empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                } );

            column.data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
        } );
    },
    "lengthMenu": [[-1, 25, 50, 100, 200], ["All", 25, 50, 100, 200]],
        "paging": true,
        "jQueryUI": false,
        "searching": true,
        "ordering": true,
        "stateSave": false,
        "pageLength": 10,
        "pagination": true,
        "sDom": "tp"
    } );
    $('#table2').dataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select class="form-control selectpicker show-tick" title="More" data-header="Filter this column by" data-container="body" data-size="5" data-live-search="true"><option hidden value="" title="">None<option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
        "lengthMenu": [[-1, 25, 50, 100, 200], ["All", 25, 50, 100, 200]],
            "paging": true,
            "jQueryUI": false,
            "searching": false,
            "ordering": true,
            "stateSave": false
    } );
    var oTable1=$('#table3').dataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select class="form-control selectpicker show-tick" title="More" data-header="Filter this column by" data-container="body" data-size="5" data-live-search="true"><option hidden value="" title="">None<option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
        "lengthMenu": [[-1, 25, 50, 100, 200], ["All", 25, 50, 100, 200]],
            "paging": true,
            "jQueryUI": false,
            "searching": true,
            "ordering": true,
            "stateSave": false,
            "pageLength": 10,
            "pagination": true,
            "sDom": "tp"
    } );

    //Targeted Date
    var datecolumn = 6;
    var startdate;
    var enddate;
    $("#reportrange").daterangepicker({
        format: "DD/MM/YYYY"
    }, function(f, a, b) {
        var c = moment(f.toISOString());
        var d = moment(a.toISOString());
        startdate = c.format("YYYY-MM-DD");
        enddate = d.format("YYYY-MM-DD")
    });
    $("#reportrange").on("apply.daterangepicker", function(b, a) {
        startdate = a.startDate.format("YYYY-MM-DD");
        enddate = a.endDate.format("YYYY-MM-DD");
        oTable.fnDraw()
    });
    $.fn.dataTableExt.afnFiltering.push(function(f, c, b) {
        if (startdate != undefined) {
            var e = c[datecolumn].split("/");
            var g = new Date(e[2], e[1] - 1, e[0]);
            var a = moment(g.toISOString());
            a = a.format("YYYY-MM-DD");
            dateMin = startdate.replace(/-/g, "");
            dateMax = enddate.replace(/-/g, "");
            a = a.replace(/-/g, "");
            if (dateMin == "" && a <= dateMax) {
                return true
            } else {
                if (dateMin == "" && a <= dateMax) {
                    return true
                } else {
                    if (dateMin <= a && "" == dateMax) {
                        return true
                    } else {
                        if (dateMin <= a && a <= dateMax) {
                            return true
                        } else {
                            return false
                        }
                    }
                }
                return false
            }
        }
    });

    var datecolumn1 = 6;
    var startdate;
    var enddate;
    $("#reportrange1").daterangepicker({
        format: "DD/MM/YYYY"
    }, function(f, a, b) {
        var c = moment(f.toISOString());
        var d = moment(a.toISOString());
        startdate = c.format("YYYY-MM-DD");
        enddate = d.format("YYYY-MM-DD")
    });
    $("#reportrange1").on("apply.daterangepicker", function(b, a) {
        startdate = a.startDate.format("YYYY-MM-DD");
        enddate = a.endDate.format("YYYY-MM-DD");
        oTable1.fnDraw()
    });
    $.fn.dataTableExt.afnFiltering.push(function(f, c, b) {
        if (startdate != undefined) {
            var e = c[datecolumn1].split("/");
            var g = new Date(e[2], e[1] - 1, e[0]);
            var a = moment(g.toISOString());
            a = a.format("YYYY-MM-DD");
            dateMin = startdate.replace(/-/g, "");
            dateMax = enddate.replace(/-/g, "");
            a = a.replace(/-/g, "");
            if (dateMin == "" && a <= dateMax) {
                return true
            } else {
                if (dateMin == "" && a <= dateMax) {
                    return true
                } else {
                    if (dateMin <= a && "" == dateMax) {
                        return true
                    } else {
                        if (dateMin <= a && a <= dateMax) {
                            return true
                        } else {
                            return false
                        }
                    }
                }
                return false
            }
        }
    });

});