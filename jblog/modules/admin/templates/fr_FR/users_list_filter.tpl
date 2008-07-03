<form action="{formurl 'admin~users:index'}" method="get">
<fieldset><legend>{@admin~acl2.filter.title@}</legend>
{formurlparam 'admin~users:index'}
    <select name="grpid">
    {foreach $groups as $group}
        <option value="{$group->id_aclgrp}" {if $group->id_aclgrp == $grpid}selected="selected"{/if}>{$group->name}</option>
    {/foreach}
     </select>
    <input type="submit" value="{@admin~acl2.show.button@}" />
</fieldset>
</form>
