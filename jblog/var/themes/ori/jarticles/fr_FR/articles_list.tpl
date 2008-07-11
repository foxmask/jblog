<h1>{@jarticles~default.articles.title@}</h1>
{if !$articlesCount}
<p>{@jarticles~default.no.article.message@}</p>
{else}
{cycle_init 'col1,col2'}
{foreach $articles as $a}
<a href="{jurl 'jarticles~articles:view', array('id'=>$a->id)}"><h4>[{$a->category}] {$a->title}</h4></a>
<div class="{cycle}">
	Par {$a->author}
	{if $fetchContent}<div class="text-content">
		{$a->content|wiki:"wr3_to_xhtml"}
	</div>{/if}
	{ifacl2 "admin.view"}
		<div class="suggestion"><a href="{jurl 'jarticles~admin:view', array('id' => $a->id)}">{@jarticles~default.modify.button@}</a></div>
		<br/>
	{/ifacl2}
	<div class="information">Ecrit le {$a->date|jdatetime:'db_datetime':'lang_date'} à {$a->date|jdatetime:'db_datetime':'db_time'}</div>
	</div>
	<br/>
{/foreach}
{/if}

{pagelinks 'jarticles~articles:index', array(),  $articlesCount, $offset, $listPageSize, 'idx' }	