<tr>
  <td class="contentHead" colspan="4" align="center"><span class="fontBold">{$head}</span></td>
</tr>
<tr>
  <td class="contentMainTop" width="10%"><span class="fontBold">{$button}</span></td>
  <td class="contentMainTop" width="88%" colspan="3"><span class="fontBold">{$link}</span></td>
</tr>
{$show}
<tr>
  <td class="contentBottom" colspan="4">
    <form action="" method="get" onsubmit="return(DZCP.submitButton())">
      <input type="hidden" name="admin" value="partners" />
      <input type="hidden" name="do" value="add" />
      <input id="contentSubmit" type="submit" class="submit" value="{$add}" />
    </form>
  </td>
</tr>