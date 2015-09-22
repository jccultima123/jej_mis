<?php

class CrmModel
{
    public function __construct($db)
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

    /**
     * Log out process, deletes cookie, deletes session
     */
    public function logout()
    {
        if (!isset($_SESSION['CRM_user_logged_in'])) {
            $_SESSION["feedback_positive"][] = FEEDBACK_INVALID_LOGOUT;
        } else {
            // delete the session
            Session::destroy();
            // init again for message
            Session::init();
            $_SESSION["feedback_positive"][] = FEEDBACK_LOGGED_OUT;
        }
    }
    
    public function getAllCustomers()
    {
        if (!isset($_SESSION['admin_logged_in'])) {
            $branch_id = $_SESSION['branch_id'];
            $sql = "SELECT * FROM tb_customers WHERE registered_branch = :branch_id ORDER BY registered_date DESC";
            $query = $this->db->prepare($sql);
            $query->execute(array(':branch_id' => $branch_id));
        } else {
            $sql = "SELECT * FROM tb_customers ORDER BY registered_date DESC";
            $query = $this->db->prepare($sql);
            $query->execute();
        }
        $fetch = $query->fetchAll();
        if (empty($fetch)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_NO_RECORDS;
            return false;
        } else {
            return $fetch;
        }
    }
    
    public function getAmountOfCustomers()
    {
        $sql = "SELECT COUNT(customer_id) AS amount_of_customers FROM tb_customers";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_customers;
    }
    
    public function countCustomers()
    {
        $sql = "SELECT COUNT(customer_id) AS customer_count FROM tb_customers";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->customers_count;
    }
    
    public function getAllFeedbacks()
    {
        if (!isset($_SESSION['admin_logged_in'])) {
            $branch_id = $_SESSION['branch_id'];
            $sql = "SELECT
                    tb_feedbacks.*,
                    priority,
                    tb_customers.*
                    FROM tb_feedbacks
                    LEFT JOIN priority on tb_feedbacks.feedback_priority = priority.id
                    LEFT JOIN tb_customers on tb_feedbacks.customer_id = tb_customers.customer_id
                    WHERE tb_customers.registered_branch = :branch_id
                    ORDER BY created OR modified DESC";
            $query = $this->db->prepare($sql);
            $query->execute(array(':branch_id' => $branch_id));
        } else {
            $sql = "SELECT
                    tb_feedbacks.*,
                    priority,
                    tb_customers.*
                    FROM tb_feedbacks
                    LEFT JOIN priority on tb_feedbacks.feedback_priority = priority.id
                    LEFT JOIN tb_customers on tb_feedbacks.customer_id = tb_customers.customer_id
                    ORDER BY created OR modified DESC";
            $query = $this->db->prepare($sql);
            $query->execute();
        }
        $fetch = $query->fetchAll();
        if (empty($fetch)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_NO_RECORDS;
            return false;
        } else {
            return $fetch;
        }
    }
    
    public function getFeedback($feedback_id)
    {
        // SET AS READ
        $s = "UPDATE tb_feedbacks SET unread = 0 WHERE feedback_id = :feedback_id";
        $q = $this->db->prepare($s);
        $p = array(':feedback_id' => $feedback_id);
        $q->execute($p);

        if (!isset($_SESSION['admin_logged_in'])) {
            $branch_id = $_SESSION['branch_id'];
            $sql = "SELECT
                    tb_feedbacks.*,
                    tb_feedbacks.email AS feedback_email,
                    priority,
                    tb_customers.*
                    FROM tb_feedbacks
                    LEFT JOIN priority on tb_feedbacks.feedback_priority = priority.id
                    LEFT JOIN tb_customers on tb_feedbacks.customer_id = tb_customers.customer_id
                    WHERE tb_customers.registered_branch = :branch_id AND tb_feedbacks.feedback_id = :feedback_id
                    ORDER BY created OR modified DESC";
            $query = $this->db->prepare($sql);
            $query->execute(array(':branch_id' => $branch_id, ':feedback_id' => $feedback_id));
        } else {
            $sql = "SELECT
                    tb_feedbacks.*,
                    tb_feedbacks.email AS feedback_email,
                    priority,
                    tb_customers.*
                    FROM tb_feedbacks
                    LEFT JOIN priority on tb_feedbacks.feedback_priority = priority.id
                    LEFT JOIN tb_customers on tb_feedbacks.customer_id = tb_customers.customer_id
                    WHERE tb_feedbacks.feedback_id = :feedback_id
                    ORDER BY created OR modified DESC";
            $query = $this->db->prepare($sql);
            $query->execute(array(':feedback_id' => $feedback_id));
        }
        
        $fetch = $query->fetch();
        if (empty($fetch)) {
            $_SESSION["feedback_negative"][] = CRUD_NOT_FOUND;
            return false;
        } else {
            return $fetch;
        }
    }
    
    public function getFeedbackHistory($feedback_id)
    {
        if (!isset($_SESSION['admin_logged_in'])) {
            $branch_id = $_SESSION['branch_id'];
            $sql = "SELECT
                    tb_fbhistory.*,
                    tb_feedbacks.*,
                    tb_feedbacks.email AS feedback_email,
                    priority,
                    tb_customers.*
                    FROM tb_fbhistory
                    LEFT JOIN tb_feedbacks on tb_fbhistory.feedback = tb_feedbacks.feedback_id
                    LEFT JOIN priority on tb_feedbacks.feedback_priority = priority.id
                    LEFT JOIN tb_customers on tb_feedbacks.customer_id = tb_customers.customer_id
                    WHERE tb_customers.registered_branch = :branch_id AND tb_feedbacks.feedback_id = :feedback_id
                    ORDER BY tb_fbhistory.timestamp DESC";
            $query = $this->db->prepare($sql);
            $query->execute(array(':branch_id' => $branch_id, ':feedback_id' => $feedback_id));
        } else {
            $sql = "SELECT
                    tb_fbhistory.*,
                    tb_feedbacks.*,
                    tb_feedbacks.email AS feedback_email,
                    priority,
                    tb_customers.*
                    FROM tb_fbhistory
                    LEFT JOIN tb_feedbacks on tb_fbhistory.feedback = tb_feedbacks.feedback_id
                    LEFT JOIN priority on tb_feedbacks.feedback_priority = priority.id
                    LEFT JOIN tb_customers on tb_feedbacks.customer_id = tb_customers.customer_id
                    WHERE tb_feedbacks.feedback_id = :feedback_id
                    ORDER BY tb_fbhistory.timestamp DESC";
            $query = $this->db->prepare($sql);
            $query->execute(array(':feedback_id' => $feedback_id));
        }
        
        $fetch = $query->fetchAll();
        if (!$fetch) {
            return false;
        } else {
            return $fetch;
        }
    }
    
    public function countFeedbacks()
    {
        $sql = "SELECT COUNT(feedback_id) AS feedback_count FROM tb_feedbacks";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->feedback_count;
    }
    
    public function countUnreadFeedbacks()
    {
        $sql = "SELECT COUNT(feedback_id) AS unread_feedback_count FROM tb_feedbacks WHERE unread = 1";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->unread_feedback_count;
    }

    public function deleteFeedback($id)
    {
        $sql = "DELETE FROM tb_feedbacks
                WHERE feedback_id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

        $_SESSION["feedback_positive"][] = CRUD_DELETE;
        return true;
    }
    
    public function replyFeedback($id, $subj, $message, $email) {
        $sql = "INSERT INTO tb_fbhistory (feedback, subject, text, timestamp, from_sys)
                VALUES (:id, :subject, :message, :timestamp, 1)";
        $query = $this->db->prepare($sql);
        $time = time();
        $parameters = array(
            ':id' => $id,
            ':subject' => $subj,
            ':message' => $message,
            ':timestamp' => $time
        );
        if ($query->execute($parameters)) {
            try {
                $sql1 = "UPDATE tb_feedbacks SET unread = 0, modified = :timestamp
                     WHERE feedback_id = :id";
                $q = $this->db->prepare($sql1);
                $parameters2 = array(
                    ':timestamp' => $time,
                    ':id' => $id
                );
                $q->execute($parameters2);
                //Send mail
                if (Auth::isInternetAvailible(CHECK_URL, 80) == true) {
                    $this->sendEmail($email, $id, $subj, $message, $time);
                    return true;
                }
                $_SESSION["feedback_positive"][] = CRUD_ADDED . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters) . '<br /><br />' . Helper::debugPDO($sql1, $parameters2));
            } catch (PDOException $e) {
                $_SESSION["feedback_negative"][] = "Can't sent. Please try again."  . Auth::detectDBEnv($e->getMessage() . '<br /><br />' . Helper::debugPDO($sql, $parameters) . '<br /><br />' . Helper::debugPDO($sql1, $parameters2));
                return false;
            }
        }
    }
    
        public function sendEmail($email, $id, $subj, $message, $time) {
            $mail = new PHPMailer;

            // enable HTML Content
            $mail->IsHTML(true);

            if (EMAIL_USE_SMTP) {
                $mail->IsSMTP();
                $mail->SMTPDebug = PHPMAILER_DEBUG_MODE;
                $mail->SMTPAuth = EMAIL_SMTP_AUTH;
                if (defined('EMAIL_SMTP_ENCRYPTION')) {
                    $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
                }
                // set SMTP provider's credentials
                $mail->Host = EMAIL_SMTP_HOST;
                $mail->Username = EMAIL_SMTP_USERNAME;
                $mail->Password = EMAIL_SMTP_PASSWORD;
                $mail->Port = EMAIL_SMTP_PORT;
            } else {
                $mail->IsMail();
            }

            // fill mail with data
            $mail->From = EMAIL_NOREPLY;
            $mail->FromName = EMAIL_OFFICIAL_SENDER;
            $mail->AddAddress($email);
            $mail->Subject = "JEJ // MOBILIZER - Feedback #" . $id . ". " . $subj;
            $mail->Body = '<html>
                            <body>
                                <img src=\"cid:logoimg" /><hr />
                                <p>We\'ve been reviewed your feedback, Here\'s the response from us: </p><br />' .
                                '<p>' . $message . '</p><br /><br />Processed ' . date(DATE_CUSTOM, $time) .
                            '</body>
                           </html>';
                // Must be after the body
                $mail->IsHTML(true);

            // final sending and check
            if($mail->Send()) {
                $_SESSION["feedback_positive"][] = "Message Sent.";
                return true;
            } else {
                $_SESSION["feedback_negative"][] = "Sending to Mail was Failed. Cause: " . $mail->ErrorInfo;
                return false;
            }
        }
    
    //CRUD for Customers
    public function addCustomer($customer_id, $customer_name, $email, $address, $branch) {
        $sql = "INSERT INTO tb_customers (customer_id, customer_name, email,
                address, registered_branch, registered_date)
                VALUES (:customer_id, :customer_name, :email,
                :address, :registered_branch, :registered_date)";
        $query = $this->db->prepare($sql);
        $parameters = array(':customer_id' => $customer_id,
            ':customer_name' => $customer_name,
            ':email' => $email,
            ':address' => $address,
            ':registered_branch' => $branch,
            ':registered_date' => time());
        if ($query->execute($parameters)) {
            $_SESSION["feedback_positive"][] = CRUD_ADDED . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
        } else {
            $_SESSION["feedback_negative"][] = CRUD_UNABLE_TO_ADD . Auth::detectDBEnv(Helper::debugPDO($sql, $parameters));
        }
    }
    
}
