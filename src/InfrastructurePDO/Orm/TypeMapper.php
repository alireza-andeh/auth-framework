<?php 

class TypeMapper{
    public static function map(string $type)
    {
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
}