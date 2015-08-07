initComplete: function () {
    this.api().columns().every( function () {
        var column = this;
        var select = $('<select class="form-control selectpicker show-tick" title="Filter this column" data-container="body" data-size="5" data-live-search="true"><option hidden value="" title="">None<option></select>')
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
}