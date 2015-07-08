<!DOCTYPE html>
<html lang="en" onContextMenu="return false;" ondragstart="return false" onselectstart="return false">
<head>
    <meta charset="utf-8">
    <title>JEJ CPANEL</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- NEEDED CLASS -->
    <script src="<?php echo URL; ?>assets/js/jquery-1.11.1.min.js"></script>
    
    <!-- CSS -->
    <link href="<?php echo URL; ?>assets_new/css/normalize.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/animate.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/bootstrap-theme.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets_new/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>assets/css/picol.css" rel="stylesheet">
    
    <!-- JS -->
    <!--[if lt IE 9]>
        <script src="<?php echo URL; ?>assets/js/html5shiv.js"></script>
        <script src="<?php echo URL; ?>assets/js/respond.min.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
        <script src="<?php echo URL; ?>assets/js/html5shiv.js"></script>
        <script src="<?php echo URL; ?>assets/js/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo URL; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets/js/sorttable.js" type="text/javascript"></script>
</head>
<body style="background-color: #FFF;">

<div class="modal-header">
    <a id="form_submit" type="button" class="btn btn-default pull-right" href="<?php echo URL; ?>products">Cancel</a>
    <h4 class="modal-title" id="myModalLabel">Edit Product</h4>
    <?php if (!isset($products->category)) { ?>
        <?php echo '<div class="alert alert-success alert-dismissible" role="alert">'.CRUD_MISSING_ITEM.'</div>'?>
        <br /><br />
    <?php } ?>
</div>
<div class="modal-body">
    <form action="<?php echo URL; ?>products/update" method="POST" style="padding: 10px;" class="form-horizontal">
        <fieldset>  
            <div class="form-group">
                <label class="col-lg-3 control-label">Category</label>
                <div class="col-lg-9">
                    <select class="form-control selectpicker" id="select" name="category" required="true">
                        <option disabled selected hidden value="">Please select...</option>
                        <?php foreach ($categories as $category) { ?>
                            <option class="option" value="<?php echo $category->id;?>"><?php echo $category->name; ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="myselect" value="myselectedvalue" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">IMEI</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="IMEI" value="<?php echo htmlspecialchars($products->IMEI, ENT_QUOTES, 'UTF-8'); ?>" required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Manufacturer</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="manufacturer_name" value="<?php echo htmlspecialchars($products->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?>" required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Product Name</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="product_name" value="<?php echo htmlspecialchars($products->product_name, ENT_QUOTES, 'UTF-8'); ?>" required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Product Model</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="product_model" value="<?php echo htmlspecialchars($products->product_model, ENT_QUOTES, 'UTF-8'); ?>" placeholder="e.g. Model No. of Device" required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Price</label>
                <div class="col-lg-9">
                    <div class="input-group">
                        <span class="input-group-addon">PhP</span>
                        <input type="number" class="form-control" name="price" value="<?php echo htmlspecialchars($products->price, ENT_QUOTES, 'UTF-8'); ?>" placeholder="0" min="1" max="999999" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Link</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="link" <?php echo htmlspecialchars($products->link, ENT_QUOTES, 'UTF-8'); ?>" placeholder="http://" />
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($products->product_id, ENT_QUOTES, 'UTF-8'); ?>" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-9 col-lg-offset-3">
                    <input id="form_submit" class="btn btn-primary" type="submit" name="update_product" value="Save Changes" />
                </div>
            </div>
        </fieldset>
    </form>
</div>
<div class="modal-footer"></div>

