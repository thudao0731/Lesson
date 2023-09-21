<?php
$data = [
    'pageTitle' => 'Danh sách Blog'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

// Xử lý lọc dữ liệu theo tên nhóm người dùng
$filter = '';

if(isGet()) {
    $body = getBody();

    //Xử lý lọc Status
    if(!empty($body['status'])) {
        $status = $body['status'];

        if($status == 2) {
            $statusSql = 0;
        } else {
            $statusSql = $status;
        }

        if(!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        }else {
            $operator = 'WHERE';
        }
        
        $filter .= "$operator blog.status=$statusSql";
    }

    if(!empty($body['keyword'])) {
        $keyword = $body['keyword'];
        
        if(!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        }else {
            $operator = 'WHERE';
        }

        $filter .= " $operator title LIKE '%$keyword%'";

    }
}

/// Xử lý phân blog

$allUser = getRows("SELECT id FROM blog $filter");
// 1. Xác định số lượng bản ghi trên 1 blog
$perPage = _PER_PAGE; // Mỗi blog có 3 bản ghi

//2. Tính số blog
$maxPage = ceil($allUser / $perPage); // Làm tròn lên


// 3. Xử lý số blog dựa vào phương thức GET
if(!empty(getBody()['page'])) {
    $page = getBody()['page'];
    if($page < 1 || $page > $maxPage) {
        $page = 1;
    }
}else {
    $page = 1;
}

$offset = ($page - 1) * $perPage;

// Lấy dứ liệu blog
$listblog = getRaw("SELECT blog.id, title, blog.thumbnail, blog.create_at, fullname, blog.status FROM blog INNER JOIN users ON blog.user_id = users.id
$filter ORDER BY blog.create_at DESC LIMIT $offset, $perPage");


// Xử lý query string tìm kiếm với phân blog
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=blog','', $queryString);
    $queryString = str_replace('&page='.$page, '', $queryString);
    $queryString = trim($queryString, '&');
    $queryString = '&'.$queryString;
}


$msg =getFlashData('msg');
$msgType = getFlashData('msg_type');
/////////////////////////////////////////////////////////////////////
?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
                 
            <a href="<?php echo getLinkAdmin('blog','add') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Thêm blog</a>
            <hr/>
            <form action="" method="get">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <select name="status" id="" class="form-control">
                                <option value="0">Chọn trạng thái</option>
                                <option value="1" <?php echo (!empty($status) && $status==1) ? 'selected':false; ?>>Đã duyệt</option>
                                <option value="2" <?php echo (!empty($status) && $status==2) ? 'selected':false; ?>>Chưa duyệt</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <input type="search" name="keyword" id="" class="form-control" placeholder="Nhập tên blog cần tìm..." value="<?php echo (!empty($keyword))?$keyword:false; ?>">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
                <input type="hidden" name="module" value="blog">
                <input type="hidden" name="action" value="lists">
            </form>
            <hr />
            <?php
                    getMsg($msg, $msgType);
                ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width=5%>STT</th>
                        <th width=10%>Ảnh</th>
                        <th width=20%>Tiêu đề</th>
                        <th width=10%>Thời gian</th>
                        <th width=10%>Người đăng</th>
                        <th width=8%>Trạng thái</th>
                        <th width=5%>Sửa</th>
                        <th width=5%>Xóa</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        if (!empty($listblog)) :
                            $count = 0;
                            foreach ($listblog as $item):
                                $count++;
                    ?>

                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo (isFontIcon($item['thumbnail']))?$item['thumbnail']:'<img src="'.$item['thumbnail'].'" width=80 height=80/>' ?></td>
                        <td>
                            <a href=""><?php echo $item['title']; ?></a>
                        </td>
                        <td><?php echo getDateFormat($item['create_at'],'d/m/Y  H:i:s'); ?></td>
                        <td><a href=""><?php echo $item['fullname'] ?></a></td>
                        <td><?php echo $item['status']==1?'<button type="button" class="btn btn-success btn-sm">Đã duyệt</button>':'<button type="button" class="btn btn-info btn-sm">Chưa duyệt</button>'; ?></td>
                        <td class="text-center"><a href="<?php echo getLinkAdmin('blog','edit',['id' => $item['id']]); ?>" class="btn btn-warning btn-sm" ><i class="fa fa-edit"></i> Sửa</a></td>
                        <td class="text-center"><a href="<?php echo getLinkAdmin('blog','delete',['id' => $item['id']]); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')"><i class="fa fa-trash"></i> Xóa</a></td>
                    </tr>
                    
                    <?php endforeach; else: ?>
                            <tr>
                                <td colspan="8">
                                    <div class="alert alert-danger text-center">Không có blog</div>
                                </td>
                            </tr>
                    <?php endif; ?>
                </tbody>
            </table>


                <!-- Xử lý số blog -->
            <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                <ul class="pagination pagination-sm">
                    <?php
                        if($page > 1) {
                            $prePage = $page - 1;
                            echo '<li class="page-item"><a class="page-link" href="'._WEB_HOST_ROOT_ADMIN.'/?module=blog'.$queryString. '&page='.$prePage.'">Pre</a></li>';
                        }
                    ?>


                    <?php 
                        // Giới hạn số blog
                        $begin = $page - 2;
                        $end = $page + 2;
                        if($begin < 1) {
                            $begin = 1;
                        }
                        if($end > $maxPage) {
                            $end = $maxPage;
                        }
                        for($index = $begin; $index <= $end; $index++){  ?>
                    <li class="page-item <?php echo ($index == $page) ? 'active' : false; ?> ">
                        <a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN.'/?module=blog'.$queryString. '&page='.$index;  ?>"> <?php echo $index;?> </a>
                    </li>
                    <?php  } ?>
                    
                    <?php
                        if($page < $maxPage) {
                            $nextPage = $page + 1;
                            echo '<li class="page-item"><a class="page-link" href="'._WEB_HOST_ROOT_ADMIN.'/?module=blog'.$queryString.'&page='.$nextPage.'">Next</a></li>';
                        }
                    ?>
                </ul>
            </nav>
            <!-- ////////////////////////////////////////////////// -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<?php
layout('footer', 'admin');