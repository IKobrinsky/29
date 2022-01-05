<?php
class controller_gd extends Controller { 
function action_index() { 
$this->view->generate('gd_view.php', 'template_view.php'); 
} 
}
?>