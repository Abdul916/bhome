<?php
$base = $this->getConfig('friendly_url_base');
$contact = $this->factory('page');
$contact->find(805);
$contact = new FrontCms_Core_Page( $contact);
?>
