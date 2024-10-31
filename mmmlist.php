<?php
/*
Plugin Name: Recipes to Grocery Lists
Plugin URI: http://www.saymmm.com
Description: Automatically add organized grocery lists with nutritional estimates to your recipe posts.
Version: 1.5
Author: Say Mmm
Author URI: http://www.saymmm.com
License: Licenced to saymmm.com
*/
?>
<?php
	if ( !function_exists( 'add_action' ) ) {
	echo "Oops!! You can not access this page directly.";
	exit;
}
?><?php
add_filter('media_buttons_context', 'wp_mmmlist_media_button');
if (strpos($_SERVER['REQUEST_URI'], 'media-upload.php') && strpos($_SERVER['REQUEST_URI'], 'type=wp_mmmlist'))
{
	wp_mmmlist_iframe_content($_REQUEST);
	exit;
}
add_action('admin_footer', 'wp_mmmlist_js_function');
add_filter('the_content','wp_mmmlist_parseURL');
function wp_mmmlist_media_button($context) {
	
	$wp_mmmlist_media_button_image = site_url().'/wp-content/plugins/'.dirname(plugin_basename(__FILE__)).'/icon.jpg';
	$wp_mmmlist_media_button = ' %s' . '<a href="media-upload.php?type=wp_mmmlist&amp;TB_iframe=true&amp;height=230&amp;width=671" class="thickbox" title="Add Grocery List to Recipe"><img src="'.$wp_mmmlist_media_button_image.'" /></a>';
	//$context=str_replace("width=640","",$context);
	return sprintf($context, $wp_mmmlist_media_button);
}
function wp_mmmlist_iframe_content($querystring)
{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo site_url();?>/wp-content/plugins/<?php echo dirname(plugin_basename(__FILE__)); ?>/mmmlist_style.css" type="text/css" />
<title>Untitled Document</title>
<script type="text/javascript" src="<?php echo site_url();?>/wp-content/plugins/<?php echo dirname(plugin_basename(__FILE__)); ?>/mmmlist.js"></script>

</head>
<body bgcolor="#ffffff" >
<div style="background-color:#FFFFFF;">
<div class="mmmlist_iframe_title">Choose a Grocery List Style</div>
<div class="mmmlist_iframe_caption"><div class="mmmlist_leftfloater"><input id="mmmlist_check1" type="radio"  name="wp_mmmlist_link_type" value="0" checked="checked" /></div> <div class="mmmlist_leftfloater">Text Link</div> <div class="mmmlist_leftfloater"><input id="mmmlist_text" type="text" name="wp_mmmlist_link_text" value="Grocery List" class="mmmlist_input" size="50" /></div><div class="mmmlist_clear"></div></div> 
<div> <div class="mmmlist_leftfloater mmmlist_padtop"><input type="radio"  name="wp_mmmlist_link_type" value="1" /></div> <div class="mmmlist_leftfloater"><img src="<?php echo site_url();?>/wp-content/plugins/<?php echo dirname(plugin_basename(__FILE__)); ?>/imggrocerylist.png" /> </div><div class="mmmlist_clear"></div></div> 
<div class="mmmlist_addbutton"><a href="#"><img onclick="mmm_Place_link('wwwgooglecom');" border="0" src="<?php echo site_url();?>/wp-content/plugins/<?php echo dirname(plugin_basename(__FILE__)); ?>/addtolist.jpg" /></a> </div>
<hr /></div>
</body>
</html>

<?php
}

function wp_mmmlist_js_function()
{
?>
<script type="text/javascript">
function  mmm_Place_link_main(typ,txt){
	
		tb_remove();
		lnk='<p><a href="http://www.saymmm.com/grocerylist.php?url=[mmmlist:url]" target="_blank">';
	var lnk;
	if(typ==0)
	{
		lnk+=txt;
	}
	else
	{
		lnk+='<img src="<?php echo site_url(); ?>/wp-content/plugins/<?php echo dirname(plugin_basename(__FILE__)); ?>/imggrocerylist.png" border="0" alt="" title="" />';
	}
	lnk+='</a></p>';
		if ( typeof tinyMCE != 'undefined' && ( ed = tinyMCE.activeEditor ) && !ed.isHidden() ) {
        		ed.focus();
        		if ( tinymce.isIE )
        			ed.selection.moveToBookmark(tinymce.EditorManager.activeEditor.windowManager.bookmark);

        		ed.execCommand('mceInsertContent', false, lnk);

        	} else if ( typeof edInsertContent == 'function' ) {
        		edInsertContent(edCanvas, lnk);
        	} else {
        		jQuery( edCanvas ).val( jQuery( edCanvas ).val() + lnk );
        	}	
}
</script>
<?php
}

function wp_mmmlist_parseURL($content)
{
	//$content=str_replace("[mmmlist:url]",wp_mmmlist_curPageURL(),$content);
	$content=str_replace("[mmmlist:url]",get_permalink(),$content);
	return $content;
}
function wp_mmmlist_curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

?>
