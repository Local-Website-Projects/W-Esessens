<!--**********************************
            Nav header start
        ***********************************-->
<div class="nav-header">
    <a href="Dashboard" class="brand-logo">
        <div class="header-left">
            <div class="dashboard_bar">
                <img src="../assets/images/logo/2.png" alt="logo" style="width: 200px;">
            </div>
        </div>
    </a>

    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>
<!--**********************************
    Nav header end
***********************************-->


<!--**********************************
            Header start
        ***********************************-->
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        <?php
                        $url=$_SERVER["REQUEST_URI"];
                        $str = substr($url, strrpos($url, '/') + 1);
                        $string = str_replace("-", " ", $str);
                        $newString = strstr($string, '?', true);
                        if($newString === false){
                            $newString = $string;
                        }
                        echo $newString;
                        ?>
                        <span>Welcome to Admin!</span>
                    </div>
                </div>
                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                            <?php
                            $admin = $_SESSION['userid'];
                            $fetch_admin = $db_handle->runQuery("select * from admin_login where id = '$admin'");
                            ?>
                            <img src="<?php echo $fetch_admin[0]['image'];?>" width="20" alt=""/>
                            <div class="header-info">
                                <span class="text-black"><strong><?php echo $fetch_admin[0]['name'];?></strong></span>
                                <p class="fs-12 mb-0">Admin</p>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="Profile" class="dropdown-item ai-icon">
                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="ml-2">Profile </span>
                            </a>
                            <a href="Logout" class="dropdown-item ai-icon">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                <span class="ml-2">Logout </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!--**********************************
    Header end ti-comment-alt
***********************************-->
