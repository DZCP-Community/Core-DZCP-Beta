<tr>
  <td class="contentHead" colspan="7" align="center"><span class="fontBold">{lang msgID="ipban_admin_head"}</span></td>
</tr>
<tr>
  <td class="contentMainTop" colspan="7"><span class="fontBold">{lang msgID="search_results"}:</span></td>
</tr>
  <tr>
    <td class="contentMainTop" width="110"><span class="fontBold">{lang msgID="server_ip"}s</span></td>
    <td class="contentMainTop" colspan="3"><span class="fontBold">{lang msgID="ipban_dis"}</span></td>
    <td class="contentMainTop" colspan="4">&nbsp;</td>
  </tr>
{$show}
<tr>
  <td class="contentMainTop" colspan="7"><div align="center"><span class="fontBold">{lang msgID="ipban_search"}:</span></div></td>
</tr>
<tr>
  <td class="contentBottom" colspan="7">
<div align="center"><form action="?admin=ipban&do=search" method="post" name="search"><table width="150" border="0"  cellpadding="0" cellspacing="0">
  <tr>
    <td><label for="ip"></label>
      <input type="text" name="ip" id="ip" /></td>
    <td><input type="submit" name="search" class="submit" id="search" value="{lang msgID="button_value_search"}" /></td>
  </tr>
</table>
</form></div>
  </td>
</tr>
<tr>
  <td class="contentBottom" colspan="7">
    <form action="" method="get" onsubmit="return(DZCP.submitButton())">
      <input type="hidden" name="index" value="admin" />
      <input type="hidden" name="admin" value="ipban" />
      <input type="hidden" name="do" value="new" />
      <input id="contentSubmit" type="submit" class="submit" value="{lang msgID="ipban_add_new"}" />
    </form>
  </td>
</tr>