<!DOCTYPE html>
<html lang="en">
<?php include 'block/base.php'; ?>
<head>
    <meta charset="UTF-8">
    <title>Bhome</title>
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>css/tailwind.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?= $base ?>css/style_m.css">
    <link rel="stylesheet" href="<?= $base ?>css/swiper_m.css">
    <meta name="description" content="<?php $page->eco('meta_description'); ?>">
	<meta name="keywords" content="<?php $page->eco('meta_keywords'); ?>">
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


        <div class="swiper-container mySwiper">
            <div class="swiper-wrapper">


                <a href="#" class="swiper-slide">
                    <img src="<?= $base ?>images/home/homeA.jpg">
                    <h1>Habitats to thrive in</h1>
                </a>




            </div>
            <!--<div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>-->





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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="js/function.js"></script>
    <script src="js/owl.carousel.js"></script>

    <script src="https://unpkg.com/popper.js@1/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 0,
            loop: false,
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
