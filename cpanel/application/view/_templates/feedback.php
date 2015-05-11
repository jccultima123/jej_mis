<?php

// get the feedback (they are arrays, to make multiple positive/negative messages possible)
$feedback_positive = Session::get('feedback_positive');
$feedback_negative = Session::get('feedback_negative');

// echo out positive messages
if (isset($feedback_positive)) {
    foreach ($feedback_positive as $feedback) {
        echo '<div class="alert alert-success alert-dismissible" role="alert">'.$feedback.'<button class="close" aria-label="close" data-dismiss="alert" type="button"><span aria-hidden="true">x</span></button></div>';
    }
}

// echo out negative messages
if (isset($feedback_negative)) {
    foreach ($feedback_negative as $feedback) {
        echo '<div class="alert alert-warning alert-dismissible" role="alert">'.$feedback.'<button class="close" aria-label="close" data-dismiss="alert" type="button"><span aria-hidden="true">x</span></button></div>';
    }
}
