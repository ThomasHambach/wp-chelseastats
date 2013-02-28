<?php
/**
 * @package ChelseaStats Widget
 * @author The Cellar Room Limited & ChelseaStats
 * @version 1.0.0
 */
/*
Plugin Name: ChelseaStats Widget
Version: 1.0.0
Plugin URI: http://api.thechels.co.uk/wordpress
Author: The Cellar Room Limited & ChelseaStats
Author URI: http://api.thechels.co.uk/wordpress
Description: Last Match Stats, form and historic data. Creates an admin page for some customisable options.

/*
Copyright (c) 2012 by The Cellar Room Limited & ChelseaStats.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy,
modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR
IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

// if ( is_admin() && !class_exists( 'ChelseaStatsWidget' ) ) :

###################################################################################

//First use the add_action to add onto the WordPress menu.
add_action('admin_menu', 'tcr_add_options');

//Make our function to call the WordPress function to add to the correct menu.
function tcr_add_options() {
	add_submenu_page('plugins.php','Chelseastats Options', 'ChelseaStats Setup', 8, 'coresetup', 'tcr_options_page');	
}

function tcr_options_page() {
    // variables for the field and option names 
    $opt_name = array(	      
	'tcr_cfc_formguideactiv' 	=> 'tcr_cfc_formguideactiv',
	'tcr_cfc_formcounter' 		=> 'tcr_cfc_formcounter',
	'tcr_cfc_apikey' 			=> 'tcr_cfc_apikey',
	'tcr_cfc_lastmatchactiv' 	=> 'tcr_cfc_lastmatchactiv',
	'tcr_cfc_historyactiv' 		=> 'tcr_cfc_historyactiv',
	'tcr_cfc_bootstrap' 			=> 'tcr_cfc_bootstrap',
	'tcr_cfc_credit' 			=> 'tcr_cfc_credit',
	
	);
				  
    $hidden_field_name = 'tcr_submit_hidden';

	// Read in existing option value from database
	$opt_val = array(
	 'tcr_cfc_formguideactiv' 	=> get_option( $opt_name['tcr_cfc_formguideactiv'] ),
	 'tcr_cfc_lastmatchactiv' 	=> get_option( $opt_name['tcr_cfc_lastmatchactiv'] ),
  	 'tcr_cfc_historyactiv' 		=> get_option( $opt_name['tcr_cfc_historyactiv'] ),
	 'tcr_cfc_bootstrap' 		=> get_option( $opt_name['tcr_cfc_bootstrap'] ),
  	 'tcr_cfc_apikey' 			=> get_option( $opt_name['tcr_cfc_apikey'] ),
	 'tcr_cfc_formcounter' 		=> get_option( $opt_name['tcr_cfc_formcounter'] ),
	 'tcr_cfc_credit' 			=> get_option( $opt_name['tcr_cfc_credit'] ),
	);

// See if the user has posted us some information
// If they did, this hidden field will be set to 'Y'

if(isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
    // Read their posted value
    $opt_val = array(	
	'tcr_cfc_formguideactiv'  	=> $_POST[ $opt_name['tcr_cfc_formguideactiv'] ],
	'tcr_cfc_lastmatchactiv' 	=> $_POST[ $opt_name['tcr_cfc_lastmatchactiv'] ],
	'tcr_cfc_historyactiv'		=> $_POST[ $opt_name['tcr_cfc_historyactiv'] ],
	'tcr_cfc_bootstrap'			=> $_POST[ $opt_name['tcr_cfc_bootstrap'] ],
	'tcr_cfc_apikey'			=> $_POST[ $opt_name['tcr_cfc_apikey'] ],
	'tcr_cfc_formcounter'		=> $_POST[ $opt_name['tcr_cfc_formcounter'] ],
	'tcr_cfc_credit'			=> $_POST[ $opt_name['tcr_cfc_credit'] ],				
	);		

    // Save the posted value in the database
    	update_option( $opt_name['tcr_cfc_formguideactiv']	, $opt_val['tcr_cfc_formguideactiv'] );
	update_option( $opt_name['tcr_cfc_lastmatchactiv']	, $opt_val['tcr_cfc_lastmatchactiv'] );
	update_option( $opt_name['tcr_cfc_historyactiv']	, $opt_val['tcr_cfc_historyactiv'] );
	update_option( $opt_name['tcr_cfc_bootstrap']		, $opt_val['tcr_cfc_bootstrap'] );
	update_option( $opt_name['tcr_cfc_apikey']		, $opt_val['tcr_cfc_apikey'] );
	update_option( $opt_name['tcr_cfc_formcounter']	, $opt_val['tcr_cfc_formcounter'] );
	update_option( $opt_name['tcr_cfc_credit']			, $opt_val['tcr_cfc_credit'] );	
    // Put an options updated message on the screen
?>
<div id="message" class="updated fade"><p><strong><?php _e('Options saved.', 'tcr_trans_domain' ); ?></strong></p></div>

<?php
	}
?>

<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div>
<h2><?php _e( 'ChelseaStats Widget Options', 'tcr_trans_domain' ); ?></h2>
<p>A sidebar widget showcasing some key Chelsea Stats</p>
<img src="http://www.thechels.co.uk/wp-content/uploads/ChelseaStatsLogoSidebar.png" alt="ChelseaStats Logo, supporting RightToPlay" style="float:left;"/>

<form style="float:left;" name="att_img_options" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<h3>General Options</h3>

<input id="tcr_cfc_formguideactiv" name="tcr_cfc_formguideactiv" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_cfc_formguideactiv' ) ); ?> />
<label for="tcr_cfc_formguideactiv">Check to show the formguide</label>
<br/>

<input id="tcr_cfc_lastmatchactiv" name="tcr_cfc_lastmatchactiv" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_cfc_lastmatchactiv' ) ); ?> />
<label for="tcr_cfc_lastmatchactiv">Check to show last match details</label>
<br/>

<input id="tcr_cfc_historyactiv" name="tcr_cfc_historyactiv" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_cfc_historyactiv' ) ); ?> />
<label for="tcr_cfc_historyactiv">Check to show history pie chart (vs last opponent, split by home/away and overall)?</label>
<br/>

<input id="tcr_cfc_bootstrap" name="tcr_cfc_bootstrap" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_cfc_bootstrap' ) ); ?> />
<label for="tcr_cfc_bootstrap">Check to use our version of twitter's bootstrap? (don't check if you already use it)</label>
<br/>

<input id="tcr_cfc_credit" name="tcr_cfc_credit" type="checkbox" value="1" <?php checked( '1', get_option( 'tcr_cfc_credit' ) ); ?> />
<label for="tcr_cfc_credit">Check to show credit/links back to the api and our wesbite? (it would be cool if you did)</label>
<br/>

<h3>Required Details</h3>

<table class="form-table">
<tbody>
<tr>
<th scope="row"><label>Your ChelseaStats apikey: (get your <a href="http://api.thechels.co.uk/wordpress.php" target="_blank">apikey here</a>)</label></th>
<td><input type="text" name="<?php echo $opt_name['tcr_cfc_apikey']?>" value="<?php echo $opt_val['tcr_cfc_apikey']; ?>" /></td>
</tr>

<tr>
<th scope="row"><label>Number to show in form guide:</label></th>
<td><input type="text" name="<?php echo $opt_name['tcr_cfc_formcounter']?>" value="<?php echo $opt_val['tcr_cfc_formcounter']; ?>" /></td>
</tr>

</tbody>
</table>

<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"  /></p>  

</form>
</div>
<?php
}
########################################################################################################################

function tcr_cfc_theme_widgets_init() {
register_sidebar( array (
'name' => 'Stats Widget Area',
'id' => 'stats-widget-area',
'before_widget' => '<div id="%1$s" class="hero-unit span3" style="min-width:200px;" widget-container %2$s">',
'after_widget' => "</div>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}

add_action( 'init', 'tcr_cfc_theme_widgets_init' );

########################################################################################################################

if(!get_option('tcr_cfc_bootstrap') ) {
// no nothing here as you already have bootstrap
} else {

// add twitter bootstrap min style & scripts
function tcr_cfc_scripts_init() {

wp_enqueue_script( 'tcr_cfc_bootstrap-css', plugins_url( '/assets/css/bootstrap.css', __FILE__ ));
wp_enqueue_script( 'tcr_cfc_bootstrap-js', plugins_url( '/assets/js/bootstrap.js', __FILE__ ));

}

add_action('init','tcr_cfc_scripts_init');

}
########################################################################################################################
// Google Charts API
/* [chart type="pie" title="Example Pie Chart" data="41.12,32.35,21.52,5.01" labels="First+Label|Second+Label|Third+Label|Fourth+Label" background_color="FFFFFF" colors="D73030,329E4A,415FB4,DFD32F" size="180x180"]
*/
function _tcr_cfc_chart( $data,$title ) {
   $charttype = 'p';
   $attributes = '';
   $attributes .= '&chd=t:'.$data.'';
   $attributes .= '&chtt='.$title.'';
   return '<img title="'.$title.'" src="http://chart.apis.google.com/chart?cht=p&chl=W|D|L&chs=200x170&chf=FFFFFF&chco=029ACF,DFD32F,D73030'.$attributes.'" alt="'.$title.'" />';
}
########################################################################################################################
function _cfcdebug ($var) {
	print '<br/>';
	print '<pre>';
	var_dump($var);
	print '</pre';
	print '<br/>';
}
########################################################################################################################
function _fswitch($result) {
	switch ($result) {
    		case "W":
        		print '<span class="label label-success">W</span>';
        		break;
    		case "D":
        		print '<span class="label label-warning">D</span>';
        		break;
    		case "L":
        		print '<span class="label label-important">L</span>';
        		break;
		} // end switch
} // end function
########################################################################################################################
function _percent($num_amount, $num_total) {
		$count1 = $num_amount / $num_total;
		$count2 = $count1 * 100;
		$count = number_format($count2, 0);
	return $count;
}
########################################################################################################################

class ChelseaStatsWidget extends WP_Widget {
    
  function ChelseaStatsWidget() {
    $widget_ops = array('classname' => 'ChelseaStatsWidget', 'description' => 'Displays stats against latest league opponent' );
    $this->WP_Widget('ChelseaStatsWidget', 'ChelseaStats', $widget_ops);
  }
 
  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
        ?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
        <?php
 }
 
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
}

  function widget($args, $instance) {

  
			    $apikey=get_option('tcr_cfc_apikey','0000'); 

				//  extract($args, EXTR_SKIP);	
				$json='http://api.thechels.co.uk?user='.$apikey.'&num=1';
				$ch = curl_init(); 
				$timeout = 5; // set to zero for no timeout 
				curl_setopt($ch, CURLOPT_URL, $json); 
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 
				ob_start();
				curl_exec($ch);
				$json=ob_get_contents(); 
				ob_end_clean(); 
				$json = json_decode($json,true); 
				$opposition	=$json['matches']['0']['match']['F_OPPOSITION'];
				$for		=$json['matches']['0']['match']['F_FOR'];
				$against	=$json['matches']['0']['match']['F_AGAINST'];
				$result		=$json['matches']['0']['match']['F_RESULT'];
				$location	=$json['matches']['0']['match']['F_LOCATION'];
				curl_close($ch);

				echo $before_widget;
				$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
			 
				if (!empty($title))
				  echo $before_title . $title . $after_title;


				
			$counter=get_option('tcr_cfc_formcounter','10'); 


			if(!get_option('tcr_cfc_formguideactiv') ) {
			// no nothing here
			} else {

					// WIDGET CODE GOES HERE
						echo '<div class="span4">';
						echo '<div class="well">';
						echo '<h3><a href="http://www.thechels.co.uk" target="_blank">Chelsea Stats</a></h3>';
						echo '<h5>Form Guide: Last '.$counter.' matches</h5>';
						echo '<p>';
						$team=str_replace(" ","_",$opposition);
						
						// Make a few of the longer names their common shortened versions
						if($team=='TOTTENHAM') : $team="SPURS"; endif;
						if($team=='QUEENS PARK RANGERS') : $team="QPR"; endif;
						if($team=='WEST BROMWICH ALBION') : $team="West Brom"; endif;
						
						// fetch data using curl and the api
						$form='http://api.thechels.co.uk?user='.$apikey.'&num='.$counter;
						$ch = curl_init(); 
						$timeout = 5; // set to zero for no timeout 
						curl_setopt($ch, CURLOPT_URL, $form); 
						curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 
						ob_start();
						curl_exec($ch);
						$form=ob_get_contents(); 
						ob_end_clean(); 
						$form = json_decode($form,true); 

					// loop through results json array to array
					$i=0;
					$check = array();
					while ( $i<$counter ) {
						$check[]=$form['matches'][$i]['match']['F_RESULT'];
						$i++;
					}

					// Iterating through the values and us the function to print to screen
					foreach($check as $value) {
						_fswitch($value);
					}
						curl_close($ch);
				
					echo '</p>';
					echo "<p><hr/></p>";
			}

				
			if(!get_option('tcr_cfc_lastmatchactiv') ) {
			// no nothing here
			} else {
				
				// begin section
					echo "<h5>Last Match vs ".$opposition.":</h5>";
					echo "<span class='label label-inverse'>".$location."</span>";
					_fswitch($result);
					echo "<span class='label label-info'>CHELSEA</span>";
					echo "<span class='label label-info'>". $for ."</span> - ";
					echo "<span class='label label-warning'>". $against ."</span>";
					echo "<span class='label label-default'>". $opposition ."</span>";
					echo "<p><hr/></p>";
				
			}	

			if(!get_option('tcr_cfc_historyactiv') ) {
			// no nothing here
			} else {
				
/*				
						echo "<h5>History vs ".$opposition.":</h5>";

						// hard coded pie charts need to retrieve this from api... version 2.
						
						$chartHd='41,32,21';
						$chartHt='Home';
						$chartAd='25,50,25';
						$chartAt='Away';
						$chartTd='34,44,22';
						$chartTt='Overall';
						
						$text_H = _tcr_cfc_chart($chartHd,$chartHt);
						$text_A = _tcr_cfc_chart($chartAd,$chartAt);
						$text_T = _tcr_cfc_chart($chartTd,$chartTt);
						
						?>

					<div class="tabbable"> <!-- Only required for left/right tabs -->
					  <ul class="nav nav-tabs">
						<li><a href="#tab1" data-toggle="tab">H</a></li>
						<li><a href="#tab2" data-toggle="tab">A</a></li>
						<li><a href="#tab3" data-toggle="tab">GT</a></li>
						<li><a href="#tab4" data-toggle="tab">F/A</a></li>
						<li><a href="#tab5" data-toggle="tab">?</a></li>
					  </ul>
					  <div class="tab-content">
						<div class="tab-pane active" id="tab1"><p class="chart"> <?php print $text_H; ?></p></div>
						<div class="tab-pane" id="tab2"><p class="chart"> <?php print $text_A; ?></p></div>
						<div class="tab-pane" id="tab3"><p class="chart"> <?php print $text_T; ?></p></div>
						<div class="tab-pane" id="tab4">
							<table class="tablesorter data-table">
								<thead><tr><th>item</th><th>Value</th><th>per game</th></tr></thead>
								<tbody>
								<tr><td>For</td>			<td><?php // print $text_GF; ?></td><td><?php // print $text_GFP; ?></td></tr>
								<tr><td>Against</td>		<td><?php // print $text_GA; ?></td><td><?php // print $text_GAP; ?></td></tr>
								<tr><td>Clean Sheets</td>	<td><?php // print $text_CS; ?></td><td><?php // print $text_CDP; ?></td></tr>
								<tr><td>Fail to score</td>	<td><?php // print $text_FS; ?></td><td><?php // print $text_FSP; ?></td></tr>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="tab5"><strong>Data Definitions</strong>
							<ul class="small">
								<li>H: Home, A: Away, GT: all fixtures (includes neutral ties).</li>
								<li>All stats are inclusive of all competitions unless specified otherwise</li>
								<li>Fail to score: Opposition clean sheet</li>
							</ul>
						</div>
					  </div>
					</div>
					<?php
				echo "<p><hr/></p>";
*/				
			}

			if(!get_option('tcr_cfc_credit') ) {
			// no nothing here
				echo '</div>';
				echo '</div>';
			} else {			
			
				echo "<small><small style='text-align:justify;' class='muted'>Data provided by <a href='http://www.twitter.com/ChelseaStats' target='_blank'>@ChelseaStats</a> & <a href='http://www.thechels.co.uk' title='ChelseaStats on thechels.co.uk' taget='_blank'>thechels.co.uk</a>. <br/>Get your own widget <a href='http://api.thechels.co.uk/wordpress.php' title='ChelseaStats on thechels.co.uk' taget='_blank'>here</a> using <a href='http://api.thechels.co.uk' title='ChelseaStats on thechels.co.uk' taget='_blank'>this</a>.</small></small>";
				echo '</div>';
				echo '</div>';
			}
		}
}

add_action( 'widgets_init', create_function('', 'return register_widget("ChelseaStatsWidget");') );

// endif;
?>