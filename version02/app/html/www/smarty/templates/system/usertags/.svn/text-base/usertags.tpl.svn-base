
<div id="usertagbox">
    <h1>My Tags</h1>
    <ul>
    {if isset( $usertags ) }
        {foreach from=$usertags key=myId item=i}
            <li class="usertag tag">{include file="disp/disp_tag.tpl" tag=$i.tagkey disp=$i.tagdisp}<span class="stopfollowing">Remove</span></li>
        {/foreach}
    {/if}
    </ul>
</div>