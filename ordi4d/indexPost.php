<?php 
session_start();
// Initialize site configuration
require_once('includes/config.inc.php');

$todosPost=Post::getAll();

// Include page view
require_once(VIEW_PATH.'indexPost.view.php');