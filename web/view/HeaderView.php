<?php

class HeaderView
{

    public function inloggedHeader($name)
    {
        $html = "<div class='topbar-wrapper'>
            <div class='topbar'>
                <div class='topbar-inner'>
                    <ul class='nav'>
                        <li>
                            <a href='index.php'>Home</a> /
                        </li>
                        <li>
                            <a href='?page=listsnippets'>Snippets</a> /
                        </li>
                        <li>
                            <a href='?page=addsnippet'>Add snippet</a> /
                        </li>
                        <li>
                            <a href='#'>News</a> /
                        </li>
                        <li>
                            <a href='#'>Downloads</a> /
                        </li>
                        <li>
                            <a href='#'>About</a> /
                        </li>
                        <li>
                            <a href='#'>Register</a>
                        </li>
                        <li>
                            <a href='?logout=true'>Logga ut</a>
                        </li>
                        <li class ='right'>
                            <a href='?logout=true'>Logga ut</a>
                        </li>
                        <li class='right'>
                            <img src='' alt='as' />
                        </li>
                        <li class='right'>
                            Hello, $name
                        </li>
                    </ul>
                </div>
            </div>
        </div>";

        return $html;
    }

    public function notLoggedInHeader()
    {
        $html = "<div class='topbar-wrapper'>
            <div class='topbar'>
                <div class='topbar-inner'>
                    <ul class='nav'>
                        <li>
                            <a href='index.php'>Home</a> /
                        </li>
                        <li>
                            <a href='?page=listsnippets'>Snippets</a> /
                        </li>
                        <li>
                        <a href='?page=addsnippet'>Add snippet</a> /
                        </li>
                        <li>
                            <a href='#'>News</a> /
                        </li>
                        <li>
                            <a href='#'>Downloads</a> /
                        </li>
                        <li>
                            <a href='#'>About</a> /
                        </li>
                        <li>
                            <a href='#'>Register</a>
                        </li>
                        <li class='right'>
                            <a class='janrainEngage' href='#'>Logga in</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>";

        return $html;
    }

}
