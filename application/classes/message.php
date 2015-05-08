<?php
class Message
{
	/** Show message * @param string - title (can be a i18n entry) * @param text - message text (can be a i18n entry) * @links array - array of links where key is link (also controller/action links) * and value is name (i18n support) * @redirect string - format: TIME[int],LINK[string] eg: 4,index or 3,http://google.com * * as return value function print message */
	public static function show($title, $text = '', $links = array(), $redirect = '0')
	{
		$links_html = '';
		
		// Set title and message content
		$tmp_title = i18n::get($title);
		$tmp_text = i18n::get($text);
		$title = empty($tmp_title) ? $title : $tmp_title;
		$text = empty($text) ? $title : (empty($tmp_text) ? $text : $tmp_text);
		
		// Creating links
		foreach ( $links as $url => $url_title )
		{
			$tmp_title = i18n::get($url_title);
			$link_title = empty($tmp_title) ? $url_title : $tmp_title;
			if(strpos($url, '://') === FALSE){$url = URL::site($url);}
			$links_html .= '<a href="'.$url.'">'.$link_title.'</a> | ';
		}
		
		$links_html = substr($links_html, 0, strlen($links_html)-3);
		// Redirect
		$redirect_info = array();
		$redirect = preg_match('/^([0-9]+),(.*?)$/', $redirect, $redirect_info);
		
		if($redirect_info[1] > 0 )
		{
			if(strpos($redirect_info[2], '://') === FALSE)
			$redirect_info[2] = URL::site($redirect_info[2]);
			$redirect = '<meta http-equiv="refresh" content="'.$redirect_info[1].'; url='.$redirect_info[2].'" />';
		}
		print View::factory('static/message', array( 'title' => $title, 'text' => $text, 'links' => $links_html, 'redirect' => $redirect ))->render();
	}
}
?>