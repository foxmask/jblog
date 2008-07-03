{if $nbcomments == 0}{@jcomments~comments.0comment@}{else}
{if $nbcomments == 1}{@jcomments~comments.1comment@}{else}
{jlocale "jcomments~comments.manycomments", array($nbcomments)}
{/if}{/if}
