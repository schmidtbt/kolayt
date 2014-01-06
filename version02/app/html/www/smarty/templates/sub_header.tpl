{include file="include/doctype.tpl"}
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
{* Generate any Meta Tags *}
{include file="head/meta.tpl"}

{* Create the browser title bar *}
{include file="head/base_title.tpl" title=$title}

{* Include CSS Files *}
<!-- CSS libraries -->
{include file="head/css/basecss.tpl"}
<!-- CSS -->
{if isset( $csstemplate) }
    {foreach from=$csstemplate item=i}
{include file="head/css/$i.tpl"}
    {/foreach}
{/if}


{* Include JS Files *}
<!-- JS libraries -->
{include file="head/js/lib.js.tpl"}
{if isset( $jstemplate) }
<!-- JS -->
    {foreach from=$jstemplate item=i}
{include file="head/js/$i.tpl"}
    {/foreach}
{/if}

{* Include Systems *}
{if isset( $systemplate) }
<!-- SYSTEMS -->
    {foreach from=$systemplate item=i}
{include file="system/$i/$i.sys.tpl"}
    {/foreach}
{/if}
</head>
