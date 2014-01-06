<?php /* Smarty version Smarty-3.1.10, created on 2012-07-07 20:50:45
         compiled from "/kore/server/backend/lib/kore/app/html/www/smarty/templates/system/urllist/urllist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4758225074ff8d965a0ce10-87824085%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae7f43bc35354f27a197b007b2be45a127848068' => 
    array (
      0 => '/kore/server/backend/lib/kore/app/html/www/smarty/templates/system/urllist/urllist.tpl',
      1 => 1341274413,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4758225074ff8d965a0ce10-87824085',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'urls' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.10',
  'unifunc' => 'content_4ff8d965c2e513_62313512',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff8d965c2e513_62313512')) {function content_4ff8d965c2e513_62313512($_smarty_tpl) {?>

<div ul class="cell-container">
    <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['urls']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
        <?php if (is_null($_smarty_tpl->tpl_vars['i']->value['title'])){?>

        <?php }else{ ?>
            <div class="cell">
                <div class="urllist-title">
                    <a href="<?php echo $_smarty_tpl->getSubTemplate ("links/link_short.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('short'=>$_smarty_tpl->tpl_vars['i']->value['short']), 0);?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['title'];?>
</a>
                </div>
                <div class="urllist-host">
                    <?php echo $_smarty_tpl->tpl_vars['i']->value['host'];?>

                </div>
                <div class="urllist-media <?php if (isset($_smarty_tpl->tpl_vars['i']->value['media']['type'])&&$_smarty_tpl->tpl_vars['i']->value['media']['type']!=='none'){?>has-media<?php }?>">
                <?php if (isset($_smarty_tpl->tpl_vars['i']->value['media']['type'])&&$_smarty_tpl->tpl_vars['i']->value['media']['type']!=='none'){?>

                    <?php if ($_smarty_tpl->tpl_vars['i']->value['media']['type']=='img'){?>
                        <?php if (!isset($_smarty_tpl->tpl_vars['i']->value['media']['thumb'])){?>
                            
                        <?php }else{ ?>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['i']->value['media']['thumb'];?>
" />
                        <?php }?>
                    <?php }elseif($_smarty_tpl->tpl_vars['i']->value['media']['type']=='vid'){?>
                        <?php if ($_smarty_tpl->tpl_vars['i']->value['media']['provider']=='Pipe_Video_Youtube'){?>
                            <iframe width="220" height="220" src="<?php echo $_smarty_tpl->tpl_vars['i']->value['media']['embed'];?>
" frameborder="0" allowfullscreen></iframe>
                        <?php }elseif($_smarty_tpl->tpl_vars['i']->value['media']['provider']=='Pipe_Video_Vimeo'){?>
                            <?php if (isset($_smarty_tpl->tpl_vars['i']->value['media']['vidkey'])){?>
                                <iframe src="http://player.vimeo.com/video/<?php echo $_smarty_tpl->tpl_vars['i']->value['media']['vidkey'];?>
" width="500" height="375" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                            <?php }else{ ?>
                                invalid vimeo id
                            <?php }?>
                        <?php }?>
                    <?php }else{ ?>
                        invalid media
                    <?php }?>
                <?php }?>
                </div>
                
            </div>
                
            
        <?php }?>
    <?php } ?>
</div><?php }} ?>