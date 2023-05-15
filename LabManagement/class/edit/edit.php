<?php
	require_once "../config/config.php";

	// 1 == success
	// 2 == exist
	// 0 == failed
	
	/**
	* 
	*/
	class edit
	{
		
		public function edit_room($edit_rm_name,$edit_rm_id)
		{
			global $conn;

			session_start();
			$h_tbl = 'room';
			$sessionid = $_SESSION['admin_id'];
			$sessiontype = $_SESSION['admin_type'];

			$ab = $conn->prepare("SELECT * FROM room WHERE id = ? ");
			$ab->execute(array($edit_rm_id));
			$fetchab = $ab->fetch();

			$check = $conn->prepare("SELECT * FROM room WHERE rm_name = ? ");
			$check->execute(array($edit_rm_name));
			$check_fetch = $check->fetch();
			$check_row = $check->rowCount();

			$h_desc = 'edit room '.$fetchab['rm_name'].' to '. $edit_rm_name;

			if($check_row <= 0){

				$sql = $conn->prepare('UPDATE room SET rm_name = ? WHERE id = ?;
										INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
				$sql->execute(array($edit_rm_name,$edit_rm_id,$h_desc,$h_tbl,$sessionid,$sessiontype));
				$count = $sql->rowCount();
				if($count > 0){
					echo "1";
				}else{
					echo "0";
				}

			}else{
				echo '2';
			}

		}

		public function edit_member($sid_number,$fname,$lname,$s_gender,$s_contact,$s_department,$s_type,$yrs,$app_id)
		{

			global $conn;

			session_start();
			$h_desc = 'edit client';
			$h_tbl = 'client';
			$sessionid = $_SESSION['admin_id'];
			$sessiontype = $_SESSION['admin_type'];


			$sql = $conn->prepare('UPDATE member SET m_school_id = ?, m_fname = ?, m_lname = ?, m_gender = ?, m_contact = ?, m_department = ?, m_year_section = ?, m_type = ? WHERE id = ?;
									INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
			$sql->execute(array($sid_number,$fname,$lname,$s_gender,$s_contact,$s_department,$yrs,$s_type,$app_id,$h_desc,$h_tbl,$sessionid,$sessiontype));
			$row = $sql->rowCount();
			echo $row;
		}

		public function activate_member($id)
		{
			global $conn;

			session_start();
			$h_desc = 'activate client';
			$h_tbl = 'client';
			$sessionid = $_SESSION['admin_id'];
			$sessiontype = $_SESSION['admin_type'];

			$sql = $conn->prepare('UPDATE member SET m_status = ? WHERE id = ?;
									INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
			$sql->execute(array(1,$id,$h_desc,$h_tbl,$sessionid,$sessiontype));
			$row = $sql->rowCount();
			echo $row;
		}

		public function deactivate_member($id)
		{
			global $conn;

			session_start();
			$h_desc = 'deactivate client';
			$h_tbl = 'client';
			$sessionid = $_SESSION['admin_id'];
			$sessiontype = $_SESSION['admin_type'];

			$sql = $conn->prepare('UPDATE member SET m_status = ? WHERE id = ?;
									INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
			$sql->execute(array(0,$id,$h_desc,$h_tbl,$sessionid,$sessiontype));
			$row = $sql->rowCount();
			echo $row;
		}


		public function activate_user($id)
		{
			global $conn;

			session_start();
			$h_desc = 'activate user';
			$h_tbl = 'user';
			$sessionid = $_SESSION['admin_id'];
			$sessiontype = $_SESSION['admin_type'];

			$sql = $conn->prepare('UPDATE user SET status = ? WHERE id = ?;
									INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
			$sql->execute(array(1,$id,$h_desc,$h_tbl,$sessionid,$sessiontype));
			$row = $sql->rowCount();
			echo $row;
		}

		public function deactivate_user($id)
		{
			global $conn;

			session_start();
			$h_desc = 'deactivate user';
			$h_tbl = 'user';
			$sessionid = $_SESSION['admin_id'];
			$sessiontype = $_SESSION['admin_type'];

			$sql = $conn->prepare('UPDATE user SET status = ? WHERE id = ?;
									INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
			$sql->execute(array(0,$id,$h_desc,$h_tbl,$sessionid,$sessiontype));
			$row = $sql->rowCount();
			echo $row;
		}


		public function edit_user($u_fname,$u_username,$u_type,$u_id)
		{
			global $conn;

			session_start();
			$h_desc = 'edit user';
			$h_tbl = 'user';
			$sessionid = $_SESSION['admin_id'];
			$sessiontype = $_SESSION['admin_type'];

			$sql = $conn->prepare('UPDATE user SET name = ?, username = ?, type = ? WHERE id = ?;
									INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
			$sql->execute(array($u_fname,$u_username,$u_type,$u_id,$h_desc,$h_tbl,$sessionid,$sessiontype));
			$count = $sql->rowCount();
			echo $count;
		}

		public function changepassword($n_pass,$u_id)
		{
			global $conn;

			session_start();
			$h_desc = 'change user password';
			$h_tbl = 'user';
			$sessionid = $_SESSION['admin_id'];
			$sessiontype = $_SESSION['admin_type'];

			$sql = $conn->prepare('UPDATE user SET password = ? WHERE id = ?;
									INSERT INTO history_logs(description,table_name,user_id,user_type) VALUES(?,?,?,?)');
			$sql->execute(array($n_pass,$u_id,$h_desc,$h_tbl,$sessionid,$sessiontype));
			$count = $sql->rowCount();
			echo $count;
		}



		public function cancel_reservation($remarks_cancel,$codereserve)
		{
			global $conn;

			session_start();
			$h_desc = 'cancel client reservation';
			$h_tbl = 'reservation';
			$sessionid = $_SESSION['admin_id'];
			$sessiontype = $_SESSION['admin_type'];

			$sql = $conn->prepare('UPDATE reservation SET status = ? WHERE reservation_code = ?');
			$sql->execute(array(2,$codereserve));
			$row = $sql->rowCount();
			if($row > 0){
				$add = $conn->prepare('INSERT INTO reservation_status (reservation_code, remark, res_status) VALUES(?,?,?)');
				$add->execute(array($codereserve,$remarks_cancel,2));
				$addrow = $add->rowCount();

				echo $addrow;
			}
		}

		public function transfer_item()
		{
			global $conn;

			session_start();
			$sessionid = $_SESSION['admin_id'];

			$room = $_POST['transfer_room'];
			$id= $_POST['id'];
			$number= $_POST['number_items'];
			$personincharge= $_POST['personincharge'];
			
			$sql = $conn->prepare('SELECT * FROM item_stock WHERE id = ?');
			$sql->execute(array($id));
			$count = $sql->rowCount();
			$fetch = $sql->fetch();
			$itemID = $fetch['item_id'];
			$itemstock = $fetch['items_stock'];
			$stockID = $id;

				if($count > 0){
					if($number > $itemstock){
						echo "Maximum number of stock to be transfer is ".$itemstock;
					}else{
						$insert = $conn->prepare('INSERT INTO item_transfer(t_itemID, t_roomID, t_stockID, t_quantity, personincharge, userid) VALUES(?,?,?,?,?,?)');
						$insert->execute(array($itemID,$room,$stockID,$number,$personincharge,$sessionid));
						$row = $insert->rowCount();
						if($row > 0){
							$update = $conn->prepare('UPDATE item_stock SET items_stock = (items_stock - ?) WHERE id = ?');
							$update->execute(array($number,$id));
							$updateCount = $update->rowCount();
							if($updateCount > 0){
								echo "Succesfully transferred";
							}
						}
					}
				}

			
		}
	}

	$edit = new edit();


	$key = trim($_POST['key']);

	switch ($key) {

		case 'edit_room';
		$edit_rm_name = strtolower($_POST['edit_rm_name']);
		$edit_rm_id = $_POST['edit_rm_id'];
		$edit->edit_room($edit_rm_name,$edit_rm_id);
		break;

		case 'edit_member';
		$sid_number = $_POST['sid_number'];
		$fname = $_POST['s_fname'];
		$lname = $_POST['s_lname'];
		$s_gender = $_POST['s_gender'];
		$s_contact = $_POST['s_contact'];
		$s_department = $_POST['s_department'];
		$yrs = $_POST['s_year'].'-'.$_POST['s_section'];
		$app_id = $_POST['app_id'];
		$s_type = $_POST['s_type'];
		$edit->edit_member($sid_number,$fname,$lname,$s_gender,$s_contact,$s_department,$s_type,$yrs,$app_id);
		break;

		case 'activate_member';
		$id = $_POST['id'];
		$edit->activate_member($id);
		break;

		case 'deactivate_member';
		$id = $_POST['id'];
		$edit->deactivate_member($id);
		break;

		case 'activate_user';
		$id = $_POST['id'];
		$edit->activate_user($id);
		break;

		case 'deactivate_user';
		$id = $_POST['id'];
		$edit->deactivate_user($id);
		break;

		case 'edit_user';
		$u_fname = $_POST['u_fname'];
		$u_username = $_POST['u_username'];
		$u_type = $_POST['u_type'];
		$u_id = $_POST['u_id'];
		$edit->edit_user($u_fname,$u_username,$u_type,$u_id);
		break;

		case 'changepassword';
		$n_pass = trim(md5($_POST['n_pass']));
		$u_id = $_POST['u_id'];
		$edit->changepassword($n_pass,$u_id);
		break;
	}