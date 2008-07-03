<h1>{@admin~acl2.users.title@}</h1>

{if isset($USR_LIST_HEADER)}
	{$USR_LIST_HEADER}
{/if}

{if $usersCount == 0}
<p>{@admin~acl2.no.user.message@}</p>
{else}
<table>
<thead>
    <tr>
        <th>{@admin~acl2.col.users@}</th>
        <th>{@admin~acl2.col.groups@}</th>
        <th></th>
    </tr>
</thead>
<tbody>
{foreach $users as $user}
    <tr>
        <td>{$user->login}</td>
        <td>{foreach $user->groups as $group} {$group->name} {/foreach}</td>
        <td><a href="{jurl 'admin~users:rights', array('user'=>$user->login)}">{@admin~acl2.rights.link@}</a></td>
    </tr>
{/foreach}
</tbody>
</table>
{/if}

{if $usersCount > 0}
<div class="pages">{@admin~acl2.pages.links.label@} {pagelinks 'admin~users:index', array('grpid'=>$grpid),  $usersCount, $offset, $listPageSize, 'idx' }</div>
{/if}