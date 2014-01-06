<?php /* Smarty version Smarty-3.1.10, created on 2012-07-08 18:09:53
         compiled from "/kore/server/backend/lib/kore/app/html/www/smarty/templates/sub_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10578091864ff8db73848a70-14020953%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a3cc4c785b48e3bc701708f77786231c08aef0fb' => 
    array (
      0 => '/kore/server/backend/lib/kore/app/html/www/smarty/templates/sub_header.tpl',
      1 => 1341785389,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10578091864ff8db73848a70-14020953',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.10',
  'unifunc' => 'content_4ff8db73932580_92518654',
  'variables' => 
  array (
    'title' => 0,
    'csstemplate' => 0,
    'jstemplate' => 0,
    'systemplate' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff8db73932580_92518654')) {function content_4ff8db73932580_92518654($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("include/doctype.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?php echo $_smarty_tpl->getSubTemplate ("head/meta.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



<?php echo $_smarty_tpl->getSubTemplate ("head/base_title.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>



<!-- CSS libraries -->
<?php echo $_smarty_tpl->getSubTemplate ("head/css/basecss.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<!-- CSS -->
<?php if (isset($_smarty_tpl->tpl_vars['csstemplate']->value)){?>
    <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['csstemplate']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
<?php echo $_smarty_tpl->getSubTemplate ("head/css/".((string)$_smarty_tpl->tpl_vars['i']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <?php } ?>
<?php }?>



<!-- JS libraries -->
<?php echo $_smarty_tpl->getSubTemplate ("head/js/lib.js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php if (isset($_smarty_tpl->tpl_vars['jstemplate']->value)){?>
<!-- JS -->
    <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['jstemplate']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
<?php echo $_smarty_tpl->getSubTemplate ("head/js/".((string)$_smarty_tpl->tpl_vars['i']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <?php } ?>
<?php }?>


<?php if (isset($_smarty_tpl->tpl_vars['systemplate']->value)){?>
<!-- SYSTEMS -->
    <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['systemplate']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
?>
<?php echo $_smarty_tpl->getSubTemplate ("system/".((string)$_smarty_tpl->tpl_vars['i']->value)."/".((string)$_smarty_tpl->tpl_vars['i']->value).".sys.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <?php } ?>
<?php }?>
</head>
<?php }} ?>