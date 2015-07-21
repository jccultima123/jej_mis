<div class="container padding-fix">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong style="line-height:26px;">Sales Out Report -- as of <?php echo date(DATE_CUSTOM); ?></strong><br />
            <strong>For <?php echo $_SESSION['branch']; ?></strong>
        </div>
        <div class="panel-body">
            <table class="table" id="full">
                <thead style="font-weight: bold;">
                    <tr>
                        <th style="cursor: pointer;">PRODUCT NO.</th>
                        <th style="cursor: pointer;">MANUFACTURER</th>
                        <th style="cursor: pointer;">PRODUCT</th>
                        <th style="cursor: pointer;">MODEL</th>
                        <th class="sorttable_nosort">INVENTORY</th>
                        <th class="sorttable_nosort">SELLOUT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sales as $sale) { ?>
                        <tr>
                            <td><?php if (isset($sale->product_id)) echo htmlspecialchars($sale->product_id, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($sale->manufacturer_name)) echo htmlspecialchars($sale->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($sale->product_name)) echo htmlspecialchars($sale->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($sale->product_model)) echo htmlspecialchars($sale->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($sale->inventory)) echo htmlspecialchars(number_format($sale->inventory), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($sale->sellout)) echo htmlspecialchars(number_format($sale->sellout), ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>