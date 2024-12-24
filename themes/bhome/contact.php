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
                <a class="botonc" href="">Contact us</a>
                <a class="btn_menu sm_open" data-modal="menu" data-effect="pushdown" href="#"><img src="<?= $base ?>images/menu.svg" alt="Menu"></a>
            </div>
        </div>


        <div class="caja">
            <div class="navigation">
                <h1>Contact</h1>
            </div>

            <div class="contact" x-data="formManager">
                <form @submit.prevent="handleSubmit" action="src/index.php" class="forma">
                    <input x-model="form.first_name" type="text1" class="form-control required" value="" placeholder="Name">
                    <input x-model="form.last_name" type="text2" class="form-control required" value="" placeholder="Last name">
                    <input x-model="form.email" type="text3" class="form-control required" value="" placeholder="e-mail">
                    <input x-model="form.phone" type="text4" class="form-control required" value="" placeholder="phone">
                    <input x-model="form.subject" class="col-span form-control" type="text5" class="form-control required" value="" placeholder="Subject">
                    <textarea x-model="form.message" class="col-span" type="text6" class="form-control required" name="mensaje" cols="3" rows="2" placeholder="Message"></textarea>
                    <button class="contact2-form-btn col-span2">Send</button>
<span x-text="message"></span>
                </form>

                <div class="derecha">
                    <div class="quote"><?= strip_tags($page->get('text')); ?></div>
                    <div class="flex flex-col contacto">
                        <a href="#" class="text-md md:text-lg lg:text-xl xl:text-xl 2xl:text-xl mb-4">Subscribe to newsletter</a>
                        <div class="redes">
                            <a href="<?= $page->get('whats-app') ?>" target="_blank" class="text-lg md:text-xl lg:text-2xl xl:text-3xl 2xl:text-4xl"><img src="<?= $base ?>images/i_whatsapp.svg" alt="whatsapp"></a>
                            <a href="<?= $page->get('facebook') ?>" target="_blank" class="text-lg md:text-xl lg:text-2xl xl:text-3xl 2xl:text-4xl"><img src="<?= $base ?>images/i_facebook.svg" alt="facebook"></a>
                            <a href="<?= $page->get('instagram') ?>" target="_blank" class="text-lg md:text-xl lg:text-2xl xl:text-3xl 2xl:text-4xl"><img src="<?= $base ?>images/i_instagram.svg" alt="instagram"></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    <script>
        function formManager() {
            return {
                form: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    subject: '',
                    message: '',
                },
                message: '',
                result: '',
                submitting: false,
                handleSubmit: function (event) {
                    this.submitting = true;
                    console.log(this.form)
                    this.message = '';
                    fetch('/formmail/src/index.php', {
                        method: 'POST',
                        mode: 'same-origin',
                        cache: 'no-cache',
                        headers: {'Content-Type': 'aplication/json'},
                        body: JSON.stringify(this.form)
                    })
                        .then(response => {
                            console.log(response);
                            this.submitting = false;
                            this.message = 'Your message was send!';
                        }).catch(e => {
                            this.submitting = false;
                            this.message = 'There was an error submitting you form, please contact us at contact@tikimail.com';
                        });
                },
                disabled: function () {
                }
            };
        }
    </script>

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
    <script src="<?= $base ?>js/plugins.js"></script>
    <script src="<?= $base ?>js/function.js"></script>
    <script src="<?= $base ?>js/functions.js"></script>


    <script src="https://unpkg.com/popper.js@1/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>




    <!--<script>
		$(document).ready(function(){
		  $(".numero span").counterUp({
		     delay: 10,
			 time: 1000
		  });
		});
   </script>-->


    <script>

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

    <script src="//unpkg.com/alpinejs" defer></script>
</body>

</html>
