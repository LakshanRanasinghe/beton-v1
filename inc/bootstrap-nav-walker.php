<?php
// bootstrap 5 wp_nav_menu walker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach($this->current_item->classes as $class) {
      if(in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";

    // If parent item has a valid destination URL (not '#' or empty), provide a clean overview link at the top for mobile
    if ($depth === 0 && !empty($this->current_item->url) && $this->current_item->url !== '#' && $this->current_item->url !== 'javascript:void(0);') {
      $raw_title = apply_filters('the_title', $this->current_item->title, $this->current_item->ID);
      $clean_title = rtrim(trim($raw_title), '?');
      if (mb_strlen($clean_title) > 28) {
        if (stripos($clean_title, 'beton') !== false) {
          $overview_title = 'Overzicht: Beton bestellen & storten';
        } else {
          $overview_title = 'Overzicht: ' . $clean_title;
        }
      } else {
        $overview_title = 'Overzicht: ' . $clean_title;
      }
      $output .= "$indent\t<li class=\"menu-item nav-item nav-item-overview d-lg-none\"><a href=\"" . esc_url($this->current_item->url) . "\" class=\"dropdown-item nav-link-overview\"><i class=\"bi bi-arrow-right-short me-1\"></i>" . esc_html($overview_title) . "</a></li>\n";
    }
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu dropdown-menu-end';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
    $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
    $is_mobile_menu = (isset($args->theme_location) && $args->theme_location === 'menu-2') || (isset($args->menu_id) && $args->menu_id === 'Mobile');
    $bs_toggle = ($args->walker->has_children && !$is_mobile_menu) ? ' data-bs-toggle="dropdown"' : '';
    $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle"' . $bs_toggle . ' aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

    $icon_class = ($args->walker->has_children) ? 'bi bi-chevron-down' : 'bi bi-arrow-up-right';

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a><i class="beton-arrow-menu-icon ' . esc_attr($icon_class) . ' absolute py-4"></i>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}
// register a new menu
register_nav_menu('main-menu', 'Main menu');
