<?php

    class modules
    {

        private function query_var() {
	        global $query;

	        return $query;
        }

        private function validate_module_name($module_name)
        {
            return TRUE;
        }

        //CREATE MODULE
        private function create_module($module_name, $columns)
        {
            global $db;

            if(!$this->validate_module_name($module_name))
            {
                echo 'ERROR: Module name is not valid!';
                return;
            }

            if($db->table_exists($module_name))
            {
                echo 'ERROR: Module already exists, try alter module..';
                return;
            }

            $args = array(
              'table_name' => $module_name,
              'columns' => $columns
            );

            $response = $this->query_var()->create_table($args);

            if($response != NULL)
            {
                $args = array(
                    'table_name' => 'modules',
                    'columns' => array('Name', 'Columns', 'Status'),
                    'values' => array($module_name, json_encode ($columns), 1)
                );

                $this->query_var()->insert_into($args);
                return TRUE;
            }

            return FALSE;
        }

        public function create($options)
        {
            return $this->create_module($options['module_name'], $options['columns']);
        }

        //RENAME MODULE
        private function rename_module($module_name, $new_module_name)
        {
            global $db;

            if(!$db->table_exists($module_name))
            {
                echo 'ERROR: Cant rename a module that dont exist';
                return;
            }

            $args = array(
                    'table_name' => $module_name,
                    'new_table_name' => $new_module_name
            );

            $response = $this->query_var()->rename_table($options);

            if($response != NULL)
            {
                $args = array(
                    'table_name' => 'modules',
                    'columns' => array('Name'),
                    'values' => array($new_module_name),
                    'where' => ' Name = '.$module_name
                );

                $this->query_var()->update($args);
                return TRUE;
            }

            return FALSE;
        }

        public function rename($module_name, $new_module_name)
        {
            return $this->rename_module($module_name, $new_module_name);
        }

        //CHANGE MODULE
        private function change_module($options)
        {
            global $db;

            $response = $this->query_var()->alter_table($options);

            if($response != NULL)
            {
                $args = array(
                    'table_name' => 'modules',
                    'column' => array('Name', 'Columns', 'Status'),
                    'action' => array($module_name, json_encode ($columns), 1)
                );

                $this->query_var()->insert_into($args);
                return TRUE;
            }

            return FALSE;
        }

        public function change($options)
        {
            return $this->change_module($options);
        }

        //DELETE MODULE
        private function delete_module($module_name, $columns)
        {
            global $db;

            if(!$db->table_exists($module_name))
            {
                echo 'ERROR: Cant delete a module that dont exist';
                return;
            }

            $args = array(
              'table_name' => $module_name
            );

            $response = $this->query_var()->create_table($module_name);

            if($response != NULL)
            {
                $args = array(
                    'table_name' => 'modules',
                    'where' => 'Name = '.$module_name
                );

                $this->query_var()->delete($args);
                return TRUE;
            }

            return FALSE;
        }

        public function delete($options)
        {
            return $this->delete_module($module_name);
        }
    }
?>