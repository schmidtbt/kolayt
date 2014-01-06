{if !isset($i.media.thumb) }
    <h2 class="home_title"><a href="/boot/?p=page&short={$i.short}">{$i.title}</a></h2>
{else}
    <h2 class="home_title"><a href="/boot/?p=page&short={$i.short}">{$i.title}</a></h2><img src="{$i.media.thumb}" />
{/if}