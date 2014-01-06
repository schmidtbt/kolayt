<?php /* Smarty version Smarty-3.1.10, created on 2012-07-09 21:43:07
         compiled from "/kore/server/backend/lib/kore/app/html/www/smarty/templates/sub_banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6340386314ff8db73991285-26044560%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7221271e254d518fc3fff494be55987725219b2b' => 
    array (
      0 => '/kore/server/backend/lib/kore/app/html/www/smarty/templates/sub_banner.tpl',
      1 => 1341884567,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6340386314ff8db73991285-26044560',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.10',
  'unifunc' => 'content_4ff8db739cf667_46619666',
  'variables' => 
  array (
    'userdata' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff8db739cf667_46619666')) {function content_4ff8db739cf667_46619666($_smarty_tpl) {?><div id="header">
    
    <div id="top-header">
    <!--<div id="logo"><a href="index.html"><img src="images/kolayt_alpha_logo.png" height="91px" alt="" title="" border="0" /></a></div>-->
    <div id="logo"><span id="logoname">Kolayt<span id="logocom">.com</span><span id="logotag">Your Stuff Now</span></div>

        <div id="menu">
            <ul id="buttonmenu">
                <li><a href="/boot/" title="">Home</a></li>
                <li><a href="/boot/?p=about" title="">About Kolayt</a></li>
                <li><a href="#" title="">Projects</a></li>
                <li><a href="/boot/?p=contact" title="">Contact</a></li>
                <?php if (isset($_smarty_tpl->tpl_vars['userdata']->value)){?>
                    <?php if (!is_null($_smarty_tpl->tpl_vars['userdata']->value)){?>
                            <li><a href="/boot/?p=account" title=""><?php echo $_smarty_tpl->tpl_vars['userdata']->value['disp'];?>
's Account</a></li>
                            <li><a href="/boot/?p=login" title="">Log out</a></li>
                        <?php }else{ ?>
                            <li><a href="/boot/?p=login" title="">Login | Sign-up</a></li>
                    <?php }?>
                <?php }else{ ?>
                    <li><a href="/boot/?p=login" title="">Login | Sign-up</a></li>
                <?php }?>
            </ul>

        </div>
    </div>    
    <br style="clear:both;" />
    <div id="searchwrap">
        <input type="text" placeholder="What are you interested in?" id="tagsearch" size="50"><div id="tagsearchresult" style="display:none;"></div>
    </div>

</div><?php }} ?>