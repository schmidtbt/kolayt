{* Include header template files 
{assign var="csstemplate"   value=','|explode:"tag.css"}
{assign var="jstemplate"    value=','|explode:"tag.js"}*}
{assign var="systemplate"   value=','|explode:"urllist,tagtrend,tag,tagsearch"}

{* Assign the header *}
{include file='sub_header.tpl' title="{$user}'s Stream"}

<body>
<div id="wrap">
    <div class="top_corner"></div>
    <div id="main_container">
        
        {include file='sub_banner.tpl'}
        
        {include file='system/imgslider/imgslider.tpl' urls=$fullurls}
        
        {include file='system/tagtrend/tagtrend.tpl' tags=$trend_tags}
        
        {include file='system/urllist/urllist.tpl'}
            
        {include file='sub_footer.tpl'}
        
    </div>
</div>
</body>

</html>
</html>