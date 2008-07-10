<h1>{@jarticles~default.articles.title@}</h1>

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
    <tr>
        <td>{$article->category}</td>
        <td>{$article->title}</td>
        <td>{$article->author}</td>
        <td>{$article->date}</td>
		{ifacl2 "admin.view"}
        	<th><a href="{jUrl 'jarticles~admin:view', array('id' => $article->id)}">{@jarticles~default.modify.button@}</a></td>
		{/ifacl2}
    </tr>
	<tr>
		{ifacl2 "admin.view"}
			<td colspan="5">
		{else}
			<td colspan="4">
		{/ifacl2}
		{$tags}
		</td>
	</tr>
	<tr>
		{ifacl2 "admin.articles.read"}
			<td colspan="5">
		{else}
			<td colspan="4">
		{/ifacl2}
		{$article->content|wiki:"wr3_to_xhtml"}
		</td>
	</tr>
</tbody>
<tfoot>
</tfoot>
</table>