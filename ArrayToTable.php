<?php
namespace common\components;

Class ArrayToTable {
	
	public static function format($array = '',$cssClass='table table-bordered',$showKey=true) {
		$html = "";
		if ($array && is_array($array)) {
			$html = self::arrayToHtmlTableRecursive($array,$cssClass,$showKey);
		}
		return $html;
	}

	public static function arrayToHtmlTableRecursive($array,$cssClass,$showKey) {
		$str = "<table class='$cssClass'><tbody>";
		foreach ($array as $key => $val) {
			$str .= "<tr>";
			if($showKey){
				$str .= "<th>$key</th>";
			}
			$str .= "<td>";
			if (is_array($val)) {
				if (!empty($val)) {
					$str .= self::arrayToHtmlTableRecursive($val,$cssClass,$showKey);
				}
			} else {
				if(is_bool($val)){
					$val = $val === true ? "true" : "false";
				}
				$str .= "$val";
			}
			$str .= "</td></tr>";
		}
		$str .= "</tbody></table>";

		return $str;
	}
}