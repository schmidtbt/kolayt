<?php /* Smarty version Smarty-3.1.10, created on 2012-07-07 20:50:45
         compiled from "/kore/server/backend/lib/kore/app/html/www/smarty/templates/system/tagtrend/tagtrend.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14026543034ff8d965956632-02981086%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '58cf8dd180b6c1d3e4419df97fe1a999cc00b70e' => 
    array (
      0 => '/kore/server/backend/lib/kore/app/html/www/smarty/templates/system/tagtrend/tagtrend.tpl',
      1 => 1341266819,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14026543034ff8d965956632-02981086',
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
  'unifunc' => 'content_4ff8d9659af5f2_54008091',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff8d9659af5f2_54008091')) {function content_4ff8d9659af5f2_54008091($_smarty_tpl) {?><div class="tagtrend-box">
<span class="trending-tags">Trending Tags</span>
<ul>
<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['trend_tags']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
    <li class="tagtrend tag"><?php echo $_smarty_tpl->getSubTemplate ("disp/disp_tag.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('tag'=>$_smarty_tpl->tpl_vars['i']->value['key'],'disp'=>$_smarty_tpl->tpl_vars['i']->value['disp']), 0);?>
</li>
<?php } ?> 
</ul>
</div>
<br style="clear:both;" /><?php }} ?>