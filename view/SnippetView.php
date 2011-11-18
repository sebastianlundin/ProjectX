<?php

class SnippetView {
	
	/*
	 * return html code for a single snippet
	 * @param Snippet
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
	
}


