=== 新浪云商店顶级域名访问301重定向插件 ===
Contributors: CplusHua<weibo.com/778936639>
Donate link: http://weibo.com/778936639
Tags: ysd 新浪 云商店 301 重定向 redirect
Requires at least: 3.0
Tested up to: 4.1.1
Stable tag: 1.1
License: GPLv2 or later

新浪云商店二级域名重定向到顶级域名,自动绑定顶级域名

== Description ==
ysd-301redirect插件的主要功能:
1.第一次启用ysd-301redirect插件,使用顶级域名访问博客,自动绑定顶级域名
2.修复了未发送header默认302重定向的问题
3.自动修改站点siteurl和home，实现博客地址的顶级域名绑定
4.所有请求的url均可进行301重定向，即博客不是 ?p=n的链接也可以被重定向

== Installation ==

1. Upload the `ysd-301redirect` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Configure the settings using "WP 301redirect" under Settings panel.

下载 云商店打包插件，上传ysd-301redirect目录及其文件到 "/wp-content/plugins/" 插件目录，在后台管理中激活插件，到设置页面开启功能并设置等.

== Screenshots ==
1.301redirect
== Changelog ==
=1.0=
完成基本功能
=1.1=
功能升级

== Frequently Asked Questions ==
1.如何安装
在云商店后台搜索ysd即可找但该插件，并安装即可
== Upgrade Notice ==
1.已经兼容3.5.1
== Update Readme==
在填写域名时，请确保域名已经解析到当前博客，否则可能引起博客无法访问。
== Update Readme==
更改可支持版本号码

注意：
如果填写错误，可以使用PHPMyadmin打开数据库，
在wp_option表中点击上方的【搜索】按钮，
在option_value处选择"LIKE%...%"，
然后填写你填错的域名，此时会搜到三个值，
分别修改这三个错误的域名为正确的域名即可。

