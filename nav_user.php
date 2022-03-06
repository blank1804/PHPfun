<nav class="navbar navbar-expand-lg  sticky-top" id="mainNav" style="background-color: #0e0a18;">
    <div class="container-fluid">
        <a class="navbar-brand" href="main_user.php"">ระบบลงทะเบียนศิษย์เก่า</a>
                <button class=" navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="main_user.php">จัดการข่าวสาร</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="user_info.php">ข้อมูลส่วนตัว</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="btn btn-danger px-0 px-lg-3 btnlogout" data-bs-toggle="modal" data-bs-target="#exampleModal">Logout</a></li>
                </ul>
            </div>
    </div>
</nav>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Log OUT!!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                IS THIS A GOOD BYE?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                <a href="logout.php" class="btn btn-primary btn-block">YES&#x1F622;</a>
            </div>
        </div>
    </div>
</div>