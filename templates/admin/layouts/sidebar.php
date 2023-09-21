 <?php
  $userId = isLogin()['user_id'];
  $userDetail = getUserInfo($userId);

?>
 
 
 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=dashboard&action=lists'; ?>" class="brand-link">
      <span class="brand-text font-weight-light text-uppercase">Radiax Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE; ?>/assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?php echo getLinkAdmin('users','profile') ?>" class="d-block"><?php echo $userDetail['fullname'];  ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo  _WEB_HOST_ROOT_ADMIN.'/?module=dashboard&action=lists'; ?>" class="nav-link  <?php echo (activeMenuSidebar('')) ? 'active':false;  ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Tổng quan
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview <?php echo activeMenuSidebar('course')?'menu-open':false; ?>">
            <a href="#" class="nav-link <?php echo activeMenuSidebar('course')?'active':false; ?>">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Quản lý khóa học
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('course', 'lists'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('course', 'add'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview <?php echo activeMenuSidebar('chapter')?'menu-open':false; ?>">
            <a href="#" class="nav-link <?php echo activeMenuSidebar('chapter')?'active':false; ?>">
              <i class="nav-icon fas fa-palette"></i>
              <p>
                Quản lý chương học
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('chapter', 'lists'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('chapter', 'add'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview <?php echo activeMenuSidebar('lesson')?'menu-open':false; ?>">
            <a href="#" class="nav-link <?php echo activeMenuSidebar('lesson')?'active':false; ?>">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Quản lý bài học
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('lesson', 'lists'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('lesson', 'add'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview <?php echo activeMenuSidebar('learn')?'menu-open':false; ?>">
            <a href="#" class="nav-link <?php echo activeMenuSidebar('learn')?'active':false; ?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Content khóa học
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('learn', 'lists'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('learn', 'add'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview <?php echo activeMenuSidebar('blog') ?'menu-open':false; ?>">
            <a href="#" class="nav-link  <?php echo activeMenuSidebar('blog')?'active':false; ?>">
              <i class="nav-icon fas fa-solid fa-blog"></i>
              <p>
                 Quản lý blog
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('blog', 'lists'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('blog', 'add'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item has-treeview <?php echo activeMenuSidebar('orderCourse') ?'menu-open':false; ?>">
            <a href="#" class="nav-link  <?php echo activeMenuSidebar('orderCourse')?'active':false; ?>">
              <i class="nav-icon fas fa-solid fa-cart-arrow-down"></i>
              <p>
                 Quản lý đơn hàng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('orderCourse', 'lists'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('orderCourse', 'add'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item has-treeview <?php echo activeMenuSidebar('groups')?'menu-open':false; ?>">
            <a href="#" class="nav-link <?php echo activeMenuSidebar('groups')?'active':false; ?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Nhóm người dùng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('groups', 'lists'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('groups', 'add'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
            </ul>
          </li>

          
          <li class="nav-item has-treeview <?php echo activeMenuSidebar('users')?'menu-open':false; ?>">
            <a href="#" class="nav-link  <?php echo activeMenuSidebar('users')?'active':false; ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                 Quản lý người dùng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('users', 'lists'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('users', 'add'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
            </ul>
          </li>


          <?php $getCountContacts = getRows("SELECT id FROM contacts WHERE status=0") ?>
          <li class="nav-item has-treeview <?php echo activeMenuSidebar('contatcs') ?'menu-open':false; ?>">
            <a href="#" class="nav-link  <?php echo activeMenuSidebar('contatcs')?'active':false; ?>">
              <i class="nav-icon fas fa-solid fa-blog"></i>
              <p>
                 Quản lý liên hệ
                <i class="right fas fa-angle-left"></i>
                <span class="badge badge-danger"><?php echo $getCountContacts; ?></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo getLinkAdmin('contacts', 'lists'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p>
                  
                  <span class="badge badge-danger"><?php echo $getCountContacts; ?></span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">