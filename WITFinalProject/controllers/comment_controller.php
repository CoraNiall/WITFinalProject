<?php

class commentController {
  
    public function createComment() {
      // we expect a url of form ?controller=post&action=create
      // if it's a GET request display a blank form for creating a new post
      if($_SERVER['REQUEST_METHOD'] == 'GET'){
          require_once('views/posts/read.php');
      }
      else { 
          comment::addComment();
          

      }
             

    }
    }
