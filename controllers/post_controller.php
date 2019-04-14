<?php

class PostController {
    public function readAll() {
      // we store all the posts in a variable
      $posts = Post::all();
      require_once('views/posts/readAll.php');
    }

    public function read() {
      // we expect a url of form ?controller=post&action=show&id=x
      // without an id we just redirect to the error page as we need the post id to find it in the database
      if (!isset($_GET['id']))
        return call('pages', 'error');

      try{
      // we use the given id to get the correct post
      $post = Post::find($_GET['id']);
      require_once('views/posts/read.php');
      }
 catch (Exception $ex){
     return call('pages','error');
 }
    }
    public function create() {
      // we expect a url of form ?controller=post&action=create
      // if it's a GET request display a blank form for creating a new post
      // else it's a POST so add to the database and redirect to readAll action
      if($_SERVER['REQUEST_METHOD'] == 'GET'){
          require_once('views/posts/create.php');
      }
      else { 
            Post::add();
             
            $posts = Post::all(); //$posts is used within the view
            require_once('views/posts/readAll.php');
      }
      
    }
    public function update() {
        
      if($_SERVER['REQUEST_METHOD'] == 'GET'){
          if (!isset($_GET['id']))
        return call('pages', 'error');

        // we use the given id to get the correct post
        $post = Post::find($_GET['id']);
      
        require_once('views/posts/update.php');
        }
      else
          { 
            $id = $_GET['id'];
            Post::update($id);
                        
            $post = Post::all();
            require_once('views/posts/readAll.php');
      }
      
    }
    public function delete() {
            Post::remove($_GET['id']);
            
            $posts = Post::all();
            require_once('views/posts/readAll.php');
      }
      
    }
  
?>