{let page_limit=20
     list_count=fetch('content','keyword_count', hash(alphabet,$alphabet,limit,$page_limit,offset,$view_parameters.offset,classid,$view_parameters.classid))}
<form action={concat("/content/keyword/",$alphabet,"/")|ezurl} method="post">

<table class="list" width="100%" cellspacing="0" cellpadding="0" border="0">
{let keyword_list=fetch('content','keyword',hash(alphabet,$alphabet,limit,$page_limit,offset,$view_parameters.offset,classid,$view_parameters.classid))}

{section name=KeywordList loop=$keyword_list}
<tr>
<td>
{$KeywordList:item.keyword}
</td>
<td>
<a href={concat("content/view/full/",$KeywordList:item.link_object.node_id)|ezurl}>{$KeywordList:item.link_object.name}</a>
</td>
</tr>
{/section}

</table>
{include name=navigator
         uri='design:navigator/google.tpl'
         page_uri=concat('/content/keyword/', $alphabet)
         item_count=$list_count
         view_parameters=$view_parameters
         item_limit=$page_limit}

</form>

{/let}
{/let}