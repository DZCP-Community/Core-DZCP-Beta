<tr>
  <td class="contentHead" colspan="2"><span class="fontBold">{$head}</span></td>
</tr>
<tr>
  <td colspan="2" class="contentMainFirst">
    <table width="100%" cellspacing="1">
      <tr>
        <td width="1%">{$pic}</td>
        <td width="4"></td>
        <td style="vertical-align:top">{$beschreibung}</td>
      </tr>
    </table>
  </td>
</tr>	
<tr>
  <td colspan="2" class="contentMainFirst">
      {$tutorial}
 </td>			
</tr>      
<tr>
  <td class="contentMainTop" width="25%"><span class="fontBold">{lang msgID="tutorials_bewertung"}:</span></td>
  <td class="contentMainFirst" align="center">
    <div id="barrating">
      <select class="bar-rating">
          {$v_bewertung}
      </select>
    </div>
  </td>
</tr>  
<tr>
  <td  colspan="2" class="contentBottom"></td>
</tr> 
</table><br />
<table class="mainContent" cellspacing="1" style="margin-top:0">
{$notification_page}
{$showmore}