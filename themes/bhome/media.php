<!DOCTYPE html>
<?php include 'block/base.php'; ?>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Bhome</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;600&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="<?= $base ?>css/tailwind.css"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  
 
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <meta name="description" content="<?php $page->eco('meta_description'); ?>">
	<meta name="keywords" content="<?php $page->eco('meta_keywords'); ?>">
  <link rel="stylesheet" href="<?= $base ?>css/style_m.css">
  <link rel="stylesheet" href="<?= $base ?>css/swiper.css">

<style>
.russell {
  text-align: right;
float: right;
}
</style>

</head>

<body>

<div class="container">
  
   <div class="header">
      <a class="logo" href="<?= $base ?>"><img src="<?= $base ?>images/bhome.svg" alt="Bhome"></a>
	   <div class="hmenu">
			<a class="botonc" href="<?= $base; ?>contact">Contact us</a>
			<a class="btn_menu sm_open" data-modal="menu" data-effect="pushdown" href="#"><img src="<?= $base ?>images/menu.svg" alt="Menu"></a>
	   </div>
   </div>

            <?php
$publications = $this->factory('page');
$publications->select()->where('publish_status = 1 and page_structure_id = 23')->orderBy('orden asc')->runSelect();
?> 
   <div class="caja">
		<div class="navigation">
            <h1><?= $page->get('page-name') ?></h1>
		</div>	 
	 
		<div class="media">
            <?php foreach($publications as $index => $item): $publication = new FrontCms_Core_Page($item); ?>
<?php
$link_title = "More info";
$link = "#";
if($publication->get('pdf-file')) {
    $link_title = 'View PDF';
    $link = $publication->get('pdf-file');
} 
?>
			<div class="bloque">
			    
                <?php if( $index % 2): ?>

                    <a href="#" class="fend"><img src="/<?php echo $publication->get('cover')->get('file_path') ?>" alt="Publication"></a> 

                  



                <?php endif; ?>
			    <div class="contenido">
                <h1 class="<?= (! $index % 2) ? 'tder' : '' ?>"><?php $publication->eco('page-name') ?></h1>
                <div class="<?= (! $index % 2) ? 'tder pdl20' : '' ?>">
				<?php $publication->eco('description') ?></div>
                <?php if($link != "#"): ?>
                <a href="<?= $link ?>" target="_blank" class="<?= (! $index % 2) ? 'fend' : '' ?>"><?= $link_title ?></a>
                <?php endif; ?>
                <?php if($publication->get('vimeo-video-id')): ?> 

<!-- <a class="" data-modal="video-<?= $item->get('id') ?>" data-effect="pushdown" href="https://bhomeenterprise.ca/file_example_MP4_1280_10MG.mp4" target="_blank">Watch video 1</a>  -->

<p><a class="fend sm_open" href="https://bhomeenterprise.ca/file_example_MP4_1280_10MG.mp4" target="_blank">Watch video</a></p>

                <?php endif; ?>

<!-- <p><a class="1fend 1sm_open" href="https://player.vimeo.com/video/868874890?badge=0&amp;autopause=0&amp;quality_selector=1&amp;progress_bar=1&amp;player_id=0&amp;app_id=58479" target="_blank">Watch video</a></p> -->

				</div>
                <?php if(! $index % 2): ?>
               <a href="#"><img src="/<?= $publication->get('cover')->get('file_path') ?>" alt="Video"></a>
                <?php endif; ?>
			</div>
                <?php endforeach; ?>
			 
		</div>
	 
   </div>




    <div class="slim_modal blanco" id="menu">
	  <div class="header">
	    <a class="logo_m" href="/"><img src="<?= $base ?>images/bhome.svg" alt="Bhome"></a>
	    <a href="#" class="btn_close sm_close sm_close_button"><img src="<?= $base ?>images/cerrar.svg" alt="Cerrar"></a>
	  </div>

            <div class="cuadro">
                <?php include 'block/menu.php' ?>
			</div>
		
    </div>
    



<?php 
foreach($publications as $index => $item): 
$publication = new FrontCms_Core_Page($item); ?>

<?php if($publication->get('vimeo-video-id')): ?>
<div class="slim_modal blanco" id="video-<?= $item->get('id') ?>">
	  <div class="header">
            <a class="logo_m" href="/"><img src="<?= $base ?>images/bhome.svg" alt="Bhome"></a>
	    <a href="#" class="btn_close sm_close sm_close_button"><img src="<?= $base ?>images/cerrar.svg" alt="Cerrar"></a>
	  </div>
            <div class="caja">
            <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/<?= $publication->get('vimeo-video-id') ?>?h=9ab3d8839f&autoplay=1" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
			<p><a href="https://vimeo.com/<?= $publication->get('vimeo-video-id') ?>"><?= $publication->get('page-name') ?></p>
		    </div>
</div>

 </div>  
<?php endif; ?>
<?php endforeach; ?>

    
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
	<script type="text/javascript" src="<?= $base ?>js/jquery.js"></script>
	<script  src="<?= $base ?>js/plugins.js"></script>
    <script  src="<?= $base ?>js/function.js"></script>
	<script  src="<?= $base ?>js/functions.js"></script>
    
  
    <script src="https://unpkg.com/popper.js@1/dist/umd/popper.min.js"></script>
	<script src="https://unpkg.com/tippy.js@4"></script>
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
   
   

   
   <!--<script>
		$(document).ready(function(){
		  $(".numero span").counterUp({
		     delay: 10,
			 time: 1000
		  });
		});
   </script>-->
   

	<script>
	  var openmodal = document.querySelectorAll('.modal-open')
	  for (var i = 0; i < openmodal.length; i++) {
		openmodal[i].addEventListener('click', function(event){
		event.preventDefault()
		toggleModal()
		})
	  }
	  
	  //const overlay = document.querySelector('.modal-overlay')
	  //overlay.addEventListener('click', toggleModal)
	  
	  var closemodal = document.querySelectorAll('.modal-close')
	  for (var i = 0; i < closemodal.length; i++) {
		closemodal[i].addEventListener('click', toggleModal)
	  }
	  
	  document.onkeydown = function(evt) {
		evt = evt || window.event
		var isEscape = false
		if ("key" in evt) {
		isEscape = (evt.key === "Escape" || evt.key === "Esc")
		} else {
		isEscape = (evt.keyCode === 27)
		}
		if (isEscape && document.body.classList.contains('modal-active')) {
		toggleModal()
		}
	  };
	  
	  
	  function toggleModal () {
		const body = document.querySelector('body')
		const modal = document.querySelector('.modal')
		modal.classList.toggle('opacity-0')
		modal.classList.toggle('pointer-events-none')
		body.classList.toggle('modal-active')
	  }
	  
	   
	</script>


</body>
</html>
