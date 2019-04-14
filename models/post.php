<?php
  class Post {

    // we define 3 attributes
    public $id;
    public $title;
    public $content;
    //public $userid;

    public function __construct($id, $title, $content) {
      $this->id    = $id;
      $this->title  = $title;
      $this->content = $content;
      //$this->userid = $userid;
    }

/* This all() function prints out all of the blog posts, which then are printed in the readAll.php page (linked by post_controller.php)*/    
    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM post');
      // we create a list of Post objects from the database results
      foreach($req->fetchAll() as $post) {
        $list[] = new Post($post['id'], $post['title'], $post['content']);
      }
      return $list;
    }

 /* This find($id) function is used to get a specific blog post, used in read.php (linked by post_controller.php)*/
    public static function find($id) {
      $db = Db::getInstance();
      //use intval to make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM post WHERE id = :id');
      //the query was prepared, now replace :id with the actual $id value
      $req->execute(array('id' => $id));
      $post = $req->fetch();
if($post){
      return new Post($post['id'], $post['title'], $post['content']);
    }
    else
    {
        //replace with a more meaningful exception
        throw new Exception('The requested post could not be found.');
    }
    }

    
/*This update($id) function is used to update a blog post, and is used in update.php (linked by post_controller.php)*/    
public static function update($id) {
    $db = Db::getInstance();
    $req = $db->prepare("Update post set title=:title, content=:content where id=:id");
    $req->bindParam(':id', $id);
    $req->bindParam(':title', $title);
    $req->bindParam(':content', $content);

// set title,content,author,postdate,userid parameters and execute
    if(isset($_POST['title'])&& $_POST['title']!=""){
        $filteredTitle = filter_input(INPUT_POST,'title', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if(isset($_POST['content'])&& $_POST['content']!=""){
        $filteredContent = filter_input(INPUT_POST,'content', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    
$title = $filteredTitle;
$content = $filteredContent;

$req->execute();

//upload post image if it exists - think this will need editing to enable multiple pictures?
        if (!empty($_FILES[self::InputKey]['title'])) {
		Post::uploadFile($title);
	}

    }

 /*This add() function is used to add a blog post and, and is used in create.php (linked by post_controller.php)*/
 /*Need to figure out how to autofill user_id, maybe when have sorted out login?*/
    /*For now ADDED user_id into the function and hardcoded the result to marry with our ADMIN user on PK 1 in the database*/
    public static function add() {
    $db = Db::getInstance();
    $req = $db->prepare("Insert into post(title, content, user_id) values (:title, :content, :user_id)");
     $req->bindParam(':title', $title);
    $req->bindParam(':content', $content);
    $req->bindParam (':user_id', $user_id);
    
// set parameters and execute
    if(isset($_POST['title'])&& $_POST['title']!=""){
        $filteredTitle = filter_input(INPUT_POST,'title', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if(isset($_POST['content'])&& $_POST['content']!=""){
        $filteredContent = filter_input(INPUT_POST,'content', FILTER_SANITIZE_SPECIAL_CHARS);
    }
$title = $filteredTitle;
$content = $filteredContent;
$user_id = 1;
$req->execute();

//upload post image
Post::uploadFile($title);
    }
//changed the slashes here from \ to /
    
const AllowedTypes = ['image/jpeg', 'image/jpg'];
const InputKey = 'myUploader';

//die() function calls replaced with trigger_error() calls
//replace with structured exception handling
public static function uploadFile(string $title) { 

	if (empty($_FILES[self::InputKey])) {
		//die("File Missing!");
                trigger_error("File Missing!");
	}

	if ($_FILES[self::InputKey]['error'] > 0) {
		trigger_error("Handle the error! " . $_FILES[self::InputKey]['error']);
	}


	if (!in_array($_FILES[self::InputKey]['type'], self::AllowedTypes)) {
		trigger_error("Handle File Type Not Allowed: " . $_FILES[self::InputKey]['type']);
	}
//changed the $path location  - implfied it to only views/images/
	$tempFile = $_FILES[self::InputKey]['tmp_name'];
        $path = "views/images/";
	$destinationFile = $path . $title . '.jpeg';

	if (!move_uploaded_file($tempFile, $destinationFile)) {
		trigger_error("Handle Error");
	}
		
	//Clean up the temp file
	if (file_exists($tempFile)) {
		unlink($tempFile); 
	}
}




/*The remove($id) function is used to remove blog posts, is used in readAll.php (linked by product_controller)*/
/*Once have started logins, should make accessible to only admins */
public static function remove($id) {
      $db = Db::getInstance();
      //make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('delete FROM post WHERE id = :id');
      // the query was prepared, now replace :id with the actual $id value
      $req->execute(array('id' => $id));
  }
  
}
?>

