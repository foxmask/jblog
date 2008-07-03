{meta_html css  $j_jelixwww.'design/jacl2.css'}

<h1>{@admin~acl2.groups.title@}</h1>

{ifacl2 "acl.group.modify"}
	<form action="{formurl 'admin~groups:saverights'}" method="post">
	<fieldset><legend>{@admin~acl2.rights.title@}</legend>
	<div>{formurlparam 'admin~groups:saverights'}</div>
{/ifacl2}
<table class="rights">
<thead>
    <tr>
        <th></th>
    {foreach $groups as $group}
        <th>{$group->name}</th>
    {/foreach}
    </tr>
</thead>
<tbody>

{assign $line = true}
{foreach $rights as $subject=>$right}
<tr class="{if $line}odd{else}even{/if}">
    <th>{$subject}</th>
    {foreach $right as $group=>$r}
    <td>
	{ifacl2 "acl.group.modify"}
		<input type="checkbox" name="rights[{$group}][{$subject}]" {if $r}checked="checked"{/if} /></td>
	{else}
		{if $r}X{/if}
	{/ifacl2}
    {/foreach}
</tr>
{assign $line = !$line}
{/foreach}
</tbody>
</table>

{ifacl2 "acl.group.modify"}
<div><input type="submit" value="{@admin~acl2.save.button@}" /></div>
</fieldset>
</form>

{ifacl2 'acl.group.create'}
<form action="{formurl 'admin~groups:newgroup'}" method="post">
<fieldset><legend>{@admin~acl2.create.group@}</legend>
{formurlparam 'admin~groups:newgroup'}
<label for="newgroup">{@admin~acl2.group.name.label@}</label> <input id="newgroup" name="newgroup" />
<input type="submit" value="{@admin~acl2.save.button@}" />
</fieldset>
</form>
{/ifacl2}

{ifacl2 'acl.group.modify'}
<form action="{formurl 'admin~groups:changename'}" method="post">
<fieldset><legend>{@admin~acl2.change.name.title@}</legend>
{formurlparam 'admin~groups:changename'}
    <select name="group_id">
    {foreach $groups as $group}
        {if  $group->id_aclgrp != 0}<option value="{$group->id_aclgrp}">{$group->name}</option>{/if}
    {/foreach}
     </select>

    <label for="newname">{@admin~acl2.new.name.label@}</label> <input id="newname" name="newname" />
    <input type="submit" value="{@admin~acl2.rename.button@}" />
</fieldset>
</form>
{/ifacl2}

{ifacl2 'acl.group.delete'}
<form action="{formurl 'admin~groups:delgroup'}" method="post">
<fieldset><legend>{@admin~acl2.delete.group@}</legend>
{formurlparam 'admin~groups:delgroup'}
    <select name="group_id">
    {foreach $groups as $group}
        {if  $group->id_aclgrp != 0}<option value="{$group->id_aclgrp}">{$group->name}</option>{/if}
    {/foreach}
     </select>

    <input type="submit" value="{@admin~acl2.delete.button@}" />
</fieldset>
</form>
{/ifacl2}

{/ifacl2}