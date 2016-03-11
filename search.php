<?php 
//check the string is not empty 
if(strlen($_POST['queryString']) > 0 && $_POST['queryString'] !== " "){
	
	//make sure string only has alphanumeric characters only
	$searchString = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['queryString']);
	
	//add % to the end of the string for use with MySql LIKE
	$queryString = $searchString ."%"; 
	try{
		//connect to db
		$conn = new PDO('mysql:host=localhost;dbname=locations', 'user', 'password');
		//set errors to on for debug
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//prepare the query
		$stmt = $conn->prepare("SELECT DISTINCT name FROM cities WHERE name LIKE :queryString LIMIT 20");
		$stmt->bindParam(':queryString', $queryString);
		try{	
			if($stmt->execute()){
				//get all results
				$result = $stmt->fetchAll();
				
				//loop and output results
				foreach($result as $row){
					echo "<li>".$row['name']."</li>";
				}
				
				//if no results
				if(count($result) === 0){
					echo "<li>Sorry no results found.</li>";
				}
				
			}else{
				throw new Exception("Unable to run query on the database.<br>");
			}
		}catch (Exception $e){
			echo $e->getMessage(); 
		}	
			
		//close db connection
		$conn->connection = null;	
		
	}catch (PDOException $e) {
		echo "Error, can not connect to database: " . $e->getMessage();
		die();
	}
}	
?>