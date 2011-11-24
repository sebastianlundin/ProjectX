<?php

<<<<<<< HEAD
require_once 'view/SnippetView.php';
require_once 'model/SnippetHandler.php';

$mSnippetHandler = new snippetHandler();
$mSnippetView = new SnippetView();
$snippet = $mSnippetHandler->getSnippetByID(1);
echo $mSnippetView->singleView($snippet);
=======
require_once 'model/SnippetHandler.php';
require_once 'view/SnippetView.php';

$sh = new SnippetHandler();
$sv = new SnippetView();

echo $sv->listView($sh->getAllSnippets());
>>>>>>> oskarhallen-master
