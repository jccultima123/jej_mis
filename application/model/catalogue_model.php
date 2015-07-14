<?php

class CatalogueModel
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            Auth::detectEnvironment();
            $ERROR = "The database was either unable to connect or doesn't exists.<hr /><b>DEBUG:</b> " . $e . "<hr />";
            require_once '_fb/error.html';
            exit();
        }
    }
    
    function setFeedback($feedback_id, $first, $last, $middle, $email, $content)
    {
        $q1 = $this->db->prepare("SELECT * FROM tb_feedbacks WHERE email = :email");
        $q1->execute(array(':email' => $email));
        $count =  $q1->rowCount();
        if ($count > 3) {
            $_SESSION["feedback_negative"][] = "You've been at the maximum limit of feedbacks. Please wait until the System response your feedback." . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
            return false;
        }
        
        $sql = "INSERT INTO tb_feedbacks (feedback_id, first_name, last_name, middle_name, email, feedback_text, created)
                            VALUES (:feedback_id, :first_name, :last_name, :middle_name, :email, :feedback_text, :created)";
        $query = $this->db->prepare($sql);
        $parameters = array('feedback_id' => $feedback_id, 'first_name' => $first, 'last_name' => $last, 'middle_name' => $middle, 'email' => $email, ':feedback_text' => $content, ':created' => time());

        if ($query->execute($parameters)) {
            // send verification email, if verification email sending failed: sends to administrator instead
            if (Auth::isInternetAvailible(CHECK_URL, 80) == true) {
                $this->sendFeedbackInvoice($feedback_id, $email);
                return true;
            } else {
                $_SESSION["feedback_positive"][] = 'Something happened bad in our Email Service. But we hear your thoughts for us and ';
            }
            $_SESSION["feedback_positive"][] = 'Feedback was Sent! Thank you for your LOVE';
            return true;
        } else {
            $_SESSION["feedback_negative"][] = CRUD_UNABLE_TO_ADD;
            return false;
        }
    }
    
    /**
     * send the password reset mail
     * @param string $user_name username
     * @param string $user_password_reset_hash password reset hash
     * @param string $user_email user email
     * @return bool success status
     */
    public function sendFeedbackInvoice($feedback_no, $email)
    {
        // create PHPMailer object here. This is easily possible as we auto-load the according class(es) via composer
        $mail = new PHPMailer;

        // please look into the config/config.php for much more info on how to use this!
        if (EMAIL_USE_SMTP) {
            // Set mailer to use SMTP
            $mail->IsSMTP();
            //useful for debugging, shows full SMTP errors, config this in config/config.php
            $mail->SMTPDebug = PHPMAILER_DEBUG_MODE;
            // Enable SMTP authentication
            $mail->SMTPAuth = EMAIL_SMTP_AUTH;
            // Enable encryption, usually SSL/TLS
            if (defined('EMAIL_SMTP_ENCRYPTION')) {
                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
            }
            // Specify host server
            $mail->Host = EMAIL_SMTP_HOST;
            $mail->Username = EMAIL_SMTP_USERNAME;
            $mail->Password = EMAIL_SMTP_PASSWORD;
            $mail->Port = EMAIL_SMTP_PORT;
        } else {
            $mail->IsMail();
        }

        // build the email
        $mail->From = EMAIL_NOREPLY;
        $mail->FromName = EMAIL_PASSWORD_RESET_FROM_NAME;
        $mail->AddAddress($email);
        $mail->Subject = "We've been listening from your heart.";
        $mail->Body = 'Please keep this feedback ticket no. (' . $feedback_no . ') in any case of something happening bad.';

        // send the mail
        $mail->Send();
    }
}

