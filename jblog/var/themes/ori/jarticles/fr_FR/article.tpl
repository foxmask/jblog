<h1>{@jarticles~default.articles.title@}</h1>

{cycle_init 'col1,col2'}
<h4>[{$article->category}] {$article->title}</h4>
<div class="{cycle}">
	Par {$article->author}
	<div class="text-content">
		{$article->content|wiki:"wr3_to_xhtml"}
	</div>
	{ifacl2 "admin.view"}
		<div class="suggestion"><a href="{jurl 'jarticles~admin:view', array('id' => $article->id)}">{@jarticles~default.modify.button@}</a></div>
		<br/>
	{/ifacl2}
	<div class="information">Ecrit le {$article->date|jdatetime:'db_datetime':'lang_date'} à {$article->date|jdatetime:'db_datetime':'db_time'}</div>
</div>