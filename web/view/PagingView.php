<?php

class PagingView
{
    /**
     * Creates HTML pagination
     * @param int $links, int $next, int $previous, int $before, int $after, int $pages, string $path
     * @return string
     */
    public function renderPaging($links, $next, $previous, $before, $after, $pages, $path)
    {
        if ($pages != 1 && $pages != 0) {
            $html = '<div class="paging-nav">';
            $html .= '<a href="' . $path . '&pagenumber=1">First</a> ';
            $html .= '<a href="' . $path . '&pagenumber=' . $previous . '"><</a> ';
            
            foreach ($before as $link) {
                if ($link > 0) {
                    $html .= '<a href="' . $path . '&pagenumber=' . $link . '">' . $link . '</a> ';    
                }
            }
            
            $html .= '<span class="current-page">' . $_GET['pagenumber'] . '</span> ';
            
            foreach ($after as $link) {
                if ($link < (count($links) + 1 )) {
                    $html .= '<a href="' . $path . '&pagenumber=' . $link . '">' . $link . '</a> ';    
                }
            }
            
            $html .= '<a href="' . $path . '&pagenumber=' . $next . '">></a> ';
            $html .= '<a href="' . $path . '&pagenumber=' . $pages . '">Last</a>';      
            $html .= '</div>';
            
            return $html;
        }
    }
}
