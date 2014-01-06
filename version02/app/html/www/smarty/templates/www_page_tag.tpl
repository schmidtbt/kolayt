{* Include header template files *}
{assign var="csstemplate"   value=','|explode:"tag.css"}
{assign var="jstemplate"    value=','|explode:"tag.js"}
{assign var="systemplate"   value=','|explode:"urllist,tagtrend,tag,tagsearch"}

{* Assign the header *}
{include file='sub_header.tpl' title=$tag}

<body>
<div id="wrap">
    <div id="main_container">
        
        {include file='sub_banner.tpl'}
        
        <div id="tag-banner">
            <div id="tag-banner-display">{$tag}</div>
            <div id="tag-banner-numfollow">{$tag_num_followers} Follower{if $tag_num_followers gt 1 || $tag_num_followers eq 0}s{/if}</div>

            {*Display button to follow/unfollow/login *}
            {if isset( $following ) }
                {if $following}
                    <div id="tag-banner-followtag">Unfollow</div>
                {else}
                    <div id="tag-banner-followtag">Follow</div>
                {/if}

            {else}
                <div id="tag-banner-followtag">Login To Follow</div>
            {/if}
            
            <br style="clear:both;">
        </div>
        {include file='system/imgslider/imgslider.tpl' urls=$fullurls}
        
        {include file='system/tagtrend/tagtrend.tpl' tags=$trend_tags}
        
        {include file='system/urllist/urllist.tpl'}
        
        {include file='sub_footer.tpl'}
        
    </div>
</div>
</body>

</html>