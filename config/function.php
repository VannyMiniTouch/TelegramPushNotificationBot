<?php 
function pageUrl($path = null, $params = array()) {
	$query_string = '';
	if (count($params)) {
		$query_string = '/?' . http_build_query($params);
	}
	if(isset($_SESSION['lang']) && !empty($_SESSION['lang'])) {
		if ($path) {
			$path = '/'. $path;
		}
		$langUrl=$_SESSION['lang'];

		return '/' . $langUrl . $path . $query_string;
	}

	return '/'. $path . $query_string;
}

?>