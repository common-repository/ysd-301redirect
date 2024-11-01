<?php
/*
Plugin Name: 云商店域名访问301重定向插件
Plugin URI: http://www.219.me/update/wordpress/
Description: 云商店二级域名重定向到顶级域名插件，第一次启用插件，可使用顶级域名访问博客即可自动绑定顶级域名,2.17修改版本
Author:CplusHua
Version: 2.1
Author URI: http://weibo.com/778936639
*/
add_action('admin_menu','ysd_redirect_menu');
function ysd_redirect_menu(){
    if(function_exists('add_options_page'))
        add_options_page('访问域名设置','访问域名设置','administrator','ysd_redirect','ysd_redirect_display','ysd_autoedit');
}

function ysd_redirect_display()
{
   if(isset($_POST['ysd_redirect'])&&!empty($_POST['ysd_redirect']))
   {
		$domain=$_POST['ysd_redirect'];
		if('http'!=strtolower(substr($domain, 0,4))) $domain='http://'.$domain;
		@update_option('ysd_redirect',$domain);
		@ysd_autoedit("home",$domain);//home地址
		@ysd_autoedit("siteurl",$domain);//站点地址
?>
     <div id="message" class="updated">保存成功!</div>
<?php
   }
   else if(isset($_POST['ysd_redirect'])&&empty($_POST['ysd_redirect']))//为空则设置为原站点url  xxx.1kapp.com
   {
		$domain='http://'.substr($_SERVER['HTTP_APPNAME'], 5).".1kapp.com";
		@update_option('ysd_redirect',$domain);
		@ysd_autoedit("home",$domain);//home地址
		@ysd_autoedit("siteurl",$domain);//站点地址
		echo '<div id="message" class="updated">恢复成功!</div>';
   }

?>
  <div class="wrap">
  <?php screen_icon(); //显示图标  ?>
  <h2>访问域名设置</h2>
  <p>在这里设置需要调整到的一级域名，如果为空或为应用二级域名则表示不进行跳转.</p>
  <p>建议您在卸载该插件前，将该地址设置为空或应用二级域名</p>
  <form action="" method="post">
  <h3>
  <label>输入你的一级域名:</label>
  <input type="text" id="ysd_redirect" name="ysd_redirect" value="<?php  echo esc_attr(get_option('ysd_redirect')); ?>"  />
  </h3>
  <p>
  <input type="submit" name="submit" value="保存" />
  </p>
  </form>
  <p><b>在填写域名时，请确保域名已经解析到当前博客，否则可能引起博客无法访问。</b></p>
  <p><b>注意：</b><br>如果填写错误，可以使用PHPMyadmin打开数据库，<br>在wp_option表中点击上方的【搜索】按钮，<br>在option_value处选择"LIKE%...%"，<br>然后填写你填错的域名，此时会搜到三个值，<br>分别修改这三个错误的域名为正确的域名即可。</p>
  </div>
<?php
}
add_action('init','ysd_redirect');
function ysd_redirect(){
	if(defined('WP_USE_THEMES')&&($domain=get_option('ysd_redirect'))!=""){
		if('http'!=strtolower(substr($domain, 0,4))) $domain='http://'.$domain;
		$url_info=parse_url($domain);
		if($_SERVER['HTTP_HOST']==$url_info['host']) return ;
		if($_SERVER['REQUEST_URI']!='/') $domain.=$_SERVER['REQUEST_URI'];
		header("HTTP/1.1 301 Moved Permanently");
		header('location:'.$domain);
		exit();
	} else if(defined('WP_USE_THEMES')&&($domain=get_option('ysd_redirect'))==""){//自动绑定顶级域名,开启插件后，使用顶级域名访问一次之后即可自动绑定到wp
		$domain=substr($_SERVER['HTTP_APPNAME'], 5).".1kapp.com";
		if($_SERVER['HTTP_HOST']!=$domain){
			$domain=$_SERVER['HTTP_HOST'];
			if('http'!=strtolower(substr($domain, 0,4))) $domain='http://'.$domain;
			update_option('ysd_redirect',$domain);
		}
		ysd_autoedit("home",$domain);
		ysd_autoedit("siteurl",$domain);
	}
}
//自动修改站点url和实际url地址 siteurl home
function ysd_autoedit($op,$domain){
	$url=get_option($op);
	$host=parse_url($url);
	update_option($op,str_replace("http://".$host['host'],$domain,$url));
}



