<?php 

namespace andeh\Framework\Domain\Enums;
enum UserRoleEnum : string{
    case    ADMIN   = 'admin';
    case    SUPPORT = 'support';
    case    USER    = 'user';
}