<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/lib/session.php");
Session::checkLogin();

include("$_SERVER[DOCUMENT_ROOT]/GTST/lib/database.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/helpers/format.php");


class admminLogin
{

    private $db;
    private $format;

    public function __construct()
    {
        $this->db = new Database();
        $this->format = new Format();
    }

    public function login($username, $password, $captcha)
    {
        $username = $this->format->validate($username);
        $password = $this->format->validate($password);

        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);

        $password = md5($password);

        $captchaCode = $_SESSION['captchaCode'];

        if (empty($username) | empty($password)) {
            $msg = "<span class='text-danger'>Username or password is not empty!</span>";
            return $msg;
        } elseif ($captcha !== $captchaCode) {
            $msg = "<span class='text-danger'>CAPTCHA verification failed!</span>";
            return $msg;

            // Clean up
            session_destroy();
        } else {
            $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";
            $result = $this->db->select($query);

            if ($result != false) {
                $value = $result->fetch_assoc();

                if ($value['idRole'] == 1) {
                    Session::set('login', true);
                    Session::set('idUser', $value['idUser']);
                    Session::set('idRole', $value['idRole']);
                    Session::set('name', $value['name']);
                    Session::set('email', $value['email']);
                    Session::set('avatar', $value['avatar']);
                    Session::set('phoneNumber', $value['phoneNumber']);
                    Session::set('password', $value['password']);

                    Session::set('start', time());
                    Session::set('expire', Session::get('start') + (60 * 30));


                    header('Location: index.php');
                } else {
                    $msg = "<span class='text-danger'>Username or password invalid!</span>";
                    return $msg;
                }
            } else {
                $msg = "<span class='text-danger'>Username or password invalid!</span>";
                return $msg;
            }
        }
    }
}
