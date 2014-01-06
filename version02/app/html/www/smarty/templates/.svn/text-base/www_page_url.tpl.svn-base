{* Include header template files *}
{assign var="csstemplate"   value="url.css"}
{assign var="jstemplate"    value="url.js"}
{* Assign the header *}
{include file='sub_header.tpl' title=$title}

<body>
<div id="wrap">
    <div id="main_container">
    
        {include file='sub_banner.tpl'}
        
        
        <div class="middle_banner">               
           
            
           
<div class="featured_slider">
      	<!-- begin: sliding featured banner -->
         <div id="featured_border" class="jcarousel-container">
            <div id="featured_wrapper" class="jcarousel-clip">
               <ul id="featured_images" class="jcarousel-list">
                    {foreach from=$media key=myId item=i}
                        {if $i.type eq 'image'}
                            <li><img src="{$i.link}" width="965" height="280" /></li>
                        {else}
                            <li><img src="{$i.link}" width="965" height="280" /></li>
                        {/if}
                    {/foreach}
               </ul>
            </div>
            <div id="featured_positioner_desc" class="jcarousel-container">
               <div id="featured_wrapper_desc" class="jcarousel-clip">
                  <ul id="featured_desc" class="jcarousel-list">
                    {foreach from=$media key=myId item=i}
                         <li>
                        <div>
                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                           </p>
                        </div>
                     </li> 
                    {/foreach}
                  </ul>
               </div>

            </div>
            <ul id="featured_buttons" class="clear_fix">
                {foreach from=$media key=myId item=i}
                         <li>{$myId+1}</li>
               {/foreach}
            </ul>
         </div>
         <!-- end: sliding featured banner -->
</div>
          
        
        
        </div><!---------------------------------end of middle banner-------------------------------->
        
        
        <div class="center_content">
        
        
            
            <h1><a href="{include file="links/link_outbound.tpl" short=$short}">{$title}</a></h1>
           
            Views: {$numviews}
            <h3>Tags</h3>
            <ul>
            {foreach from=$tags key=myId item=i}
            <li><a href="/boot/?p=tag&tag={$i.key}">{$i.display}</a></li>
            {/foreach}
            </ul>
        
            <br />
            
            
            {$description}


   
        <div class="clear">
        </div>
        </div>
        {include file='sub_footer.tpl'}
    </div>
</div>
</body>
</html>