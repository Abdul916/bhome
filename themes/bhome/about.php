<!DOCTYPE html>
<?php include 'block/base.php'; ?>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>About Bhome</title>
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
	   <a class="logo" href="<?= $base ?>"><img src="<?= $base ?>images/bhome.svg" alt="Bhome"></a>
	   <div class="hmenu">
	   <a class="botonc" href="<?= $base ?>contact">Contact us</a>
			<a class="btn_menu sm_open" data-modal="menu" data-effect="pushdown" href="#"><img src="<?= $base ?>images/menu.svg" alt="Menu"></a>
	   </div>
   </div>

  
<div class="caja">
		<div class="navigation" x-data="{selected: 0}">
			 <h1>About us</h1>
                <ul class="subnav"><li><a :class="{active: selected == 0}" @click="selected = 0" href="#">History</a></li>
                    <li><a @click="selected = 1" :class="{active: selected == 1}" href="#numbers">Numbers</a></li><li><a @click="selected = 2":class="{active: selected == 2}" href="#developments">Developments</a></li></ul>
		</div>	 
	 <div class="cuadricula">
	     <div class="uno">
            <?php $page->eco('introduction') ?>
		</div>
        <div class="dos"><img src="/<?= $page->get('photo')->get('file_path') ?>" alt="CEO"></div>
	 </div>
     <div class="frase">
			<h1><?php $page->eco('phrase') ?></h1>
	 </div>
	 
<?php
    $numbers = $this->factory('page');
    $numbers->select()->where('parent_page_id = 767 and publish_status = 1')->orderBy('orden asc')->runSelect();
?>
	 <div id="numbers" class="listado">
            <?php foreach($numbers as $num): ?> 
                <?php $number = new FrontCms_Core_Page( $num); ?>
		   <div class="hilera">
           <div class="counter"><?php $number->eco('value-sign') ?><span data-from="1" data-to="<?php $number->eco('value') ?>" data-refresh-interval="5" data-speed="1200" data-comma="true"></span>
<?php $number->eco('value-unit') ?>
           </div><div class="datos">
           <?php if(strlen( $number->get('icon')->get('file_path') ) > 3): ?>
            <img src="/<?= $number->get('icon')->get('file_path') ?>" >
        <?php endif; ?>
           <p><?php $number->eco('page-name') ?></p></div>
		   </div>
            <?php endforeach; ?>
		   
	 </div>
	 
<?php
    $developmentCategories = $this->factory('page');
    $developmentCategories->select()->where('page_structure_id = 18 and publish_status = 1')->orderBy('orden asc')->runSelect();
?>
<?php foreach($developmentCategories as $category): ?>
	 <div id="developments" class="listado">
     <h3><?= $category->get('name') ?></h3>
     <?php $frontCat = new FrontCms_Core_Page($category); ?>
        <?php if( strlen($frontCat->get('banner')->get('file_path')) > 4): ?>
        <img src="/<?= $frontCat->get('banner')->get('file_path') ?>" alt ="<?= $category->get('name') ?>">
        <?php endif; ?>
		<div class="lista">
     <?php $projects = $this->factory('page');
    $projects->select()->where('parent_page_id =' . $category->get('id') . ' and publish_status = 1')->orderBy('orden asc')->runSelect();
            foreach( $projects as $pr):
                $project = new FrontCms_Core_Page($pr);
    ?>
	    <div class="item"><p><?php echo $project->get('year') ?></p> <p><?php $project->eco('page-name') ?></p> <p><?= $project->eco('description'); ?></p></div>
            <?php endforeach; ?>
		</div>
	 </div>
<?php endforeach; ?>
	 

	 
</div>




    <div class="slim_modal blanco" id="menu">
	  <div class="header">
	    <a class="logo_m" href="<?= $base ?>"><img src="<?= $base ?>images/bhome.svg" alt="Bhome"></a>
	    <a href="#" class="btn_close sm_close sm_close_button"><img src="<?= $base ?>images/cerrar.svg" alt="Cerrar"></a>
	  </div>

            <div class="cuadro">
                <?php include 'block/menu.php'; ?>
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
