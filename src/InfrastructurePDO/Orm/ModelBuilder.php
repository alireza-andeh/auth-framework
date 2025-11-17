<?php 

class ModelBuilder{
    private ?PDO $conn;
    private array $columns = [];
    public function __construct(?PDO $conn= null)
    {
       $this->conn = $conn;
    }
    private function matchTypes($type): string {
    return match (strtolower($type)) {
        'int', 'integer'       => 'INT',
        'tinyint'              => 'TINYINT',
        'smallint'             => 'SMALLINT',
        'bigint'               => 'BIGINT',
        'float', 'double'      => 'DOUBLE',
        'decimal'              => 'DECIMAL(10,2)',
        'bool', 'boolean'      => 'BOOLEAN',
        'string', 'varchar'    => 'VARCHAR(255)',
        'text'                 => 'TEXT',
        'longtext'             => 'LONGTEXT',
        'date'                 => 'DATE',
        'datetime'             => 'DATETIME',
        'timestamp'            => 'TIMESTAMP',
        'array', 'json'        => 'JSON',
        default                => 'VARCHAR(255)',
    };
}
    public function createTableFromModel(string  $classname)
    {
        $ref = new ReflectionClass($classname);
        $tableName = strtolower($ref->getShortName()).'s';
        foreach($ref->getProperties() as $prop){
            $type = $prop->getType() ? $prop->getType()->getName():'string';
            $name = $prop->getName();
            $colType = $this->matchTypes($type);
            if(class_exists($type)){
                $refType = new ReflectionClass($type);
                $fk      = strtolower($refType->getShortName())."_id";
                $columns [] = "$fk INT";
                continue;
            }
            if($name === 'id'){
                $columns[]  = "$name INT AUTO_INCREMENT PRIMARY KEY";
            }
            else{
                $nullable   = $prop->hasDefaultValue()&& $prop->getDefaultValue() === null ? "NULL" : "NOT NULL"; 
                $defulat    = $prop->hasDefaultValue()&& $prop->getDefaultValue() != null ?
                 "DEFUALT'".$prop->getDefaultValue()."'":"";
                $columns[]  = "$name $colType";
            }
             
            
            
        }
        
        $sql = "CREATE TABLE IF NOT EXISTS $tableName (" . implode(", ", $columns) . ");";
        $this->conn->exec($sql);
        return $tableName;
            
    }
}


