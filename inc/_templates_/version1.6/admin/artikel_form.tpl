<tr>
  <td>
    <script language="javascript" type="text/javascript">
      var prevURL = '../artikel/?action=preview';
    </script>
    <form enctype="multipart/form-data" id="artikelForm" name="artikelForm" action="?admin=artikel&amp;do={$do}" method="post" onsubmit="return(DZCP.submitButton())">
      <table class="hperc" cellspacing="1">
        <tr>
          <td class="contentHead" align="center" colspan="2"><span class="fontBold">{$head}</span></td>
        </tr>
        {$error}
        <tr>
          <td class="contentMainTop" style="width:25%"><span class="fontBold">{lang msgID="autor"}:</span></td>
          <td class="contentMainFirst" style="width:75%;text-align:center"><span class="fontBold">{$autor}</span></td>
        </tr>
        <tr>
          <td class="contentMainTop"><span class="fontBold">{lang msgID="news_admin_kat"}:</span></td>
          <td class="contentMainFirst" align="center">
            <select name="kat" class="dropdown">
              {$kat}
            </select>
          </td>
        </tr>
        <tr>
          <td class="contentMainTop"><span class="fontBold">{lang msgID="artikel_userimage"}:</span></td>
          <td class="contentMainFirst" align="center">
            {$n_artikelpic}{$delartikelpic}
               <input type="file" name="artikelpic">
          </td>
        </tr>
        <tr>
          <td class="contentMainTop"><span class="fontBold">{lang msgID="titel"}:</span></td>
          <td class="contentMainFirst" align="center">
            <input type="text" name="titel" value="{$titel}" class="inputField_dis"
            onfocus="this.className='inputField_en';"
            onblur="this.className='inputField_dis';" />
          </td>
        </tr>
        <tr>
          <td class="contentMainFirst" colspan="2" align="center">
            <textarea id="artikel" name="artikel" cols="0" rows="0" class="editorStyleWord">{$artikeltext}</textarea>
          </td>
        </tr>
        <tr>
          <td class="contentMainTop"><span class="fontBold">{lang msgID="linkname"} 1:</span></td>
          <td class="contentMainFirst" align="center">
            <input type="text" name="link1" value="{$link1}" class="inputField_dis"
            onfocus="this.className='inputField_en';"
            onblur="this.className='inputField_dis';" />
          </td>
        </tr>
        <tr>
          <td class="contentMainTop"><span class="fontBold">{lang msgID="url"} 1:</span></td>
          <td class="contentMainFirst" align="center">
            <input type="text" name="url1" value="{$url1}" class="inputField_dis"
            onfocus="this.className='inputField_en';"
            onblur="this.className='inputField_dis';" />
          </td>
        </tr>
        <tr>
          <td class="contentMainTop"><span class="fontBold">{lang msgID="linkname"} 2:</span></td>
          <td class="contentMainFirst" align="center">
            <input type="text" name="link2" value="{$link2}" class="inputField_dis"
            onfocus="this.className='inputField_en';"
            onblur="this.className='inputField_dis';" />
          </td>
        </tr>
        <tr>
          <td class="contentMainTop"><span class="fontBold">{lang msgID="url"} 2:</span></td>
          <td class="contentMainFirst" align="center">
            <input type="text" name="url2" value="{$url2}" class="inputField_dis"
            onfocus="this.className='inputField_en';"
            onblur="this.className='inputField_dis';" />
          </td>
        </tr>
        <tr>
          <td class="contentMainTop"><span class="fontBold">{lang msgID="linkname"} 3:</span></td>
          <td class="contentMainFirst" align="center">
            <input type="text" name="link3" value="{$link3}" class="inputField_dis"
            onfocus="this.className='inputField_en';"
            onblur="this.className='inputField_dis';" />
          </td>
        </tr>
        <tr>
          <td class="contentMainTop"><span class="fontBold">{lang msgID="url"} 3:</span></td>
          <td class="contentMainFirst" align="center">
            <input id="url3" name="url3" type="text" value="{$url3}" class="inputField_dis"
            onfocus="this.className='inputField_en';"
            onblur="this.className='inputField_dis';" />
          </td>
        </tr>
        <tr>
          <td class="contentBottom" colspan="2"><input id="contentSubmit" type="submit" value="{$button}" class="submit" /> <input type="button"  value="{lang msgID="preview}" class="submit" onclick="DZCP.ajaxPreview('artikelForm')" /></td>
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