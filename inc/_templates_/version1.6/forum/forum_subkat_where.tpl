<a href="../forum/">{$mainkat}</a>
<span class="fontBold">{lang msgID="forum_head"}:</span>
<a href="?action=show&amp;kid={$kid}">{$wherekat}</a>
{if $tid != 0 || $wherepost != ""}
    <span class="fontBold">{lang msgID="forum_thread"}:</span>
    <a href="?action=showthread&amp;kid={$kid}&amp;id={$tid}">{$wherepost}</a>
{/if}