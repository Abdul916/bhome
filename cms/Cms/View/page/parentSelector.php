<h3>Asignar nueva página principal para: <?php echo $currentPage->get('name'); ?>
	<a href="#" class="jqmClose modal_close_bluebg">Cerrar</a></h3>

<div id="modalcontent" class="">

<style type="text/css" media="screen">
	#pages {
		overflow: auto;
		height: 460px;
	}
</style>
<div id="pages">
<?php

function hasChilds($page, $section)
{
	$chidls = $page->getPages();
	if($chidls->count() > 0)
	{
		echo '<ul>';
		foreach($chidls as $p)
		{
			echo "\n";
			$class = $page->get('parent_page_id') == $p->get('id') ? 'current' : '';
			echo '<li><a href="#" class="pagparent '.$class.'" id="'.$section->get('id').'-'.$p->get('id').'" >'.$p->get('name').'</a>';
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
	$sclass = $section->get('id') == $currentPage->get('site_section_id') ? ' current' : '';
	echo '<li class="pagparent"><a href="#" class="section pagparent'.$sclass.'" id="'.$section->get('id').'-0">'.$section->get('name').'</a>';
		//$pages= new Cms_Model_Page( Cms_Cms::getDbConnection());
		//$pages->select()->where('site_section_id='.$section->get('id').' AND site_language_id = 0')->runSelect();
		$pages = $section->getParentPages();
	if($pages->count() > 0)
	{
    
    $current_page_id = $currentParent ? $currentParent->get('id') : 0;
		foreach($pages as $page)
		{
			echo '<ul>';
      echo "\n";
      
			$class = $current_page_id === $page->get('parent_page_id') ? ' current' : '';
			
			if(( $currentPage->get('id') != $page->get('id')) && ( $currentPage->get('lang_main_page_id') != $page->get('id')))
			{
				echo '<li><a href="#" class="pagparent'.$class.'" id="'.$section->get('id').'-'.$page->get('id').'">'.$page->get('name').'</a>';

				if($languages->count() > 0)
				{

					foreach($languages as $lang)
					{
						$pagelang = new Cms_Model_Page( Cms_Cms::getDbConnection());
						$pagelang->select()->where('lang_code = "'.$lang->get('code').'" AND lang_main_page_id = '. $page->get('id'))->runSelect();
						if($pagelang->count() == 1)
						{
							$langsecc = $section->getForLanguage($lang->get('code'));
							echo ' - <a href="#" style="color:#5E9D09;" class="pagparent'.$class.'" id="'.$langsecc->get('id').'-'.$pagelang->get('id').'-'.strtolower($lang->get('code')).'" title="'.$pagelang->get('name').'">'.$lang->get('name').'</a>';
						}
					}
				}
				hasChilds($page, $section);

				echo '</li>';
			}
			
			echo '</ul>';
			echo "\n";
		}
		$pages = null;
	}
	echo '</li>';
	echo '</ul>';
}

?>
</div>
<p>
<?php if(isset($_GET['type']) && $_GET['type'] == 'submit'): ?>
<input type="button" name="save" value="Asignar" id="asign_new_path_btn">
<?php endif; ?>
</p>
</div>

<script type="text/javascript" charset="utf-8">
var isupdate = false;
var counter = false;
<?php if(isset($_GET['type']) && isset($_GET['field']) && isset($_GET['toupdate']) && isset($_GET['title_field'])): ?>
var isupdate = true;
var fieldupdate = '<?php echo $_GET['field']; ?>';
var textupdate = '<?php echo $_GET['toupdate']; ?>';
var titlefield = '<?php echo $_GET['title_field']; ?>';
<?php endif; ?>

<?php if(isset($_GET['counter'])): ?>
var counter = '<?php echo $_GET['counter']; ?>';
<?php endif; ?>

</script>
<script type="text/javascript" src="Cms/includes/javascript/parent_selector.js"></script>
<script type="text/javascript" charset="utf-8">
<?php if(isset($_GET['type']) && $_GET['type'] == 'submit'): ?>
	$('#asign_new_path_btn').click( function(){
		if(anychange)
			document.update_page_structure.submit();
		return false;
	});
<?php endif; ?>

<?php if(isset($_GET['type'])): ?>
	$('#asign_new_path_btn').click( function(){
		return false;
	});
<?php endif; ?>

</script>
