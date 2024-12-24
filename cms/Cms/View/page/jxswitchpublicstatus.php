<p>El estatus de la página se actualizo a: <strong><?php if($page->get('publish_status') == 1){ echo 'Publico'; }else{ echo 'Privado'; } ?></strong>
<span class="date"><?php echo $page->get('publish_date'); ?></span>
</p>