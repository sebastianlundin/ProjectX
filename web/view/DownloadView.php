<?php

class DownloadView {
    
    public function doDownloadLinks() {
            $html = 
			'
				<h1>Downloads</h1>

				<div class="search">
					<p>
						<a href="https://github.com/downloads/jensevertsson/ProjectX/Snippt.exe">
							<img src="content/image/snippt_downloadlink_windows.png" alt="Download Snippt for Windows" title="Download Snippt for Windows" />
						</a>
					</p>
	
					<p>
						<a href="https://github.com/downloads/jensevertsson/ProjectX/Snippt.dmg">
							<img src="content/image/snippt_downloadlink_macosx.png" alt="Download Snippt for Mac OS X" title="Download Snippt for Mac OS X" />
						</a>
					</p>
				</div>
			';
            return $html;
    }
}