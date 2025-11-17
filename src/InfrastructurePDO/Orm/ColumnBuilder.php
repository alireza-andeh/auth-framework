<?php 


class ColumnBuilder{
    public static function build(ReflectionProperty $prop): string
    {
        $name = $prop->getName();
        $type = $prop->getType()?->getName() ?? 'string';
        if (class_exists($prop)) return '';
        $colType = TypeMapper::map($type);
        $modifiers = self::getColumnModifiers($prop);
        if($name ==='id') return "$name INT AUTO_INCREMENT PRIMARY KEY";
        return trim("$name $colType $modifiers");

    }
    public static function getColumnModifiers(ReflectionProperty $prop): string
    {
        if($prop->hasDefaultValue()){
            $value = $prop->getDefaultValue();
            if ($value === null){
                return "NULL";
            }
            else{
                if(is_bool($value)){
                    $value = $value ? 1: 0;
                }
                return "NOT NULL DEFAULT '". $value ."'";
            }
        }
        return "NOT NULL";
    }
}