<?php /* Smarty version Smarty-3.1.10, created on 2012-07-09 20:31:26
         compiled from "/kore/server/backend/lib/kore/app/html/www/smarty/templates/www_page_tag.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1231311324ff8d965430e58-80134223%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c4447c124e0b7a5cd8709094eb4aa547595b429' => 
    array (
      0 => '/kore/server/backend/lib/kore/app/html/www/smarty/templates/www_page_tag.tpl',
      1 => 1341880282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1231311324ff8d965430e58-80134223',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.10',
  'unifunc' => 'content_4ff8d9655847e1_59025641',
  'variables' => 
  array (
    'tag' => 0,
    'tag_num_followers' => 0,
    'following' => 0,
    'fullurls' => 0,
    'trend_tags' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff8d9655847e1_59025641')) {function content_4ff8d9655847e1_59025641($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars["csstemplate"] = new Smarty_variable(explode(',',"tag.css"), null, 0);?>
<?php $_smarty_tpl->tpl_vars["jstemplate"] = new Smarty_variable(explode(',',"tag.js"), null, 0);?>
<?php $_smarty_tpl->tpl_vars["systemplate"] = new Smarty_variable(explode(',',"urllist,tagtrend,tag,tagsearch"), null, 0);?>


<?php echo $_smarty_tpl->getSubTemplate ('sub_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['tag']->value), 0);?>


<body>
<div id="wrap">
    <div id="main_container">
        
        <?php echo $_smarty_tpl->getSubTemplate ('sub_banner.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        
        <div id="tag-banner">
            <div id="tag-banner-display"><?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
</div>
            <div id="tag-banner-numfollow"><?php echo $_smarty_tpl->tpl_vars['tag_num_followers']->value;?>
 Follower<?php if ($_smarty_tpl->tpl_vars['tag_num_followers']->value>1||$_smarty_tpl->tpl_vars['tag_num_followers']->value==0){?>s<?php }?></div>

            
            <?php if (isset($_smarty_tpl->tpl_vars['following']->value)){?>
                <?php if ($_smarty_tpl->tpl_vars['following']->value){?>
                    <div id="tag-banner-followtag">Unfollow</div>
                <?php }else{ ?>
                    <div id="tag-banner-followtag">Follow</div>
                <?php }?>

            <?php }else{ ?>
                <div id="tag-banner-followtag">Login To Follow</div>
            <?php }?>
            
            <br style="clear:both;">
        </div>
        <?php echo $_smarty_tpl->getSubTemplate ('system/imgslider/imgslider.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('urls'=>$_smarty_tpl->tpl_vars['fullurls']->value), 0);?>

        
        <?php echo $_smarty_tpl->getSubTemplate ('system/tagtrend/tagtrend.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('tags'=>$_smarty_tpl->tpl_vars['trend_tags']->value), 0);?>

        
        <?php echo $_smarty_tpl->getSubTemplate ('system/urllist/urllist.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        
        <?php echo $_smarty_tpl->getSubTemplate ('sub_footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        
    </div>
</div>
</body>

</html><?php }} ?>