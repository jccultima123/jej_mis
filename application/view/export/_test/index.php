<div class="container padding-fix">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong style="line-height:26px;">Report -- <?php echo date(DATE_CUSTOM); ?></strong>
        </div>
        <div class="panel-body">
            <table class="table-striped tb-compact" id="tabletest">
                <thead>
                <tr>
                    <th>BRANCH</th>
                    <th>TYPE</th>
                    <th>ITEM</th>
                    <th>QTY</th>
                    <th>PRICE</th>
                    <th>TOTAL AMT.</th>
                    <th>LATEST DATE</th>
                </tr>
                </thead>

                <thead>
                <tr>
                    <td><input type="text" id="0"  class="employee-search-input"></td>
                    <td><input type="text" id="1" class="employee-search-input"></td>
                    <td><input type="text" id="2" class="employee-search-input" ></td>
                    <td><input type="text" id="3" class="employee-search-input" ></td>
                    <td><input type="text" id="4" class="employee-search-input" ></td>
                    <td><input type="text" id="5" class="employee-search-input" ></td>
                    <td valign="middle"><input  readonly="readonly" type="text" id="6" class="employee-search-input datepicker"></td>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>MOBILIZER SAN LAZARO</td>
                    <td>INTERIORS</td>
                    <td>COB TABLE</td>
                    <td>1</td>
                    <td>1,200</td>
                    <td>1,200</td>
                    <td>29/08/2015</td>
                </tr>
                <tr>
                    <td>MOBILIZER GREENHILLS</td>
                    <td>SUPPLIES</td>
                    <td>PANDA BALLPEN CLASSIC</td>
                    <td>2</td>
                    <td>80</td>
                    <td>160</td>
                    <td>12/08/2015</td>
                </tr>
                <tr>
                    <td>MOBILIZER GREENHILLS</td>
                    <td>EQUIPMENT</td>
                    <td>GLASS TABLE</td>
                    <td>1</td>
                    <td>120</td>
                    <td>120</td>
                    <td>12/08/2015</td>
                </tr>
                </tbody>
                <tfoot>
                <th>BRANCH</th>
                <th>TYPE</th>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
    var dataTable =  $('#tabletest').DataTable( {
        processing: true
    } );

    $('.employee-search-input').on( 'keyup click change', function () {
        var i=$(this).attr('id');  // getting column index
        var v=$(this).val();  // getting search input value
        dataTable.columns(i).search(v).draw();
    } );

    $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd",
        showOn: "button",
        showAnim: 'slideDown',
        showButtonPanel: true ,
        autoSize: true,
        buttonImage: "//jqueryui.com/resources/demos/datepicker/images/calendar.gif",
        buttonImageOnly: true,
        buttonText: "Select date",
        closeText: "Clear"
    });
    $(document).on("click", ".ui-datepicker-close", function(){
        $('.datepicker').val("");
        dataTable.columns(5).search("").draw();
    });
</script>