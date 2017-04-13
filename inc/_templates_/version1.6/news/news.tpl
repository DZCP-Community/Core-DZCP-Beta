<!-- start news.tpl -->
{$show_sticky}
{$show}
</table>
<table class="mainContent" cellspacing="1">
<tr>
    <td>
        <div style="text-align: center;">{$nav}</div>
        <div style="text-align: center;padding-top: 5px;">
            <select name="newskat" id="newskat" class="dropdown">
              <option value="lazy" class="dropdownKat">- {lang msgID="news_kat_choose"} -</option>
                {$kategorien}
            </select>
         </div>
    </td>
</tr>
<!-- end news.tpl -->