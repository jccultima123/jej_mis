<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>MOBILIZER</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="THE BIG FIVE from Jose Rizal University">

        <link href="<?php echo URL; ?>assets_new/css/normalize.css" rel="stylesheet">
        <link href="<?php echo URL; ?>assets_new/css/public.css" rel="stylesheet">
        <link href="<?php echo URL; ?>assets_new/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo URL; ?>assets_new/css/bootstrap-social.css" rel="stylesheet">
        <link href="<?php echo URL; ?>assets_new/css/bootstrap-table.min.css" rel="stylesheet">
        <link href="<?php echo URL; ?>assets_new/css/picol.css" rel="stylesheet">
    </head>
    <!-- UI Background Set by Database -->
    <body style="background-image: url('img/_BG/<?php echo $ui->theme; ?>');">
        
        <header role="navigation" class="navbar navbar-default navbar-fixed-top" id="header">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-links" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo URL; ?>" style="padding: 5px;">
                        <img class="logo" src="img/logo.jpg" title="Copyright <?php echo date('Y'); ?> JEJ CELLMANIA TRADING CORPORATION">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="header-links">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo URL; ?>">Home</a></li>
                        <li><a data-toggle="modal" data-target="#list" href="javascript:void(0)">Products</a></li>
                        <li><a data-toggle="modal" data-target="#about" href="javascript:void(0)">About</a></li>
                        <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                            <li><a href="<?php echo URL; ?>admin">Go to ADMIN page</a></li>
                        <?php } ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo URL . 'catalogue/support'; ?>">Need Help/Support?</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="modal fade" id="list" tabindex="-1" role="dialog" aria-labelledby="Products">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="Products">Available Products</h4>
                    </div>
                    <div class="modal-body" id="prod">
                        <?php if (!empty($products)) { require VIEWS_PATH . 'CRM/public/products.php'; ?>
                            <div class="alert alert-info">
                                Please always Refresh the page to Get Latest Products<br />
                                Use your browser's search text to find your desired products
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-info">
                                COMING SOON!
                            </div>
                        <?php } ?>
                    </div>
                    <div class="modal-footer">
                        Is your chosen device available to your nearest MOBILIZER Stores? Please Contact Us!
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="About">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="About">About Us</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            MOBILIZER is an established retailer and wholesaler of Quality Mobile Phones and Accessories at competitive prices for the customers. The brands that were carried by JEJ Cellmania Trading Corporation
                            offer best quality and warranty assurance to the market for almost 14 years now.
                            <br /><br />
                            From its humble beginnings as a retailer of Cell phone accessories in Year 2000, Mr. James Francisco
                            the owner of JEJ Cellmania Trading Corporation has put up the business with just minimal capitalization and with 4 employees under him, after a successful year in the industry Nokia brand was also introduced to the market and this marked the beginning of the growing business of Telecommunication Industry. After 5 years in business following the footsteps of Nokia other emerging Cell phone brands had begun talking to Mr. James Francisco to carry their products, by Year 2008 – 2010, giant companies such as Samsung, LG, BlackBerry Sony had intensive campaign over their brand and since JEJ Cellmania Trading Corporation was already established the store branches gradually increased from just 2 branch in Greenhills Shopping Center it expanded to 7 Branches including prime locations in SM Supermalls. There has been continues development in the company especially in the quality of products and services offered in the customers.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript">
            $("#prod").ready(function(){
                refresh();
                function refresh() {
                    setTimeout(refresh, 3000);
                    $("#prod").load('<?php echo URL . 'catalogue/fetch/products'; ?>');
                };
            });
        </script>