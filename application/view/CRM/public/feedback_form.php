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
    <style>
        html, body {
            background: #333333;
        }
    </style>

    <body>
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
                        <img class="logo" src="<?php echo URL; ?>img/logo.jpg" title="Copyright <?php echo date('Y'); ?> JEJ CELLMANIA TRADING CORPORATION">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="header-links">
                    <ul class="nav navbar-nav">
                        <?php if (isset($_SESSION['admin_logged_in'])) { ?>
                            <li><a href="<?php echo URL; ?>admin">Go to ADMIN page</a></li>
                        <?php } ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a>Need Help/Support?</a></li>
                    </ul>
                </div>
            </div>
        </header>
        
        <div class="modal show" style="margin-top: 60px; overflow: auto;" id="contact" tabindex="-1" role="dialog" aria-labelledby="Contact">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4 class="modal-title">NEED HELP / SUPPORT?</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Contact us</h5><hr />
                                <?php foreach($sys_contact as $s) {
                                    echo $s->config_value . '<br />';
                                } ?>
                            </div>
                            <div class="col-md-8">
                                <h5>or Submit a Feedback</h5><hr />
                                <div class="alert alert-info">
                                    <strong>PLEASE NOTE: </strong> Feedbacks will be verified and consolidated when the feedback is considerable or the person exists as a customer to our MOBILIZER products and we will send an email with support ticket no. for reference.
                                </div>
                                <?php $this->renderFeedbackMessages(); ?>
                                <p>
                                <form action="<?php echo URL; ?>catalogue/support" method="POST">
                                    <fieldset>
                                        <div class="form-group col-md-12">
                                            <select class="form-control selectpicker" name="type" required="true">
                                                <option value="" disabled selected>How can we help you?</option>
                                                <option value="Complaint">I've seen something wrong with your products</option>
                                                <option value="Suggestion">I have a Suggestion</option>
                                                <option value="Others">Others (Please Specify in description field)</option>
                                            </select>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="form-group col-md-4 has-feedback">
                                                <select class="form-control selectpicker" name="priority" required="true">
                                                    <option value="2">High</option>
                                                    <option value="3" selected>Normal</option>
                                                    <option value="4">Low</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-8 has-feedback">
                                                <input type="text" class="form-control email" name="email" placeholder="Enter Your E-Mail Address" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>" required="required" />
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="form-group col-md-12 has-feedback"><br />
                                                <input type="text" class="form-control required" name="name" placeholder="Complete Name" value="<?php if(isset($_POST['name'])) {echo $_POST['name'];} ?>" min="10" />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" name="feedback_content" placeholder="What's Up? Write down details/description here." required><?php if(isset($_POST['feedback_content'])) {echo $_POST['feedback_content'];} ?></textarea><br />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input class="btn btn-primary btn-block submit" type="submit" name="set_feedback" value="DONE" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <a href=".." class="btn btn-danger btn-block submit">Cancel</a>
                                        </div>
                                    </fieldset>
                                </form>
                                </p>
                            </div>
                        </div>
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
            
            $(document).ready(function(){
                $("#submit_feed").click(function(){
                    var subject = $("#subject").val();
                    var invoice = $("#invoice").val();
                    var email = $("#email").val();
                 if (subject=='')
                 {
                     alert("The subject seems empty. Please check the details");
                 }
                 else if (email=='') {
                     alert("The email form seems empty. Please check your email");
                 }
                 else {
                     $.post("<?php echo URL . 'catalogue/action'; ?>", //Required URL of the page on server
                        { // Data Sending With Request To Server
                           user: vUserId,
                        },
                     function(response,status){ // Required Callback Function
                         $("#contact").html(response);//"response" receives - whatever written in echo of above PHP script.
                         $("#form")[0].reset();
                     });
                    }
                 });
            });
        </script>
        
    <!-- JS -->
    <script src="<?php echo URL; ?>assets_new/js/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/ajax.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/nod.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/validator.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/sorttable.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/bootstrap-table.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/bootstrap-table-en-US.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets_new/js/animate.js" type="text/javascript"></script>
    
    <style>
        body {display: block;}
    </style>
    <link href="<?php echo URL; ?>assets_new/css/animate.css" rel="stylesheet">

    <footer>
        
    </footer>
    
    </body>
</html>
