<?php 


namespace andeh\Framework\Utilities;
class PasswordManager{

    // تابع برای هش کردن رمز عبور
    function hash_password($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // تابع برای بررسی رمز عبور
    function verify_password($password, $hash)
    {
        return password_verify($password, $hash);
    }
}