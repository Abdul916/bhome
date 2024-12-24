<?php 
// Sections
$sections = new Cms_Model_Section(Cms_Cms::getDbConnection());
$sections->select()->where('publish_status = 1 and index_status is null')->orderBy('orden asc')->runSelect();


//contact page
$cmodel = $this->factory('page');
$cmodel->find(805);
$contact = new FrontCms_Core_Page($cmodel);
?>
                <div class="flex flex-col w-min menu">
                <?php foreach( $sections as $inx => $section): ?>
                <?php $pg = $section->getIndexPage(); ?>
<?php if( $pg->count() ): $index = new FrontCms_Core_Page($pg); ?>
                <a href="<?= $index->getUrl() ?>" 
                class="animate__animated animate__fadeInLeft animate__delay-<?= $inx + 1 ?>s w-min float-left text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl mb-4 xl:mb-4 2xl:mb-4 font-normal"
                ><?= $index->get('page-name') ?></a>
                <?php endif; ?>
                <?php endforeach; ?>
                    <!-- <a href="why.html" class="animate__animated animate__fadeInLeft animate__delay-2s w-min float-left text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl mb-4 xl:mb-4 2xl:mb-4 font-normal">Why us?</a> -->
                    <!-- <a href="projects.html" class="animate__animated animate__fadeInLeft animate__delay-3s    w-min float-left text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl mb-4 lg:mb-4 xl:mb-4 2xl:mb-4 font-normal">Projects</a> -->
                    <!-- <a href="media.html" class="animate__animated animate__fadeInLeft animate__delay-4s w-min float-left text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl mb-4 xl:mb-4 2xl:mb-4 font-normal">Media</a> -->
                    <!-- <a href="contact.html" class="animate__animated animate__fadeInLeft animate__delay-5s    w-min float-left text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-8xl  font-normal">Contact</a> -->
                </div>

                <div class="flex flex-col contacto animate__animated animate__fadeIn animate__delay-5s">
                    <a href="#" class="text-md md:text-lg lg:text-xl xl:text-xl 2xl:text-xl mb-6 mt-6">Subscribe to newsletter</a>
                    <div class="redes">
                        <a href="<?= $contact->get('whats-app') ?>" target="_blank" class="text-lg md:text-xl lg:text-2xl xl:text-3xl 2xl:text-4xl"><img src="<?= $base ?>images/i_whatsapp.svg" alt="whatsapp"></a>
                        <a href="<?= $contact->get('facebook') ?>" target="_blank" class="text-lg md:text-xl lg:text-2xl xl:text-3xl 2xl:text-4xl"><img src="<?= $base ?>images/i_facebook.svg" alt="facebook"></a>
                        <a href="<?= $contact->get('instagram') ?>" target="_blank" class="text-lg md:text-xl lg:text-2xl xl:text-3xl 2xl:text-4xl"><img src="<?= $base ?>images/i_instagram.svg" alt="instagram"></a>
                    </div>
                </div>
