</table>
<script language="javascript" type="text/javascript">
    <!-- Preview -->
    var prevURL = '../forum/?action=preview&amp;what=thread&amp;do=addthread';
</script>
<table class="mainContent" cellspacing="0" style="margin-top:0">
<tr>
  <td>
    <form id="forumForm" name="forumForm" action="?action=thread&amp;do={if $edit}edit{else}add{/if}&amp;kid={$kid}{if $edit}&amp;id={$id}{/if}" method="post" onsubmit="return(DZCP.submitButton())">
      <table class="hperc" cellspacing="1">
        <tr>
          <td class="contentHead" colspan="2" align="center"><span class="fontBold">{if $edit}{lang msgID="forum_edit_thread_head"}{else}{lang msgID="forum_new_thread_head"}{/if}</span></td>
        </tr>
          {$notification}
        <tr>
          <td class="contentMainTop"><span class="fontBold">{lang msgID="forum_topic"}:</span></td>
          <td class="contentMainFirst" align="center">
            <input type="text" name="topic" value="{$posttopic}" class="inputField_dis"
            onfocus="this.className='inputField_en';"
            onblur="this.className='inputField_dis';" />
          </td>
        </tr>
        <tr>
          <td class="contentMainTop"><span class="fontBold">{lang msgID="forum_subtopic"}:</span></td>
          <td class="contentMainFirst" align="center">
            <input type="text" name="subtopic" value="{$postsubtopic}" class="inputField_dis"
            onfocus="this.className='inputField_en';"
            onblur="this.className='inputField_dis';" /></td>
        </tr>
        {$form}
        <tr>
          <td class="contentMainFirst" align="center" colspan="2">
            <textarea id="eintrag" name="eintrag" cols="0" rows="0" class="editorStyle">{$posteintrag}</textarea>
          </td>
        </tr>
        <tr>
          <td class="contentMainTop" colspan="2" align="center">{lang msgID="iplog_info"}</td>
        </tr>
        {$admin}
        {$vote}
        <tr>
          <td class="contentBottom" colspan="2"><input id="contentSubmit" type="submit" value="{if $edit}{lang msgID="button_value_edit"}{else}{lang msgID="button_value_add"}{/if}" class="submit" name="send" />  <input type="button"  value="{lang msgID="preview"}" class="submit" onclick="DZCP.ajaxPreview('forumForm')" /></td>
        </tr>
      </table>
    </form>
  </td>
</tr>
</table>
<table class="hperc" cellspacing="0">
  <tr>
    <td>
      <div id="previewDIV"></div>
    </td>
</tr>