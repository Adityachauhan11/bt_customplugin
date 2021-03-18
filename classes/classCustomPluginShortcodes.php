<?php
 class WPshortcode{
	 
  
  public function __construct(){
	  add_action('init', [$this, 'initShortcode']);
  }	 
  public function initShortcode(){
	  
	add_shortcode('upload-file', [$this, 'uploadfiles']);
	add_shortcode('bt-travel-form', [$this, 'travel_listing']);
  }
  public function uploadfiles()
  {
	 $this->uplodeImgFolder();
	 include_once BT_CUSTOM_PLUGIN_ABSPATH . '/views/uploadfile.php'; 
  }
   public function travel_listing()
  {
	 $this->savetravellistform();
	 include_once BT_CUSTOM_PLUGIN_ABSPATH . '/views/travellists.php'; 
  }
	
	public function uplodeImgFolder()
	{
     if(isset($_POST['my_submit_btn'])){
	 if (!function_exists('wp_handle_upload'))
    { 
     require_once( ABSPATH . '/wp-admin/includes/file.php' );
    }
	if($_FILES['file']['name'] != ''){
		
    $uploadedfile = $_FILES['file'];
    $upload_overrides = array( 'test_form' => false );

    $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
    $imageurl = "";
    if ( $movefile && ! isset( $movefile['error'] ) ) {
       $imageurl = $movefile['url'];
	   
        echo "url : ".$imageurl;
	   
    } else {
       echo $movefile['error'];
    }
  }
	
      }	
	}
  public function savetravellistform()
  {
	  
	 
	  if (isset( $_POST['bt_custom_field'] ) && wp_verify_nonce( $_POST['bt_custom_field'], 'bt_custom_action' ) ) {
		 		
		$bt_custompost_args = array(

	'post_title'    => $_POST['title'],

	'post_content'  => $_POST['description'],

	'post_status'   => 'publish',

	'post_type' => 'travel_list'
     
	);
	// insert the post into the database
    $wp_error = '';
	$bt_id = wp_insert_post( $bt_custompost_args, $wp_error);
	$uploaddir = wp_upload_dir();
	$file = $_FILES['post_Fimage']['name'];
	$uploadfile = $uploaddir['path'] . '/' . basename( $file );

	move_uploaded_file( $_FILES["post_Fimage"]["tmp_name"] , $uploadfile );
	$filename = basename( $uploadfile );

	$wp_filetype = wp_check_filetype(basename($filename), null );

	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
		'post_content' => '',
		'post_status' => 'publish',
		//'menu_order' => $_i + 1000
	);
	
	$attach_id = wp_insert_attachment( $attachment, $uploadfile );
	set_post_thumbnail( $bt_id, $attach_id ); 
	
	}
   	
  }	
}
return new WPshortcode();
?>