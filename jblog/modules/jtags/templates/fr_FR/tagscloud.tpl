<p>
    {foreach $tags as $t}
        
        <a href="{jurl $destination, array('tag'=>$t->tag_name)}" style="font-size:{$size[$t->tag_id]}px" title="{$t->tag_name}">{$t->tag_name}</a>,
    {/foreach}
</p>
