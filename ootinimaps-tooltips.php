<?PHP
/*
Plugin Name: OotiniMaps Tooltips
Plugin URI: https://ootinicast.com/maps/wordpressplugin
Description: Allows pop-up tooltips to be shown for links to OotiniMaps locations.
Version: 1.1
Author: Jason Etheridge (a.k.a. Teo)
Author URI: https://ootinicast.com
*/

function ootinimaps_header() {
  echo '<script type="text/javascript" src="https://ootinicast.com/maps/js/ootinimapspopup.js"></script>';
  echo "\n";
}

function ootinimaps_shortcode_handler($atts, $content, $tag) {
  if (!array_key_exists('zone', $atts)) {
    return "ootinimaps: needs zone";
  }

  $url = 'https://ootinicast.com/maps/' . $atts['zone'];

  if (array_key_exists('subzone', $atts)) {
    $url .= '/' . $atts['subzone'];
  }

  $faction = 'Republic';

  if (array_key_exists('faction', $atts)) {
    $faction_str = strtolower($atts['faction']);

    if ($faction_str[0] == 'e') {
      $faction = 'Empire';
    }
  }

  $url .= '?faction=' . $faction;

  if (array_key_exists('x', $atts) && array_key_exists('y', $atts)) {
    $url .= '&x=' . $atts['x'];
    $url .= '&y=' . $atts['y'];
  }

  return '<a href="' . $url . '">' . $content . '</a>';
}

add_action('wp_head','ootinimaps_header');

add_shortcode('ootinimaps', 'ootinimaps_shortcode_handler');
?>
