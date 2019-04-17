<?php

class DB {
    
    private static $instance = NULL;

    //Singleton Design Pattern
    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        //db name has been changed to be more reflective of the project
        self::$instance = new PDO('mysql:host=localhost;dbname=mvc_witblog', 'root', '', $pdo_options);
      }
      return self::$instance;
    }
}
