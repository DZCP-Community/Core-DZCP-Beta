<tr>
<td>
<form name="navi" method="post" action="?admin=navi&amp;do={$do}" onsubmit="return(DZCP.submitButton())">
<table class="hperc" cellspacing="1">
<tr>
  <td class="contentHead" colspan="2" align="center"><span class="fontBold">{$head}</span></td>
</tr>
<tr>
  <td class="contentMainTop"><span class="fontBold">{$name}:</span></td>
  <td class="contentMainFirst" align="center">
    <input type="text" name="name" value="{$n_name}" class="inputField_dis"
    onfocus="this.className='inputField_en';"
    onblur="this.className='inputField_dis';" />
  </td>
</tr>
<tr>
  <td class="contentMainTop"><span class="fontBold">{$url}:</span></td>
  <td class="contentMainFirst" align="center">
    <input type="text" name="url" value="{$n_url}" class="inputField_dis"
    onfocus="this.className='inputField_en';"
    onblur="this.className='inputField_dis';" />
  </td>
</tr>
<tr>
  <td class="contentMainTop"><span class="fontBold">{$pos}:</span></td>
  <td class="contentMainFirst" align="center">
    <select name="pos" class="dropdown">
      {$position}
    </select>
  </td>
</tr>
<tr>
  <td class="contentMainTop"><span class="fontBold">{$wichtig}:</span></td>
  <td class="contentMainFirst" align="center">
    <select name="wichtig" class="dropdown">
      <option value="0">{$nein}</option>
      <option value="1">{$ja}</option>
    </select>
  </td>
</tr>
<tr>
  <td class="contentMainTop"><span class="fontBold">{$intern}:</span></td>
  <td class="contentMainFirst" align="center">
    <select name="internal" class="dropdown">
      <option value="0">{$nein}</option>
      <option value="1">{$ja}</option>
    </select>
  </td>
</tr>
<tr>
  <td class="contentMainTop"><span class="fontBold">{$target}:</span></td>
  <td class="contentMainFirst" align="center">
    <select name="target" class="dropdown">
      <option value="0">{$nein}</option>
      <option value="1">{$ja}</option>
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