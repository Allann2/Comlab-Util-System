<?php
	require_once "../config/config.php";
	// include "../../views/session.php";

	// 1 == success
	// 2 == exist
	// 0 == failed

	class add {
		
		public function add_room($name)
		{
			global $conn;

			session_start();
			$h_desc = 'add new room '. $name;
			$h_tbl = 'room';
			$sessionid = $_SESSION['admin_id'];
			$sessiontype = $_SESSION['admin_type'];


			$select = $conn->prepare("SELECT * FROM room WHERE rm_name = ? "); 
			$select->execute(array($name));
			$row = $select->rowCount();
			if($row <= 0){
				$sql = $conn->prepare("INSERT INTO room(rm_name, rm_status) VALUES(?, ?) ;
									   INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)");
				$sql->execute(array('room '.$name,1,$h_desc,$h_tbl,$sessionid,$sessiontype));
				$count = $sql->rowCount();
				if($count > 0){
					echo "1"; 
				}else{
					echo "0";
				}
			}else{
				echo "2";
			}
		}

		public function sign_student($sid_number,$s_fname,$s_lname,$s_gender,$s_contact,$s_department,$s_major,$s_year,$s_section,$s_password,$type)
		{
			global $conn;

			$sql = $conn->prepare('SELECT * FROM member WHERE m_school_id = ? AND m_fname = ? AND m_lname = ? AND m_type = ?');
			$sql->execute(array($sid_number,$s_fname,$s_lname,$type));
			$sql_count = $sql->rowCount();
				if($sql_count <= 0 ){
					
					$insert = $conn->prepare('INSERT INTO  member(m_school_id, m_fname, m_lname, m_gender, m_contact, m_department, m_year_section, m_type, m_password) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
					$insert->execute(array($sid_number,$s_fname,$s_lname,$s_gender,$s_contact,$s_department,$s_year.' - '.$s_section,$type,$s_password));
					$insert_count = $insert->rowCount();
						
						if($insert_count > 0){
							echo "1";
						}else{
							echo "0";
						}

				}else{
					echo "2";
				}
		}

		public function sign_faculty($f_id,$f_fname,$f_lname,$f_gender,$f_contact,$f_department,$f_password,$type)
		{
			global $conn;

			$sql = $conn->prepare('SELECT * FROM member WHERE m_school_id = ? AND m_fname = ? AND m_lname = ? AND m_type = ?');
			$sql->execute(array($f_id,$f_fname,$f_lname,$type));
			$sql_count = $sql->rowCount();
				if($sql_count <= 0 ){
					
					$insert = $conn->prepare('INSERT INTO  member(m_school_id, m_fname, m_lname, m_gender, m_contact, m_department, m_type, m_password) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
					$insert->execute(array($f_id,$f_fname,$f_lname,$f_gender,$f_contact,$f_department,$type,$f_password));
					$insert_count = $insert->rowCount();
						
						if($insert_count > 0){
							echo "1";
						}else{
							echo "0";
						}

				}else{
					echo "2";
				}

		}


		public function add_member($as,$handle){
			global $conn;

			session_start();
			$h_desc = 'add csv file clients';
			$h_tbl = 'client';
			$sessionid = $_SESSION['admin_id'];
			$sessiontype = $_SESSION['admin_type'];

			try {	
				$sql = $conn->prepare('INSERT INTO member(m_school_id,m_fname,m_lname,m_gender,m_contact,m_department,m_year_section,m_type	) VALUES(?,?,?,?,?,?,?,?)');
				fgets($handle);
				 while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
		            $sql->execute($data);
		        }   
		        $insert = $conn->prepare('INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
		        $insert->execute(array($h_desc,$h_tbl,$sessionid,$sessiontype));   
			}
			catch(ePDOException $e){
				echo 0;
			}
			echo 1;
		}


		public function add_users($u_fname,$u_username,$u_password,$u_type)
		{
			global $conn;

			session_start();
			$h_desc = 'add user'. $u_fname;
			$h_tbl = 'user';
			$sessionid = $_SESSION['admin_id'];
			$sessiontype = $_SESSION['admin_type'];

			$sql = $conn->prepare('SELECT * FROM user WHERE name = ? OR username = ? ');
			$sql->execute(array($u_fname,$u_username));
			$count = $sql->rowCount();
			if($count <= 0){
				$que = $conn->prepare('INSERT INTO user	(name,username,password,type) VALUES(?,?,?,?);
										INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
				$que->execute(array($u_fname,$u_username,$u_password,$u_type,$h_desc,$h_tbl,$sessionid,$sessiontype));
				$row = $que->rowCount();
				if($row > 0){
					echo "1";
				}else{
					echo "0";
				}
			}else{
				echo "2";
			}
		}



		public function add_newstudent($sid_number,$s_fname,$s_lname,$s_gender,$s_contact,$s_department,$s_major,$s_year,$s_section)
		{
			global $conn;

			session_start();
			$h_desc = 'add new student';
			$h_tbl = 'client';
			$sessionid = $_SESSION['admin_id'];
			$sessiontype = $_SESSION['admin_type'];

			$type = 'Student';

			$sql = $conn->prepare('SELECT * FROM member WHERE m_school_id = ? AND m_fname = ? AND m_lname = ? AND m_type = ?');
			$sql->execute(array($sid_number,$s_fname,$s_lname,$type));
			$sql_count = $sql->rowCount();
				if($sql_count <= 0 ){
					
					$insert = $conn->prepare('INSERT INTO member(m_school_id, m_fname, m_lname, m_gender, m_contact, m_department, m_year_section, m_type) VALUES(?, ?, ?, ?, ?, ?, ?, ?);
						INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
					$insert->execute(array($sid_number,$s_fname,$s_lname,$s_gender,$s_contact,$s_department,$s_year.' - '.$s_section,$type,$h_desc,$h_tbl,$sessionid,$sessiontype));
					$insert_count = $insert->rowCount();
						
						if($insert_count > 0){
							echo "1";
						}else{
							echo "0";
						}

				}else{
					echo "2";
				}
		}

		public function add_newfaculty($f_id,$f_fname,$f_lname,$f_gender,$f_contact,$f_department,$type)
		{
			global $conn;

			$sql = $conn->prepare('SELECT * FROM member WHERE m_school_id = ? AND m_fname = ? AND m_lname = ? AND m_type = ?');
			$sql->execute(array($f_id,$f_fname,$f_lname,$type));
			$sql_count = $sql->rowCount();
				if($sql_count <= 0 ){
					
					$insert = $conn->prepare('INSERT INTO  member(m_school_id, m_fname, m_lname, m_gender, m_contact, m_department, m_type) VALUES(?, ?, ?, ?, ?, ?, ?);
						INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
					$insert->execute(array($f_id,$f_fname,$f_lname,$f_gender,$f_contact,$f_department,$type,$h_desc,$h_tbl,$sessionid,$sessiontype));
					$insert_count = $insert->rowCount();
						
						if($insert_count > 0){
							echo "1";
						}else{
							echo "0";
						}

				}else{
					echo "2";
				}
		}

	}


	$add_function = new add();

	$key = trim($_POST['key']);

	switch ($key){
		case 'add_room';
		$name = strtolower($_POST['name']);
		$add_function->add_room($name);
		break;

		case 'sign_student';
		$sid_number = trim($_POST['sid_number']);
 		$s_fname = strtolower(trim($_POST['s_fname']));
 		$s_lname = strtolower(trim($_POST['s_lname']));
 		$s_gender = trim($_POST['s_gender']);
 		$s_contact = trim($_POST['s_contact']);
 		$s_department = trim($_POST['s_department']);
 		$s_major = trim($_POST['s_major']);
 		$s_year = trim($_POST['s_year']);
 		$s_section = trim($_POST['s_section']);
 		$s_password = trim(md5($_POST['s_password']));
 		$type = 1;
 		$add_function->sign_student($sid_number,$s_fname,$s_lname,$s_gender,$s_contact,$s_department,$s_major,$s_year,$s_section,$s_password,$type);
		break;

		case 'sign_faculty';
		$f_id = trim($_POST['f_id']);
		$f_fname = strtolower(trim($_POST['f_fname']));
		$f_lname = strtolower(trim($_POST['f_lname']));
		$f_gender = trim($_POST['f_gender']);
		$f_contact = trim($_POST['f_contact']);
		$f_department = trim($_POST['f_department']);
		$f_password = trim(md5($_POST['f_password']));
 		$type = 2;
		$add_function->sign_faculty($f_id,$f_fname,$f_lname,$f_gender,$f_contact,$f_department,$f_password,$type);
		break;


		case 'add_member';
		if($_FILES['file']['name'])  
 		{
 			$filename = explode('.',$_FILES['file']['name']);  
           	if($filename[1] == 'csv')  
       		{
       			$as = 1;
       			$handle = fopen($_FILES['file']['tmp_name'], "r");  
       		}else{
       			$as = 0;
       		} 
 		}
 		$add_function->add_member($as,$handle);
		break;

		case 'add_users';
		$u_fname = trim($_POST['u_fname']);
		$u_username = trim($_POST['u_username']);
		$u_password = trim(md5($_POST['u_password']));
		$u_type = trim($_POST['u_type']);
		$add_function->add_users($u_fname,$u_username,$u_password,$u_type);
		break;


		case 'add_newstudent';
		$sid_number = trim($_POST['sid_number']);
 		$s_fname = ucwords(trim($_POST['s_fname']));
 		$s_lname = ucwords(trim($_POST['s_lname']));
 		$s_gender = trim($_POST['s_gender']);
 		$s_contact = trim($_POST['s_contact']);
 		$s_department = trim($_POST['s_department']);
 		$s_major = trim($_POST['s_major']);
 		$s_year = trim($_POST['s_year']);
 		$s_section = ucwords(trim($_POST['s_section']));
 		$add_function->add_newstudent($sid_number,$s_fname,$s_lname,$s_gender,$s_contact,$s_department,$s_major,$s_year,$s_section);
		break;

		case 'add_newfaculty';
		$f_id = trim($_POST['f_id']);
		$f_fname = strtolower(trim($_POST['f_fname']));
		$f_lname = strtolower(trim($_POST['f_lname']));
		$f_gender = trim($_POST['f_gender']);
		$f_contact = trim($_POST['f_contact']);
		$f_department = trim($_POST['f_department']);
 		$type = 'Faculty';
		$add_function->add_newfaculty($f_id,$f_fname,$f_lname,$f_gender,$f_contact,$f_department,$type);
		break;
		



	}



	?>


