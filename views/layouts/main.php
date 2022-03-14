<?php
use PhpMvc\Support\Session;
include VIEWS_PATH . 'partials' . DIRECTORY_SEPARATOR . 'head.php';
isAdmin() ?  include (VIEWS_PATH . 'partials' . DIRECTORY_SEPARATOR . 'admin-header.php') : include VIEWS_PATH . 'partials' . DIRECTORY_SEPARATOR . 'user-header.php';
?>

    {{content}}

<?php include VIEWS_PATH.'partials'.DIRECTORY_SEPARATOR.'footer.php'; ?>
