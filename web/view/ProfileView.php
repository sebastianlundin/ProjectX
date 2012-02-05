<?php

class ProfileView
{

    public function profile($avatar,$name, $data)
    {

        $html = "
                <h3>Hi there $name</h3><br>
                <img src='$avatar' alt='User' />
                <div id='stats'>
                    <p>Created snippets:" . count($data['snippets']). "</p>
                    <p>Commented snippets: " . count($data['comments']). "</p>
                    <p>Total likes: " . count($data['likes']) . "</p>
                    <p>Total dislikes: " . count($data['dislikes']) . "</p>
                </div>
                <br />
                <div id='userActivity'>";
         $html.= $this->createdSnippets($data['snippets'] );   
         $html.= $this->CommentedSnippets($data['comments']);   
         $html.= $this->likedSnippets($data['likes']);   
         $html.= $this->dislikedSnippets($data['dislikes']);   

         $html .='</div>';
        return $html;
    }

    public function likedSnippets($likedSnippets) {
        $html = "<h3>Liked snippets</h3>
                    <ul>";
                    foreach ($likedSnippets as $snippet) {
                        $html .= "<li><a href='?page=listsnippets&snippet=".$snippet->getID()."'>".$snippet->getTitle()."</a> - (".$snippet->getLanguage().")</li>";
                    }
        $html .= "</ul>";        
        return $html;
    }
    
    public function dislikedSnippets($dislikedSnippets) {
        $html ="<h3>Disliked snippets</h3>
                    <ul>";
                    foreach ($dislikedSnippets as $snippet) {
                        $html .= "<li><a href='?page=listsnippets&snippet=".$snippet->getID()."'>".$snippet->getTitle()."</a> - (".$snippet->getLanguage().")</li>";
                    }
        $html .= "</ul>";
        return $html;
    }
    
    public function createdSnippets($createdSnippets) {
        $html ="<h3>Created snippets</h3>
                    <ul>";
                    foreach ($createdSnippets as $snippet) {
                        $html .= "<li><a href='?page=listsnippets&snippet=".$snippet->getID()."'>".$snippet->getTitle()."</a> - (".$snippet->getLanguage().")</li>";
                    }
        $html .= "</ul>";
        return $html;
    }
    
    public function commentedSnippets($commentedSnippets) {
        $html ="<h3>Commented snippets</h3>
                    <ul>";
                    foreach ($commentedSnippets as $snippet) {
                    $html .= "<li><a href='?page=listsnippets&snippet=".$snippet['id']."'>".$snippet['title'].'</a><br />'.$snippet['comment'].'</li>';
                    }
        $html .= "</ul>";
        return $html;
    }

    public function isUpdateProfile()
    {
        if (isset($_POST['update'])) {
            return true;
        } else {
            return false;
        }
    }

}
