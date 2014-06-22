<?php
    global $db;

    class querybuilder
    {
        private function db_var() {
	        global $db;

	        return $db;
        }
        //CREATE TABLE:
        private function create_table_query($table_name, $columns, $options)
        {
            $sql = "CREATE TABLE ".$table_name. "(";
    
            $col_length = count($columns);
    
            for($i = 0; $i < $col_length; $i++)
            {
                $c = $columns[$i];
                $sql .= $c['name'].' '. $c['type'];
    
                if($i != $col_length - 1)
                {
                    $sql .= ', ';
                }
                else{
                    $sql .= ");";        
                }
            }
            return $this->db_var()->db_execute_query($sql);
        }    
    
        public function create_table($options)
        {
            return $this->create_table_query($options['table_name'], $options['columns'], $options['options']);
        }
        
        //RENAME TABLE:
        private function rename_table_query($table_name, $new_table_name)
        {
            $sql = "RENAME TABLE ".$table_name. " TO ".$new_table_name;
    
            return $this->db_var()->db_execute_query($sql);
        }
    
        public function rename_table($options)
        {
            return $this->rename_table_query($options['table_name'], $options['new_table_name']);
        }

        //ALTER TABLE:
        private function alter_table_query($table_name, $action, $column, $datatype)
        {
            $sql = "ALTER TABLE ".$table_name. " ";
    
            $sql .= $action . " " . $column . " " . $datatype;
    
            return $this->db_var()->db_execute_query($sql);
        }
    
        public function alter_table($options)
        {
            return $this->alter_table_query($options['table_name'], $options['action'], $options['column'], $options['datatype']);
        }

        //DROP TABLE:
        private function drop_table_query($table_name)
        {
            $sql = "DROP TABLE ".$table_name. " ;";
    
            return $this->db_var()->db_execute_query($sql);
        }
    
        public function drop_table($table_name)
        {
            return $this->drop_table_query($table_name);
        }

        //INSERT
        private function insert_into_query($table_name, $columns, $values)
        {
            $sql = "INSERT INTO ".$table_name. " (";
    
            $col_length = count($columns);
    
            for($i = 0; $i < $col_length; $i++)
            {
                $sql .= $columns[$i];
    
                if($i != $col_length - 1)
                {
                    $sql .= ', ';
                }
            }
    
            $sql .= ")VALUES(";
    
            for($i = 0; $i < $col_length; $i++)
            {
                if(gettype($values[$i]) == 'string'){
                    $sql .= "'".$values[$i]."'";    
                }
                else{
                    $sql .= $values[$i];    
                }
                
    
                if($i != $col_length - 1)
                {
                    $sql .= ', ';
                }
                else{
                    $sql .= ");";        
                }
            }

            return $this->db_var()->db_execute_query($sql);
        }

        public function insert_into($options)
        {
            return $this->insert_into_query($options['table_name'], $options['columns'], $options['values']);
        }

        //UPDATE
        private function update_query($table_name, $columns, $values, $where)
        {
            $sql = "UPDATE ".$table_name. " SET ";
    
            $col_length = count($columns);
    
            for($i = 0; $i < $col_length; $i++)
            {
                $sql .= $columns[$i]. ' = ' . $values[$i];
    
                if($i != $col_length - 1)
                {
                    $sql .= ', ';
                }
                else{
                    $sql .= ";";        
                }
            }

            if($where != NULL)
            {
                $sql .= " WHERE ".$where;
            }

            return $this->db_var()->db_execute_query($sql);
        }

        public function update($options)
        {
            return $this->update_query($options['table_name'], $options['columns'], $options['values'], $options['where']);
        }
    
        //DELETE
        private function delete_query($table_name, $where)
        {
            $sql = "DELETE FROM ".$table_name;
    
            if($where != NULL)
            {
                $sql .= " WHERE ".$where;
            }

            return $this->db_var()->db_execute_query($sql);
        }

        public function delete($options)
        {
            return $this->delete_query($options['table_name'], $options['where']);
        }

        //SELECT
        private function simple_select_query($table_name, $columns, $where, $limit)
        {
            $sql = "SELECT ";
    
            if($columns != NULL){
                $col_length = count($columns);
    
                for($i = 0; $i < $col_length; $i++)
                {
                    $sql .= $columns[$i];
    
                    if($i != $col_length - 1)
                    {
                        $sql .= ', ';
                    }
                }
            }
            else{
                $sql .= '*';
            }
    
            $sql .= " FROM ".$table_name;
    
            if($where != NULL)
            {
                $sql .= " WHERE ".$where;
            }
    
            if($limit != NULL)
            {
                $sql .= " LIMIT ".$limit;
            }
    
            $sql .= ";";
    
            echo $sql;
    
            return $this->db_var()->db_select_query($sql);
        }
    
        public function simple_select($options)
        {
            return $this->simple_select_query($options['table_name'], $options['columns'], $options['where'], $options['limit']);
        }
    }
?>