<?php
	$email = $_POST['email'];
	$radioEmail = $_POST['radioEmail'];
	$radioEmail2 = $_POST['radioEmail2'];

	$first_name = $_POST['first_name'];
	$radioFirstname = $_POST['radioFirstname'];
	$radioFirstname2 = $_POST['radioFirstname2'];

	$last_name = $_POST['last_name'];
	$radioLastname = $_POST['radioLastname'];
	$radioLastname2 = $_POST['radioLastname2'];

	$employee_id = $_POST['employee_id'];
	$radioEmployee_id = $_POST['radioEmployee_id'];
	$radioEmployee_id2 = $_POST['radioEmployee_id2'];

	$status = $_POST['status'];
	$radioStatus = $_POST['radioStatus'];
	$radioStatus2 = $_POST['radioStatus2'];
	
	$start = $_POST['start'];
	$draw = $_POST['draw'];
	$length = $_POST['length'];
	$order = $_POST['order'];

 	$rows = "id, email, first_name, last_name, employee_id, status";
 	$column_order = array('id', 'email', 'first_name', 'last_name', 'employee_id', 'status');
 	$order_by = array('email' => 'asc');

 	$keys = [];
 	$keys[0][0]='email';
	$keys[0][1]=$email;
	$keys[0][2]='radioEmail';
	$keys[0][3]= $radioEmail;
	$keys[0][4]='radioEmail2';
	$keys[0][5]=$radioEmail2;

	$keys[1][0]='first_name';
	$keys[1][1]=$first_name;
	$keys[1][2]='radioFirstname';
	$keys[1][3]=$radioFirstname;
	$keys[1][4]='radioFirstname2';
	$keys[1][5]=$radioFirstname2;

	$keys[2][0]='last_name';
	$keys[2][1]=$last_name;
	$keys[2][2]='radioLastname';
	$keys[2][3]=$radioLastname;
	$keys[2][4]='radioLastname2';
	$keys[2][5]=$radioLastname2;

	$keys[3][0]='employee_id';
	$keys[3][1]=$employee_id;
	$keys[3][2]='radioEmployee_id';
	$keys[3][3]=$radioEmployee_id;
	$keys[3][4]='radioEmployee_id2';
	$keys[3][5]=$radioEmployee_id2;

	$keys[4][0]='status';
	$keys[4][1]=$status;
	$keys[4][2]='radioStatus';
	$keys[4][3]=$radioStatus;
	$keys[4][4]='radioStatus2';
	$keys[4][5]=$radioStatus2;

	require_once "model.php";
	$test = new Test();

	$selector = 1;
	$list_1 = $test->server_side($selector, $rows, $keys, $length, $start, $order, $column_order, $order_by);

	$selector = 2;
	$list_2 = $test->server_side($selector, $rows, $keys, $length, $start, $order, $column_order, $order_by);

    $count_1 = $test-> count_total();

    $output = array(
				"draw" => $draw,
				"recordsTotal" => $count_1,
				"recordsFiltered" => count($list_1),
				"data" => $list_2,
		);

	//output to json format
	echo json_encode($output);
?>