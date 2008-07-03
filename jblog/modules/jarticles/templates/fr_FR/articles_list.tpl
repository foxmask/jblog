<h1>{@jarticles~default.articles.title@}</h1>

{if $articlesCount == 0}
<p>{@jarticles~default.no.article.message@}</p>
{else}
<table>
<thead>
    <tr>
        <th>{@jarticles~default.col.category@}</th>
        <th>{@jarticles~default.col.title@}</th>
        <th>{@jarticles~default.col.author@}</th>
        <th>{@jarticles~default.col.date@}</th>
		{ifacl2 "admin.articles.read"}
        	<th></th>
		{/ifacl2}
    </tr>
</thead>
<tbody>
{foreach $articles as $a}
    <tr>
        <td>{$a->category}</td>
        <td><a href="{jurl 'jarticles~articles:view', array('id'=>$a->id)}">{$a->title}</a></td>
        <td>{$a->author}</td>
        <td>{$a->date}</td>
		{ifacl2 "admin.articles.read"}
        	<th><a href="{jUrl 'jarticles~admin:view', array('id' => $a->id)}">{@jarticles~default.modify.button@}</a></td>
		{/ifacl2}
    </tr>
	{if $fetchContent === true}
		<tr>
			{ifacl2 "admin.articles.read"}
				<td colspan="5">
			{else}
				<td colspan="4">
			{/ifacl2}
			{$a->content}
			</td>
		</tr>
	{/if}
{/foreach}
</tbody>
</table>
{/if}

{if $articlesCount > 0}
{pagelinks 'jarticles~articles:index', array(),  $articlesCount, $offset, $listPageSize, 'idx' }
{/if}