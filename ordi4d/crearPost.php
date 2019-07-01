<?php 
// Initialize site configuration
require_once('includes/config.inc.php');

$title= $_POST["title"];
$content=$_POST["content"];
$idAutor=$_POST["idAutor"];

if(isset($_POST["idEdit"]) && intval($_POST["idEdit"])){

    $newPost= new Post();
    $newPost->id=$_POST["idEdit"];
    $newPost->title=$title;
    $newPost->content=$content;
    $newPost->idAutor=$idAutor;

    $newPost->save();
}
 else{
$newPost= new Post();

$newPost->title=$title;
$newPost->content=$content;
$newPost->idAutor=$idAutor;

$newPost->save();
    
 }


redirect_to("indexPost.php");
?>