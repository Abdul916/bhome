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
</head>

<body>

<div class="container">
  
   <div class="header">
    <a class="logo" href="<?= $base ?>"><img src="<?= $base; ?>images/bhome.svg" alt="Bhome"></a>
	   <div class="hmenu">
			<a class="botonc" href="<?= $base; ?>contact">Contact us</a>
			<a class="btn_menu sm_open" data-modal="menu" data-effect="pushdown" href="#"><img src="<?= $base; ?>images/menu.svg" alt="Menu"></a>
	   </div>
   </div>

  
   <div class="caja">
		<div class="navigation">
            <h1><?php $page->eco('page-name') ?></h1>
			 
		</div>	 
	 <div class="cuadricula2">
	     <div class="uno">
            <?php $page->eco('introduction'); ?>
		</div>
        <div class="dos"><img src="/<?= $page->get('main-image')->get('file_path') ?>" alt=""></div>
	 </div>
     <div class="mivi">
        <?php $page->eco('text-1') ?>
	 </div>
	 <div class="mivi">
        <?php $page->eco('text-2') ?>
	 </div>
	 
	 <div class="mivi">
			<div class="uno orange">
        <?php $page->eco('text-3') ?>
		    </div>
	 
	 </div>
            <?php
$profiles = $this->factory('page');
$profiles->select()->where('page_structure_id = 21 and publish_status = 1')->orderBy('orden asc')->runSelect();
?> 
	 <div class="cuadricula4">
     <?php foreach($profiles as $item): $profile = new FrontCms_Core_Page($item); ?>
<div><img src="/<?= $profile->get('portrait')->get('file_path') ?>" alt="<?= $profile->get('position') ?>"><p><?= $profile->get('page-name') ?> - <?= $profile->get('position') ?></p></div>
        <?php endforeach ?>
	 </div>

	 <!--<div class="cuadricula3">
	    <div class="uno orange">
			 <h2>Led by a team of highly creative architects and interior designers, at BHOME we are committed to integrate beauty with functionality in everything we do.</h2></br>
			 <h2>Our marketing and realtor team is made up of successful creatives who specialize in the Vancouver market.</h2>
		</div>
		<div class="dos"><img src="<?= $base; ?>images/why/equipo.jpg" alt="CEO"></div>
	 </div>-->

	 <div class="mivi">
        <?php $page->eco('closure') ?>
	 </div>

	 
   </div>




    <div class="slim_modal blanco" id="menu">
	  <div class="header">
	    <a class="logo_m" href="index.html"><img src="<?= $base; ?>images/bhome.svg" alt="Bhome"></a>
	    <a href="#" class="btn_close sm_close sm_close_button"><img src="<?= $base; ?>images/cerrar.svg" alt="Cerrar"></a>
	  </div>

            <div class="cuadro">
                <?php include 'block/menu.php' ?>
			</div>
		
    </div>
    

 </div>  

    
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
	  
	  const overlay = document.querySelector('.modal-overlay')
	  overlay.addEventListener('click', toggleModal)
	  
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
