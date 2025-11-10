<?php
/**
 * Pagination layout
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'understrap_pagination' ) ) {
	/**
	 * Displays the navigation to next/previous set of posts.
	 *
	 * @param array  $args {
	 *     (Optional) Array of arguments for generating paginated links for archives.
	 *
	 *     @type string $base               Base of the paginated url. Default empty.
	 *     @type string $format             Format for the pagination structure. Default empty.
	 *     @type int    $total              The total amount of pages. Default is the value WP_Query's
	 *                                      `max_num_pages` or 1.
	 *     @type int    $current            The current page number. Default is 'paged' query var or 1.
	 *     @type string $aria_current       The value for the aria-current attribute. Possible values are 'page',
	 *                                      'step', 'location', 'date', 'time', 'true', 'false'. Default is 'page'.
	 *     @type bool   $show_all           Whether to show all pages. Default false.
	 *     @type int    $end_size           How many numbers on either the start and the end list edges.
	 *                                      Default 1.
	 *     @type int    $mid_size           How many numbers to either side of the current pages. Default 2.
	 *     @type bool   $prev_next          Whether to include the previous and next links in the list. Default true.
	 *     @type bool   $prev_text          The previous page text. Default '&laquo;'.
	 *     @type bool   $next_text          The next page text. Default '&raquo;'.
	 *     @type string $type               Controls format of the returned value. Possible values are 'plain',
	 *                                      'array' and 'list'. Default is 'array'.
	 *     @type array  $add_args           An array of query args to add. Default false.
	 *     @type string $add_fragment       A string to append to each link. Default empty.
	 *     @type string $before_page_number A string to appear before the page number. Default empty.
	 *     @type string $after_page_number  A string to append after the page number. Default empty.
	 *     @type string $screen_reader_text Screen reader text for the nav element. Default 'Posts navigation'.
	 * }
	 * @param string $class                 (Optional) Classes to be added to the <ul> element. Default 'pagination'.
	 */
	function understrap_pagination( $args = array(), $class = 'pagination' ) {

		if ( ! $GLOBALS['wp_query'] instanceof WP_Query || ( ! isset( $args['total'] ) && $GLOBALS['wp_query']->max_num_pages <= 1 ) ) {
			return;
		}

		$args = wp_parse_args(
			$args,
			array(
				'mid_size'           => 2,
				'prev_next'          => true,
				'prev_text'          => _x( '<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.0711 6.74998C15.4853 6.74998 15.8211 6.41419 15.8211 5.99998C15.8211 5.58576 15.4853 5.24998 15.0711 5.24998L15.0711 5.99998L15.0711 6.74998ZM0.398603 5.46965C0.10571 5.76254 0.105709 6.23741 0.398603 6.53031L5.17157 11.3033C5.46447 11.5962 5.93934 11.5962 6.23223 11.3033C6.52513 11.0104 6.52513 10.5355 6.23223 10.2426L1.98959 5.99998L6.23223 1.75734C6.52513 1.46444 6.52513 0.989569 6.23223 0.696676C5.93934 0.403783 5.46447 0.403783 5.17157 0.696676L0.398603 5.46965ZM15.0711 5.99998L15.0711 5.24998L0.928933 5.24998L0.928933 5.99998L0.928933 6.74998L15.0711 6.74998L15.0711 5.99998Z" fill="#31312F"/>
</svg>
', 'previous set of posts', 'understrap' ),
				'next_text'          => _x( '<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.928932 6.74998C0.514718 6.74998 0.178932 6.41419 0.178932 5.99998C0.178932 5.58576 0.514718 5.24998 0.928932 5.24998L0.928932 5.99998L0.928932 6.74998ZM15.6014 5.46965C15.8943 5.76254 15.8943 6.23741 15.6014 6.53031L10.8284 11.3033C10.5355 11.5962 10.0607 11.5962 9.76777 11.3033C9.47487 11.0104 9.47487 10.5355 9.76777 10.2426L14.0104 5.99998L9.76777 1.75734C9.47487 1.46444 9.47487 0.989569 9.76777 0.696676C10.0607 0.403783 10.5355 0.403783 10.8284 0.696676L15.6014 5.46965ZM0.928932 5.99998L0.928932 5.24998L15.0711 5.24998L15.0711 5.99998L15.0711 6.74998L0.928932 6.74998L0.928932 5.99998Z" fill="#31312F"/>
</svg>
', 'next set of posts', 'understrap' ),
				'current'            => max( 1, get_query_var( 'paged' ) ),
				'screen_reader_text' => __( 'Posts navigation', 'understrap' ),
			)
		);

		// Make sure we always get an array.
		$args['type'] = 'array';

		/**
		 * Array of paginated links.
		 *
		 * @var array<int,string>
		 */
		$links = paginate_links( $args );
		if ( empty( $links ) ) {
			return;
		}
		?>

		<!-- The pagination component -->
		<nav aria-labelledby="posts-nav-label">

			<h2 id="posts-nav-label" class="screen-reader-text">
				<?php echo esc_html( $args['screen_reader_text'] ); ?>
			</h2>

			<ul class="<?php echo esc_attr( $class ); ?>">

				<?php
				foreach ( $links as $link ) {
					?>
					<li class="page-item <?php echo strpos( $link, 'current' ) ? 'active' : ''; ?>">
						<?php
						$search  = array( 'page-numbers', 'dots' );
						$replace = array( 'page-link', 'disabled dots' );
						echo str_replace( $search, $replace, $link ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</li>
					<?php
				}
				?>

			</ul>

		</nav>

		<?php
	}
}
