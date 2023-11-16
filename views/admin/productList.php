<!-- Sidebar -->
<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/header.php");
include("$_SERVER[DOCUMENT_ROOT]/GTST/model/admin/managementProduct/productManagement.php");

$products = new productManagement();

if (isset($_GET['DelID'])) {
    $productID = $_GET['DelID'];
    $delProduct = $products->delProduct($productID);
}

?>
<!-- End of Sidebar -->

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List products</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- <div>
            <h6>Total <strong>#</strong> products</h6>
        </div> -->
        <?php if (isset($delProduct)) {
            echo $delProduct;
        } ?>
        <div style="position: absolute;  right: 100px; top: 100px; ">
            <a class="btn btn-danger" href="productAdd.php"><i class="fas fa-plus"></i> Add Product</a>
        </div>
        <?php

        // Get all user in DB and pagination
        $count = 0;

        $productsList = $products->countProducts();
        $rows = mysqli_fetch_assoc($productsList);

        $totalRows = $rows['total'];

        $currentPage = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
        $limit = 7;

        $sizePage = 2;
        $totalPage = ceil($totalRows / $limit);

        if ($currentPage > $totalPage) {
            $currentPage = $totalPage;
        } else if ($currentPage < 1) {
            $currentPage = 1;
        }
        $start = ($currentPage - 1) * $limit;
        ?>

        <?php
        if ($totalRows == 0) { ?>
            <table class="table">
                <thead style="text-align: center;">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Type</th>
                        <!-- <th scope="col">New product</th>
                        <th scope="col">Highlight product</th> -->
                        <th scope="col">Update at</th>
                        <th scope="col">Activity</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    <tr>
                        <span class='text-danger'>List Empty!</span>
                    </tr>
                </tbody>
            </table>
        <?php } else {
        ?>
            <table class="table ">
                <thead style="text-align: center;">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Type</th>
                        <!-- <th scope="col">New product</th>
                        <th scope="col">Highlight product</th> -->
                        <th scope="col">Update at</th>
                        <th scope="col">Activity</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    <?php
                    $productsList = $products->startEnd($start, $limit);
                    if ($productsList) {
                        $i = 0;
                        while ($row = $productsList->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td><img src="../../assets/img/product/<?php echo $row['image']; ?>" width="50px" height="auto"></td>
                                <td><?php echo $row['nameProduct']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['unit']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['nameProductType']; ?></td>
                                <!-- <?php if ($row['newProduct'] == 1) { ?>
                                    <td><input type="checkbox" checked disabled></td>
                                <?php } else { ?>
                                    <td><input type="checkbox" disabled></td>
                                <?php } ?>
                                <?php if ($row['highlightProduct'] == 1) { ?>
                                    <td><input type="checkbox" checked disabled></td>
                                <?php } else { ?>
                                    <td><input type="checkbox" disabled></td>
                                <?php } ?> -->
                                <td><?php echo $row['updateAtProduct']; ?></td>
                                <td><a class="btn btn-info" title="Details" href="productEdit.php?productID=<?php echo $row['idProduct']; ?>"><i class="fas fa-eye"></i></a> |
                                    <a onclick="return confirm('Are you want to Delete this Product?')" class="btn btn-danger" title="Delete" href="?DelID=<?php echo $row['idProduct']; ?>"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                    <?php
                        }
                    }

                    ?>
                </tbody>
            </table>
        <?php }
        ?>
        <div>
            <a class="btn btn-success" href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i class="fas fa-caret-left"></i> Back</a>
        </div>
        <hr>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <?php if ($currentPage > 1 && $totalPage > 1) { ?>
                        <a class="page-link" href="userList.php?currentPage=<?php echo $currentPage - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <?php
                    }

                    for ($i = 1; $i <= $totalPage; $i++) {
                        if ($i == $currentPage) { ?>
                <li class="page-item"><a class="page-link" href="#"><?php echo $i; ?></a></li>
            <?php  } else { ?>

                <li class="page-item"><a class="page-link" href="userList.php?currentPage=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php   }
                    }
                    if ($currentPage != $totalRows) { ?>
            <li class="page-item">
                <a class="page-link" href="userList.php?currentPage=<?php echo $currentPage + 1; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        <?php  }
        ?>
        </li>
            </ul>
        </nav>

    </div>
    <!-- /.container-fluid -->

</div>


<?php
include("$_SERVER[DOCUMENT_ROOT]/GTST/views/layouts/admin/footer.php");
?>