<?
if ( ! function_exists('identify_user_from_content')) {
  function identify_user_from_content($content) {

    $regex = "/Assigned to: (.*?)\n/";

    return identify_item_from_content($regex,$content);

  }
}

if ( ! function_exists('identify_title_from_content')) {
  function identify_title_from_content($content)
  {
    $regex = "/\"(.*?)\" \((.*?)\).*?/";

    return identify_item_from_content($regex,$content);
  }
}

if ( ! function_exists('identify_item_from_content')) {
  function identify_item_from_content($regex,$content) {

    $content = str_replace('\r\n',"\n",$content) ;
    if(preg_match($regex, $content)) {
      preg_match_all($regex, $content, $matched_content, PREG_PATTERN_ORDER);

      if(!empty($matched_content[0])) {
        return $matched_content[1][0];
      }
    }
    return "";
  }
}
?>