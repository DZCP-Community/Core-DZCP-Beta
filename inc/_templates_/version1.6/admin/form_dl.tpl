<tr>
<td>
<script type="text/javascript">
    function setFile(elementId) {
        var win = window.open('../inc/tinymce/plugins/ajaxfilemanager/ajaxfilemanager.php?editor=form&elementId='+elementId, 'ajaxFileImageManager', 'width=850,height=500');		
        return false;
    }
</script>
<form enctype="multipart/form-data" name="dlformular" action="?admin=dladmin&amp;do={$do}" method="post" onsubmit="return(DZCP.submitButton())">
<table class="hperc" cellspacing="0">
<tr>
  <td class="contentHead" align="center" colspan="2"><span class="fontBold">{$admin_head}</span></td>
</tr>
<tr>
  <td class="contentMainTop" width="25%"><span class="fontBold">{lang msgID="downloads_kat"}:</span></td>
  <td class="contentMainFirst" width="75%" align="center">
    <select name="kat" class="dropdown">
      {$kats}
    </select>
  </td>
</tr>
<tr>
  <td class="contentMainTop"><span class="fontBold">{lang msgID="downloads_name"}:</span></td>
  <td class="contentMainFirst" align="center">
    <input id="download" name="download" type="text" value="{$ddownload}" class="inputField_dis"
    onfocus="this.className='inputField_en';"
    onblur="this.className='inputField_dis';" />
  </td>
</tr>
<tr>
  <td class="contentMainTop"><span class="fontBold">{lang msgID="internal"}:</span></td>
  <td class="contentMainFirst" align="center">
    <input id="intern" name="intern" type="checkbox" value="1" {$dintern} class="inputField_dis"
    onfocus="this.className='inputField_en';"
    onblur="this.className='inputField_dis';" />
  </td>
</tr>
<tr>
  <td class="contentMainTop"><span class="fontBold">{lang msgID="downloads_url"}:</span></td>
  <td class="contentMainFirst" align="center">
    <table class="hperc" cellspacing="0" style="width:1%">
      <tr>
        <td>
          <input id="url" name="url" type="text" value="{$durl}" class="inputField_dis"
          onfocus="this.className='inputField_en';"
          onblur="this.className='inputField_dis';" />
        </td>
        <td style="padding-left:3px">
          <a id="dladmin" href="#" onclick="return setFile('url');"><img src="../inc/tinymce/themes/advanced/images/browse.gif" alt="" /></a>
        </td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td class="contentMainTop"><span class="fontBold">{lang msgID="beschreibung"}:</span></td>
  <td class="contentMainFirst" align="center">
    <textarea id="beschreibung" name="beschreibung" cols="0" rows="0" class="editorStyleMini">{$dbeschreibung}</textarea>
  </td>
</tr>
<tr>
  <td class="contentBottom" colspan="2"><input id="contentSubmit" type="submit" value="{$what}" class="submit" /></td>
</tr>
</table>
</form>
</td>
</tr>