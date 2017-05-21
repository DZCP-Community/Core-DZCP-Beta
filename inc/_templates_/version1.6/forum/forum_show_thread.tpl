<table class="mainContent" width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
        <td class="contentHead" colspan="5"><span class="fontBold">&nbsp;{lang msgID="forum_head_threads"}&nbsp;</span></td>
    </tr>
</table>
<table class="forumBG" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th class="forumTH" colspan="2">&nbsp;{lang msgID="forum_thread"}&nbsp;</th>
            <th class="forumTH" width="120">&nbsp;{lang msgID="autor"}&nbsp;</th>
            <th class="forumTH" width="40">&nbsp;{lang msgID="replies"}&nbsp;</th>
            <th class="forumTH" width="40">&nbsp;{lang msgID="hits"}&nbsp;</th>
            <th class="forumTH" width="175">&nbsp;{lang msgID="forum_lpost"}&nbsp;</th>
        </tr>          
        {$threads}
        <tr align="center">
            <td class="forumTD" colspan="6">
                <form method="post" action="?action=show&kid={$kid}&id={$id}">
                    <span class="gensmall">{lang msgID="forum_sort_by"}</span>
                    <select name="sortby" id="sk">
                        <option value="autor">{lang msgID="autor"}</option>
                        <option value="time">{lang msgID="forum_sort_bcc"}</option>
                        <option value="posts">{lang msgID="replies"}</option>
                        <option value="hits">{lang msgID="hits"}</option>
                    </select> 
                    <select name="orderby" id="sd">
                        <option value="desc">{lang msgID="forum_sort_descending"}</option>
                        <option value="asc">{lang msgID="forum_sort_ascending"}</option>
                    </select>&nbsp;
                    <input class="submit" id="contentSubmit" type="submit" name="sort" value="{lang msgID="forum_go"}">
                    <input class="submit" id="newPostSubmit" type="button" value="{lang msgID="forum_new_thread"}" onclick="DZCP.goTo('../forum/?action=thread&do=add&kid={$kid}')">
                </form>
            </td>
        </tr>
    </tbody>
</table>