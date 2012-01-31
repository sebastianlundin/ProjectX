<?php

class ProfileView
{

    public function __construct()
    {

    }

    public function profile($avatar,$stats)
    {

        $html = "
                <h3>Hi there Kim</h3><br>
                <img src='$avatar' alt='User' />
                <div id='stats'>
                    <p>Created snippets:".$stats['snippets']."</p>
                    <p>Commented snippets: ".$stats['comments']."</p>
                    <p>Total likes: ".$stats['likes']."</p>
                    <p>Total dislikes: ".$stats['dislikes']."</p>
                </div>
                <br />
                <div id='userActivity'>
                    <p>liked snippets<p>
                    <ul>
                        <li>Whatt</li>
                        <li>en annan snippet</li>
                        <li>The third one</li>
                        <li>Phååp</li>
                    </ul>
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
