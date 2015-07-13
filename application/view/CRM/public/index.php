
        <div class="modal fade" id="list" tabindex="-1" role="dialog" aria-labelledby="Products">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="Products">Products</h4>
                    </div>
                    <div class="modal-body" style="max-height: 400px; overflow-x: auto;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                AS OF <?php echo date(DATE_CUSTOM, $latest_prod_time); ?>
                                <span class="badge pull-right">
                                    Count: <?php echo $product_count; ?>
                                </span>
                            </div>
                            <table class="table table-bordered table-hover sortable" id="full">
                                <thead style="font-weight: bold;">
                                    <tr>
                                        <th style="cursor: pointer;">NO.</th>
                                        <th style="cursor: pointer;">CATEGORY</th>
                                        <th style="cursor: pointer;">MANUFACTURER</th>
                                        <th style="cursor: pointer;">PRODUCT</th>
                                        <th style="cursor: pointer;">MODEL</th>
                                        <th class="sorttable_nosort">SRP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product) { ?>
                                        <tr>
                                            <td><?php if (isset($product->product_id)) echo htmlspecialchars($product->product_id, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php if (isset($product->category)) echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php if (isset($product->manufacturer_name)) echo htmlspecialchars($product->manufacturer_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php if (isset($product->product_name)) echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php if (isset($product->product_model)) echo htmlspecialchars($product->product_model, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php if (isset($product->SRP)) echo htmlspecialchars(number_format($product->SRP), ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="panel-footer">
                                Is the device available to your nearest MOBILIZER Stores? Contact Us at Facebook!
                            </div>
                        </div>
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


    <div class="container">
        <?php $this->renderFeedbackMessages(); ?>
        <div class="table">
            <div class="row animated fadeInDownBig">
                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <!-- Default panel contents -->
                        <div class="panel-heading"><h5>Connect with us!</h5></div>                        
                        <ul class="list-group">
                            <a class="list-group-item" href="https://www.facebook.com/MobilizerSMofficial" target="_blank">
                                Facebook<span class="pull-right"><i class="fa fa-facebook"></i></span>
                            </a>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default" id="carousel">
                        
                        <div id="image-slide" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#image-slide" data-slide-to="0" class="active"></li>
                                <li data-target="#image-slide" data-slide-to="1"></li>
                                <li data-target="#image-slide" data-slide-to="2"></li>
                                <li data-target="#image-slide" data-slide-to="3"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <center>
                                        <img id="slide" src="img/slides/0.jpg" alt="">
                                    </center>
                                </div>
                                <div class="item">
                                    <center>
                                        <img id="slide" src="img/slides/1.jpg" alt="">
                                    </center>
                                </div>
                                <div class="item">
                                    <center>
                                        <img id="slide" src="img/slides/2.jpg" alt="">
                                    </center>
                                </div>
                                <div class="item">
                                    <center>
                                        <img id="slide" src="img/slides/3.jpg" alt="">
                                    </center>
                                </div>
                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#image-slide" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#image-slide" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>