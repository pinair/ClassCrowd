<?php
/**
 * Created by IntelliJ IDEA.
 * User: riccardosibani
 * Date: 01/10/15
 * Time: 16:25
 */
include_once 'DbFunction.php';

session_start();

if(!empty($_POST['newLesson'])){

    // Update Database
    $connection = Database::getConnection();

    $lesson_name = htmlspecialchars($_POST['newLesson']);
    
    $query = "INSERT INTO lesson (title, subject_id, user_id) VALUES ('" . $lesson_name.
        "', " . $_POST['subject_id'] . ", " . $_COOKIE['id'] . ")";

    //echo $query;
    $result = $connection->query($query);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}else{
    $_GET['message'] = "No name inserted!";

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}