<?php
class SearchController extends Controller
{
	public function searchProduct($htmlKeywords)
	{
		$arrayKeywords = explode(" ", $htmlKeywords);
		
		$sql1 = $sql2 = null;
		$sql1 = "
			SELECT * 
			FROM products 
			WHERE 
		";
		foreach($arrayKeywords AS $eachKey)
		{
			$sql2 .= "tags LIKE '%".$eachKey."%' OR ";
		}
		$sql2 = rtrim($sql2, " OR");
		
		$sql_code = $sql1 . $sql2; 
		
		$query = $this->connection->prepare($sql_code);
		
		$query->execute();
		
		$dataList = $query->fetchAll(PDO::FETCH_ASSOC);
		$totalRowSelected = $query->rowCount();
		
		if($totalRowSelected > 0)
			return $dataList;
		else
			return 0;
	}
}

/*
			SELECT * 
			FROM products 
			WHERE 
			    tags LIKE '%key%' OR 
				tags LIKE '%key%' OR 
				tags LIKE '%key%' OR 
				tags LIKE '%key%' OR 
				tags LIKE '%key%' OR 
*/