<script>
    var file = "<?php echo 'ASSET_QUICK_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>
<script type="text/javascript" src="<?php echo URL; ?>assets_new/js/_MIS/AMS.js"></script>

<div class="container padding-fix">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong style="line-height:26px;">Quick Full Asset Report -- as of <?php echo date(DATE_CUSTOM); ?></strong><br />
            <strong>For <?php echo $_SESSION['branch']; ?></strong>
        </div>
        <div class="panel-body">
            <table class="table" id="full">
                <thead style="font-weight: bold;">
                    <tr>
                        <th style="cursor: pointer;">ID</th>
                        <th style="cursor: pointer;">TYPE</th>
                        <th style="cursor: pointer;">ITEM</th>
                        <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                            <th style="cursor: pointer;">BRANCH</th>
                        <?php } ?>
                        <th class="sorttable_nosort"></th>
                        <th style="cursor: pointer;">PRICE</th>
                        <th style="cursor: pointer;">QTY</th>
                        <th class="sorttable_nosort"></th>
                        <th style="cursor: pointer;">SUBTOTAL</th>
                        <th class="sorttable_nosort">LATEST DATE</th>
                        <th class="sorttable_nosort">STATUS</th>
                    </tr>
                </thead>
                <tbody class="searchable">
                    <?php foreach ($assets as $asset) { ?>
                        <tr>
                            <td><?php if (isset($asset->asset_id)) echo htmlspecialchars($asset->asset_id, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($asset->type)) echo htmlspecialchars($asset->atype, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($asset->name)) echo htmlspecialchars($asset->name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                                <td><?php if (isset($asset->branch)) echo htmlspecialchars($asset->branch_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <?php } ?>
                            <td>₱</td>
                            <td><?php if (isset($asset->price)) echo htmlspecialchars(number_format($asset->price), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($asset->price)) echo htmlspecialchars($asset->qty, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>₱</td>
                            <td><?php if (isset($asset->qty)) echo htmlspecialchars(number_format($asset->price * $asset->qty), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($asset->timestamp)) echo htmlspecialchars(date(DATE_CUSTOM, $asset->timestamp), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php if (isset($asset->as_status)) echo htmlspecialchars($asset->status, ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>