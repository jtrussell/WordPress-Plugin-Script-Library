<?php
/**
 * Various utility functions
 */
class template_util
{

	// -----------------------------------------------------
	// Redirect to a given url
	// * If headers are already sent tries to use js and
	// 	 provides a link to the target page
	// -----------------------------------------------------
	public static function redirect($url) {
		#$url = urldecode($url);
		if(!headers_sent() && false) {
			header("Location: {$url}");
		} else {
			if(strpos($url, "http") === false) {
				$url = site_url($url);
			}
			// JS to perform redirect
			$redirect_markup = "<script type='text/javascript'>\n";
			$redirect_markup .= "window.top.location.href = '{$url}';\n";
			$redirect_markup .= "</script>\n";
			// Style to make sure our redirect link shows up on dark themes
			$redirect_markup .= "<style type='text/css'>\n";
			$redirect_markup .= "body { background: #FFFFFF; }";
			$redirect_markup .= "</style>";
			// Fail safe redirect link
			$redirect_markup .= "<p>Please click <a href='{$url}'>here</a> if your browser does not redirect you.";
			echo $redirect_markup;
		}
		exit();
	}

	// -----------------------------------------------------
	// Returns the url requested by the user
	// -----------------------------------------------------
	public static function requested_url() {
		$url = $_SERVER["REQUEST_URI"];
		$url = site_url($url);
		return $url;
	}

}

// -----------------------------------------------------
// Closing PHP tag omitted
// -----------------------------------------------------
