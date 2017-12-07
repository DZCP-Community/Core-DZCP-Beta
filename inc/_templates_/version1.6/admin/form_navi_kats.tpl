<tr>
<td>
<form name="navi" method="post" action="?admin=navi&amp;do={$do}" onsubmit="return(DZCP.submitButton())">
<table class="hperc" cellspacing="1">
<tr>
  <td class="contentHead" colspan="2" align="center"><span class="fontBold">{$head}</span></td>
</tr>
<tr>
  <td class="contentMainTop" colspan="2" align="center">{lang msgID="menu_kat_info"}</td>
</tr>
<tr>
  <td class="contentMainTop"><span class="fontBold">{lang msgID="sponsors_admin_name"}:</span></td>
  <td class="contentMainFirst" align="center">
    <input type="text" name="name" value="{$n_name}" class="inputField_dis"
    onfocus="this.className='inputField_en';"
    onblur="this.className='inputField_dis';" />
  </td>
</tr>
<tr>
  <td class="contentMainTop"><span class="fontBold">{lang msgID="placeholder"}:</span></td>
  <td class="contentMainFirst" align="center">
      {literal}{$nav_ <input type="text" name="placeholder" value="{/literal}{$n_placeholder} {literal}" class="inputField_dis" style="width:100px" /> }{/literal}
  </td>
</tr>
<tr>
  <td class="contentMainTop"><span class="fontBold">{lang msgID="menu_visible"}:</span></td>
  <td class="contentMainFirst" align="center">
    <select name="level" class="dropdown">
      <option value="0">{lang msgID="status_unregged"}</option>
      <option value="1"{$sel_user}>{lang msgID="status_user"}</option>
      <option value="2"{$sel_trial}>{lang msgID="status_trial"}</option>
      <option value="3"{$sel_member}>{lang msgID="status_member"}</option>
      <option value="4"{$sel_admin}>{lang msgID="status_admin"}</option>
    </select>
  </td>
</tr>
<tr>
  <td class="contentBottom" colspan="2"><input id="contentSubmit" type="submit" value="{$what}" class="submit" /></td>
</tr>
</table>
</form>
</td>
</tr>