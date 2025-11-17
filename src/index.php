<?php
include "Applications/Auth.php";
include "../config/config.php";
include "Models/Enums/UserRoleEnum.php";
include "Models/user.php";

$auth = new Auth();

$auth->register();

return '';

echo "is work!";

$user = new User();
$user->username     = "andeh";
$user->email        = "sasan_andeh@mail.com";
$user->password     = "1";
$user->full_name    = "alireza andeh";
$user->role         = UserRoleEnum::ADMIN->value;
$user->phone        = "09149461350";

$rpo = new UserRepository();
$rpo->create($user);
var_dump ($rpo);



// اگر کاربر وارد شده، به داشبورد هدایت شود
if (isset($_SESSION['user_id'])) {
    redirect('dashboard.php');
}

if ($_POST) {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'توکن امنیتی نامعتبر است';     
    } else {
        $username = sanitize_input($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        if (empty($username) || empty($password)) {
            $error = 'لطفاً تمام فیلدها را پر کنید';
        } else {
            
            if ($auth->login($username,$password)) {
                echo "شما وارد شدید.";
                
                redirect('dashboard.php');
            } else {

                $error = 'نام کاربری یا رمز عبور اشتباه است';
            }
        }
    }
}  


