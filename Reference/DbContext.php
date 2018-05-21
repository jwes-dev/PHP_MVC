<?php
class DbSet
{
    public function __construct($ref_object)
    {
        $this->db = NewSQLConnection();
        $this->obj = $ref_object;
    }

    public function Add($obj)
    {
        $reflect = new ReflectionClass($obj);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        $fields = "";
        $values = "";
        foreach ($props as $prop) {
            $name = $prop->getName();
            $fields = $fields.$prop->getName().",";
            $values = $values."'".$prop->getValue($obj)."',";
        }
        $fields = substr($fields, 0, strlen($fields) - 1);
        $values = substr($values, 0, strlen($values) - 1);
        $table = get_class($obj);
        $this->db->query("INSERT INTO $table ($fields) VALUES($values);");
    }

    public function Find($table, $column, $value)
    {
        $res = $this->db->query("SELECT TOP 1 * FROM $table WHERE $column = '$value'");
        $row = $res->fetch_assoc();
        $inst = get_class($this->obj);
        $obj = new $inst();
        $reflect = new ReflectionClass($obj);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($props as $prop) {
            $prop->setValue($obj, $row[$prop->getName()]);
            //print $prop->getName();
        }
        return $obj; 
    }

    public function Update($obj)
    {
        $table = get_class($obj);


        $res = $this->db->query("SELECT k.column_name as KC FROM information_schema.table_constraints t JOIN information_schema.key_column_usage k USING(constraint_name,table_schema,table_name) WHERE t.constraint_type='PRIMARY KEY' AND t.table_schema='".DB_NAME."' AND t.table_name='$table';");
        if($res->num_rows < 1)
            return -1;
        $row = $res->fetch_assoc();
        $col = $row["KC"];

        $reflect = new ReflectionClass($obj);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        $q = "UPDATE ".get_class($obj)." SET ";
        foreach ($props as $prop) {
            $q = $q.$prop->getName()."='".$prop->getValue($obj)."',";
        }
        $q = substr($q, 0, strlen($q) - 1);
        return $this->db->query($q." WHERE $col='".(string)$obj->$col."'");
    }

    public function Remove($obj)
    {
        $table = get_class($obj);
        $res = $this->db->query("SELECT k.column_name as KC FROM information_schema.table_constraints t JOIN information_schema.key_column_usage k USING(constraint_name,table_schema,table_name) WHERE t.constraint_type='PRIMARY KEY' AND t.table_schema='".DB_NAME."' AND t.table_name='$table';");
        if($res->num_rows < 1)
            return -1;
        $row = $res->fetch_assoc();
        $col = $row["KC"];
        return $this->db->query("DELETE FROM $table WHERE $col='".(string)$obj->$col."'");
    }

    public function Close()
    {
        $db->close();
    }
}
?>