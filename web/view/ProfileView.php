<?php

class ProfileView
{

    public function __construct()
    {

    }

    public function profile($avatar, $stats, $snippets, $comments)
    {

        $html = "
                <h3>Hi there Kim</h3><br>
                <img src='$avatar' alt='User' />
                <div id='stats'>
                    <p>Created snippets:" . $stats['snippets'] . "</p>
                    <p>Commented snippets: " . $stats['comments'] . "</p>
                    <p>Total likes: " . $stats['likes'] . "</p>
                    <p>Total dislikes: " . $stats['dislikes'] . "</p>
                </div>
                <br />
                <div id='userActivity'>
                    <h3>created snippets</h3>
                    <ul>";
                        foreach ($snippets as $snippet) {
                            $html .= '<li>'.$snippet->getTitle().' - '.$snippet->getLanguage().'</li>';
                        }
         $html .= "</ul>
                </div>
                <div id='options'>
                    <p><a href='#'>delete account</a></p>
                </div>";
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
