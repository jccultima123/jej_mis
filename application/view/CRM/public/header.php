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
    <body>
        
        <header role="navigation" class="navbar navbar-default navbar-fixed-top animated fadeInDown" id="header">
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
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a data-toggle="modal" data-target="#contact" href="javascript:void(0)">Need Help/Support?</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="modal fade" id="list" tabindex="-1" role="dialog" aria-labelledby="Products">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="Products">Products</h4>
                    </div>
                    <div class="modal-body" id="prod">
                        <?php require VIEWS_PATH . 'CRM/public/products.php'; ?>
                        <div class="alert alert-info">
                            Please always Refresh the page to Get Latest Products
                        </div>
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
        
        <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="Contact">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="Contact">Contact Us</h4>
                        <strong>How can we help you?</strong><br />
                        Hate waiting? You may Call 00932132<br /><br />
                        <div class="alert alert-info">
                            <strong>PLEASE NOTE: </strong> We will send you a email with feedback ticket no. for reference.
                        </div>
                    </div>
                    <div class="modal-body">
                        <p>
                            <form action="<?php echo URL . 'catalogue/action' ?>" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control uppercase required" name="first_name" placeholder="First Name" required />
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control uppercase required" name="last_name" placeholder="Last Name" required />
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control uppercase" name="middle_name" placeholder="Middle Name" />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 has-feedback"><br />
                                        <input type="text" class="form-control email required" name="email" placeholder="Your EMAIL Address" />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" name="feedback_content" placeholder="What's Up?" required></textarea><br />
                                        <input class="btn btn-default btn-block submit" type="submit" name="set_feedback" value="DONE" />
                                    </div>
                                </fieldset>
                            </form>
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