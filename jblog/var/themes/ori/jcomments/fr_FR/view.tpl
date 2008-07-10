<h3 clas="comments-title">{@jcomments~comments.titleallcomments@}</h3>

{foreach $comments as $c}
    <div class="comments-info">
        {@jcomments~comments.the@} 
            {$c->com_created_at|jdatetime:'db_datetime':'lang_date'} 
        {@jcomments~comments.at@} 
            {$c->com_created_at|jdatetime:'db_datetime':'db_time'} 
        {@jcomments~comments.by@} 
            {$c->user_login}
    </div>
    {$c->com_content|wiki:"wr3_to_xhtml"}
    <hr />
{/foreach}

{if $nbcomments == 0}
<p>{@jcomments~comments.nocomments@}</p>
{/if}
