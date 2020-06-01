<?php
class AdminController extends Controller
{
	# FUNCTION FOR LOGIN
	public function tryLogin($username, $password)
	{
		$sql_code = "SELECT * FROM `admins` WHERE `admin_email`=:VALUE1 AND `admin_password`=:VALUE2";
		$query = $this->connection->prepare($sql_code);
		
		$values = array(
			':VALUE1' => $username,
			':VALUE2' => $password
		);
		$query->execute($values);
		
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();
		
		if($totalRowSelected > 0)
			return $dataList;
		else
			return 0;
	}
	
	
	# [C]REATE FUNCTION | INSERT
	public function createAdminData($admin_name, $admin_email, $admin_password, $admin_type, $admin_status)
	{
		# PUT YOUR SQL QUERY IN A VARIABLE
		$sql_code = "
		INSERT INTO `admins` (`admin_name`, `admin_email`, `admin_password`, `admin_type`, `admin_status`, `created_at`) 
		VALUES (:ADMIN_NAME, :ADMIN_EMAIL, :ADMIN_PASSWORD, :ADMIN_TYPE, :ADMIN_STATUS, :CREATED_AT)
		";

		# PREPARE YOUR SQL QUERY
		$query = $this->connection->prepare($sql_code);

		# PUT YOUR VALUES IN A ARRAY
		$values = array(
			':ADMIN_NAME'		=> $admin_name, 
			':ADMIN_EMAIL' 		=> $admin_email, 
			':ADMIN_PASSWORD' 	=> $admin_password,
			':ADMIN_TYPE' 	=> $admin_type,
			':ADMIN_STATUS' 	=> $admin_status,
			':CREATED_AT'	 	=> date("Y-m-d H:i:s")
		);
		# PASS YOUR VALUES IN THE EXECUTE FUNCTION, AND RUN SQL QUERY
		$query->execute($values);

		# COUNT TOTAL ROWS THAT OUR SQL QUERY HAS INSERTED
		$totalRowInserted = $query->rowCount();

		# BRING THE LAST INSERT ID FROM DATABASE
		$lastInsertId = $this->connection->lastInsertId();

			return $totalRowInserted;
	}
	
	
	# [R]EAD FUNCTION | SELECT
	public function listAdminData()
	{
		$sql_code = "SELECT * FROM `admins`";
		$query = $this->connection->prepare($sql_code);
		
		$query->execute();
		
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();
		
		if($totalRowSelected > 0)
			return $dataList;
		else
			return 0;
	}
	

	# [U]PDATE FUNCTION | UPDATE
	public function editAdminData($id, $admin_name, $admin_email, $admin_type, $admin_status)
	{
		# PUT YOUR SQL QUERY IN A VARIABLE
		$sql_code = "
			UPDATE `admins` 
			SET `admin_name`=:ADMIN_NAME,
				`admin_email`=:ADMIN_EMAIL,
				`admin_type`=:ADMIN_TYPE,
				`admin_status`=:ADMIN_STATUS
			WHERE `id` = :ID
		";

		# PREPARE YOUR SQL QUERY
		$query = $this->connection->prepare($sql_code);

		# PUT YOUR VALUES IN A ARRAY
		$values = array(
			':ADMIN_NAME' => $admin_name,
			':ADMIN_EMAIL' => $admin_email,
			':ADMIN_TYPE' => $admin_type,
			':ADMIN_STATUS' => $admin_status,
			':ID' => $id
		);

		# PASS YOUR VALUES IN THE EXECUTE FUNCTION, AND RUN SQL QUERY
		$query->execute($values);

		# COUNT TOTAL ROWS THAT OUR SQL QUERY HAS UPDATED/AFFECTED
		$totalRowUpdated = $query->rowCount();
		
		return $totalRowUpdated;
	}
	
	
	# [D]ELETE FUNCTION | DELETE
	public function deleteAdminData($admin_id)
	{
		# PUT YOUR SQL QUERY IN A VARIABLE
		$sql_code = "DELETE FROM `admins` WHERE id=:ID";

		# PREPARE YOUR SQL QUERY
		$query = $this->connection->prepare($sql_code);

		# PUT YOUR VALUES IN A ARRAY
		$values = array(
			':ID' => $admin_id
		);

		# PASS YOUR VALUES IN THE EXECUTE FUNCTION, AND RUN SQL QUERY
		$query->execute($values); 

		# COUNT TOTAL ROWS THAT OUR SQL QUERY HAS DELETED
		$deletedRowNumber = $query->rowCount();
		
			return $deletedRowNumber;
	}
	
	
	# ADMIN STATUS CHANGE | UPDATE
	public function changeAdminStatus($admin_id, $current_status)
	{
		# PUT YOUR SQL QUERY IN A VARIABLE
		if($current_status == "Active")
			$sql_code = "UPDATE `admins` SET `admin_status`='Inactive' WHERE `id` = :ID";
		else if($current_status == "Inactive")
			$sql_code = "UPDATE `admins` SET `admin_status`='Active' WHERE `id` = :ID";

		# PREPARE YOUR SQL QUERY
		$query = $this->connection->prepare($sql_code);

		# PUT YOUR VALUES IN A ARRAY
		$values = array(
			':ID' => $admin_id
		);

		# PASS YOUR VALUES IN THE EXECUTE FUNCTION, AND RUN SQL QUERY
		$query->execute($values);

		# COUNT TOTAL ROWS THAT OUR SQL QUERY HAS UPDATED/AFFECTED
		$totalRowUpdated = $query->rowCount();
		
			return $totalRowUpdated;
	}
	
	
	# GET SINGLE ADMIN DATA | SELECT
	public function getAdminData($admin_id)
	{
		$sql_code = "SELECT * FROM `admins` WHERE `id`=:ID";
		$query = $this->connection->prepare($sql_code);
		
		$values = array(
			':ID' => $admin_id
		);
		$query->execute($values);
		
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();
		
		if($totalRowSelected > 0)
			return $dataList;
		else
			return 0;
	}
	
}
