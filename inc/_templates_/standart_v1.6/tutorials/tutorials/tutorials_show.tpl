<tr>
  <td colspan="2" class="contentMainTop">
	   <table width="100%" cellspacing="1">
		    <tr>
			     <td width="70%"><span class="fontBold">{$bezeichnung}</span> <span class="fontNormal">/ {$datum} {lang msgID="uhr"}</span></td>
				    <td width="30%" align="right">{$autor}</td>
			   </tr>
		  </table>
	 </td>			
</tr>
<tr>
  <td width="1%" class="contentMainFirst" style="vertical-align:top">{$pic}</td>
	 <td class="contentMainFirst" style="vertical-align:top">
    <table width="100%">
      <tr>        
        <td>{$beschreibung}</td>
      </tr>
    </table>
    <table width="100%">      
      <tr>
        <td class="contentMainFirst" width="75"><span class="fontBold">{lang msgID="tutorials_schwierigkeit"}:</span></td>
        <td class="contentMainFirst"><span class="fontItalic">{lang msgID="tutorials_schwierigkeit_leicht"}</span>
            <img src="{dir}/images/tutorials/{$v_schwierigkeit}.gif" alt="" /> <span class="fontItalic">{lang msgID="tutorials_schwierigkeit_schwer"}</span></td>
      </tr>
      <tr>
        <td class="contentMainFirst"><span class="fontBold">{lang msgID="tutorials_bewertung"}:</span></td>
        <td class="contentMainFirst">
            <select class="bar-rating">
                {$v_bewertung}
            </select>
        </td>
      </tr>
      <tr>
        <td class="contentMainFirst"><span class="fontBold">{lang msgID="tutorials_comments"}:</span></td>
        <td class="contentMainFirst"><span class="fontItalic">{$v_comments}</span></td>
      </tr>
      <tr>
        <td height="2"></td>
      </tr>  
      <tr>
        <td class="contentMainFirst" colspan="2">
            <input type="button" name="show" class="submit" onclick="DZCP.goTo('index.php?action=tutorial&amp;id={$id}')" value="{lang msgID="tutorials_read"}" />
        </td>
      </tr>
    </table>    
	 </td>
</tr>	