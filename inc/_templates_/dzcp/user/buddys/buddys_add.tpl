<form name="buddys" action="?action=buddys&amp;do=addbuddy" method="post" onsubmit="return(DZCP.submitButton())">
    <select name="users" class="dropdown">
      <option value="-" class="dropdownKat">- User -</option>
      {$users}
    </select>
    <input id="contentSubmit" type="submit" value="{lang msgID="button_value_addto"}" class="submit" />
</form>