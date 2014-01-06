<ul>
{foreach from=$trend_tags key=myId item=i}
    <li>{include file="disp/disp_tag.tpl" tag=$i.key disp=$i.disp}</li>
{/foreach} 
</ul>