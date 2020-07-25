<!DOCTYPE html>
<html lang="en">
<head>
    <title>Truyen SH</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    

    <!-- import fontawesome -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
    <!-- import my css login -->
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/story.css">
</head>
<body>

<div class="outsite">

    <section class="top-nav">
        <div class="container ">
                <div class="d-flex">
                    <div class="top-nav-left ">
                        <a class="navbar-brand" href="#">
                            <img src="./img/logo/logo_home.png" class="rounded img-fluid" alt="Cinque Terre"></a>
                    </div>
                    <div class="top-nav-input ">
                        <form class="form-inline" action="/action_page.php">
                            <div class="input-group">

                                <input type="text" class="form-control" placeholder="Username">
                                <div class="input-group-append">
                                    <button class="btn_search " type="submit"><i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="top-nav-ls-td ml-auto">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Lịch Sử</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Theo Dõi</a>
                            </li>

                        </ul>
                    </div>
                 <!--    <div class="top-nav-btn btn-group">
                        <button type="button" class="btn btn-dangnhap" data-toggle="modal" data-target="#myModal">Đăng nhập</button>
                        <button type="button" class="btn btn-dangky" data-toggle="modal" data-target="#myModal">Đăng ký</button>
                    </div> -->
                        
                        <!-- Đã đăng nhập -->

                         <div class="logined">
                            <button class="avatar-user"><img src="http://static.truyenqq.com/template/frontend/images/noavatar.png" alt=""></button>
                            <ul class="user-links">
                                <li>
                                    <a href="http://truyenqq.com/quan-ly-tai-khoan.html"><i class="fa fa-user-circle" aria-hidden="true"></i> Quản lý tài khoản</a>
                                </li>
                                <li>
                                    <a href="http://truyenqq.com/truyen-dang-theo-doi.html"><i class="fa fa-heart" aria-hidden="true"></i> Truyện đang theo dõi</a>
                                </li>
                                <li>
                                    <a href="http://truyenqq.com/lich-su.html"><i class="fa fa-history" aria-hidden="true"></i> Lịch sử đọc truyện</a>
                                </li>
                                <li>
                                    <a href="http://truyenqq.com/doi-mat-khau.html"><i class="fa fa-lock" aria-hidden="true"></i> Đổi mật khẩu</a>
                                </li>
                                <li>
                                    <a href="http://truyenqq.com/logout.html?url=http://truyenqq.com/"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất</a>
                                </li>
                            </ul>
                        </div>

        
                        <!-- end đã đăng nhập -->

                    <nav class="navbar navbar-expand-xl navbar-dark open-menu d-lg-none" >
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-small">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                           
                        </nav>                   
                </div>
                
                <div class="collapse navbar-collapse d-lg-none" id="menu-small">
                    <ul class="navbar-nav">
                    <li class="nav-item nav-item-main-menu">
                        <a class="nav-link" href="#">Trang chủ</a>
                    </li>
                    <li class="row nav-item nav-item-main-menu  dropdown-main-menu " >
                        <a class="nav-link dropdown-toggle" href="#small-menu-1"  data-toggle="collapse">
                            Thể Loại
                        </a>
                        <div class="my-drop-menu col-12 collapse" id="small-menu-1">
                            <a class="dropdown-item " href="#">Link 1</a>
                            <a class="dropdown-item " href="#">Link 2</a>
                            <a class="dropdown-item " href="#">Link 3</a>
                            <a class="dropdown-item " href="#">Link 1</a>
                            <a class="dropdown-item " href="#">Link 2</a>
                            <a class="dropdown-item " href="#">Link 3</a>
                        </div>
                    </li>
                    <li class="row nav-item nav-item-main-menu dropdown-main-menu">
                        <a class="nav-link dropdown-toggle" href="#small-menu-2"  data-toggle="collapse">
                            Sắp Xếp
                        </a>
                        <div class="my-drop-menu col-12 collapse" id="small-menu-2">
                            <a class="dropdown-item" href="#">Link 4</a>
                            <a class="dropdown-item" href="#">Link 5</a>
                            <a class="dropdown-item" href="#">Link 6</a>
                        </div>
                    </li>
                    <li class="nav-item nav-item-main-menu">
                        <a class="nav-link" href="#">Mới Cập Nhật</a>
                    </li>
                    <li class="row nav-item nav-item-main-menu dropdown-main-menu">
                        <a class="nav-link dropdown-toggle" href="#small-menu-3"  data-toggle="collapse">
                            Trạng Thái
                        </a>
                        <div class="my-drop-menu col-12 collapse" id="small-menu-3">
                            <a class="dropdown-item" href="#">Link 4</a>
                            <a class="dropdown-item" href="#">Link 5</a>
                            <a class="dropdown-item" href="#">Link 6</a>
                        </div>
                    </li>
                    <li class="nav-item nav-item-main-menu">
                        <a class="nav-link" href="#">Lịch Sử</a>
                    </li>
                    <li class="nav-item nav-item-main-menu">
                        <a class="nav-link" href="#">Theo dõi</a>
                    </li>
                    <li class="nav-item nav-item-main-menu">
                        <a class="nav-link" href="#">Đọc Nhiều</a>
                    </li>
                    <li class="nav-item nav-item-main-menu">
                        <a class="nav-link" href="#">Yêu Thích</a>
                    </li>
                </ul>
                  </div> 
        </div>

        <!-- </section class="top-nav"> -->
    </section>

    <section class="main-menu ">
        <div class="container mx-auto">
            <nav class="navbar navbar-expand-md ">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-top">
                     <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Links -->
                <div class="collapse navbar-collapse" id="navbar-top">
                    <ul class="navbar-nav">
                        <li class="nav-item nav-item-main-menu">
                            <a class="nav-link" href="#">Trang chủ</a>
                        </li>
                        <li class="nav-item nav-item-main-menu  dropdown-main-menu">
                            <a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown">
                                Thể Loại
                            </a>
                            <div class="dropdown-menu ">
                                <a class="dropdown-item " href="#">Link 1</a>
                                <a class="dropdown-item " href="#">Link 2</a>
                                <a class="dropdown-item " href="#">Link 3</a>
                                <a class="dropdown-item " href="#">Link 1</a>
                                <a class="dropdown-item " href="#">Link 2</a>
                                <a class="dropdown-item " href="#">Link 3</a>
                            </div>
                        </li>
                        <li class="nav-item nav-item-main-menu dropdown-main-menu">
                            <a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown">
                                Sắp Xếp
                            </a>
                            <div class="dropdown-menu ">
                                <a class="dropdown-item" href="#">Link 4</a>
                                <a class="dropdown-item" href="#">Link 5</a>
                                <a class="dropdown-item" href="#">Link 6</a>
                            </div>
                        </li>
                        <li class="nav-item nav-item-main-menu">
                            <a class="nav-link" href="#">Mới Cập Nhật</a>
                        </li>
                        <li class="nav-item nav-item-main-menu dropdown-main-menu">
                            <a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown">
                                Trạng Thái
                            </a>
                            <div class="dropdown-menu ">
                                <a class="dropdown-item" href="#">Link 4</a>
                                <a class="dropdown-item" href="#">Link 5</a>
                                <a class="dropdown-item" href="#">Link 6</a>
                            </div>
                        </li>
                        <li class="nav-item nav-item-main-menu">
                            <a class="nav-link" href="#">Lịch Sử</a>
                        </li>
                        <li class="nav-item nav-item-main-menu">
                            <a class="nav-link" href="#">Theo dõi</a>
                        </li>
                        <li class="nav-item nav-item-main-menu">
                            <a class="nav-link" href="#">Đọc Nhiều</a>
                        </li>
                        <li class="nav-item nav-item-main-menu">
                            <a class="nav-link" href="#">Yêu Thích</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>