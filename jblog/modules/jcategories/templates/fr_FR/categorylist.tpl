<p>
    {foreach $categories as $c}
        <li>
            <ul><a href="{jurl $destination, array('catName'=>$c->cat_name, 'catId'=>$c->cat_id)}">{$c->cat_name}</a></ul>
        </li>
    {/foreach}
</p>
