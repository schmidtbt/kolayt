<?php /* Smarty version Smarty-3.1.10, created on 2012-07-08 18:34:04
         compiled from "/kore/server/backend/lib/kore/app/html/www/smarty/templates/www_page_account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6033869124ff8e06cd255a9-93425182%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '769ac729330e908d29ee00fb1ae38b82b3594c46' => 
    array (
      0 => '/kore/server/backend/lib/kore/app/html/www/smarty/templates/www_page_account.tpl',
      1 => 1341786843,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6033869124ff8e06cd255a9-93425182',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.10',
  'unifunc' => 'content_4ff8e06cd97ba9_37198497',
  'variables' => 
  array (
    'userdata' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff8e06cd97ba9_37198497')) {function content_4ff8e06cd97ba9_37198497($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars["systemplate"] = new Smarty_variable(explode(',',"tag,usertags"), null, 0);?>


<?php echo $_smarty_tpl->getSubTemplate ('sub_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['userdata']->value['disp']), 0);?>


<body>
<div id="wrap">
    <div class="top_corner"></div>
    <div id="main_container">
        
        <?php echo $_smarty_tpl->getSubTemplate ('sub_banner.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        
        <?php echo $_smarty_tpl->getSubTemplate ("system/usertags/usertags.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        
        <?php echo $_smarty_tpl->getSubTemplate ('sub_footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        
    </div>
</div>
</body>
</html><?php }} ?>