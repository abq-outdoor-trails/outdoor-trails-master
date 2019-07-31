<?php
namespace AbqOutdoorTrails\AbqBike;

require_once "../Classes/Comment.php";

$comment = new Comment("379dae82-5a2b-4c4b-8193-b8e7749a3495", '379dae82-5a2b-4c4b-8193-b8e7749a3495', "379dae82-5a2b-4c4b-8193-b8e7749a3495", "This is a comment!  I really hope this works!", "");

var_dump($comment);