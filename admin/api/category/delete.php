<?php 
ob_start();
session_start();
require_once '../../data/config.php';
if(isset($_SESSION['wf_id']) && strlen($_SESSION['wf_id']) > 0) // login check
{
	header('Content-Type: application/json');
	 
	  $request = json_decode(file_get_contents('php://input'));
	  try {
		$dbh = new PDO($dsn, $username, $password);
		$active = "N";
		$dt = date('Y-m-d H:i:s');
		/*** echo a message saying we have connected ***/
		/*** INSERT data ***/
        
          $sql = "UPDATE p_categories SET
		  		pc_active = :pc_active,
		  		pc_modified_dt = :pc_modified_dt,
		  		pc_modified_by = :pc_modified_by
				WHERE pc_id = :pc_id";
				
		$stmt = $dbh->prepare($sql);
 
	    $stmt->bindParam(':pc_active', $active);
		$stmt->bindParam(':pc_modified_dt', $dt);
		$stmt->bindParam(':pc_modified_by', $_SESSION['wf_id']);
		// use PARAM_STR although a number
		$stmt->bindParam(':pc_id', $_POST['pc_id']);
		//print_r($stmt); exit;							  
		$stmt->execute(); 
		//$newId = $dbh->lastInsertId();
		//$request = $newId; 
		
		 
		
        echo json_encode('Information deleted successfully!');
		/*** close the database connection ***/
		$dbh = null;
		}
	catch(PDOException $e)
		{
		echo $e->getMessage();
		}
}
else
{
	header('Location: ../index.php?mo=&errmsg=1');
}
?>