<?php

    require_once "conn.php";
    
    class Test{

        protected $db_con;
        
        public function __construct() {
            
            $database= new Connection();
            $this->db_con = $database -> connect();
        }  
        
        public function count_total(){
            $sql= 'SELECT COUNT(*) Total FROM com_auth_users';
            //die(var_dump($sql));
            $stm = $this->db_con->prepare($sql);
            $stm->execute();
            $data=$stm->fetch();  
            $result= $data['Total'];
            //die(var_dump($result));
            return !empty($result) ? $result : false;
        }
		
		public function server_side($selector, $rows, $keys, $length, $start, $order, $column_order, $order_by){
	    
			$sql_a = "SELECT ".$rows." FROM `com_auth_users`";
			$sql_b = "";

			$flag = 0;
			for ($i=0; $i<count($keys); $i++) { //0-4
				if(!empty($keys[$i][1])){ //verifica si el input esta vacio
					$flag++;
					if($flag>1){
						$sql_b = $sql_b. " AND ";
					}
					if($keys[$i][5] === "a"){
						$sql_b = $sql_b;
					}else if($keys[$i][5] === "A"){
						$sql_b = " BINARY " .$sql_b;
					}
					if($keys[$i][3] === "C"){
						$sql_b = $sql_b.$keys[$i][0]." LIKE '%".$keys[$i][1]."%' ";
					}else if($keys[$i][3] === "S"){
						$sql_b = $sql_b.$keys[$i][0]." LIKE '".$keys[$i][1]."%' ";
					}else if($keys[$i][3] === "F"){
						$sql_b = $sql_b.$keys[$i][0]." LIKE '%".$keys[$i][1]."' ";
					}else if($keys[$i][3] === "W"){
						$sql_b = $sql_b.$keys[$i][0]." = '".$keys[$i][1]."' ";
					}

				}
			}
			if ($sql_b == ""){
				$sql = $sql_a;
			}else{
				$sql = $sql_a . " WHERE " . $sql_b;
			}

			// ordenamiento por columnas ( una a la vez)
			if(isset($order)){
				$sql = $sql . " ORDER BY " . $column_order[$order['0']['column']] . " " . $order['0']['dir'];
			}else if(isset($order_by)){
				$sql = $sql . " ORDER BY " . key($order_by) . " " . $order_by[key($order_by)];
			}

			switch ($selector) {
				case 1:
					$sql = $sql;
					break;
				case 2:
					if($length>0){
						$sql = $sql . " LIMIT ".$start.",". $length;
					}else{
						$sql = $sql;
					}
					break;
				default:
					if($length>0){
						$sql = $sql . " LIMIT ".$start.",". $length;
					}else{
						$sql = $sql;
					}
					break;
			}
	// 		die(var_dump($sql));
			$stm = $this->db_con ->prepare($sql);
			$stm->execute();
			$data=$stm->fetchAll(PDO::FETCH_NUM);   

			return $data;

		}
    }
?>