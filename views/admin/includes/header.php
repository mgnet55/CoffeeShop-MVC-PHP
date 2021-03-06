<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= env('APP_NAME') ?>|Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Home</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto"><li class="nav-item">
                <a class="nav-link" href="/logout" role="button">Logout <i class="fa fa-sign-out""></i>
                </a></li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="/logo.png"  class="brand-image img-circle elevation-3 bg-white" style="opacity: .8">
            <span class="brand-text font-weight-light"><?= env('APP_NAME') ?></span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/uploads/<?= $_SESSION['avatar'] ?>" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= $_SESSION['name'] ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item"><a href="/" class="nav-link"><i class="nav-icon fa fa-home"></i><p>Home</p></a></li>

                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="nav-icon fa fa-user"></i><p>Users<i class="fas fa-angle-left right"></i></p></a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="/admin/users" class="nav-link"><i class="nav-icon fa fa-asterisk"></i><p>All</p></a></li>
                            <li><li class="nav-item"><a href="/admin/users/add" class="nav-link"><i class="nav-icon fa fa-plus"></i><p>Add User</p></a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="nav-icon fa fa-coffee"></i><p>Products<i class="fas fa-angle-left right"></i></p></a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="/admin/products" class="nav-link"><i class="nav-icon fa fa-asterisk"></i><p>All</p></a></li>
                            <li class="nav-item"><a href="/admin/products/add" class="nav-link"><i class="nav-icon fa fa-plus"></i><p>Add Product</p></a></>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="nav-icon fa fa-shopping-cart"></i><p>Orders<i class="fas fa-angle-left right"></i></p></a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="/admin/orders" class="nav-link"><i class="nav-icon fa fa-asterisk"></i><p>All</p></a></li>
                            <li class="nav-item"><a href="/orders/processing" class="nav-link"><i class="nav-icon fa fa-spinner"></i><p>Processing</p></a></li>
                            <li class="nav-item"><a href="/admin/orders/add" class="nav-link"><i class="nav-icon fa fa-plus"></i><p>Add Order</p></a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="nav-icon fa fa-th-list"></i><p>Categories<i class="fas fa-angle-left right"></i></p></a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a href="/admin/categories" class="nav-link disabled"><i class="nav-icon fa fa-asterisk"></i><p>All</p></a></li>
                            <li class="nav-item"><a href="/admin/categories/add" class="nav-link disabled"><i class="nav-icon fa fa-plus"></i><p>Add Category</p></a></>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
