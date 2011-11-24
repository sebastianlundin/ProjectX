<?php

class SnippetView {
	
	/**
	 * return html code for a single snippet
	 * @param Snippet a snippet Object
	 * @return String
	 */
	public function singleView($aSnippet) {
		$html =  "<h2>".$aSnippet->getTitle()."</h2>
		<div class='snippet-desc'>
			<p>".$aSnippet->getDesc()."</p>	
		</div>
		<div class='snippet-code'>
			<code>".$aSnippet->getCode()."</code>
		</div>
		<div class='snippet-author'>
			<span>".$aSnippet->getAuthor()."</span>
		</div>";
		
		return $html;		
	}
    
    /**
     * Transform an array of snippets to html-code
     * @param array $aSnippets is an array of snippets
     * @return string
     */
    public function listView($aSnippets) {
        $html = '';
            
        foreach ($aSnippets as $snippet) {
            $html .= '
                <div class="snippet-list-item">
                    <div class="snippet-title">
                        <h3>' . $snippet->getTitle() . '</h3>
                    </div>
                    <div class="snippet-description">
                        <p>' . $snippet->getDescription() . '</p>
                    </div>
                    <div class="snippet-code">
                        <code>' . $snippet->getCode() . '</code>
                    </div>
                    <div class="snippet-author">
                        <p>Posted by: <i>' . $snippet->getTitle() . '</i></p>
                    </div>
                </div>
            ';
        }
        
        return $html;
    }
    
}
