<?php

// get the feedback (they are arrays, to make multiple positive/negative messages possible)
$feedback_positive = Session::get('feedback_positive');
$feedback_negative = Session::get('feedback_negative');
$feedback_note = Session::get('feedback_note');

// echo out positive messages
if (isset($feedback_positive)) {
    echo '<div class="alert bg-success alert-dismissible" role="alert"><button class="close" aria-label="close" data-dismiss="alert" type="button"><span aria-hidden="true">x</span></button>';
        echo '<ul class="list-unstyled"><span class="glyphicon glyphicon-ok">&nbsp;</span><strong>SUCCESS</strong><br /><br />';
            foreach ($feedback_positive as $feedback) {echo '<li>' . $feedback . '</li>';}
        echo '</ul>';
    echo '</div>';
}

// echo out negative messages
else if (isset($feedback_negative)) {
    echo '<div class="alert bg-danger alert-dismissible" role="alert"><button class="close" aria-label="close" data-dismiss="alert" type="button"><span aria-hidden="true">x</span></button>';
        echo '<ul class="list-unstyled"><span class="glyphicon glyphicon-remove">&nbsp;</span><strong>OOPS</strong><br /><br />';
            foreach ($feedback_negative as $feedback) {echo '<li>' . $feedback . '</li>';}
        echo '</ul>';
    echo '</div>';
}

else if (isset($feedback_note)) {
    echo '<div class="alert bg-success alert-dismissible" role="alert"><button class="close" aria-label="close" data-dismiss="alert" type="button"><span aria-hidden="true">x</span></button>';
        echo '<ul class="list-unstyled"><span class="glyphicon glyphicon-exclamation-sign">&nbsp;</span><strong>NOTE</strong><br /><br />';
            foreach ($feedback_note as $feedback) {echo '<li>' . $feedback . '</li>';}
        echo '</ul>';
    echo '</div>';
}