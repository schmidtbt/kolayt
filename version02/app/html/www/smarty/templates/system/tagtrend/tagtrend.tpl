<div class="tagtrend-box">
<span class="trending-tags">Trending Tags</span>
<ul>
{foreach from=$trend_tags key=myId item=i}
    <li class="tagtrend tag">{include file="disp/disp_tag.tpl" tag=$i.key disp=$i.disp}</li>
{/foreach} 
</ul>
</div>
<br style="clear:both;" />