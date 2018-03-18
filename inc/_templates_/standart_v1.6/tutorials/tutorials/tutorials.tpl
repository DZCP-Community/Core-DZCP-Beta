<tr>
  <td colspan="2" class="contentHead"><span class="fontBold">{lang msgID="tutorials"} <font style="font-weight:normal">( Kategorie: {$kategorie_name} )</font></span></td>
</tr>
<tr>
  <td colspan="2" class="contentMainFirst" style="border-bottom: 1px solid #000000">
    <table width="100%" cellspacing="1">
      <tr>
        <td width="1%">{$katpic}</td>
        <td width="5"></td>   
        <td style="vertical-align:top">{$kat_beschreibung}</td>
      </tr>
    </table>
  </td>
</tr>	
<tr>
  <td colspan="2" class="contentMainTop">
    <table width="100%" cellspacing="1">
      <tr>
        <td width="50%"><span class="fontBold">{lang msgID="tutorials_sortieren"}:</span>
          <script type="text/javascript">
            function orderselect(that,select) {
              document.location.href="index.php?action=show&id={$id}" + that.value;
            }
          </script>
          <select name="orderby" onchange="orderselect(this,"orderby")" class="dropdown">
            <option value="pos" {if $orderby == "pos"}selected{/if}>{lang msgID="tutorials_position"}</option>
            <option value="datum" {if $orderby == "datum"}selected{/if}>{lang msgID="tutorials_erstellt_am"}</option>
            <option value="name" {if $orderby == "name"}selected{/if}>{lang msgID="tutorials_bezeichnung"}</option>
            <option value="difficulty" {if $orderby == "difficulty"}selected{/if}>{lang msgID="tutorials_schwierigkeit"}</option>
            <option value="rating" {if $orderby == "rating"}selected{/if}>{lang msgID="tutorials_bewertung"}</option>
          </select>		
          <select name="order" onchange="orderselect(this,"order")" class="dropdown">
            <option value="ASC" {if $order == "ASC"}selected{/if}>{lang msgID="tutorials_steigend"}</option>
            <option value="DESC" {if $order == "DESC"}selected{/if}>{lang msgID="tutorials_fallend"}</option>
          </select>
        </td>
        <td width="50%" align="center">{$seiten}</td>
      </tr>
    </table>
  </td>			
</tr>
{$tutorials}
<tr>
  <td colspan="2" class="contentBottom"></td>
</tr>