<tr>
  <td colspan="3" class="contentHead" align="center"><span class="fontBold">{$head}</span></td>
</tr>
<tr>
<td>
<form name="formular" action="?admin=linkus&amp;do={$do}" method="post" onsubmit="return(DZCP.submitButton())">
<input type="hidden" name="banner" value="1" />
<table class="hperc" cellspacing="1">
<tr>
  <td class="contentMainTop" width="30%"><span class="fontBold">{$btext}:</span> (src="")</td>
  <td class="contentMainFirst" align="center" colspan="2" width="80%">
    <input class="inputField_dis" type="text" name="text" value="{$ltext}" 
    onfocus="this.className='inputField_en';"   
    onblur="this.className='inputField_dis';" />
  </td>
</tr>
<tr>
  <td class="contentMainTop" width="30%"><span class="fontBold">{$beschreibung}:</span> (title="")</td>
  <td class="contentMainFirst" align="center" colspan="2" width="80%">
    <input class="inputField_dis" type="text" name="beschreibung" value="{$lbeschreibung}"
    onfocus="this.className='inputField_en';" 
    onblur="this.className='inputField_dis';" />
  </td>
</tr>
<tr>
  <td class="contentMainTop" width="30%"><span class="fontBold">{$link}:</span> (href="")</td>
  <td class="contentMainFirst" align="center" colspan="2" width="80%">
    <input class="inputField_dis" type="text" name="link" value="{$llink}" 
    onfocus="this.className='inputField_en';"   
    onblur="this.className='inputField_dis';" />
  </td>
</tr>
<tr>
  <td colspan="3" class="contentBottom"><input id="contentSubmit" type="submit" class="submit" value="{$what}" /></td>
</tr>
</table>
</form>
</td>
</tr>
