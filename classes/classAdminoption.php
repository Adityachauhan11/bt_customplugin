<?php
 class Adminoption
 {
	public function __construct()
    {
		add_action("admin_menu", [$this, "mycustomplugin_menu"]); 
	}	
   public function mycustomplugin_menu()
   {
	   
	add_menu_page("My Custom Plugin", "My Custom Plugin","manage_options", "myplugin", [$this, "uploadfile"]);
    add_submenu_page("myplugin","Upload file", "Upload file","manage_options", "uploadfile", "uploadfile");   
   }
   public function uploadfile()
   {
	   include_once BT_CUSTOM_PLUGIN_ABSPATH . '/views/uploadfile.php';
   }
   
     
 }
 return new Adminoption();
?>