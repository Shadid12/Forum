<?php 
/**This class has the behaviour of category
*  Created by group 16 
*  UOIT WEB PROGRAMING FINAL ASSIGNMENT
*  
*/
class CatController
{
	private $cid;
	
	public function CatController($id){
		$this->cid = $id;
	}

	// This function finds the topics in this Category object
	public function getTopics(){
		include 'core/connect.php';
		
		//do a query for the topics
		$sql = "SELECT topic_id, topic_subject, topic_date, topic_cat
				FROM topics
				WHERE topic_cat = " . $this->cid;

		$result = mysql_query($sql);

		return $result;
	}

	// This function gets the Category name
	public function getName(){
		include 'core/connect.php';

		$sql = "SELECT cat_name
				FROM categories
				WHERE cat_id = " . $this->cid;

		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		return $row['cat_name'];

	}

}


 ?>