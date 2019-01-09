<?php
include 'db_loginPDO.php';
class SQLQuery{
	private $sql;
	private $stmt;
	public $queryResult=array();
	public $row=array();

	function startUserLoginQuery($e, $p){
		$this->sql = "SELECT * FROM userinfo WHERE username=\"$e\"";
		//echo $this->sql;
		global $conn;
		$stmt=$conn->prepare($this->sql);
		$stmt->execute();
		$this->row=$stmt->fetch();
		return $this->row;
	}

	function searchSubjectList(){
		$this->sql = "SELECT * FROM subject order by subject_code";
		$this->row=$this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function searchPopularPost($catchVisit, $start, $numberOfTopRows){
		$this->sql="SELECT postinfo.pid, postinfo.post_title, categroies.catid, categroies.catname, userinfo.uid, userinfo.username, postinfo.post_numberOfvisits
			FROM postinfo, userinfo, categroies
			WHERE postinfo.catid = categroies.catid
			AND postinfo.uid = userinfo.uid";
		//var_dump($this->sql);
		$this->row=$this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function searchComments($sub){
		$this->sql = "SELECT * FROM comments, subject WHERE subject.sid=comments.sid AND subject_code=$sub";
		$this->row=$this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function searchSubjectDetail($sub){
		$this->sql = $sql = "SELECT * FROM subject, comments WHERE subject_code=\"$sub\" AND comments.sid=subject.sid
							order by comment_datetime desc";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function showSubjectInformation($sCode){
		$this->sql = "SELECT * FROM subject WHERE subject_code=\"$sCode\"";
		$this->row=$this->goFetchALLWithASSOC($this->sql);
		return $this->row;		
	}

	function distinctCategory($item, $tableName){
		$this->sql = "SELECT DISTINCT ". $item . " FROM " . $tableName;
		//var_dump($this->sql);
		$this->row=$this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function goFetchALLWithASSOC($query){
		global $conn;
		$s=$conn->query($query);
		return $s->fetchALL(PDO::FETCH_ASSOC);
	}

	function filterSubjectList($ls, $sc, $sl){
		$this->sql = "SELECT * FROM subject WHERE ";
		if($ls!==""){
			$this->sql.="subject_language = '$ls'";
			if ($sc!=="" or $sl!=="") $this->sql.=" AND ";
		}
		if($sc!==""){
			$this->sql.="subject_categories = '$sc'";
			if ($sl!=="") $this->sql.=" AND ";
		}
		if($sl!==""){
			$this->sql.="subject_level = '$sl'";
		}
		$this->sql.=" order by subject_code";
		$this->row=$this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function writeCommentToTable($array){
		//var_dump($array);
		$datetime = date("Y-m-d h:i:sa");
		global $conn;
		$this->stmt = $conn->prepare("INSERT INTO comments(
		sid, tutorName, year_finished, grades, workload, comment_group_project, comment_assignment, 
		comment_test, comment_exam, comment_identity, comment_datetime, comments_content) 
		VALUES(
		:sid, :tutorName, :year_finished, :grades, :workload, :comment_group_project,
		:comment_assignment, :comment_test, :comment_exam, :comment_identity, :comment_datetime,
		:comments_content)");
		//$this->stmt -> bindParam(':cid', "");
		$this->stmt -> bindParam(':sid', $array["commtSid"]);
		$this->stmt -> bindParam(':tutorName', $array['commtTutor']);
		$this->stmt -> bindParam(':year_finished', $array['commtSem']);
		$this->stmt -> bindParam(':grades', $array['commtGrade']);
		$this->stmt -> bindParam(':workload', $array['commtWorkload']);
		$this->stmt -> bindParam(':comment_group_project', $array['commtGP']);
		$this->stmt -> bindParam(':comment_assignment', $array['commtAssign']);
		$this->stmt -> bindParam(':comment_test', $array['commtTest']);
		$this->stmt -> bindParam(':comment_exam', $array['commtExam']);
		$this->stmt -> bindParam(':comment_identity', $array['identity']);
		$this->stmt -> bindParam(':comment_datetime', $datetime);
		$this->stmt -> bindParam(':comments_content', $array['commtContent']);
		$this->stmt -> execute();
	}
}


class loginUser{
	private $username;
	private $password;
	public $result=array();

	function getUserName($a, $b){
		$this->username=$a;
		$this->password=$b;
		$userQuery = new SQLQuery();
		$this->result=$userQuery->startUserLoginQuery($this->username, $this->password);
		//var_dump($this->result);
	}
}



class post{
	private $sql;
	private $stmt;
	private $row=array();

	function getCategories($filterOn, $filter){
		$this->sql="SELECT * FROM categroies";
		if($filterOn==true)
			$this->sql = $this->sql ." WHERE grouping='".$filter."'"; 
		$this->row=$this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function getPostInfo($check, $postCatid){
		if($check==true)
			$this->sql="SELECT * FROM postinfo,userinfo WHERE 
		     postinfo.uid = userinfo.uid AND postinfo.catid=\"$postCatid\"";
		else $this->sql="SELECT * FROM postinfo";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function listPostBaseOnRequest($catOn, $catid, $orderItem){
		$this->sql="SELECT * FROM postinfo, userinfo
			WHERE postinfo.uid = userinfo.uid";
		if($catOn)
			$this->sql.=" AND postinfo.catid=\"$catid\"";
		if($orderItem!="likes")
			$this->sql.=" ORDER BY $orderItem desc";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		for($i=0; $i<sizeof($this->row); $i++){
			$likes[$i] = $this->getLikeCouting($this->row[$i]['pid'], 1);
			if(isset($likes[$i][0]["count(likeId)"]))
				$this->row[$i]['like']=(int)$likes[$i][0]["count(likeId)"];
			else
				$this->row[$i]['like']=0;
			$repliesNumber[$i] = $this->getRepliesCounting($this->row[$i]['pid']);
			if(isset($repliesNumber[$i][0]["count(rid)"]))
				$this->row[$i]['repliesNumber']=(int)$repliesNumber[$i][0]["count(rid)"];
			else
				$this->row[$i]['repliesNumber']=0;	
			$firstContent[$i] = $this->getFirstPost($this->row[$i]['pid']);
			if(isset($firstContent[$i][0]['content']))
				$this->row[$i]['content']=$firstContent[$i][0]['content'];
		}
		return $this->row;
	}

	function listReplies($pid){
		$this->sql="SELECT * from replies, userinfo WHERE userinfo.uid = replies.uid AND pid=\"$pid\" order by replies_datetime";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function getLikeCouting($pid, $rid){
		$likeSql="SELECT count(likeId) FROM reply_like WHERE pid=\"$pid\" AND rid=\"$rid\" GROUP BY pid, rid";
		$likeRow = $this->goFetchALLWithASSOC($likeSql);
		return $likeRow;
	}

	function getRepliesCounting($pid){
		$repliesSql="SELECT count(rid) FROM replies WHERE pid=\"$pid\" GROUP BY pid";
		$repliesRow = $this->goFetchALLWithASSOC($repliesSql);
		return $repliesRow;		
	}

	function getFirstPost($pid){
		$fisrtPostSql="SELECT content FROM replies WHERE pid=\"$pid\" AND rid=1";
		$fisrtPostRow = $this->goFetchALLWithASSOC($fisrtPostSql);
		return $fisrtPostRow;			
	}

	function checkLiked($pid, $rid, $uid){
		$this->sql = "SELECT * FROM reply_like WHERE pid=\"$pid\" AND rid=\"$rid\" AND uid=\"$uid\"";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		if(!empty($this->row)){
			return true;
		}else
			return false;
	}

	function updateLike($pid, $rid, $uid){
		global $conn;
		$this->stmt = $conn->prepare("INSERT INTO reply_like(pid, rid, uid) VALUES(:pid, :rid, :uid)");
		$this->stmt -> bindParam(':pid', $pid);
		$this->stmt -> bindParam(':rid', $rid);
		$this->stmt -> bindParam(':uid', $uid);
		$this->stmt -> execute();
	}

	function deleteLike($pid, $rid, $uid){
		global $conn;
		$this->stmt = $conn->prepare("DELETE FROM reply_like WHERE pid=:pid AND rid=:rid AND uid=:uid");
		$this->stmt -> bindParam(':pid', $pid);
		$this->stmt -> bindParam(':rid', $rid);
		$this->stmt -> bindParam(':uid', $uid);
		$this->stmt -> execute();		
	}

	function updateVisit($pid){
		global $conn;
		$this->stmt = $conn->prepare("UPDATE postinfo SET post_numberOfvisits = 
			post_numberOfvisits+1 WHERE pid=:pid");
		$this->stmt -> bindParam(':pid', $pid);
		$this->stmt -> execute();	
	}

	function submitReplies($pid, $uid, $content, $rid){
		global $conn;
		if($rid==0){
			$this->sql = "SELECT MAX(rid) FROM replies WHERE pid=\"$pid\"";
			$this->row = $this->goFetchALLWithASSOC($this->sql);
			$newRid = $this->row[0]["MAX(rid)"];
			$newRid++;
		}else{
			$newRid = $rid;
		}
		$this->stmt = $conn->prepare("INSERT INTO replies(pid, uid, content, rid) VALUES(:pid, :uid, :content, :rid)");
		$this->stmt -> bindParam(':pid', $pid);
		$this->stmt -> bindParam(':uid', $uid);
		$this->stmt -> bindParam(':rid', $newRid);
		$this->stmt -> bindParam(':content', $content);
		$this->stmt -> execute();
	}

	function uploadPost($uid, $catId, $title, $content){
		global $conn;
		$this->stmt = $conn->prepare("INSERT INTO postinfo(uid, catid, post_title) VALUES(:uid, :catId, :title)");
		$this->stmt -> bindParam(':uid', $uid);
		$this->stmt -> bindParam(':catId', $catId);
		$this->stmt -> bindParam(':title', $title);
		$this->stmt -> execute();
		$this->sql = "SELECT MAX(pid) FROM postinfo";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		$this->submitReplies($this->row[0]["MAX(pid)"], $uid, $content, 1);
	}

	function goFetchALLWithASSOC($query){
		global $conn;
		$s=$conn->query($query);
		return $s->fetchALL(PDO::FETCH_ASSOC);
	}
}

class admin{
	private $sql;
	private $stmt;
	public $queryResult=array();
	public $row=array();
	private $temp;
	function userList(){
		$this->sql = "SELECT * FROM userinfo";
		$this->row= $this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function postList(){
		$this->sql = "SELECT * FROM postinfo, userinfo, categroies
						WHERE postinfo.uid = userinfo.uid
						AND categroies.catid = postinfo.catid";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function repliesList(){
		$this->sql = "SELECT * FROM replies, userinfo, postinfo
						WHERE replies.uid = userinfo.uid
						AND replies.pid = postinfo.pid";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function subjectList(){
		$this->sql = "SELECT * FROM subject";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;		
	}

	function commentList(){
		$this->sql = "SELECT * FROM comments, subject
						WHERE comments.sid = subject.sid";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function likeList(){
		$this->sql = "SELECT * FROM reply_like";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function adminAction($d, $array){
		global $conn;
		$temp=1;
		$this->sql = "SELECT * FROM userinfo WHERE uid=\"$array[0]\"";
		$this->row = $this->goFetchALLWithASSOC($this->sql);

		$this->sql = "INSERT INTO logbook(target_table, action, ";// VALUES('userinfo', 'update', ";
		
		for($i=1; $i<=sizeof($this->row[0]); $i++){
			$this->sql = $this->sql."col".$temp++.", ";
		}

		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .=") VALUES('userinfo', 'update', ";
		foreach($this->row[0] as $value){
			$this->sql = $this->sql . "'$value'" . ", ";
		}
		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .= ")";
		$s = $conn->query($this->sql); 

		$this->stmt = $conn->prepare("UPDATE userinfo SET username=:uname, user_password=:upassword, 
					sex=:usex, email=:uemail, user_datatime=:udatetime WHERE uid=:uid");
		$this->stmt -> bindParam(':uname', $array[2]);
		$this->stmt -> bindParam(':upassword', $array[4]);
		$this->stmt -> bindParam(':usex', $array[6]);
		$this->stmt -> bindParam(":uemail", $array[8]);
		$this->stmt -> bindParam(":udatetime", $array[10]);
		$this->stmt -> bindParam(":uid", $array[0]);
		$this->stmt -> execute();
	}

	function userDelete($d, $array){
		global $conn;
		$temp=1;
		$this->sql = "SELECT * FROM userinfo WHERE uid=\"$array[0]\"";
		$this->row = $this->goFetchALLWithASSOC($this->sql);

		$this->sql = "INSERT INTO logbook(target_table, action, ";// VALUES('userinfo', 'update', ";	
		for($i=1; $i<=sizeof($this->row[0]); $i++){
			$this->sql = $this->sql."col".$temp++.", ";
		}
		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .=") VALUES('userinfo', 'delete', ";
		foreach($this->row[0] as $value){
			$this->sql = $this->sql . "'$value'" . ", ";
		}
		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .= ")";
		$s = $conn->query($this->sql); 

		$this->sql = "DELETE FROM userinfo WHERE uid=\"$array[0]\"";
		$conn->query($this->sql);
	}

	function subjectUpdate($d, $array){
		global $conn;
		$temp=1;
		$this->sql = "SELECT * FROM subject WHERE sid=\"$array[0]\"";
		$this->row = $this->goFetchALLWithASSOC($this->sql);

		$this->sql = "INSERT INTO logbook(target_table, action, ";
		
		for($i=1; $i<=sizeof($this->row[0]); $i++){
			$this->sql = $this->sql."col".$temp++.", ";
		}

		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .=") VALUES('subject', 'update', ";
		foreach($this->row[0] as $value){
			$this->sql = $this->sql . "'$value'" . ", ";
		}
		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .= ")";
		$s = $conn->query($this->sql); 

		$this->stmt = $conn->prepare("UPDATE subject SET subject_code=:sc, subject_name=:sn, 
					subject_subgroup=:sg, subject_categories=:scg, subject_level=:sl, subject_language=:slg WHERE sid=:sid");
		$this->stmt -> bindParam(':sc', $array[2]);
		$this->stmt -> bindParam(':sn', $array[4]);
		$this->stmt -> bindParam(':sg', $array[6]);
		$this->stmt -> bindParam(":scg", $array[8]);
		$this->stmt -> bindParam(":sl", $array[10]);
		$this->stmt -> bindParam(":slg", $array[12]);
		$this->stmt -> bindParam(":sid", $array[0]);
		$this->stmt -> execute();		
	}

	function subjectDelete($d, $array){
		global $conn;
		$temp=1;
		$this->sql = "SELECT * FROM subject WHERE sid=\"$array[0]\"";
		$this->row = $this->goFetchALLWithASSOC($this->sql);

		$this->sql = "INSERT INTO logbook(target_table, action, ";// VALUES('userinfo', 'update', ";	
		for($i=1; $i<=sizeof($this->row[0]); $i++){
			$this->sql = $this->sql."col".$temp++.", ";
		}
		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .=") VALUES('subject', 'delete', ";
		foreach($this->row[0] as $value){
			$this->sql = $this->sql . "'$value'" . ", ";
		}
		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .= ")";
		$s = $conn->query($this->sql); 

		$this->sql = "DELETE FROM subject WHERE sid=\"$array[0]\"";
		$conn->query($this->sql);
	}

	function repliesUpdate($d, $array){
		global $conn;
		$temp=1;
		$this->sql = "SELECT * FROM replies WHERE replies_id=\"$array[0]\"";
		$this->row = $this->goFetchALLWithASSOC($this->sql);

		$this->sql = "INSERT INTO logbook(target_table, action, ";
		
		for($i=1; $i<=sizeof($this->row[0]); $i++){
			$this->sql = $this->sql."col".$temp++.", ";
		}

		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .=") VALUES('replies', 'update', ";
		foreach($this->row[0] as $value){
			$this->sql = $this->sql . "'$value'" . ", ";
		}
		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .= ")";
		$s = $conn->query($this->sql); 

		$this->stmt = $conn->prepare("UPDATE replies SET content=:content WHERE replies_id=:rid");
		$this->stmt -> bindParam(":content", $array[6]);
		$this->stmt -> bindParam(":rid", $array[0]);
		$this->stmt -> execute();		
	}

	function repliesDelete($d, $array){
		global $conn;
		$temp=1;
		$this->sql = "SELECT * FROM replies WHERE replies_id=\"$array[0]\"";
		$this->row = $this->goFetchALLWithASSOC($this->sql);

		$this->sql = "INSERT INTO logbook(target_table, action, ";// VALUES('userinfo', 'update', ";	
		for($i=1; $i<=sizeof($this->row[0]); $i++){
			$this->sql = $this->sql."col".$temp++.", ";
		}
		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .=") VALUES('replies', 'delete', ";
		foreach($this->row[0] as $value){
			$this->sql = $this->sql . "'$value'" . ", ";
		}
		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .= ")";
		$s = $conn->query($this->sql); 

		$this->sql = "DELETE FROM replies WHERE replies_id=\"$array[0]\"";
		$conn->query($this->sql);
	}

	function commentsUpdate($d, $array){
		global $conn;
		$temp=1;
		$this->sql = "SELECT * FROM comments WHERE cid=\"$array[0]\"";
		$this->row = $this->goFetchALLWithASSOC($this->sql);

		$this->sql = "INSERT INTO logbook(target_table, action, ";
		
		for($i=1; $i<=sizeof($this->row[0]); $i++){
			$this->sql = $this->sql."col".$temp++.", ";
		}

		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .=") VALUES('comments', 'update', ";
		foreach($this->row[0] as $value){
			$this->sql = $this->sql . "'$value'" . ", ";
		}
		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .= ")";
		$s = $conn->query($this->sql); 

		$this->stmt = $conn->prepare("UPDATE comments SET tutorName=:tn, comments_content=:content WHERE cid=:cid");
		$this->stmt -> bindParam(":tn", $array[6]);
		$this->stmt -> bindParam(":content", $array[8]);
		$this->stmt -> bindParam(":cid", $array[0]);
		$this->stmt -> execute();		
	}

	function commentsDelete($d, $array){
		global $conn;
		$temp=1;
		$this->sql = "SELECT * FROM comments WHERE cid=\"$array[0]\"";
		$this->row = $this->goFetchALLWithASSOC($this->sql);

		$this->sql = "INSERT INTO logbook(target_table, action, ";// VALUES('userinfo', 'update', ";	
		for($i=1; $i<=sizeof($this->row[0]); $i++){
			$this->sql = $this->sql."col".$temp++.", ";
		}
		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .=") VALUES('comments', 'delete', ";
		foreach($this->row[0] as $value){
			$this->sql = $this->sql . "'$value'" . ", ";
		}
		$this->sql = substr($this->sql, 0, strlen($this->sql)-2);
		$this->sql .= ")";
		$s = $conn->query($this->sql); 

		$this->sql = "DELETE FROM comments WHERE cid=\"$array[0]\"";
		$conn->query($this->sql);
	}

	function addNewCourse($array){
		global $conn;
		$this->stmt = $conn->prepare("SELECT subject_code FROM subject WHERE subject_code=:subjectCode");
		$this->stmt -> bindParam(':subjectCode', $array['scode']);
		$this->stmt ->execute();
		$result = $this->stmt->fetchALL(PDO::FETCH_ASSOC);
		if(sizeof($result)<=0){
			$this->stmt = $conn->prepare("INSERT INTO subject(subject_code, subject_name, subject_categories, subject_subgroup, subject_level, subject_language) VALUES(:sc, :sn, :scg, :ssg, :sl, :slg)");
			$this->stmt -> bindParam(':sc', $array['scode']);
			$this->stmt -> bindParam(':sn', $array['sname']);
			$this->stmt -> bindParam(':scg', $array['scategories']);
			$this->stmt -> bindParam(':ssg', $array['ssubject']);
			$this->stmt -> bindParam(':sl', $array['slevel']);
			$this->stmt -> bindParam(':slg', $array['slanguage']);
			$this->stmt -> execute();
		}else{
			$_SESSION['msg']="Depulicated Subject Code! PLEASE have a Check!";
		}
	}

	function footprintComment($id){
		$this->sql = "SELECT * FROM comments, subject  WHERE comments.sid = subject.sid AND comment_identity=\"$id\"";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function footprintReplies($id){
		$this->sql = "SELECT * FROM replies, postinfo, userinfo WHERE replies.uid = userinfo.uid 
						AND replies.pid = postinfo.pid and replies.uid=\"$id\"";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function footprintLike($id){
		$this->sql = "SELECT * FROM postinfo, reply_like, replies, userinfo WHERE
						postinfo.pid = reply_like.pid AND reply_like.rid = replies.rid 
						AND reply_like.uid = userinfo.uid AND replies.pid = postinfo.pid AND reply_like.uid = \"$id\"";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;	
	}

	function footpinrtPost($id){
		$this->sql = "SELECT * FROM postinfo, replies, userinfo WHERE postinfo.pid = replies.pid AND replies.rid=1 AND userinfo.uid = postinfo.uid AND postinfo.uid = replies.uid AND userinfo.uid=\"$id\"";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;	
	}

	function requestReplies(){
		$this->sql = "SELECT * FROM replies, postinfo, userinfo WHERE postinfo.pid = replies.pid AND replies.uid = userinfo.uid";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function requestComments(){
		$this->sql = "SELECT * FROM comments, subject WHERE comments.sid = subject.sid";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function requestSubjects(){
		$this->sql = "SELECT * FROM subject";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function logbookRequest($table){
		$this->sql = "SELECT * FROM logbook WHERE target_table=\"$table\"";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function showColumn($table){
		$this->sql = "SHOW columns FROM $table";
		$this->row = $this->goFetchALLWithASSOC($this->sql);
		return $this->row;
	}

	function recovery($array){
		//var_dump($array);
		if($array[1]=="update"){
			$takeInsert = false;
		}elseif($array[1]=="delete"){
			$takeInsert = true;
		}
		$this->sql = "INSERT INTO userinfo VALUES($array[2]";
		for($i=3; $i<sizeof($array); $i++){
			$this->sql.= " ," . $array[$i];
		}
		var_dump($this->sql);
	}

	function goFetchALLWithASSOC($query){
		global $conn;
		$s=$conn->query($query);
		return $s->fetchALL(PDO::FETCH_ASSOC);
	}	
}
/*
$getSubjectList = new SQLQuery();
$subjectTable="subject";
$subjectCategory = $getSubjectList->distinctCategory("subject_categories", $subjectTable);
var_dump($subjectCategory);

$loginCurrentUser = new loginUser();
$loginCurrentUser->getUsername("admin","123");
echo $loginCurrentUser->result["uid"];
*/
?>