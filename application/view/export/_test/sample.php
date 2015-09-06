<div class="container padding-fix">
    <div class="panel panel-default no-border-print">
        <div class="panel-heading">
            <strong style="line-height:26px;">Quick Order Report</strong><br />
            Generated at <?php echo $_SESSION['branch']; ?>
            <span class="pull-right">
                <strong><?php echo date(DATE_CUSTOM); ?></strong><br />
            </span>
        </div>
        <div class="panel-body">
            <?php if (!empty($orders)) { ?>
                <div>
                    <hr /><h5>QUICK ORDER TABLE</h5>
                    <!-- Filter dates -->
                    <div id="external_filter_container_wrapper">
                        <label>External filter for "Numbers" column :</label>
                        <div id="external_filter_container"></div>
                    </div><br />
                    <table class="table-striped tb-compact" id="example">
                        <thead>
                        <tr>
                            <th>BRAND</th>
                            <th>PRODUCT</th>
                            <th>STK</th>
                            <th>DP</th>
                            <th>SRP</th>
                            <th>PROCESSED</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $order) { ?>
                            <tr>
                                <td><?php if (isset($order->product_id)) echo htmlspecialchars($order->brand, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($order->product_id)) echo htmlspecialchars($order->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($order->order_stocks)) echo htmlspecialchars($order->order_stocks, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($order->DP)) echo 'PhP ' . htmlspecialchars(number_format($order->DP), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($order->SRP)) echo 'PhP ' . htmlspecialchars(number_format($order->SRP), ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php if (isset($order->order_date)) echo date(DATE_MMDDYY_C, $order->order_date) . ' / ' . date("D", $order->order_date); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <br />
                <div class="hidden-print">
                    <select class="selectpicker pull-right" data-style="btn-danger" data-width="120" onchange="doExport('#full',{type: this.options[this.selectedIndex].value});" data-container="body">
                        <option selected data-icon="glyphicon glyphicon-book"> &nbsp;Export</option>
                        <option value="csv" data-icon="">CSV</option>
                        <option value="excel" data-icon="">Excel</option>
                        <option value="pdf" data-icon="">PDF</option>
                    </select>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

    <script>
        $(document).ready(function(){
            $('#example').dataTable().yadcf([
                {column_number : 0},
                {column_number : 1},
                {column_number : 2},
                {column_number : 3, text_data_delimiter: ",", filter_type: "auto_complete"},
                {column_number : 4, column_data_type: "html", html_data_type: "text", filter_default_label: "Select tag"},
                {column_number : 5,  filter_type: "range_date", filter_container_id: "external_filter_container"}
            ]);
        });
    </script>

</div>
