<?php

if(!defined('_INCODE'))
die('Access denied...');


$data = [
    'pageTitle' => 'Danh sách bài học'
];

layout('header', 'admin', $data);
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

// Xử lý lọc dữ liệu
$filter = '';
if (isGet()) {
    $body = getBody();

    // Xử lý lọc theo từ khóa
    if(!empty($body['keyword'])) {
        $keyword = $body['keyword'];
        
        if(!empty($filter) && strpos($filter, 'WHERE') >= 0) {
            $operator = 'AND';
        }else {
            $operator = 'WHERE';
        }

        $filter .= " $operator lesson.name LIKE '%$keyword%'";

    }

   //Xử lý lọc theo groups
   if(!empty($body['course_id'])) {
    $courseId = $body['course_id'];

    if(!empty($filter) && strpos($filter, 'WHERE') >= 0) {
        $operator = 'AND';
    }else {
        $operator = 'WHERE';
    }

    $filter .= " $operator lesson.course_id = $courseId";

}

//Xử lý lọc theo groups
if(!empty($body['chapter_id'])) {
    $chapterId = $body['chapter_id'];

    if(!empty($filter) && strpos($filter, 'WHERE') >= 0) {
        $operator = 'AND';
    }else {
        $operator = 'WHERE';
    }

    $filter .= " $operator lesson.chapter_id = $chapterId";

}

}



/// Xử lý phân trang

$allUser = getRows("SELECT id FROM lesson $filter");
// 1. Xác định số lượng bản ghi trên 1 trang
$perPage = _PER_PAGE; // Mỗi trang có 3 bản ghi

//2. Tính số trang
$maxPage = ceil($allUser / $perPage);


// 3. Xử lý số trang dựa vào phương thức GET
if(!empty(getBody()['page'])) {
    $page = getBody()['page'];
    if($page < 1 and $page > $maxPage) {
        $page = 1;
    }
}else {
    $page = 1;
}


$offset = ($page - 1) * $perPage;
// Truy vấn lấy tất cả dữ liệu
$listAlllesson = getRaw(
    "SELECT lesson.id, lesson.name as les_name, video, lesson.create_at,
     title, chapter.name as chap_name 
     FROM lesson INNER JOIN course ON lesson.course_id = course.id 
     INNER JOIN chapter ON lesson.chapter_id = chapter.id
     $filter ORDER BY lesson.create_at ASC LIMIT $offset, $perPage");

// Truy vấn lấy ra danh sách khóa học
$allCourse = getRaw("SELECT id, title FROM course ORDER BY id");

// Truy vấn lấy ra danh sách chương học
$allChapter = getRaw("SELECT id, name FROM chapter ORDER BY id");

// Xử lý query string tìm kiếm với phân trang
$queryString = null;
if (!empty($_SERVER['QUERY_STRING'])) {
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = str_replace('module=lesson','', $queryString);
    $queryString = str_replace('&page='.$page, '', $queryString);
    $queryString = trim($queryString, '&');
    $queryString = '&'.$queryString;
}

$msg =getFlashData('msg');
$msgType = getFlashData('msg_type');

?>

<div class="container">

        <?php
            getMsg($msg, $msgType);
        ?>
       
    <p>
        <a href="<?php echo getLinkAdmin('lesson', 'add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Thêm bài học</a>
    </p>
    <hr/>
    <!-- Tìm kiếm , Lọc dưz liệu -->
    <form action="" method="get">
        <div class="row">
          
            <div class="col-3">
                <div class="form-group">
                    <select name="course_id" id="" class="form-control">
                    <option value="">Chọn khóa học</option>
                       <?php

                        if(!empty($allCourse)) {
                            foreach($allCourse as $item) {
                        ?>
                               <option value="<?php echo $item['id'] ?>" <?php  echo (!empty($courseId) && $courseId == $item['id'])?'selected':false; ?>><?php echo $item['title'] ?></option> 
                        
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
           </div>

           <div class="col-3">
                <div class="form-group">
                    <select name="chapter_id" id="" class="form-control">
                    <option value="">Chọn chương học</option>
                       <?php

                        if(!empty($allChapter)) {
                            foreach($allChapter as $item) {
                        ?>
                               <option value="<?php echo $item['id'] ?>" <?php  echo (!empty($chapterId) && $chapterId == $item['id'])?'selected':false; ?>><?php echo $item['name'] ?></option> 
                        
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
           </div>
           <div class="col-4">
                <input type="search" name="keyword" class="form-control" placeholder="Nhập từ khóa tìm kiếm..." value="<?php echo (!empty($keyword))? $keyword:false; ?>">
           </div>
           <div class="col">
            <button type="submit" class="btn btn-primary ">Tìm kiếm</button>
           </div>
        </div>
        <input type="hidden" name="module" value="lesson">
        <input type="hidden" name="action" value="lists">
    </form>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th wìdth="5%">ID</th>
                <th>Tên</th>
                <th>Video</th>
                <th>Khóa</th>
                <th>Chương</th>
                <th>Thời gian</th>
                <th wìdth="3%">Sửa</th>
                <th wìdth="3%">Xóa</th>
            </tr>
        </thead>
        <tbody>

            <?php
                if(!empty($listAlllesson)):
                    $count = 0; // Hiển thi số thứ tự
                    foreach($listAlllesson as $item):
                        $count ++;

            ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><a href="<?php echo getLinkAdmin('lesson','edit',['id' => $item['id']]); ?>"><?php echo $item['les_name']; ?></a></td>
                <td><?php echo $item['video']; ?></td>
                <td><?php echo $item['title'] ?></td>
                <td><?php echo $item['chap_name'] ?></td>
                <td><?php echo (!empty($item['create_at']))?getDateFormat($item['create_at'], 'd/m/Y H:i:s') : false; ?></td>
                <td class="text-center"><a href="<?php echo getLinkAdmin('lesson','edit',['id' => $item['id']]); ?>" class="btn btn-warning btn-sm" ><i class="fa fa-edit"></i> Sửa</a></td>
                <td class="text-center"><a href="<?php echo getLinkAdmin('lesson','delete',['id' => $item['id']]); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không ?')"><i class="fa fa-trash"></i> Xóa</a></td>

            <?php endforeach; else: ?>
                <tr>
                    <td colspan="8">
                        <div class="alert alert-danger text-center">Không tìm thấy bài học</div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
        <ul class="pagination pagination-sm">
            <?php
                if($page > 1) {
                    $prePage = $page - 1;
                    
                   echo '<li class="page-item"><a class="page-link" href="'._WEB_HOST_ROOT_ADMIN.'/?module=lesson'.$queryString. '&page='.$prePage.'">Pre</a></li>';
                }
            ?>


            <?php 
                // Giới hạn số trang
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
                <a class="page-link" href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=lesson'.$queryString.'&page='.$index;  ?>"> <?php echo $index;?> </a>
            </li>
            <?php  } ?>
            
            <?php
                if($page < $maxPage) {
                    $nextPage = $page + 1;
                    echo '<li class="page-item"><a class="page-link" href="'._WEB_HOST_ROOT_ADMIN.'?module=lesson'.$queryString.'&page='.$nextPage.'">Next</a></li>';
                }
            ?>
        </ul>
    </nav>

</div>

<?php
layout('footer', 'admin');