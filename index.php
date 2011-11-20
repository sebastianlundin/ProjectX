<?php

require_once 'model/SnippetHandler.php';
require_once 'view/SnippetView.php';

$sh = new SnippetHandler();
$sv = new SnippetView();

echo $sv->listView($sh->getAllSnippets());