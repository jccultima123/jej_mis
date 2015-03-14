<?php

class Model
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get all songs from database
     */
    public function getAllSongs()
    {
        $sql = "SELECT id, artist, track, link FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    /**
     * Get all products and categories
     */
    public function getAllProducts()
    {
        $sql = "SELECT product_id, category, SKU, product_name, product_model, manufacturer_name, release_date, price, link FROM tb_products";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
        return $query->fetchAll();
    }
    
    public function getCategories() {
        $sql = "SELECT * FROM tb_categories";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }

    /**
     * Add a song to database
     * TODO put this explanation into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     */
    public function addSong($artist, $track, $link)
    {
        $sql = "INSERT INTO song (artist, track, link) VALUES (:artist, :track, :link)";
        $query = $this->db->prepare($sql);
        $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }
    
    public function addProduct($category, $SKU, $product_name, $product_model, $manufacturer_name, $price, $link)
    {
        $sql = "INSERT INTO tb_products (category, SKU, product_name, product_model, manufacturer_name, price, link) VALUES (:category, :SKU, :product_name, :product_model, :manufacturer_name, :price, :link)";
        $query = $this->db->prepare($sql);
        $parameters = array(':category' => $category, ':SKU' => $SKU, ':product_name' => $product_name, ':product_model' => $product_model, ':manufacturer_name' => $manufacturer_name, ':price' => $price, ':link' => $link);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Delete a song in the database
     * Please note: this is just an example! In a real application you would not simply let everybody
     * add/update/delete stuff!
     * @param int $song_id Id of song
     */
    public function deleteSong($song_id)
    {
        $sql = "DELETE FROM song WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get a song from database
     */
    public function getSong($song_id)
    {
        $sql = "SELECT id, artist, track, link FROM song WHERE id = :song_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }
    
    public function getProduct($product_id)
    {
        $sql = "SELECT product_id, category, SKU, product_name, product_model, manufacturer_name, release_date, price FROM tb_products WHERE product_id = :product_id LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':product_id' => $product_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Update a song in database
     * // TODO put this explaination into readme and remove it from here
     * Please note that it's not necessary to "clean" our input in any way. With PDO all input is escaped properly
     * automatically. We also don't use strip_tags() etc. here so we keep the input 100% original (so it's possible
     * to save HTML and JS to the database, which is a valid use case). Data will only be cleaned when putting it out
     * in the views (see the views for more info).
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     * @param int $song_id Id
     */
    public function updateSong($artist, $track, $link, $song_id)
    {
        $sql = "UPDATE song SET artist = :artist, track = :track, link = :link WHERE id = :song_id";
        $query = $this->db->prepare($sql);
        $parameters = array(':artist' => $artist, ':track' => $track, ':link' => $link, ':song_id' => $song_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Get simple "stats". This is just a simple demo to show
     * how to use more than one model in a controller (see application/controller/songs.php for more)
     */
    public function getAmountOfSongs()
    {
        $sql = "SELECT COUNT(id) AS amount_of_songs FROM song";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_songs;
    }
    
    public function getAmountOfProducts()
    {
        $sql = "SELECT COUNT(product_id) AS amount_of_products FROM tb_products";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch()->amount_of_products;
    }
    
    //GET MYSQL VERSION
    public function getMySqlVersion()
    {
        $sql = "SELECT @@VERSION";
        $query = $this->db->prepare($sql);
        $query->execute();

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }
    
    //SORTING RELEASE DATES
    public function sortDate()
    {
        $sql = "SELECT product_id, categor, SKU, product_name, product_model, manufacturer_name, release_date, price, link FROM tb_products ORDER BY release_date";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll();
    }
    
    // **************************************************************************************
    
    /**
     * Login process (for DEFAULT user accounts).
     *
     * @param $user_name string The user's name
     * @param $user_password string The user's password
     * @param $set_remember_me_cookie mixed Marker for usage of remember-me cookie feature
     *
     * @return bool success state
     */
    public static function login($user_name, $user_password, $set_remember_me_cookie = null)
    {
        // we do negative-first checks here, for simplicity empty username and empty password in one line
        if (empty($user_name) OR empty($user_password)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_OR_PASSWORD_FIELD_EMPTY'));
            return false;
        }

        // get all data of that user (to later check if password and password_hash fit)
        $result = UserModel::getUserDataByUsername($user_name);

        // Check if that user exists. We don't give back a cause in the feedback to avoid giving an attacker details.
        if (!$result) {
            Session::add('feedback_negative', Text::get('FEEDBACK_LOGIN_FAILED'));
            return false;
        }

        // block login attempt if somebody has already failed 3 times and the last login attempt is less than 30sec ago
        if (($result->user_failed_logins >= 3) AND ($result->user_last_failed_login > (time() - 30))) {
            Session::add('feedback_negative', Text::get('FEEDBACK_PASSWORD_WRONG_3_TIMES'));
            return false;
        }

        // if hash of provided password does NOT match the hash in the database: +1 failed-login counter
        if (!password_verify($user_password, $result->user_password_hash)) {
            LoginModel::incrementFailedLoginCounterOfUser($user_name);
            // we say "password wrong" here, but less details like "login failed" would be better (= less information)
            Session::add('feedback_negative', Text::get('FEEDBACK_PASSWORD_WRONG'));
            return false;
        }

        // from here we assume that the password hash fits the database password hash, as password_verify() was true

        // if user is not active (= has not verified account by verification mail)
        if ($result->user_active != 1) {
            Session::add('feedback_negative', Text::get('FEEDBACK_ACCOUNT_NOT_ACTIVATED_YET'));
            return false;
        }

        // reset the failed login counter for that user (if necessary)
        if ($result->user_last_failed_login > 0) {
            LoginModel::resetFailedLoginCounterOfUser($user_name);
        }

        // save timestamp of this login in the database line of that user
        LoginModel::saveTimestampOfLoginOfUser($user_name);

        // if user has checked the "remember me" checkbox, then write token into database and into cookie
        if ($set_remember_me_cookie) {
            LoginModel::setRememberMeInDatabaseAndCookie($result->user_id);
        }

        // successfully logged in, so we write all necessary data into the session and set "user_logged_in" to true
        LoginModel::setSuccessfulLoginIntoSession(
            $result->user_id, $result->user_name, $result->user_email, $result->user_account_type
        );

        // return true to make clear the login was successful
        // maybe do this in dependence of setSuccessfulLoginIntoSession ?
        return true;
    }

    /**
     * performs the login via cookie (for DEFAULT user account, FACEBOOK-accounts are handled differently)
     * TODO add throttling here ?
     *
     * @param $cookie string The cookie "remember_me"
     *
     * @return bool success state
     */
    public static function loginWithCookie($cookie)
    {
        // do we have a cookie ?
        if (!$cookie) {
            Session::add('feedback_negative', Text::get('FEEDBACK_COOKIE_INVALID'));
            return false;
        }

        // check cookie's contents, check if cookie contents belong together
        list ($user_id, $token, $hash) = explode(':', $cookie);
        if ($hash !== hash('sha256', $user_id . ':' . $token)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_COOKIE_INVALID'));
            return false;
        }

        // do not log in when token is empty
        if (empty($token)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_COOKIE_INVALID'));
            return false;
        }

        // get data of user that has this id and this token
        $result = UserModel::getUserDataByUserIdAndToken($user_id, $token);

        // if user with that id and exactly that cookie token exists in database
        if ($result) {
            // successfully logged in, so we write all necessary data into the session and set "user_logged_in" to true
            LoginModel::setSuccessfulLoginIntoSession(
                $result->user_id, $result->user_name, $result->user_email, $result->user_account_type
            );
            // save timestamp of this login in the database line of that user
            LoginModel::saveTimestampOfLoginOfUser($result->user_name);

            // NOTE: we don't set another remember_me-cookie here as the current cookie should always
            // be invalid after a certain amount of time, so the user has to login with username/password
            // again from time to time. This is good and safe ! ;)

            Session::add('feedback_positive', Text::get('FEEDBACK_COOKIE_LOGIN_SUCCESSFUL'));
            return true;
        } else {
            Session::add('feedback_negative', Text::get('FEEDBACK_COOKIE_INVALID'));
            return false;
        }
    }

    /**
     * Log out process: delete cookie, delete session
     */
    public static function logout()
    {
        LoginModel::deleteCookie();
        Session::destroy();
    }

    /**
     * The real login process: The user's data is written into the session.
     * Cheesy name, maybe rename. Also maybe refactoring this, using an array.
     *
     * @param $user_id
     * @param $user_name
     * @param $user_email
     * @param $user_account_type
     */
    public static function setSuccessfulLoginIntoSession($user_id, $user_name, $user_email, $user_account_type)
    {
        Session::init();
        Session::set('user_id', $user_id);
        Session::set('user_name', $user_name);
        Session::set('user_email', $user_email);
        Session::set('user_account_type', $user_account_type);
        Session::set('user_provider_type', 'DEFAULT');

        // get and set avatars
        Session::set('user_avatar_file', AvatarModel::getPublicUserAvatarFilePathByUserId($user_id));
        Session::set('user_gravatar_image_url', AvatarModel::getGravatarLinkByEmail($user_email));

        // finally, set user as logged-in
        Session::set('user_logged_in', true);
    }

    /**
     * Increments the failed-login counter of a user
     *
     * @param $user_name
     */
    public static function incrementFailedLoginCounterOfUser($user_name)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE users
                   SET user_failed_logins = user_failed_logins+1, user_last_failed_login = :user_last_failed_login
                 WHERE user_name = :user_name OR user_email = :user_name
                 LIMIT 1";
        $sth = $database->prepare($sql);
        $sth->execute(array(':user_name' => $user_name, ':user_last_failed_login' => time() ));
    }

    /**
     * Resets the failed-login counter of a user back to 0
     *
     * @param $user_name
     */
    public static function resetFailedLoginCounterOfUser($user_name)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE users
                   SET user_failed_logins = 0, user_last_failed_login = NULL
                 WHERE user_name = :user_name AND user_failed_logins != 0
                 LIMIT 1";
        $sth = $database->prepare($sql);
        $sth->execute(array(':user_name' => $user_name));
    }

    /**
     * Write timestamp of this login into database (we only write a "real" login via login form into the database,
     * not the session-login on every page request
     *
     * @param $user_name
     */
    public static function saveTimestampOfLoginOfUser($user_name)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE users SET user_last_login_timestamp = :user_last_login_timestamp
                WHERE user_name = :user_name LIMIT 1";
        $sth = $database->prepare($sql);
        $sth->execute(array(':user_name' => $user_name, ':user_last_login_timestamp' => time()));
    }

    /**
     * Write remember-me token into database and into cookie
     * Maybe splitting this into database and cookie part ?
     *
     * @param $user_id
     */
    public static function setRememberMeInDatabaseAndCookie($user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        // generate 64 char random string
        $random_token_string = hash('sha256', mt_rand());

        // write that token into database
        $sql = "UPDATE users SET user_remember_me_token = :user_remember_me_token WHERE user_id = :user_id LIMIT 1";
        $sth = $database->prepare($sql);
        $sth->execute(array(':user_remember_me_token' => $random_token_string, ':user_id' => $user_id));

        // generate cookie string that consists of user id, random string and combined hash of both
        $cookie_string_first_part = $user_id . ':' . $random_token_string;
        $cookie_string_hash = hash('sha256', $cookie_string_first_part);
        $cookie_string = $cookie_string_first_part . ':' . $cookie_string_hash;

        // set cookie
        setcookie('remember_me', $cookie_string, time() + Config::get('COOKIE_RUNTIME'), Config::get('COOKIE_PATH'));
    }

    /**
     * Deletes the cookie
     * It's necessary to split deleteCookie() and logout() as cookies are deleted without logging out too!
     * Sets the remember-me-cookie to ten years ago (3600sec * 24 hours * 365 days * 10).
     * that's obviously the best practice to kill a cookie @see http://stackoverflow.com/a/686166/1114320
     */
    public static function deleteCookie()
    {
        setcookie('remember_me', false, time() - (3600 * 24 * 3650), Config::get('COOKIE_PATH'));
    }

    /**
     * Returns the current state of the user's login
     *
     * @return bool user's login status
     */
    public static function isUserLoggedIn()
    {
        return Session::userIsLoggedIn();
    }
    
}
