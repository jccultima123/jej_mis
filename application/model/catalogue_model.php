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
    
    function setFeedback($feedback_id, $type, $priority, $name, $email, $content)
    {
        $q1 = $this->db->prepare(
                    "SELECT tb_feedbacks.*
                     FROM tb_feedbacks
                     WHERE tb_feedbacks.email = :email AND unread = 1
                     GROUP BY tb_feedbacks.customer_id"
                );
        $q1->execute(array(
                    ':email' => $email
                    ));
        $count =  $q1->rowCount();
        if ($count > 3) {
            $_SESSION["feedback_negative"][] = "You have been at the maximum limit (more than 3). Please wait until the system read your feedback.";
            return false;
        }

        $q = $this->db->prepare(
                    "SELECT *, COUNT(*) FROM tb_customers
                     WHERE (customer_name = :name)"
                    );
        $q->execute(array(
                    ':name' => $name
                    ));
        $q->fetch();
        if ($q->rowCount() > 0) {
            $customer_id = $q->customer_id;
        }

        /*
        switch ($type) {
            case 'Complaint':
                $priority = 2; // HIGH
                break;
            case 'Suggestion':
                $priority = 3; // NORMAL
                break;
            case 'Others':
                $priority = 3; // OTHERS
                break;
            default:
                $_SESSION["feedback_negative"][] = CRUD_UNABLE_TO_ADD;
                return false;
        }
        */
        
        $sql = "INSERT INTO tb_feedbacks (feedback_id, type, feedback_priority, customer_id, name, email, feedback_text, created)
                VALUES (:feedback_id, :type, :feedback_priority, :customer_id, :name, :email, :feedback_text, :created)";
        $query = $this->db->prepare($sql);
        $time = time();
        $parameters = array(':feedback_id' => $feedback_id,
                            ':type' => $type,
                            'feedback_priority' => $priority,
                            ':customer_id' => $customer_id,
                            ':name' => $name,
                            ':email' => $email,
                            ':feedback_text' => $content,
                            ':created' => $time);
        if ($query->execute($parameters)) {
            if (isset($email) OR !empty($email)) {
                $this->sendFeedbackInvoice($feedback_id, $type, $priority, $email, $content, $time);
            } else {
                $_SESSION["feedback_positive"][] = 'Ow, snap! Something happened bad with your Email. Please try again.';
                return false;
            }
            $_SESSION["feedback_positive"][] = 'Thank you for your SUPPORT!';
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
    public function sendFeedbackInvoice($feedback_id, $type, $priority, $email, $content, $time)
    {
        // create PHPMailer object here. This is easily possible as we auto-load the according class(es) via composer
        $mail = new PHPMailer;

        // enable HTML Content
        $mail->IsHTML(true);

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
        $mail->Subject = "JEJ // MOBILIZER - Here's your ticket #" . $feedback_id;
        $mail->AddEmbeddedImage(URL . 'img/logo.jpg', 'logoimg', 'logo.jpg');
        $mail->Body = '<html>
                        <body>
                            <img src=\"cid:logoimg" /><hr />
                            <h4>Feedback # ' . $feedback_id . '</h4>
                            <strong>' . date(DATE_CUSTOM, $time) . '</strong><br />
                            <ul>
                                <li>Type: ' . $type . '</li>
                                <li>Priority Code: ' . $priority . '</li>
                                <li>Content: <p style=\"width: 250px;\">' . $content . '</p></li>
                            </ul>
                            Please keep this feedback/ticket no. (' . $feedback_id . ') for any reference
                            required.
                        </body>
                       </html>';

        // send the mail
        $mail->Send();
    }
    
    public function validate($feedback_id)
    {
        $sql = "UPDATE tb_feedbacks SET valid = 1, unread = 0, modified = :timestamp WHERE feedback_id = :feedback_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':timestamp' => time(), ':feedback_id' => $feedback_id);

        $query->execute($parameters);
        $_SESSION["feedback_positive"][] = "Feedback #" . $feedback_id . " was Validated";
    }
}

