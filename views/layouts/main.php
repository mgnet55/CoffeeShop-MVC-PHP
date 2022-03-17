<?php
use PhpMvc\Support\Session;
include VIEWS_PATH . 'partials' . DS . 'head.php';
//isAdmin() ?  include (VIEWS_PATH . 'partials' . DIRECTORY_SEPARATOR . 'admin-header.php') :
    include VIEWS_PATH . 'partials' . DS . 'user-header.php';
?>
    {{content}}

<?php include VIEWS_PATH.'partials'.DS.'footer.php'; ?>
