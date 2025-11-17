<?php 

include "../../DataAccessPDO/DbContext.php";
include "ModelBuilder.php";
include "../../Models/user.php";




$obj  = new ModelBuilder(get_db_connection());
$obj->createTableFromModel(User::class);

