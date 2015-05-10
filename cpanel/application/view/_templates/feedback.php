<?php

// get the feedback (they are arrays, to make multiple positive/negative messages possible)
$feedback_positive = Session::get('feedback_positive');
$feedback_negative = Session::get('feedback_negative');

// echo out positive messages
if (isset($feedback_positive)) {
    foreach ($feedback_positive as $feedback) {
        echo '<div id="feedback" class="panel panel-heading panel-success" style="border-width: 2px;">'.$feedback.'<a id="close" href=""><span class="glyphicon glyphicon-remove pull-right"></span></a></div>';
    }
}

// echo out negative messages
if (isset($feedback_negative)) {
    foreach ($feedback_negative as $feedback) {
        echo '<div id="feedback" class="panel panel-heading panel-danger" style="border-width: 2px;">'.$feedback.'<a id="close" href=""><span class="glyphicon glyphicon-remove pull-right"></span></a></div>';
    }
}
