
    <div class="container">
        <div class="table">
            <div class="row animated fadeInDownBig">
                <div class="col-md-4">
                    <div class="animated fadeInDownBig">
                        <?php $this->renderFeedbackMessages(); ?>
                    </div>
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