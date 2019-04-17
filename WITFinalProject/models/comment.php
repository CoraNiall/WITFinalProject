<?php

class comment {

    // we define 3 attributes
    public $id;
    public $date_time;
    public $content;
    public $post_id;
    public $user_id;

    public function __construct($id, $date_time, $content, $post_id) {
      $this->id = $id;
      $this->date_time = $date_time;
      $this->content = $content;
      $this->post_id = $post_id;
      $this->userid = $userid;
    }

    public static function addComment() {
    $db = Db::getInstance();
    $req = $db->prepare("Insert into comment(content, user_id, post_id) values ( :content, user_id, post_id)");
    $req->bindParam(':content', $content);
    $req->bindParam (':user_id' , $user_id);
    $req->bindParam (':post_id', $post_id);
    
// set parameters and execute
    
    if(isset($_POST['content'])&& $_POST['content']!=""){
        $filteredContent = filter_input(INPUT_POST,'content', FILTER_SANITIZE_SPECIAL_CHARS);
    }
$date_time = $filtereddate_time;
$content = $filteredContent;
$user_id = 1;
$post_id = 8;
$req->execute();

    }
}
?>



