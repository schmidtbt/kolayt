

{if sizeof( $urls ) eq 0 }
{else}
<div class="middle_banner">
<div class="featured_slider">
      	<!-- begin: sliding featured banner -->
         <div id="featured_border" class="jcarousel-container">
            <div id="featured_wrapper" class="jcarousel-clip">
               <ul id="featured_images" class="jcarousel-list">
                    {foreach from=$urls key=myId item=i}
                        <li class="fitem">
                            <div class="fimg-wrap">
                                <div class="feature-img">
                                    <img src="{$i.img}">
                                </div>
                            </div>
                            <div class="feature-info">
                                <div class="feature-title">
                                    {if isset( $i.title )}
                                    {$i.title}
                                    {/if}
                                </div>
                                <div class="feature-descr">
                                    {if isset( $i.describe )}
                                    {$i.describe}
                                    {/if}
                                </div>
                            </div>
                            
                        </li>
                    {/foreach} 
               </ul>
            </div>
            <ul id="featured_buttons" class="clear_fix">
            {foreach from=$urls key=myId item=i}
                <li>{$myId+1}</li>
            {/foreach} 
            </ul>
            
         </div>
         <!-- end: sliding featured banner -->
</div>
          
        

        </div><!---------------------------------end of middle banner-------------------------------->
{/if}       

{*
{if sizeof( $urls ) eq 0 }
{else}
<div class="middle_banner">
<div class="featured_slider">
      	<!-- begin: sliding featured banner -->
         <div id="featured_border" class="jcarousel-container">
            <div id="featured_wrapper" class="jcarousel-clip">
               <ul id="featured_images" class="jcarousel-list">
                    {foreach from=$urls key=myId item=i}
                        <li><img src="{$i.img}" width="965" height="280" alt="" /></li>
                    {/foreach} 
               </ul>
            </div>
            <div id="featured_positioner_desc" class="jcarousel-container">
               <div id="featured_wrapper_desc" class="jcarousel-clip">
                  <ul id="featured_desc" class="jcarousel-list">                 
                    {foreach from=$urls key=myId item=i}
                        <li>
                            <div>
                            <p>

                                {if isset( $i.describe )}
                                {$i.describe}
                                {else}
                                {$i.title}
                                {/if}
                            </p>
                            </div>
                        </li> 
                    {/foreach} 
                  </ul>
               </div>

            </div>
            
            <ul id="featured_buttons" class="clear_fix">
            {foreach from=$urls key=myId item=i}
                <li>{$myId+1}</li>
            {/foreach} 
            </ul>
            
         </div>
         <!-- end: sliding featured banner -->
</div>
          
        

        </div><!---------------------------------end of middle banner-------------------------------->
{/if}       
*}