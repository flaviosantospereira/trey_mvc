<?php

class Session{

    public function __construct()
    {
        session_start();
    }

    public function auth()
    {
        if(!isset($_SESSION['user_name']) || !isset($_SESSION['user_id']) || !isset($_SESSION['user_email'])){
            return false;            
        }
        return true;
    }
    public static function redirect($url, array $message = null)
    {
        if($message){
            self::setMessage($message['message'],$message['type']);
        }
        $path = "http://localhost/trey_mvc/";
        header('Location: ' . $path . $url);
        exit;
    }

    public static function setMessage($message,$type)
    {
        $_SESSION['message'] = [
            'message' => $message,
            'type' => $type
        ];

    }

    public static function getMessage()
    {
        if(isset($_SESSION['message'])){
            echo sprintf("<div class='container-fluid'>
                <div class='alert alert-%s text-center' role='alert'>
                    %s   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
            </div>",$_SESSION['message']['type'],$_SESSION['message']['message']);
            unset($_SESSION['message']);
        }
    }

    public static function start(array $user)
    {
        $_SESSION['user_id']    = $user['user_id'];
        $_SESSION['user_name']  = $user['user_name'];
        $_SESSION['user_email'] = $user['user_email'];
    }

    public static function get($value)
    {
        if(isset($_SESSION[$value])){
            return $_SESSION[$value];
        }

        return '';
    }

    public static function logout()
    {
        $_SESSION = [];
        session_destroy();
        header("location: http://localhost/trey_mvc/home/login.php");
    }
}