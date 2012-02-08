<?php

class ProfileView
{

    public function profile($avatar, $name, $data, $user)
    {
        $html = $this->doProfileMenu(true);

        $html .= "
                <h3>Hi there $name</h3><br>
                <img src='$avatar' alt='User' />
                <div id='stats'>
                    <p>Created snippets:" . count($data['snippets']) . "</p>
                    <p>Commented snippets: " . count($data['comments']) . "</p>
                    <p>Total likes: " . count($data['likes']) . "</p>
                    <p>Total dislikes: " . count($data['dislikes']) . "</p>
                    <p>User role: " . $user->getRole() . "</p>
                </div>
                <br />
                <div id='userActivity'>";

        $html .= $data['content'];

        $html .= '</div>';
        return $html;
    }

    public function likedSnippets($likedSnippets)
    {
        $html = "<h3>Liked snippets</h3>
                    <ul>";

        foreach ($likedSnippets as $snippet) {
            $html .= "<li><a href='?page=listsnippets&snippet=" . $snippet->getID() . "'>" . $snippet->getTitle() . "</a> - (" . $snippet->getLanguage() . ")</li>";
        }
        $html .= "</ul>";
        return $html;
    }

    public function dislikedSnippets($dislikedSnippets)
    {
        $html = "<h3>Disliked snippets</h3>
                    <ul>";
        foreach ($dislikedSnippets as $snippet) {
            $html .= "<li><a href='?page=listsnippets&snippet=" . $snippet->getID() . "'>" . $snippet->getTitle() . "</a> - (" . $snippet->getLanguage() . ")</li>";
        }
        $html .= "</ul>";
        return $html;
    }

    public function createdSnippets($createdSnippets)
    {
        $html = "<h3>Created snippets</h3>
                    <ul>";
        foreach ($createdSnippets as $snippet) {
            $html .= "<li><a href='?page=listsnippets&snippet=" . $snippet->getID() . "'>" . $snippet->getTitle() . "</a> - (" . $snippet->getLanguage() . ")</li>";
        }
        $html .= "</ul>";
        return $html;
    }

    public function commentedSnippets($commentedSnippets)
    {
        $html = "<h3>Commented snippets</h3>
                    <ul>";
        foreach ($commentedSnippets as $snippet) {
            $html .= "<li><a href='?page=listsnippets&snippet=" . $snippet['id'] . "'>" . $snippet['title'] . '</a><br />' . $snippet['comment'] . '</li>';
        }
        $html .= "</ul>";
        return $html;
    }

    public function doApiKey($apiKey)
    {
        $html = 'api key ' . $apiKey;
        $html .= " - <a href='/profile?api_key=generate'>Generate new<a/>";
        return $html;
    }
    
    public function doProfileMenu($isAdmin) {
        $html = "    
                <ul>
                <li><a href='?p=created'>Created snippets</a></li>
                <li><a href='?p=commented'>Commented Snippets</a></li>
                <li><a href='?p=liked'>Liked snippets</a></li>
                <li><a href='?p=disliked'>DislikedSnippets</a></li>
                <li><a href='?p=settings'>Settings</a></li>
                ";
                
                if($isAdmin) {
                    $html .= "<li><a href='?p=users'>Search for users</a></li>";
                }
                $html .= "</ul>";
        return $html;
    }
    
    public function searchForUsers() {
        return "<form action='/profile?p=users' method='GET' name='usersearch'>
            <input type='text' name='q' />
            <input type='submit' name'searchuser' value='search' />
        </form>";
    }
    
    public function settings() {
        return "sättings";
    }

    public function isUpdateProfile()
    {
        if (isset($_POST['update'])) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getPage() {
        if(isset($_GET['p'])) {
            return $_GET['p'];
        }
        return false;
    }

    public function doSearch() {
        if(isset($_GET['q'])) {
            return $_GET['q'];
        }
        return false;
    }

}
