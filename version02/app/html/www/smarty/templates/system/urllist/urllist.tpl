

<div ul class="cell-container">
    {foreach from=$urls key=myId item=i}
        {if is_null( $i.title ) }

        {else}
            <div class="cell">
                <div class="urllist-title">
                    <a href="{include file="links/link_short.tpl" short=$i.short}">{$i.title}</a>
                </div>
                <div class="urllist-host">
                    {$i.host}
                </div>
                <div class="urllist-media {if isset( $i.media.type) && $i.media.type !== 'none' }has-media{/if}">
                {if isset( $i.media.type) && $i.media.type !== 'none'  }

                    {if $i.media.type eq 'img'}
                        {if !isset($i.media.thumb) }
                            
                        {else}
                            <img src="{$i.media.thumb}" />
                        {/if}
                    {elseif $i.media.type eq 'vid'}
                        {if $i.media.provider eq 'Pipe_Video_Youtube' }
                            <iframe width="220" height="220" src="{$i.media.embed}" frameborder="0" allowfullscreen></iframe>
                        {elseif $i.media.provider eq 'Pipe_Video_Vimeo' }
                            {if isset( $i.media.vidkey ) }
                                <iframe src="http://player.vimeo.com/video/{$i.media.vidkey}" width="500" height="375" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                            {else}
                                invalid vimeo id
                            {/if}
                        {/if}
                    {else}
                        invalid media
                    {/if}
                {/if}
                </div>
                
            </div>
                
            
        {/if}
    {/foreach}
</div>