<?php
    
include 'config.php';

class dbconnection
{
    public function connect_to_server_db(){
        $config = get_global_config_object();
         // Create connection
        $con=mysqli_connect($config->domain_name, $config->sql_user, $config->sql_pass, $config->db_name);

        // Check connection
        if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          return null;
        }
   
        return $con;
    }

    public function db_select_query($sql)
    {
        $con = $this->connect_to_server_db();

        if($con == NULL)
        {
            return NULL;
        }

        $result = mysqli_query($con,$sql);

        $matrix_result = array();

        while($row = mysqli_fetch_array($result)) {
            array_push($matrix_result, $row);
        }

        mysqli_close($con);

        return $matrix_result;
    }

    public function db_execute_query($sql)
    {
        $con = $this->connect_to_server_db();

        if($con == NULL)
        {
            return NULL;
        }

        $result = mysqli_query($con,$sql);

        mysqli_close($con);
        
        return $result;
    }
 
     public function table_exists($table_name)
     {
         return FALSE;
     }
}

?>