<script>
    var file = "<?php echo 'AUDIT_TRAIL_REPORT_' . strtoupper(date(DATE_FOR_EXPORT, time())); ?>";
</script>
<script type="text/javascript" src="<?php echo URL; ?>assets_new/js/_MIS/AUDIT.js"></script>

<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="btn-group-sm pull-right">
                <select class="selectpicker pull-right" data-style="btn-danger btn-sm" data-width="120" onchange="doExport('#au',{type: this.options[this.selectedIndex].value});" data-container="body" title="Export">
                    <option title="Export">Select Format</option>
                    <option value="csv" data-icon="">CSV</option>
                    <option value="excel" data-icon="">Excel</option>
                    <option value="pdf" data-icon="">PDF</option>
                </select>
            </div>
            <h4>Audit Trail</h4>
        </div>
        <div class="panel-body padding-fix">
            <div class="table">
                <div class="row">
                    <div class="col-md-12">
                        <br />
                        <?php $this->renderFeedbackMessages(); ?>
                        <?php if (!empty($au)) { ?>
                            <div class="row-fluid table-responsive">
                                <table class="table table-striped" id="au">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>TYPE</th>
                                            <th>MESSAGE</th>
                                            <th>USER DETAILS</th>
                                            <th>IP SRC</th>
                                            <th>USER AGENT</th>
                                            <th>DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($au as $a) { ?>
                                            <tr>
                                                <td><?php if (isset($a->id)) echo htmlspecialchars($a->id, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($a->id)) echo htmlspecialchars($a->type, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($a->id)) echo htmlspecialchars($a->description, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($a->user) AND isset($a->branch)) echo htmlspecialchars('User "' .$a->user . '" from ', ENT_QUOTES, 'UTF-8') . $a->branch; else echo 'NONE' ?></td>
                                                <td><?php if (isset($a->ip_address)) echo htmlspecialchars($a->ip_address, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($a->UA)) echo htmlspecialchars($a->UA, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php if (isset($a->id)) echo htmlspecialchars(date(DATE_CUSTOM, $a->date), ENT_QUOTES, 'UTF-8'); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
</div>             
