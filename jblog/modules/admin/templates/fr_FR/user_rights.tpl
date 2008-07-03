{meta_html css  $j_jelixwww.'design/jacl2.css'}

<h1>{@admin~acl2.user.rights.title@} {$user}</h1>

{ifacl2 "acl.user.modify"}
<form action="{formurl 'admin~users:saverights',array('user'=>$user)}" method="post">
<fieldset><legend>{@admin~acl2.rights.title@}</legend>
{/ifacl2}

<div>{formurlparam 'admin~users:saverights',array('user'=>$user)}</div>
<table class="rights">
<thead>
    <tr>
        <th rowspan="2"></th>
        <th rowspan="2">{@admin~acl2.col.personnal.rights.1@}<br />{@admin~acl2.col.personnal.rights.2@}</th>
        {if $nbgrp}
        <th colspan="{$nbgrp}">{@admin~acl2.col.groups@}</th>
        {/if}
        <th class="colblank" rowspan="2"></th>
        <th rowspan="2">{@admin~acl2.col.resulting.1@}<br />{@admin~acl2.col.resulting.2@}</th>
    </tr>
    <tr>
    {foreach $groups as $group}
        {if isset($groupsuser[$group->id_aclgrp])}
        <th>{$group->name} 
			{ifacl2 "acl.user.modify"}
				<a class="removegroup" href="{jurl 'admin~users:removegroup',array('user'=>$user,'grpid'=>$group->id_aclgrp)}" title="{@admin~acl2.remove.group.tooltip@}">-</a>
        	{/ifacl2}
		</th>
		{else}
        <th class="notingroup">{$group->name}
			{ifacl2 "acl.user.modify"}
				<a class="addgroup" href="{jurl 'admin~users:addgroup',array('user'=>$user,'grpid'=>$group->id_aclgrp)}" title="{@admin~acl2.add.group.tooltip@}">+</a>
				{/ifacl2}
		</th>
        {/if}
    {/foreach}
    </tr>
</thead>

{ifacl2 "acl.user.modify"}
	<tfoot>
    	<tr>
        	<td></td>
        	<td><input type="submit" value="{@admin~acl2.save.button@}" /></td>
        	{if $nbgrp}
        		<td colspan="{$nbgrp}"></td>
        	{/if}
        	<td colspan="2"></td>
    	</tr>
	</tfoot>
{/ifacl2}


<tbody>


{assign $line = true}
{foreach $rights as $subject=>$right}
	<tr class="{if $line}odd{else}even{/if}">
    	<th>{$subject}</th>
    	{assign $hasr=false}
    	{foreach $right as $group=>$r}
    		{if $group == $hisgroup->id_aclgrp}
				{ifacl2 "acl.user.modify"}
    				<td><input type="checkbox" name="rights[{$subject}]" {if $r}{assign $hasr=true}checked="checked"{/if} /></td>
				{else}
					<td>{if $r}{assign $hasr=true}X{/if}</td>
				{/ifacl2}
   			{else}
   				<td {if !isset($groupsuser[$group])}class="notingroup"{elseif $r}{assign $hasr=true}{/if}>{if $r}X{/if}</td>
    		{/if}
		{/foreach}
    	<td class="colblank"></td>
    	<td>{if $hasr}X{/if}</td>
	</tr>
	{assign $line = !$line}
{/foreach}
</tbody>
</table>

{ifacl2 "acl.user.modify"}
	</fieldset>
	</form>
{/ifacl2}
