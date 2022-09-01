<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/////UPLOAD FILE AND DISPLAY IF EVENT PASSED//////
$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();


$start_date = tribe_get_start_date( null, false );
$date= date('Y-m-d', strtotime($start_date));

$today = date("Y-m-d");

$file = get_post_meta(get_the_ID(), 'event_file_upload', true);

?>

<!--EVENTBRITE URL SCRIPT -->
<script src="https://www.eventbrite.ca/static/widgets/eb_widgets.js"></script>

<div id="tribe-events-content" class="tribe-events-single">

	<p class="tribe-events-back">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( '&laquo; ' . esc_html_x( 'All %s', '%s Events plural label', 'the-events-calendar' ), $events_label_plural ); ?></a>
	</p>

	<!-- Notices -->
	<?php tribe_the_notices() ?>

	<!-- Event header -->
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		<!-- Navigation -->
		<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
			<ul class="tribe-events-sub-nav">
				<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
				<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
			</ul>
			<!-- .tribe-events-sub-nav -->
		</nav>
	</div>
	<!-- #tribe-events-header -->

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="flexy-box-row vertical-end">
			<div class="two-col">
					<?php the_title( '<h1 class="tribe-events-single-event-title">', '</h1>' ); ?>
					<div class="tribe-events-schedule tribe-clearfix">
						<?php echo tribe_events_event_schedule_details( $event_id, '<h2>', '</h2>' ); ?>
						<?php if ( tribe_get_cost() ) : ?>
							<span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
						<?php endif; ?>
					</div>
				</div>
				<!-- Event featured image, but exclude link -->
				<div class="four-col">
					<?php echo tribe_event_featured_image( $event_id, 'large', false ); ?>	
				</div>
			</div>
				<!-- Event content -->
				<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
				<div class="tribe-events-single-event-description tribe-events-content">
					<?php the_content(); ?>
					<?php if($date < $today & !empty($file)) { ?>
						<div style="display: block; margin-top: 20px;"><a href="<?php echo $file['url']; ?>" target="_blank" class="btn">View/ Download Event Resource</a></div>
					<?php } ?>
				</div>
				<!-- .tribe-events-single-event-description -->
				<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
			
    <!-- EventBrite Ticket Button -->
	<?php
		function eventbrite_id() {
			$eventbrite_url = get_post_meta( get_the_ID(), 'eventbrite_url_for_tickets', true );
			//$eventbrite_url = 'https://www.eventbrite.ca/e/sample-event-tickets-152406693523';
			$file_arg = explode("-",$eventbrite_url);
			$justthe_id = array_pop($file_arg);
			//$justthe_id = '152406693523';
			$eventbrite_id = 'eventbrite-widget-modal-trigger-' . $justthe_id;
			echo $eventbrite_id;
		}
	?>

	<!--End Eventbrite Ticket Button -->
<?php 

	$has_url = get_post_meta( get_the_ID(), 'eventbrite_url_for_tickets', true );
	if(!empty ($has_url) & $date >= $today){ ?>
    	<button id="<?php eventbrite_id(); ?>" class="ticketsbtn" type="button">Registration Is Open</button>
    <?php }
	else { ?>
		<div class="seperator" style="width: 85%; border-top: 2px solid black;"></div>
	<?php }
?>

			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
		</div> <!-- #post-x -->
		<?php //if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>

	<!-- Event footer 
	<div id="tribe-events-footer">
		<!-- Navigation 
		<nav class="tribe-events-nav-pagination" aria-label="<//?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
			<ul class="tribe-events-sub-nav">
				<li class="tribe-events-nav-previous"><?php //tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
				<li class="tribe-events-nav-next"><?php //tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
			</ul>
			<!-- .tribe-events-sub-nav 
		</nav>
	</div>
	<!-- #tribe-events-footer 

</div><!-- #tribe-events-content -->


<script type="text/javascript">

var elementId = document.querySelector('button.ticketsbtn').id;
var eventId = elementId.split("-").pop();


var exampleCallback = function() {
    console.log('Order complete!');
};

window.EBWidgets.createWidget({
    widgetType: 'checkout',
    eventId: eventId,
    modal: true,
    modalTriggerElementId: elementId,
    onOrderComplete: exampleCallback
});
</script>