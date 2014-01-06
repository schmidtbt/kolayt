<?php /* Smarty version Smarty-3.1.10, created on 2012-07-09 20:05:02
         compiled from "/kore/server/backend/lib/kore/app/html/www/smarty/templates/system/imgslider/imgslider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19716758864ff8d965844082-43581962%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e5ecaa176175be4ece341f7332b6d16b06c46cc2' => 
    array (
      0 => '/kore/server/backend/lib/kore/app/html/www/smarty/templates/system/imgslider/imgslider.tpl',
      1 => 1341878673,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19716758864ff8d965844082-43581962',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.10',
  'unifunc' => 'content_4ff8d96594fcf4_04330789',
  'variables' => 
  array (
    'urls' => 0,
    'i' => 0,
    'myId' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ff8d96594fcf4_04330789')) {function content_4ff8d96594fcf4_04330789($_smarty_tpl) {?>

<?php if (sizeof($_smarty_tpl->tpl_vars['urls']->value)==0){?>
<?php }else{ ?>
<div class="middle_banner">
<div class="featured_slider">
      	<!-- begin: sliding featured banner -->
         <div id="featured_border" class="jcarousel-container">
            <div id="featured_wrapper" class="jcarousel-clip">
               <ul id="featured_images" class="jcarousel-list">
                    <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['urls']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
                        <li class="fitem">
                            <div class="fimg-wrap">
                                <div class="feature-img">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['i']->value['img'];?>
">
                                </div>
                            </div>
                            <div class="feature-info">
                                <div class="feature-title">
                                    <?php if (isset($_smarty_tpl->tpl_vars['i']->value['title'])){?>
                                    <?php echo $_smarty_tpl->tpl_vars['i']->value['title'];?>

                                    <?php }?>
                                </div>
                                <div class="feature-descr">
                                    <?php if (isset($_smarty_tpl->tpl_vars['i']->value['describe'])){?>
                                    <?php echo $_smarty_tpl->tpl_vars['i']->value['describe'];?>

                                    <?php }?>
                                </div>
                            </div>
                            
                        </li>
                    <?php } ?> 
               </ul>
            </div>
            <ul id="featured_buttons" class="clear_fix">
            <?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->_loop = false;
 $_smarty_tpl->tpl_vars['myId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['urls']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['i']->key => $_smarty_tpl->tpl_vars['i']->value){
$_smarty_tpl->tpl_vars['i']->_loop = true;
 $_smarty_tpl->tpl_vars['myId']->value = $_smarty_tpl->tpl_vars['i']->key;
?>
                <li><?php echo $_smarty_tpl->tpl_vars['myId']->value+1;?>
</li>
            <?php } ?> 
            </ul>
            
         </div>
         <!-- end: sliding featured banner -->
</div>
          
        

        </div><!---------------------------------end of middle banner-------------------------------->
<?php }?>       

<?php }} ?>