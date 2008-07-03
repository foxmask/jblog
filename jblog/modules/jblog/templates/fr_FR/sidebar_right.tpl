<p>
{ifacl2 "admin.default.access"}<a href="{jurl "admin~default:index"}">Admin</a><br/>{/ifacl2}
<a href="{jurl "jarticles~articles:index"}">Entrées</a><br/>
</p>
<p>
	{zone 'jcategories~categoriesList', array('destination'=>'jarticles~articles:byCategory')}
</p>
<p>
	{zone 'jtags~tagscloud', array('destination'=>'jarticles~articles:byTag')}
</p>
<p>
	<a href="feed://{$server_url}{jurl 'jarticles~articles:rss'}">Fil RSS</a>
</p>