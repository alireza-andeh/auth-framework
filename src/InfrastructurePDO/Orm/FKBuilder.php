<?php


class FKBuilder{

    public static function build(ReflectionProperty $prop): ?array
    {   
        $type = $prop->getType()->getName();
        if($type && class_exists($type))
        {
            $tableName      = new ReflectionClass($type);#->getShortName(); 
            $relatedTable   = strtolower($tableName).'s';
            $fkName = $relatedTable.'_id';
            return [
                'column'     => "$fkName INT",
                'constraint' => "FOREIGN KEY ($fkName) REFRENCES $relatedTable(id)",
            ];
        }
        return null;
        
    }
}