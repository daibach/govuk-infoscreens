<?
if ( ! function_exists('convert_to_human_date')) {
  function convert_to_human_date($time, $precision=2, $date_format='Y-m-d')
  {

    $now = time();

    $diff   =  $now - $time;

    $months =  floor($diff/2419200);
    $diff   -= $months * 2419200;
    $weeks  =  floor($diff/604800);
    $diff -= $weeks*604800;
    $days   =  floor($diff/86400);
    $diff   -= $days * 86400;
    $hours  =  floor($diff/3600);
    $diff   -= $hours * 3600;
    $minutes = floor($diff/60);
    $diff   -= $minutes * 60;
    $seconds = $diff;

    if ($months > 0) {
      return date($date_format, $time);
    } else {
      $relative_date = '';
      if ($weeks > 0) {
        // Weeks and days
        $relative_date .= ($relative_date?', ':'').$weeks.' week'.($weeks>1?'s':'');
        if ($precision <= 2) {
          $relative_date .= $days>0?($relative_date?', ':'').$days.' day'.($days>1?'s':''):'';
          if ($precision == 1) {
            $relative_date .= $hours>0?($relative_date?', ':'').$hours.' hour'.($hours>1?'s':''):'';
          }
        }
      } elseif ($days > 0) {
        // days and hours
        $relative_date .= ($relative_date?', ':'').$days.' day'.($days>1?'s':'');
        if ($precision <= 2) {
          $relative_date .= $hours>0?($relative_date?', ':'').$hours.' hour'.($hours>1?'s':''):'';
          if ($precision == 1) {
            $relative_date .= $minutes>0?($relative_date?', ':'').$minutes.' minute'.($minutes>1?'s':''):'';
          }
        }
      } elseif ($hours > 0) {
        // hours and minutes
        $relative_date .= ($relative_date?', ':'').$hours.' hour'.($hours>1?'s':'');
        if ($precision <= 2) {
          $relative_date .= $minutes>0?($relative_date?', ':'').$minutes.' minute'.($minutes>1?'s':''):'';
          if ($precision == 1) {
            $relative_date .= $seconds>0?($relative_date?', ':'').$seconds.' second'.($seconds>1?'s':''):'';
          }
        }
      } elseif ($minutes > 0) {
        // minutes only
        $relative_date .= ($relative_date?', ':'').$minutes.' minute'.($minutes>1?'s':'');
        if ($precision == 1) {
          $relative_date .= $seconds>0?($relative_date?', ':'').$seconds.' second'.($seconds>1?'s':''):'';
        }
      } else {
        // seconds only
        $relative_date .= ($relative_date?', ':'').$seconds.' second'.($seconds>1?'s':'');
      }
      $relative_date .= ' ago';
    }

    // Return relative date and add proper verbiage
    return $relative_date;
  }
}

function time_based_class($time) {

  $now = time();
  $diff = $now - $time;
  if($diff <= 7200) {
    return 'error';
  } elseif($diff <= 86400) {
    return 'warning';
  } else {
    return 'info';
  }

}
?>