<?php /* Smarty version Smarty-3.1.10, created on 2012-07-07 20:50:37
         compiled from "/kore/server/backend/lib/kore/app/html/www/smarty/templates/sub_trending_tags.tpl" */ ?>
<?php /*%%SmartyHeaderCode:843991534ff8d95d8f88a7-36405564%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c233a9ad0205734cbc77e8c6871b5c734e400d3' => 
    array (
      0 => '/kore/server/backend/lib/kore/app/html/www/smarty/templates/sub_trending_tags.tpl',
      1 => 1341088720,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '843991534ff8d95d8f88a7-36405564',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'trend_tags' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.10',
  'unifunc' => 'content_4ff8d95d92d409_93245560',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff8d95d92d409_93245560')) {function content_4ff8d95d92d409_93245560($_smarty_tpl) {?><ul>
<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['trend_tags']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
    <li><?php echo $_smarty_tpl->getSubTemplate ("disp/disp_tag.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('tag'=>$_smarty_tpl->tpl_vars['i']->value['key'],'disp'=>$_smarty_tpl->tpl_vars['i']->value['disp']), 0);?>
</li>
<?php } ?> 
</ul><?php }} ?>