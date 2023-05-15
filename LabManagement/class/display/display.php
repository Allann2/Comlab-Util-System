<?php

	require_once "../config/config.php";


	/**
	* 
	*/
	class display
	{
		
		function display_room()
		{
			global $conn;
			$sql = $conn->prepare("SELECT * FROM room WHERE rm_status = ?");
			$sql->execute(array(1));
			$count = $sql->rowCount();
			$fetch = $sql->fetchAll();
			if($count > 0){
				foreach ($fetch as $key => $value) {
					$myname = $value['rm_name'];

					
					$button1 = 	'<div class="btn-group">
									<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a href="javascript:;" class="edit-room" ><i class="fa fa-edit"></i> Edit</a></li>
										<li><a href="room_info?name='.$myname.'&id='.$value["id"].'"><i class="fa fa-search"></i> View Items</a></li>
									</ul>
								</div>';

					$button2 = 	'<div class="btn-group">
									<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a href="javascript:;" class="edit-room" ><i class="fa fa-edit"></i> Edit</a></li>
									</ul>
								</div>';

					// <li><a href="room_info?name='.$myname.'&id='.$value["id"].'"><i class="fa fa-search"></i> View equipments</a></li>

					$button =  $button1;

					$data['data'][] = array(ucwords($value['rm_name']),$button,$value['id']);
				}
				echo json_encode($data);
			}else{
				$data['data'] = array();
				echo json_encode($data);
			}
		}


		public function display_member()
		{
			global $conn; 
			$sql = $conn->prepare("SELECT * FROM member");
			$sql->execute();
			$count = $sql->rowCount();
			$fetch = $sql->fetchAll();
			if($count > 0){
				foreach ($fetch as $key => $value) {
					$status = ($value['m_status'] == 1) ? '<a href="javascript:;" class="deactivate-member" ><i class="fa fa-remove"></i> deactivate</a>' : '<a href="javascript:;" class="activate-member" ><i class="fa fa-remove"></i> activate</a>' ;
					$button = 	'<div class="btn-group">
									<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a href="javascript:;" class="edit-member" ><i class="fa fa-edit"></i> Edit</a></li>
										<li>'.$status.'</li>
										<li><a href="member_profile?id='.$value['id'].'&name='.$value['m_fname'].' '.$value['m_lname'].'"><i class="fa fa-user"></i> Borrower Profile</a></li>
									</ul>
								</div>';

					$data['data'][] = array($value['m_school_id'],$value['m_fname'].' '.$value['m_lname'],$value['m_gender'],$value['m_contact'],$value['m_department'],$value['m_year_section'],$value['m_type'],$button,$value['m_fname'],$value['m_lname'],$value['id']);
				}
				echo json_encode($data);
			}else{
				$data['data'] = array();
				echo json_encode($data);
			}
		}


		public function display_user()
		{
			global $conn; 
			$sql = $conn->prepare("SELECT * FROM user");
			$sql->execute();
			$count = $sql->rowCount();
			$fetch = $sql->fetchAll();
			if($count > 0){
				foreach ($fetch as $key => $value) {
					$status = ($value['status'] == 1) ? '<a href="javascript:;" class="deactivate-user" ><i class="fa fa-remove"></i> deactivate</a>' : '<a href="javascript:;" class="activate-user" ><i class="fa fa-remove"></i> activate</a>' ;
					$button = 	'<div class="btn-group">
									<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action <span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a href="javascript:;" class="edit-user" ><i class="fa fa-edit"></i> Edit</a></li>
										<li>'.$status.'</li>
										<li><a href="javascript:;" class="edit-upass" ><i class="fa fa-lock"></i> Change Password</a></li>
									</ul>
								</div>';
					$type = ($value['type'] == 1) ? 'Administrator' : 'Staff/ Student Assistance';
					$data['data'][] = array($value['name'],$type,$value['username'],$button,$value['id'],$value['password']);
				}
				echo json_encode($data);
			}else{
				$data['data'] = array();
				echo json_encode($data);
			}
		}


		public function display_roomtype()
		{
			global $conn;

			$sql = $conn->prepare('SELECT * FROM room WHERE rm_name = ?');
			$sql->execute(array('room 310'));
			$count = $sql->rowCount();
			$fetch = $sql->fetchAll();
			if($count > 0){
				
				foreach ($fetch as $key => $value) {
					$data[] = array($value['id'],ucwords($value['rm_name']));
				}
				echo json_encode($data);

			}else{
				echo "0";
			}
		}

		public function display_roomtype1($id)
		{
			global $conn;

			$sql = $conn->prepare('SELECT * FROM room WHERE rm_status = ? AND id != ? ORDER BY rm_name ASC');
			$sql->execute(array(1,$id));
			$count = $sql->rowCount();
			$fetch = $sql->fetchAll();
			if($count > 0){
				
				foreach ($fetch as $key => $value) {
					$data[] = array($value['id'],ucwords($value['rm_name']));
				}
				echo json_encode($data);

			}else{
				echo "0";
			}
		}


		public function display_memberselect()
		{
			global $conn;

			$sql = $conn->prepare("SELECT * FROM member WHERE m_status = ? ORDER BY m_fname ASC");
			$sql->execute(array(1));
			$count = $sql->rowCount();
			$fetch = $sql->fetchAll();
			if($count > 0){
				foreach ($fetch as $key => $value) {
					$data[] = array($value['m_fname'].' '.$value['m_lname'],$value['m_school_id'],$value['id']);	
				}
				echo json_encode($data);
			}else{
				echo "0";
			}
		}


		public function table_history()
		{
			global $conn;
			$sql = $conn->prepare("SELECT * FROM history_logs 
									LEFT JOIN user ON user.id = history_logs.user_id
									ORDER BY history_logs.date_created ASC");
			$sql->execute();
			$count = $sql->rowCount();
			$fetch = $sql->fetchAll();
			if($count > 0){
				foreach ($fetch as $key => $value) {
					$date = date('M d,Y H:i:s A', strtotime($value['date_created']));
					$data['data'][] = array($value['name'],$value['description'],$date);	
				}
				echo json_encode($data);
			}else{
				$data['data'] = array();
				echo json_encode($data);
			}
		}

		public function dashboard_history()
		{
			global $conn;
			$sql = $conn->prepare("SELECT * FROM history_logs 
									LEFT JOIN user ON user.id = history_logs.user_id
									ORDER BY history_logs.date_created ASC LIMIT 0,10");
			$sql->execute();
			$count = $sql->rowCount();
			$fetch = $sql->fetchAll();
			if($count > 0){
				foreach ($fetch as $key => $value) {
					$date = date('M d,Y H:i:s', strtotime($value['date_created']));
					$data[] = array($date.' - '.$value['name'].' - '.$value['description']);
				}
				echo json_encode($data);
			}else{
				echo "0";
			}
		}

		public function table_dashboard()
		{
			global $conn;

			$sql = $conn->prepare('SELECT * FROM item_stock
									LEFT JOIN item ON item.id = item_stock.item_id
									WHERE item_stock.items_stock > ? ');
			$sql->execute(array(0));
			$row = $sql->rowCount();
			$fetch = $sql->fetchAll();
			if($row > 0){
				foreach ($fetch as $key => $value) {
					$status = ($value['item_status'] == 1) ? 'New' : 'Old' ;
					$data['data'][] = array($value['i_model'],$value['i_category'],$value['i_brand'],$value['i_description'],$value['items_stock'],$status);
				}
				echo json_encode($data);
			}else{
				$data['data'] = array();
				echo json_encode($data);
			}

		}

		public function tbl_member_profile($id)
		{
			global $conn;

			$sql = $conn->prepare('SELECT *, borrow.status as statusb FROM borrow
								 	LEFT JOIN item_stock ON item_stock.id = borrow.stock_id
								 	LEFT JOIN item ON item.id = item_stock.item_id
								 	LEFT JOIN member ON member.id = borrow.member_id
								 	LEFT JOIN room ON room.id = borrow.room_assigned
								 	WHERE borrow.member_id = ? GROUP BY borrow.borrowcode');
			$sql->execute(array($id));
			$row = $sql->rowCount();
			$fetch = $sql->fetchAll();

			if($row > 0){
				foreach ($fetch as $key => $value) {
					$date = date('F d,Y H:i:s A', strtotime($value['date_borrow']));
					$status = ($value['statusb'] == 1) ? 'Borrow' : 'Returned';
					$data['data'][] = array($date,$value['i_brand'].' - '.$value['i_category'],ucwords($value['rm_name']),$status); 
				}
				echo json_encode($data);
			}else{
				$data['data'] = array();
				echo json_encode($data);
			}

		}

		public function display_rooms()
		{
			global $conn;

			$sql = $conn->prepare('SELECT * FROM room WHERE rm_name != ? ORDER BY rm_name ASC');
			$sql->execute(array('room 310'));
			$fetch = $sql->fetchAll();
				foreach ($fetch as $key => $value) {
					$data[] = array($value['id'],ucwords($value['rm_name']));
				}
				echo json_encode($data);
		}

		public function count_due_borrow()
		{
			global $conn;
			$date = date('Y-m-d h:i:s');

			$sql = $conn->prepare('SELECT COUNT(*) as countDue FROM borrow WHERE time_limit < ? AND status = ?');
			$sql->execute(array($date,1));
			$fetch = $sql->fetch();
			echo $fetch['countDue'];
		}


	}

	$display = new display();

	$key = trim($_POST['key']);

	switch ($key) {

		case 'display_room';
		$display->display_room();
		break;

		case 'display_member';
		$display->display_member();
		break;

		case 'display_user';
		$display->display_user();
		break;

		case 'display_roomtype';
		$display->display_roomtype();
		break;

		case 'display_roomtype1';
		$id = $_POST['id'];
		$display->display_roomtype1($id);
		break;

		case 'table_history';
		$display->table_history();
		break;

		case 'dashboard_history';
		$display->dashboard_history();
		break;


		case 'table_dashboard';
		$display->table_dashboard();
		break;

		case 'tbl_member_profile';
		$id = $_POST['id'];
		$display->tbl_member_profile($id);
		break;

		case 'display_rooms';
		$display->display_rooms();
		break;
	}




?>