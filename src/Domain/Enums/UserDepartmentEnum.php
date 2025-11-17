<?php
namespace andeh\Framework\Domain\Enums;


enum UserDepartmentEnum :string {
    case  TECHNICAL = 'Technical';
    case FINANCE    = 'Finance';
    case CUSTOMER   = 'Coustomer';
    case SALES      = 'Sales';
    case USER       = 'User' ;
}