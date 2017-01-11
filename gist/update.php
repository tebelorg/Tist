<?php
/* TA.Gist is a PHP template that displays your GitHub gists as blog posts     */
/* This is a sample raw text gist - http://tebel.org/gist/interface_automation */
/* Script to update gist ID-name mapping if provided gist name is not found    */
/* For more info and GitHub repository - https://github.com/tebelorg/TA.Gist   */

// retrieve gist listing on github page
$gist_URL = 'https://gist.github.com/' . $user_id;
$gist_user_page = get_data($gist_URL);

// open mapping php file to store id-name mapping
$gist_file = fopen('gist_map.php','w'); fwrite($gist_file, "<?php\r\n\$gist = [\r\n");
$gist_count = 1; do {$gist_item = read_gist($gist_user_page,$gist_count); fwrite($gist_file,$gist_item); $gist_count++;}
while ($gist_item != ""); fwrite($gist_file, "];\r\n?>"); fclose($gist_file);

// get the nth gist id and name from list of gists
function read_gist($web_content,$item_count) {
	// assign string tokens to search for, may need updating when GitHub Gist layout changes
	$token1 = "/ <a href=\"/".$GLOBALS['user_id']."/"; // use GitHub user id set in index.php
	$token2 = "\"><strong class=\"css-truncate-target\">";
	$token3 = "</strong></a>";

	// search for the nth occurrence of a gist and track key positions in variables
	$start_pos = 0; for ($gist_counter = 1; $gist_counter <= $item_count; $gist_counter++)
	{$start_pos = strpos($web_content,$token1,$start_pos+strlen($token1)); if (!$start_pos) return "";}
	$mid_pos = strpos($web_content,$token2,$start_pos); if (!$mid_pos) return "";
	$end_pos = strpos($web_content,$token3,$start_pos); if (!$end_pos) return ""; 

	// extract the id and name to be returned for writing to gist_map.php file
	$gist_id = substr($web_content,$start_pos+strlen($token1),$mid_pos-$start_pos-strlen($token1));
	$gist_name = substr($web_content,$mid_pos+strlen($token2),$end_pos-$mid_pos-strlen($token2));
	return "\"".$gist_name ."\" => \"" . $gist_id . "\",\r\n";
}

/* GET DATA FROM URL */
function get_data($url) {
        $ch = curl_init();
        $timeout = 60;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = array("Cache-Control: no-cache","Pragma: no-cache");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
}

?>
