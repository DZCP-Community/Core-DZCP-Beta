<tr>
  <td class="contentHead" colspan="2" align="center"><span class="fontBold">{$head}</span></td>
</tr>
<tr>
<td>
<form name="kalenderadmin" method="post" action="?admin=kalender&amp;do={$do}" onsubmit="return(DZCP.submitButton())">
<table class="hperc" cellspacing="1">
<tr>
  <td class="contentMainTop"><span class="fontBold">{lang msgID="datum"}:</span></td>
  <td class="contentMainFirst" align="center">{$dropdown_date} {$dropdown_time}</td>
</tr>
<tr>
  <td class="contentMainTop"><span class="fontBold">{lang msgID="kalender_event"}:</span></td>
  <td class="contentMainFirst" align="center">
    <input type="text" name="title" value="{$k_event}" class="inputFieldKal_dis"
    onfocus="this.className='inputFieldKal_en';"
    onblur="this.className='inputFieldKal_dis';" />
  </td>
</tr>
<tr>
  <td class="contentMainTop" valign="top"><span class="fontBold">{lang msgID="beschreibung"}:</span></td>
  <td class="contentMainFirst" align="center">
    <textarea id="event" name="event" cols="0" rows="0" class="editorStyleMini">{$k_beschreibung}</textarea>
  </td>
</tr>
<tr>
  <td class="contentBottom" colspan="2"><input id="contentSubmit" type="submit" value="{$what}" class="submit" /></td>
</tr>
</table>
</form>
</td>
</tr>