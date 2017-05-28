</table>
<table class="mainContent" cellspacing="0" style="margin-top:0">
<tr>
  <td>
    <script language="javascript" type="text/javascript">
      var prevURL = '../forum/?action=preview&amp;what=post&amp;do=addpost&amp;id={$id}';
    </script>
    <form id="fpostForm" name="fpostForm" action="?action=post&amp;do=addpost&amp;id={$id}" method="post" onsubmit="return(DZCP.submitButton())">
    <table class="hperc" cellspacing="1">
      <tr>
        <td class="contentHead" colspan="2" align="center"><span class="fontBold">{lang msgID="forum_new_post_head"}</span></td>
      </tr>
      {$error}
      {$from}
      <tr>
        <td class="contentMainFirst" align="center" colspan="2">
          <textarea id="eintrag" name="eintrag" cols="0" rows="0" class="editorStyle" >{$zitat}{$posteintrag}</textarea>
        </td>
      </tr>
      <tr>
        <td class="contentMainTop" colspan="2" align="center">{lang msgID="iplog_info"}</td>
      </tr>
      <tr>
        <td class="contentBottom" colspan="2"><input id="contentSubmit" type="submit" value="{lang msgID="button_value_add"}" class="submit" name="send" />
          <input type="button"  value="{lang msgID="preview"}" class="submit" onclick="DZCP.ajaxPreview('fpostForm')" /></td>
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
{$br1}
</table>
<table class="mainContent" cellspacing="1">
  <tr>
    <td class="contentHead" colspan="2" align="center"><span class="fontBold">{lang msgID="forum_lp_head"}</span></td>
  </tr>
  {$lastpost}
{$br2}