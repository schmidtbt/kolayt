{* Include header template files 
{assign var="csstemplate"   value=','|explode:"tag.css"}
{assign var="jstemplate"    value=','|explode:"tag.js"}*}
{assign var="systemplate"   value=','|explode:"tag,usertags"}

{* Assign the header *}
{include file='sub_header.tpl' title=$userdata.disp}

<body>
<div id="wrap">
    <div class="top_corner"></div>
    <div id="main_container">
        
        {include file='sub_banner.tpl'}
        
        {include file="system/usertags/usertags.tpl" }
        
        {include file='sub_footer.tpl'}
        
    </div>
</div>
</body>
</html>