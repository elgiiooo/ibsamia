<?php
/* Custom functions code goes here. */

include('test.php');
include('test-js.php');

/////// CREAZIONE SHORTCODE /////////
  
add_shortcode( 'emailform', 'custom_shortcode_emailform' );
 
function custom_shortcode_emailform() {   
    ob_start();
	
	
	$api_key = 'e0778750b5ef08d0d47f94c70d31e66e-us8';
	$list_id = '34f492f735';
	$us = 'us8'; 

	$userid = md5($_GET['email']);
    $auth = base64_encode( 'user:'. $api_key );
    $data = array(
        'apikey'        => $api_key,
        'email_address' => $_GET['email']
        );
    $json_data = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://'.$us.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members/' . $userid);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
        'Authorization: Basic '. $auth));
    curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    $result = curl_exec($ch);

    //var_dump($result);

    $json = json_decode($result);
    
    $mailchimp_status = $json->{'status'};
    //echo $mailchimp_status;

  
	if ($mailchimp_status == 'subscribed'){
		
		echo '		
		<div class="mystatus">
		Il tuo indirizzo email<br>
		risulta già registrato.
		</div>
	
		';

		
		
	} else {
		
		echo '
		<div class="mystatus">
			Grazie per esserti registrato.<br>
			Ti abbiamo mandato una mail di conferma all’indirizzo da te indicato.
	</div>
				
		';
		
	}


		
	
    return ob_get_clean();
}














add_action('wp_footer', 'hook_javascript', 999);

function hook_javascript() {	
  	
	
	
	
	
    ?>
	<script>
		jQuery(function($){ 
			
			
			$(".page-id-7565 .wpcf7-submit, .page-id-7031 .wpcf7-submit").click(function(){
				  
			  function isValidEmailAddress(emailAddress) {
    			  var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    			  return pattern.test(emailAddress);
    		  };			  
				  
				  
				var email = $('input.wpcf7-validates-as-email').val();
				var nome = $('input[name="your-name"]').val();  
				var cognome = $('input[name="your-cognome"]').val(); 
				var comune = $('input[name="your-comune"]').val();
				 
				 if ( email != '' && isValidEmailAddress(email) && nome != '' && cognome != '' && comune != ''  ) {
					  $(".response").empty();	
					  $(".response").text('Attendere...');	
					  $('.response').load( 'https://euclorina.com/check-mailchimp/?email=' +  email + ' .mystatus');
				  
					$(".cf7-resp").show();	
					$(".wpcf7-response-output").hide();	
				
				 } else {
					$(".wpcf7-response-output").show();	 
				 }
				

				
				});
				
			
			
			
			$("input#wpsl-search-input").attr("placeholder", "Inserisci la città, provincia o CAP*");
			
			
			/*
			document.addEventListener( 'wpcf7mailsent', function( event ) {
			  if ( '368' == event.detail.contactFormId ) {
				$(".cf7-resp").show();	
				$(".wpcf7-response-output").hide();					 
			  }
			}, false );					
			*/
			
			
			$(".mclose").click(function(){
			 $(".cf7-resp").hide();	
			});

	   }); 

			
		
		
		
	</script>  
    <?php
}









//add_filter( 'wpsl_js_settings', 'custom_js_settings' );

function custom_js_settings( $settings ) {

    $settings['startMarker'] = '';

    return $settings;
}




/*** caricamento css per nuovo template prodotto **/
function et_nexus_load_scripts_styles(){
    
	$categories = get_categories(); 
	foreach($categories as $category) {
		$background=get_field('colore_categoria','category_'.$category->term_id);
		?>
		<style>
		
		.category-<?php echo $category->slug; ?> .color_categoria{
			width:100%;
			height:9px;
			background:<?php echo $background;?>;
		}
		
		</style>
		<?php
	}
    
	?>
	
	
       
        
    <?php

}
add_action( 'wp_enqueue_scripts', 'et_nexus_load_scripts_styles' );

/** marker wpsl***/
add_filter( 'wpsl_admin_marker_dir', 'custom_admin_marker_dir' );
function custom_admin_marker_dir() {
$admin_marker_dir = get_stylesheet_directory() . '/wpsl-markers/';
return $admin_marker_dir;
}

define( 'WPSL_MARKER_URI', dirname( get_bloginfo( 'stylesheet_url') ) . '/wpsl-markers/' );






//add_action( 'wpcf7_mail_sent', 'your_wpcf7_mail_sent_function' ); 
function your_wpcf7_mail_sent_function( $contact_form ) {
  
	//$title = $contact_form->title;
	$id = $contact_form->id;
	$submission = WPCF7_Submission::get_instance();  
    if ( $submission ) {
        $posted_data = $submission->get_posted_data();
    }
	
	$to = strtolower($posted_data['your-email']);
	//$to = $_POST['your-email'];
	$subject = '[Euclorina] Grazie per esserti iscritto';
	$body ='
	

<!DOCTYPE html>
<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="it">
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!--[if mso]>
    <xml>
      <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
        <o:AllowPNG/>
      </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <style>
      *{box-sizing:border-box}body{margin:0;padding:0}a[x-apple-data-detectors]{color:inherit!important;text-decoration:inherit!important}#MessageViewBody a{color:inherit;text-decoration:none}p{line-height:inherit}.desktop_hide,.desktop_hide table{mso-hide:all;display:none;max-height:0;overflow:hidden}@media (max-width:620px){.row-content{width:100%!important}.mobile_hide{display:none}.stack .column{width:100%;display:block}.mobile_hide{min-height:0;max-height:0;max-width:0;overflow:hidden;font-size:0}.desktop_hide,.desktop_hide table{display:table!important;max-height:none!important}}
    </style>
  </head>
  <body style="background-color:#fff;margin:0;padding:0;-webkit-text-size-adjust:none;text-size-adjust:none">
    <table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#fff">
      <tbody>
        <tr>
          <td>
            <table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" 
              style="mso-table-lspace:0;mso-table-rspace:0;background-image:url(https://euclorina.com/wp-content/uploads/2022/10/header-back.png);background-repeat:no-repeat;background-size:cover">
              <tbody>
                <tr>
                  <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;color:#000;background-size:auto;width:600px" 
                      width="600">
                      <tbody>
                        <tr>
                          <td class="column column-1" width="100%" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;vertical-align:top;padding-top:30px;padding-bottom:20px;border-top:0;border-right:0;border-bottom:0;border-left:0">
                            <table class="image_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0">
                              <tr>
                                <td class="pad" style="width:100%;padding-right:0;padding-left:0">
                                  <div 
                                    class="alignment" align="center" style="line-height:10px"><img src="https://euclorina.com/wp-content/uploads/2022/10/dompe-logo-email-header.png" style="display:block;height:auto;border:0;width:83px;max-width:100%" width="83"></div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" 
              style="mso-table-lspace:0;mso-table-rspace:0;background-color:#d7ebfa">
              <tbody>
                <tr>
                  <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;color:#000;border-radius:0;width:600px" width="600">
                      <tbody>
                        <tr>
                          <td class="column column-1" width="100%" 
                            style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;vertical-align:top;padding-top:25px;padding-bottom:30px;border-top:0;border-right:0;border-bottom:0;border-left:0">
                            <table class="image_block block-1" width="100%" border="0" cellpadding="15" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0">
                              <tr>
                                <td class="pad">
                                  <div class="alignment" align="center" style="line-height:10px"><img 
                                    src="https://euclorina.com/wp-content/uploads/2022/10/euclorina-logo-email.png" style="display:block;height:auto;border:0;width:254px;max-width:100%" width="254"></div>
                                </td>
                              </tr>
                            </table>
                            <table class="text_block block-2" width="100%" border="0" cellpadding="15" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word">
                              <tr>
                                <td class="pad">
                                  <div 
                                    style="font-family:sans-serif">
                                    <div class style="font-size:14px;mso-line-height-alt:16.8px;color:#555;line-height:1.2;font-family:Arial,Helvetica Neue,Helvetica,sans-serif">
                                      <p style="margin:0;text-align:center;mso-line-height-alt:16.8px"><span style="font-size:20px;">Grazie per esserti iscritto a Euclorina®.</span></p>
                                      <p style="margin:0;text-align:center;mso-line-height-alt:16.8px">&nbsp;</p>
                                      <p style="margin:0;text-align:center;mso-line-height-alt:24px">
                                        <span style="font-size:34px;"><strong>Congratulazioni,&nbsp;</strong></span>
                                      </p>
                                      <p style="margin:0;text-align:center;mso-line-height-alt:40.8px"><span style="font-size:20px;">la tua registrazione è andata a buon fine!</span></p>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="row row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" 
              style="mso-table-lspace:0;mso-table-rspace:0;background-color:#294985;background-size:auto">
              <tbody>
                <tr>
                  <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;color:#000;border-radius:0;background-size:auto;width:600px" width="600">
                      <tbody>
                        <tr>
                          <td class="column column-1" width="100%" 
                            style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;vertical-align:top;padding-top:0;padding-bottom:0;border-top:0;border-right:0;border-bottom:0;border-left:0">
                            <table class="empty_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0">
                              <tr>
                                <td class="pad">
                                  <div></div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="row row-4" align="center" width="100%" 
              border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0">
              <tbody>
                <tr>
                  <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;color:#000;border-radius:0;width:600px" width="600">
                      <tbody>
                        <tr>
                          <td class="column column-1" width="100%" 
                            style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;vertical-align:top;padding-top:5px;padding-bottom:5px;border-top:0;border-right:0;border-bottom:0;border-left:0">
                            <table class="image_block block-1" width="100%" border="0" cellpadding="15" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0">
                              <tr>
                                <td class="pad">
                                  <div class="alignment" align="center" style="line-height:10px"><img 
                                    src="https://euclorina.com/wp-content/uploads/2022/10/dompe-logo-email-footer.png" style="display:block;height:auto;border:0;width:112px;max-width:100%" width="112"></div>
                                </td>
                              </tr>
                            </table>
                            <table class="text_block block-2" width="100%" border="0" cellpadding="15" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word">
                              <tr>
                                <td class="pad">
                                  <div 
                                    style="font-family:sans-serif">
                                    <div class style="font-size:14px;mso-line-height-alt:16.8px;color:#555;line-height:1.2;font-family:Arial,Helvetica Neue,Helvetica,sans-serif">
                                      <p style="margin:0;font-size:14px;text-align:center;mso-line-height-alt:16.8px">Dompé farmaceutici S.p.A.<br>+39 02 583 831 • Via Santa Lucia, 6 • 20122 Milano (MI) - Italia</p>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="row row-5" align="center" width="100%" border="0" 
              cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-image:url(https://euclorina.com/wp-content/uploads/2022/10/footer-back.png);background-repeat:no-repeat;background-size:cover">
              <tbody>
                <tr>
                  <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" 
                      style="mso-table-lspace:0;mso-table-rspace:0;color:#000;background-size:auto;width:600px" width="600">
                      <tbody>
                        <tr>
                          <td class="column column-1" width="100%" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;vertical-align:top;padding-top:30px;padding-bottom:20px;border-top:0;border-right:0;border-bottom:0;border-left:0">
                            <table class="text_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" 
                              style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word">
                              <tr>
                                <td class="pad">
                                  <div style="font-family:sans-serif">
                                    <div class style="font-size:14px;mso-line-height-alt:16.8px;color:#555;line-height:1.2;font-family:Arial,Helvetica Neue,Helvetica,sans-serif">
                                      <p style="margin:0;font-size:14px;text-align:center;mso-line-height-alt:16.8px"><strong>Se non desidera più ricevere queste e-mail, le basterà scrivere a privacy@dompe.com</strong><br>
                                        <strong>chiedendo la cancellazione da tale servizio</strong>
                                      </p>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- End -->
    <div style="background-color:transparent;">
      <div style="Margin: 0 auto;min-width: 320px;max-width: 500px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;" class="block-grid ">
        <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
          <!--[if (mso)|(IE)]>
          <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td style="background-color:transparent;" align="center">
                <table cellpadding="0" cellspacing="0" border="0" style="width: 500px;">
                  <tr class="layout-full-width" style="background-color:transparent;">
                    <![endif]-->
                    <!--[if (mso)|(IE)]>
                    <td align="center" width="500" style=" width:500px; padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:15px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top">
                      <![endif]-->
                      <div class="col num12" style="min-width: 320px;max-width: 500px;display: table-cell;vertical-align: top;">
                        <div style="background-color: transparent; width: 100% !important;">
                          <!--[if (!mso)&(!IE)]><!-->
                          <div style="border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent; padding-top:15px; padding-bottom:15px; padding-right: 0px; padding-left: 0px;">
                            <!--<![endif]-->
                            <div align="center" class="img-container center  autowidth " style="padding-right: 0px;  padding-left: 0px;">
                              <!--[if mso]>
                              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                  <td style="padding-right: 0px; padding-left: 0px;" align="center">
                                    <![endif]-->
                                    <!--[if mso]>
                                  </td>
                                </tr>
                              </table>
                              <![endif]-->
                            </div>
                            <!--[if (!mso)&(!IE)]><!-->
                          </div>
                          <!--<![endif]-->
                        </div>
                      </div>
                      <!--[if (mso)|(IE)]>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          <![endif]-->
        </div>
      </div>
    </div>
  </body>
</html>


	';
		
	
	$headers = array(
	'Content-Type: text/html; charset=UTF-8',
	'From: [Euclorina] <euclorinainfo@gmail.com>'
	);
	if ( 368 == $id) {
	//if ( 7142 == $id || 368 == $id) {
		wp_mail( $to, $subject, $body, $headers );
	}

}











add_action( 'admin_head', 'rv_custom_wp_admin_style_head' );
add_action( 'wp_enqueue_scripts', 'rv_custom_wp_admin_style_head' );
 
function rv_custom_wp_admin_style_head() { 
 
    $user = wp_get_current_user();
     
    if($user && isset($user->user_login) && 'EuclorinAAdmiN03' == $user->user_login) { ?>
             
            <style>
                 
                li#wp-admin-bar-new-content, /* nuovo contenuto in alto */
                li#wp-admin-bar-comments, /* commenti in alto */
                li#wp-admin-bar-updates, /* aggiornamenti in alto */
                 
                div#welcome-panel, /* pannello benvenuto */
                div#dashboard_right_now, /* pannello in sintesi */
                 
                li#menu-dashboard ul.wp-submenu.wp-submenu-wrap, /* dashboard sottomenu */
                li#menu-comments, /* commenti */
                li#toplevel_page_wpcf7, /* cf7 */
                li#toplevel_page_woocommerce, /* woocommerce */
                li#toplevel_page_us-theme-options, /* impreza */
                li#menu-appearance, /* aspetto */
                li#toplevel_page_yith_plugin_panel, /* yith */
                li#menu-plugins, /* plugin */
                li#menu-tools, /* strumenti */ 
                li#toplevel_page_vc-general, /* visual composer */
                li#menu-settings, /* impostazioni */
                li#toplevel_page_edit-post_type-acf-field-group, /* acf */
                li#toplevel_page_wpseo_dashboard, /* yoast seo */              
                .toplevel_page_revslider .rs-dashboard, /* slider revolution sezione interna */
                .toplevel_page_revslider .rs-update-history-wrapper, /* slider revolution sezione interna */
                li#toplevel_page_sitepress-multilingual-cms-menu-languages, /* wpml */
                 
                li.wp-menu-separator, /* separatore */
                 
                li#wp-admin-bar-customize, /* personalizza in alto - frontend */
                li#wp-admin-bar-ushb-edit-header, /* header in alto - frontend */
                 
                tr#user-1 /* utente 1 */,
				li#toplevel_page_wpda_duplicate_post_menu,
				li#toplevel_page_duplicator
     
                {
                    display:none!important;
                }
                 
                 
                #adminmenu li {
                    margin-bottom: 5px;
                }
                 
                .post-type-us_portfolio div#postdivrich {
                    display: none;
                }
                 
            </style>          
 
    <?php }   
 
}






// link menu admin sidebar (username diversa da admin principale)
 
$user = wp_get_current_user();
 
if($user && isset($user->user_login) && 'EuclorinAAdmiN03' == $user->user_login) {
     
    add_action( 'admin_menu', 'my_item_menu' );
    function my_item_menu() {
        add_menu_page( 'my_item_menu', 'Menu', 'read', '/nav-menus.php', '', 'dashicons-menu', 60 );
    }
 
    add_action( 'admin_menu', 'my_item_header' );
    function my_item_header() {
        add_menu_page( 'my_item_header', 'Header', 'read', '/post.php?post=32&action=edit', '', 'dashicons-align-center', 61 );
    }
 
    add_action( 'admin_menu', 'my_item_footer' );
    function my_item_footer() {
        add_menu_page( 'my_item_footer', 'Footer', 'read', '/post.php?post=33&action=edit', '', 'dashicons-align-center', 62 );
    }
 
    //see icon on https://developer.wordpress.org/resource/dashicons/
 
}


