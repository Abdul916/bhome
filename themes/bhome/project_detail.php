<!DOCTYPE html>
<?php include 'block/base.php'; ?>
<html lang="en">

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
    <link rel="stylesheet" href="<?= $base ?>css/style_m.css">
    <link rel="stylesheet" href="<?= $base ?>css/swiper2.css">
    <script src="//unpkg.com/alpinejs" defer></script>
    <meta name="description" content="<?php $page->eco('meta_description'); ?>">
	<meta name="keywords" content="<?php $page->eco('meta_keywords'); ?>">
</head>

<body>

    <div id="description" class="container">

        <div class="header">
            <a class="logo" href="<?= $base ?>"><img src="<?= $base ?>images/bhome.svg" alt="Bhome"></a>
            <div class="hmenu">
                <a class="botonc" href="<?= $base; ?>contact">Contact us</a>
                <a class="btn_menu sm_open" data-modal="menu" data-effect="pushdown" href="#"><img src="<?= $base ?>images/menu.svg" alt="Menu"></a>
            </div>
        </div>


        <div class="caja">
            <div class="navigation" x-data="{selected: 0}">
                <h1><?php $page->eco('page-name'); ?></h1>
                <ul class="subnav">
                    <li><a :class="{active: selected == 0}" @click="selected =0" href="#description">Description</a></li>
                <?php if( strlen($page->get('description-2')) > 4): ?>
                    <li><a :class="{active: selected == 1}" @click="selected =1" href="#home">Why this home?</a></li>
                <?php endif; ?>
                <?php if( strlen($page->get('description-3')) > 4): ?>
                    <li><a :class="{active: selected == 2}" @click="selected =2" href="#north">Why this location?</a></li>
                <?php endif; ?>
                <?php if( strlen($page->get('description-4')) > 4): ?>
                    <li><a :class="{active: selected == 3}" @click="selected =3" href="#gift">A special Gift</a></li>
                <?php endif; ?>
                </ul>
            </div>
            <div class="swiper-container mySwiper mt-100">
                <div class="swiper-wrapper">
                    <?php foreach ($page->get('project-gallery')->getImages() as $image) : ?>
                        <div class="swiper-slide"><img src="/<?= $image->get('file_path') ?>"></div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>


            <div class="mivi">
                <h6>Description</h6>
                <?php $page->eco('description'); ?>
            </div>

            <div class="mivi">
            <?php $page->eco('characteristics'); ?>
            </div>
            <?php if(strlen( $page->get('animated-image')->get('file_path') ) > 5): ?>
            <div id="lista3" class="mivi mt-100">
            <img src="/<?= $page->get('animated-image')->get('file_path'); ?>" alt="animacion">
            </div>
            <?php endif; ?>

<?php if( strlen($page->get('description-2')) > 4): ?>
            <div id="home" class="mivi">
                <h6>Why this home?</h6>
            <?php $page->eco('description-2'); ?>
                <h6>Location</h6>
            </div>
            <?php $page->eco('location-map-embed'); ?>
<?php endif; ?>

            <div id="north" class="mivi">
            <?php if( strlen($page->eco('description-3')) ): ?>
                <?php $page->eco('description-3'); ?>
            <?php endif; ?>
            </div>


            <?php if($page->get('gallery')->getImages()): ?>
            <div class="vancouver">
            <?php foreach( $page->get('gallery')->getImages() as $img): ?>
                <div class="card">
                <img src="/<?= $img->get('file_path') ?>" alt="Canyon Elementary School">
                <p><?= $img->serialized('image_name'); ?></p>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>


            </div>

            <?php if(strlen($page->get('description-4')) || $page->get('image')->get('file_path')): ?>
            <div id="gift" class="mivi">
                <div class="uno mb-8">
                <?php $page->eco('description-4'); ?>
                </div>
                <img src="/<?= $page->get('image')->get('file_path'); ?>" alt="">
            </div>
            <?php endif; ?>

        </div>

        <div class="slim_modal blanco" id="menu">
            <div class="header">
                <a class="logo_m" href="<?= $base ?>"><img src="<?= $base ?>images/bhome.svg" alt="Bhome"></a>
                <a href="#" class="btn_close sm_close sm_close_button"><img src="<?= $base ?>images/cerrar.svg" alt="Cerrar"></a>
            </div>

            <div class="cuadro">
        <?php include 'block/menu.php' ?>
            </div>

        </div>

    </div>


    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <script src="<?= $base ?>js/plugins.js"></script>
    <script src="<?= $base ?>js/function.js"></script>
    <script src="<?= $base ?>js/functions.js"></script>


    <script src="https://unpkg.com/popper.js@1/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


    <!--<script>
		$(document).ready(function(){
		  $(".numero span").counterUp({
		     delay: 10,
			 time: 1000
		  });
		});
   </script>-->
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 0,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

    <script>
        var openmodal = document.querySelectorAll('.modal-open')
        for (var i = 0; i < openmodal.length; i++) {
            openmodal[i].addEventListener('click', function(event) {
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


        function toggleModal() {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active')
        }
    </script>


</body>

</html>
