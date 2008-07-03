<ul>
    {foreach $comments as $c}
        <li><a href="{jurl 'admin~snippets:view', array('id'=>$c->sn_id)}">{$c->sn_title}</a></li>
    {/foreach}
</ul>