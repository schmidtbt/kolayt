<div id="header">
    
    <div id="top-header">
    <!--<div id="logo"><a href="index.html"><img src="images/kolayt_alpha_logo.png" height="91px" alt="" title="" border="0" /></a></div>-->
    <div id="logo"><span id="logoname">Kolayt<span id="logocom">.com</span><span id="logotag">Your Stuff Now</span></div>

        <div id="menu">
            <ul id="buttonmenu">
                <li><a href="/boot/" title="">Home</a></li>
                <li><a href="/boot/?p=about" title="">About Kolayt</a></li>
                <li><a href="#" title="">Projects</a></li>
                <li><a href="/boot/?p=contact" title="">Contact</a></li>
                {if isset( $userdata ) }
                    {if !is_null( $userdata ) }
                            <li><a href="/boot/?p=account" title="">{$userdata.disp}'s Account</a></li>
                            <li><a href="/boot/?p=login" title="">Log out</a></li>
                        {else}
                            <li><a href="/boot/?p=login" title="">Login | Sign-up</a></li>
                    {/if}
                {else}
                    <li><a href="/boot/?p=login" title="">Login | Sign-up</a></li>
                {/if}
            </ul>

        </div>
    </div>    
    <br style="clear:both;" />
    <div id="searchwrap">
        <input type="text" placeholder="What are you interested in?" id="tagsearch" size="50"><div id="tagsearchresult" style="display:none;"></div>
    </div>

</div>