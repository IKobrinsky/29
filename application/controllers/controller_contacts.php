<?php
class controller_contacts extends Controller { 
function action_index() { 
$this->view->generate('contacts_view.php', 'template_view.php'); 
} 
}
?>
