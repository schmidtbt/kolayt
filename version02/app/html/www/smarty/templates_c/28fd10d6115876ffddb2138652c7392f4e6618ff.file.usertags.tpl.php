<?php /* Smarty version Smarty-3.1.10, created on 2012-07-08 18:50:47
         compiled from "/kore/server/backend/lib/kore/app/html/www/smarty/templates/system/usertags/usertags.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8743073984ffa0adcd07915-16774053%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '28fd10d6115876ffddb2138652c7392f4e6618ff' => 
    array (
      0 => '/kore/server/backend/lib/kore/app/html/www/smarty/templates/system/usertags/usertags.tpl',
      1 => 1341787846,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8743073984ffa0adcd07915-16774053',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.10',
  'unifunc' => 'content_4ffa0adcd65831_81474705',
  'variables' => 
  array (
    'usertags' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ffa0adcd65831_81474705')) {function content_4ffa0adcd65831_81474705($_smarty_tpl) {?>
<div id="usertagbox">
    <h1>My Tags</h1>
    <ul>
    <?php if (isset($_smarty_tpl->tpl_vars['usertags']->value)){?>
        <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['usertags']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
            <li class="usertag tag"><?php echo $_smarty_tpl->getSubTemplate ("disp/disp_tag.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('tag'=>$_smarty_tpl->tpl_vars['i']->value['tagkey'],'disp'=>$_smarty_tpl->tpl_vars['i']->value['tagdisp']), 0);?>
<span class="stopfollowing">Remove</span></li>
        <?php } ?>
    <?php }?>
    </ul>
</div><?php }} ?>