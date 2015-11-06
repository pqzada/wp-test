<?php
/*
Plugin Name: Paginación Bootstrap
Plugin URI: http://www.anacondaweb.com
Version: 0.1
Description: Crea una paginacion al estilo bootstrap.
Author: Zalongo
Author URI: http://www.anacondaweb.com
*/


/**
     * PAGINACION
     */


/***** Numbered Page Navigation (Pagination) Code.
Tested up to WordPress version 3.1.2 *****/

/* Function that Rounds To The Nearest Value.
Needed for the pagenavi() function */
function round_num($num, $to_nearest) {
	/*Round fractions down (http://php.net/manual/en/function.floor.php)*/
	return floor($num/$to_nearest)*$to_nearest;
}

/* Function that performs a Boxed Style Numbered Pagination (also called Page Navigation).
Function is largely based on Version 2.4 of the WP-PageNavi plugin */
function pagenavi($before = '', $after = '', $request = null, $return = false) {
	global $wpdb, $wp_query;
	$pagenavi_options = array();
	$pagenavi_options['pages_text'] = ('Página %CURRENT_PAGE% de %TOTAL_PAGES%:');
	$pagenavi_options['current_text'] = '%PAGE_NUMBER%';
	$pagenavi_options['page_text'] = '%PAGE_NUMBER%';
	$pagenavi_options['first_text'] = ('Primera');
	$pagenavi_options['last_text'] = ('Última');
	$pagenavi_options['next_text'] = '&raquo;';
	$pagenavi_options['prev_text'] = '&laquo;';
	$pagenavi_options['dotright_text'] = '...';
	$pagenavi_options['dotleft_text'] = '...';
    $pagenavi_options['num_pages'] = 5; //continuous block of page numbers
    $pagenavi_options['always_show'] = 0;
    $pagenavi_options['num_larger_page_numbers'] = 0;
    $pagenavi_options['larger_page_numbers_multiple'] = 5;

    //If NOT a single Post is being displayed
    /*http://codex.wordpress.org/Function_Reference/is_single)*/
if (!is_single()) {
	if(!$request){
		$request = $wp_query->request;
	}

	$pagination = $request;
	        //intval — Get the integer value of a variable
	/*http://php.net/manual/en/function.intval.php*/
	$posts_per_page = intval(get_query_var('posts_per_page'));
	        //Retrieve variable in the WP_Query class.
	/*http://codex.wordpress.org/Function_Reference/get_query_var*/
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;

	        //empty — Determine whether a variable is empty
	/*http://php.net/manual/en/function.empty.php*/
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}

	$pages_to_show = intval($pagenavi_options['num_pages']);
	$larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
	$larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
	$pages_to_show_minus_1 = $pages_to_show - 1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	        //ceil — Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;

	if($start_page <= 0) {
		$start_page = 1;
	}

	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}

	$larger_per_page = $larger_page_to_show*$larger_page_multiple;
	        //round_num() custom function - Rounds To The Nearest Value.
	$larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
	$larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
	$larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
	$larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);

	if($larger_start_page_end - $larger_page_multiple == $start_page) {
		$larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
		$larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
	}
	if($larger_start_page_start <= 0) {
		$larger_start_page_start = $larger_page_multiple;
	}
	if($larger_start_page_end > $max_page) {
		$larger_start_page_end = $max_page;
	}
	if($larger_end_page_end > $max_page) {
		$larger_end_page_end = $max_page;
	}
	if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {

		$pagination = '';

		/*http://php.net/manual/en/function.str-replace.php */
		/*number_format_i18n(): Converts integer number to format based on locale (wp-includes/functions.php*/
			$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
			$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);



			$pagination.= $before.'<ul class="pagination pagination-sm">'."\n";


            //Displays a link to the previous post which exists in chronological order from the current post.
			/*http://codex.wordpress.org/Function_Reference/previous_post_link*/
			$pagination.= '<li>';
			$pagination.= get_previous_posts_link($pagenavi_options['prev_text']);
			$pagination.= '</li>';



			if ($start_page >= 2 && $pages_to_show < $max_page) {
				$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
                //esc_url(): Encodes < > & " ' (less than, greater than, ampersand, double quote, single quote).
				/*http://codex.wordpress.org/Data_Validation*/
                //get_pagenum_link():(wp-includes/link-template.php)-Retrieve get links for page numbers.
				$pagination.= '<li><a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a></li>';
				if(!empty($pagenavi_options['dotleft_text'])) {
					$pagination.= '<li class="disabled"><a>'.$pagenavi_options['dotleft_text'].'</a></li>';
				}
			}

			if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
				for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
					$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
					$pagination.= '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
				}
			}

			for($i = $start_page; $i  <= $end_page; $i++) {
				if($i == $paged) {
					$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
					$pagination.= '<li class="active"><a>'.$current_page_text.'  <span class="sr-only">(current)</span></a></li>';
				} else {
					$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
					$pagination.= '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
				}
			}

			if ($end_page < $max_page) {
				if(!empty($pagenavi_options['dotright_text'])) {
					$pagination.= '<li class="disabled"><a>'.$pagenavi_options['dotright_text'].'</a></li>';
				}
				$last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
				$pagination.= '<li><a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a></li>';
			}

			$pagination.= '<li>';
			$pagination.= get_next_posts_link($pagenavi_options['next_text'], $max_page);
			$pagination.= '</li>';

			if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
				for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
					$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
					$pagination.= '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
				}
			}
			$pagination.= '</ul>'.$after."\n";
			if(!empty($pages_text)) {
				$pagination.= '<div class="pages">'.$pages_text.'</div>';
			}

			if($return){
				return $pagination;
			}else{
				echo $pagination;
			}

		}
	}
}

?>