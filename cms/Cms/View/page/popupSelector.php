<style type="text/css" media="screen">
	ul li {
		margin:0px;
		padding: 0px;
	}
	li a {
		font-family:Arial, Verdana;
		font-size: 11px;
		color:#333;
		text-decoration:none;
	}
	li a:hover {
		text-decoration:underline;
	}
</style>
<?php

function hasChilds($page)
{
	$chidls = $page->getPages();
	if($chidls->count() > 0)
	{
		echo '<ul>';
		foreach($chidls as $page)
		{
			echo "\n";
			echo '<li><a href="#" onClick="javascript:parent.document.linkform.href.value =\''.Cms_Cms::getConfig('site_url').'?secc='.$section->get('id').'&page_id='.$page->get('id').'\'">'.$page->get('name').'</a>';
			echo '</li>';
		}
		echo '</ul>';
		echo "\n";
	}
}

foreach($sections as $section)
{
	echo '<ul>';
	echo "\n";
	echo '<li><a href="#" class="section" onClick="javascript:parent.document.linkform.href.value =\''.Cms_Cms::getConfig('site_url').'?secc='.$section->get('id').'\'">'.$section->get('name').'</a>';
		$pages= $section->getPages();
		
		if($pages->count() > 0)
		{
			foreach($pages as $page)
			{
				echo '<ul>';
				echo "\n";
				echo '<li><a href="#" onClick="javascript:parent.document.linkform.href.value =\''.Cms_Cms::getConfig('site_url').'?secc='.$section->get('id').'&page_id='.$page->get('id').'\'">'.$page->get('name').'</a>';
				echo '</li>';
				echo '</ul>';
				echo "\n";
			}
			$pages = null;
		}
	echo '</li>';
	echo '</ul>';
}

?>