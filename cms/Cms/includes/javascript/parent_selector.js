var current = $('a.current');
var anychange = false;
$('a.pagparent').each( function(i, e){
		$(e).click( function()
				{
				$(this).addClass('current');
				current.removeClass('current');
				current = $(this);
				var det = jQuery(this).get(0).id.split("-"); // alert(jQuery(this).get(0).id);
			    var section_id = det[0];
				var page_id = det[1];
				//alert(' secc id: ' + section_id);
				if(!isupdate)
				{
					// si no es update
					$('input#parent_page_id').val(page_id);
					document.getElementById('parent_section_id').value = page_id;
					document.getElementById('parent_section_id').value = section_id;
				}else{
					// actualizar campo
					$('input#'+fieldupdate).val(page_id);
					var nombrepagina = $(this).text();
					
					$('#'+textupdate).html( '<span>' + nombrepagina + '</span> <em>index.php?seccid=' + section_id + '&pageid=' + page_id + '</em><br /> <label>Titulo link</label> <input name="'+titlefield+'" id="'+titlefield+'" value="' + nombrepagina + '" />');
					if(!counter)
					{
						$('#call-to-action-derecha-counter').jqmHide();
					}else{
						$('#' + counter).jqmHide();
					}
					
				}
				
				anychange = true;
				return false;
				}
			);
		}
	
	);
	


