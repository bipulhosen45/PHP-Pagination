<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <title>Hello, world!</title>
</head>

<body>
    <?php
    include "db_connect.php";
    ?>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Users Table</h2>
            </div>
            <div class="card-body">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">S/N</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $limit = 10;
                        if(isset($_GET['page'])){
                            $page_number = $_GET['page'];
                        }else{
                            $page_number =1;
                        }
                        $start_page = ($page_number -1)* $limit;
                        $sql   = "SELECT * FROM users LIMIT $start_page,$limit ";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_object($result)) { ?>
                                <tr>
                                    <td><?php echo $row->id; ?></td>
                                    <td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
                                    <td><?php echo $row->email; ?></td>
                                    <td><?php echo $row->gender; ?></td>
                                    <td><?php echo $row->phone; ?></td>
                                    <td>
                                        <a href="">Edit</a>
                                    </td>
                                </tr>

                        <?php     }
                        }


                        ?>
                    </tbody>
                </table>
                <?php
                $sql   = "SELECT * FROM users ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $total_record = mysqli_num_rows($result);
                    $total_page = ceil($total_record / $limit);
                    echo '<nav aria-label="Page navigation example">
                       <ul class="pagination">';
                       if($page_number > 1){
                        echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page_number-1).'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                       }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if($page_number == $i){
                            $active = "active";
                        }else{
                            $active = '';
                        }
                        echo '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
                    }
                    if($total_page > $page_number){
                        echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page_number+1).'" aria-label="next"><span aria-hidden="true">&raquo;</span></a></li>';
                       }
                    echo '</ul>
                    </nav>';
                }
                ?>

                <!-- 

                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li> -->


            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="http://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // $('#myTable').DataTable();
        });
    </script>
</body>

</html>