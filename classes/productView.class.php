<?php

class ProductView extends Products
{
    // -----------------------------------------------------------------> SHOW ALL PRODUCTS
    public function showAllProducts()
    {
        // set page content limit
        $cont_limit = 5;
        // check the value of page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        // return page value to 1
        if ($page == null) {
            $page = 1;
        } elseif ($page == 0) {
            $page = 1;
        }

        // compute the database limit
        $start_from = ($page - 1) * $cont_limit;

        // get limit data from database
        $result = $this->getAllProducts($start_from, $cont_limit);
        // get number of available products from database
        $avail_prod = $this->getAvailProducts();
        // get total page show
        $total_page = ceil($avail_prod / $cont_limit);

        foreach ($result as $products) {
    ?>
<div class="container">
    <table class="table shoping-cart-table">
        <tbody>
            <tr>
                <td width="90">
                    <img src="<?php echo $products['images']; ?>" style="width: 160px; height: 150px;">
                </td>
                <td class="desc" id="product-desc">
                    <h3 id="product-title">
                        <a href="./items.php?product_id=<?php echo $products['product_id']; ?>">
                            <?php echo ucwords($products['product_title']); ?>
                        </a>
                    </h3>
                    <p class="small">
                        <?php echo $products['description']; ?>
                    </p>
                    <dl class="small m-b-none">
                        <dt>Description lists</dt>
                        <dd><?php echo "Price per: " . $products['kilo_pcs_pack']; ?></dd>
                        <dd><b>Expiry Date: </b><?php echo $products['expiry_date']; ?></dd>
                    </dl>
                    <?php 
                        if($products['stock_number'] <= 0) {
                        ?> 
                            <p class="text-danger lead" style="font-size: 15px;">We sincerely apologize for this inconvenience. We've experienced an unusually high number of orders and have run out of inventory.</p>
                        <?php
                        } elseif($products['stock_number'] < 20) {
                        ?> 
                            <p class="text-danger lead" style="font-size: 15px;">Less than or equal 20 stocks are available.</p>
                        <?php
                        }
                    ?>
                </td>
                <td>
                    <h4 id="product-price" id="product-price">
                        <?php echo "₱" . $products['price']; ?>
                    </h4>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php
        } ?>
<br>
<!-- Pagination -->
<div class="container-fluid row">
    <div class="col-sm-12">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <?php
                        // if condition for prev button
                        if ($page >= 2) {
                        ?>
                <li class="page-item">
                    <a class="page-link" href="products.php?All_Products&page=<?php echo $page - 1; ?>">Previous</a>
                </li>
                <?php
                        } else {
                        ?>
                <li class="page-item disabled">
                    <a class="page-link" href="#">Previous</a>
                </li>
                <?php
                        }
                        // loop for num pages
                        for ($i = 1; $i <= $total_page; $i++) {
                        ?>
                <li class="page-item">
                    <a class="page-link" href="products.php?All_Products&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php
                        }
                        // if condition for next button
                        if ($page == $total_page) {
                        ?>
                <li class="page-item disabled">
                    <a class="page-link" href="#">Next</a>
                </li>
                <?php
                        } else {
                        ?>
                <li class="page-item">
                    <a class="page-link" href="products.php?All_Products&page=<?php echo $page + 1; ?>">Next</a>
                </li>
                <?php
                        }
                        ?>
            </ul>
        </nav>
    </div>
</div> <!-- / .row -->
<?php
    }

    // -----------------------------------------------------------------> SHOW CATEGORIES
    public function showCustomCategory($category)
    {
        // set page content limit
        $cont_limit = 5;
        // check the value of page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        // return page value to 1
        if ($page == null) {
            $page = 1;
        } elseif ($page == 0) {
            $page = 1;
        }

        // compute the database limit
        $start_from = ($page - 1) * $cont_limit;

        // get limit data from database
        $result = $this->getSpecificCategory($start_from, $cont_limit, $category);
        // get number of available products from database
        $avail_prod = $this->getAvailSpecificCategory($category);
        // get total page show
        $total_page = ceil($avail_prod / $cont_limit);

        // Image Cover - category condition
        if ($category == "canned products") {
            $image = "//st.depositphotos.com/2075661/4508/i/950/depositphotos_45081567-stock-photo-canned-food.jpg";
            $txt = "CANNED PRODUCTS";
        } elseif ($category == "breads and spreads") {
            $image = "//media.gettyimages.com/photos/chocolate-and-hazelnut-spread-on-bread-slices-shot-on-rustic-wooden-picture-id815870712?k=20&m=815870712&s=612x612&w=0&h=odkZP9qPOBFNtnRN_Z38lrvQ4BFxoMLLTI_G599G65A=";
            $txt = "BREADS AND SPREADS";
        } elseif ($category == "snacks and chips") {
            $image = "//media.istockphoto.com/photos/salty-snacks-picture-id478815753?k=20&m=478815753&s=612x612&w=0&h=fBpfqyP-4ddG9tGyDVLmm4614zKfxxbeKioJqwP1qAY=";
            $txt = "SNACKS AND CHIPS";
        } elseif ($category == "packed noodles") {
            $image = "//media.istockphoto.com/photos/various-products-from-asian-grocery-picture-id1276555001?k=20&m=1276555001&s=612x612&w=0&h=TXNVvs0z7smjgQWi4mferkQOoLvZICL0x26kFEdc2mU=";
            $txt = "PACKED NOODLES";
        } elseif ($category == "meats and poultry") {
            $image = "//cdn.shopify.com/s/files/1/0264/3420/7802/collections/AdobeStock_175165460_900x.jpg?";
            $txt = "MEATS AND POULTRY";
        } elseif ($category == "fresh fruits and veggies") {
            $image = "//cdn.shopify.com/s/files/1/0264/3420/7802/collections/vegetables_540x.jpg?v=1591006873";
            $txt = "FRUITS AND VEGGIES";
        }

    ?>
<!-- image cover -->
<div class="container-fluid">
    <div class="row row-cols-12 row-cols-sm-12 row-cols-md-12 row-cols-lg-12 row-cols-xl-12">
        <div class="col mb-4">
            <div class="card">
                <img src="<?php echo $image; ?>" class="card-img-top" id="card">
                <div class="centered h3 text-light"><?php echo $txt; ?></div>
            </div>
        </div>
    </div>
    <?php

            foreach ($result as $products) {
            ?>
    <div class="container">
        <table class="table shoping-cart-table">
            <tbody>
            <tr>
                <td width="90">
                    <img src="<?php echo $products['images']; ?>" style="width: 160px; height: 150px;">
                </td>
                <td class="desc" id="product-desc">
                    <h3 id="product-title">
                        <a href="./items.php?product_id=<?php echo $products['product_id']; ?>">
                            <?php echo ucwords($products['product_title']); ?>
                        </a>
                    </h3>
                    <p class="small">
                        <?php echo $products['description']; ?>
                    </p>
                    <dl class="small m-b-none">
                        <dt>Description lists</dt>
                        <dd><?php echo "Price per: " . $products['kilo_pcs_pack']; ?></dd>
                        <dd><b>Expiry Date: </b><?php echo $products['expiry_date']; ?></dd>
                    </dl>
                    <?php 
                        if($products['stock_number'] <= 0) {
                        ?> 
                            <p class="text-danger lead" style="font-size: 15px;">We sincerely apologize for this inconvenience. We've experienced an unusually high number of orders and have run out of inventory.</p>
                        <?php
                        } elseif($products['stock_number'] < 20) {
                        ?> 
                            <p class="text-danger lead" style="font-size: 15px;">Less than or equal 20 stocks are available.</p>
                        <?php
                        }
                    ?>
                </td>
                <td>
                    <h4 id="product-price" id="product-price">
                        <?php echo "₱" . $products['price']; ?>
                    </h4>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php
            } ?>
    <br>
    <!-- Pagination -->
    <div class="container-fluid row">
        <div class="col-sm-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <?php
                            // if condition for prev button
                            if ($page >= 2) {
                            ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="products.php?category=<?php echo $category; ?>&page=<?php echo $page - 1; ?>">Previous</a>
                    </li>
                    <?php
                            } else {
                            ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Previous</a>
                    </li>
                    <?php
                            }
                            // loop for num pages
                            for ($i = 1; $i <= $total_page; $i++) {
                            ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="products.php?category=<?php echo $category; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                    <?php
                            }
                            // if condition for next button
                            if ($page == $total_page) {
                            ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Next</a>
                    </li>
                    <?php
                            } else {
                            ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="products.php?category=<?php echo $category; ?>&page=<?php echo $page + 1; ?>">Next</a>
                    </li>
                    <?php
                            }
                            ?>
                </ul>
            </nav>
        </div>
    </div> <!-- / .row -->
    <?php
        }
        
        // -----------------------------------------------------------------> SHOW SEARCHED PRODUCTS
        public function showSearchedProduct()
        {
            // set page content limit
            $cont_limit = 5;
            // check the value of page
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            // return page value to 1
            if ($page == null) {
                $page = 1;
            } elseif ($page == 0) {
                $page = 1;
            }

            // compute the database limit
            $start_from = ($page - 1) * $cont_limit;

            // get limit data from database
            $result = $this->getSearchedProduct($start_from, $cont_limit);
            // get number of available products from database
            $avail_prod = $this->getAvailSearchedProduct();
            // get total page show
            $total_page = ceil($avail_prod / $cont_limit);

            if ($avail_prod == 0) {
            ?>
    <center>
        <h2 style="color: #31352E;">NO MATCHING ITEMS</h2><br>
        <h3 style="color: #31352E;">Your search for "<b
                style="color: #778A35;"><?php echo "" . ucwords($_GET['search']) . ""; ?></b>" did not match any
            results.</h3>
        <h5 style="color: #31352E;">Please check the spelling or try again with a less specific term.</h5>
    </center>

    <br><br><br>
    <div class="container mt-5">
        <h4 style="color: #31352E;"><?php echo "Recommendations: "; ?></h4>
    </div>

    <hr>
    <?php
                // view all products
                $this->showAllProducts();
                ?>
    <?php
            } else {
            ?>
    <center>
        <h2 style="color: #31352E;">MATCHED RESULTS FOUND : "<b
                style="color: #778A35;"><?php echo "" . $avail_prod . ""; ?></b>" results</h2><br>
        <h3 style="color: #31352E;">Showing search results for "<b
                style="color: #778A35;"><?php echo "" . ucwords($_GET['search']) . "" ?></b>"</h3>
        <br>
        <hr>
    </center>
    <?php

                foreach ($result as $products) {
                ?>
    <div class="container">
        <div class="table-responsive">
            <table class="table shoping-cart-table">
                <tbody>
                <tr>
                <td width="90">
                    <img src="<?php echo $products['images']; ?>" style="width: 160px; height: 150px;">
                </td>
                <td class="desc" id="product-desc">
                    <h3 id="product-title">
                        <a href="./items.php?product_id=<?php echo $products['product_id']; ?>">
                            <?php echo ucwords($products['product_title']); ?>
                        </a>
                    </h3>
                    <p class="small">
                        <?php echo $products['description']; ?>
                    </p>
                    <dl class="small m-b-none">
                        <dt>Description lists</dt>
                        <dd><?php echo "Price per: " . $products['kilo_pcs_pack']; ?></dd>
                        <dd><b>Expiry Date: </b><?php echo $products['expiry_date']; ?></dd>
                    </dl>
                    <?php 
                        if($products['stock_number'] <= 0) {
                        ?> 
                            <p class="text-danger lead" style="font-size: 15px;">We sincerely apologize for this inconvenience. We've experienced an unusually high number of orders and have run out of inventory.</p>
                        <?php
                        } elseif($products['stock_number'] < 20) {
                        ?> 
                            <p class="text-danger lead" style="font-size: 15px;">Less than or equal 20 stocks available.</p>
                        <?php
                        }
                    ?>
                </td>
                <td>
                    <h4 id="product-price" id="product-price">
                        <?php echo "₱" . $products['price']; ?>
                    </h4>
                </td>
            </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php
                } ?>
    <br>
    <!-- Pagination -->
    <div class="container-fluid row">
        <div class="col-sm-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <?php
                                // if condition for prev button
                                if ($page >= 2) {
                                ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="products.php?search=<?php echo $_GET['search']; ?>&page=<?php echo $page - 1; ?>">Previous</a>
                    </li>
                    <?php
                                } else {
                                ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Previous</a>
                    </li>
                    <?php
                                }
                                // loop for num pages
                                for ($i = 1; $i <= $total_page; $i++) {
                                ?>
                    <li class="page-item" id="page">
                        <a class="page-link"
                            href="products.php?search=<?php echo $_GET['search']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                    <?php
                                }
                                // if condition for next button
                                if ($page == $total_page) {
                                ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Next</a>
                    </li>
                    <?php
                                } else {
                                ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="products.php?search=<?php echo $_GET['search']; ?>&page=<?php echo $page + 1; ?>">Next</a>
                    </li>
                    <?php
                                }
                                ?>
                </ul>
            </nav>
        </div>
    </div> <!-- / .row -->
    <?php
            }
        }
    
    // ####################################################################################################
    // Admin Side (Show products)

    public function AdminShowProducts() {
        // set page content limit
        $cont_limit = 5;
        // check the value of page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        // return page value to 1
        if ($page == null) {
            $page = 1;
        } elseif ($page == 0) {
            $page = 1;
        }

        // compute the database limit
        $start_from = ($page - 1) * $cont_limit;

        // get number of available products from database
        $avail_prod = $this->getAvailProducts();
        // get limit data from database
        $result = $this->getAllProducts($start_from, $cont_limit);
        
        if($avail_prod == 0) {
            ?>
    <tr>
        <td colspan="8">
            <center>
                <h2 style="color: #31352E;">NO ITEMS</h2>
            </center>
        </td>
    </tr>
    <?php
        } else {
            foreach($result as $products) {
                ?>
    <tr>
        <td><?php echo $products['product_id']; ?></td>
        <td><?php echo ucwords($products['product_title']); ?></td>
        <td><?php echo $products['stock_number']; ?></td>
        <td><?php echo $products['expiry_date']; ?></td>
        <td><?php echo "₱ " . $products['price']; ?></td>
        <td><?php echo ucwords($products['category']); ?></td>
        <td><?php echo $products['description']; ?></td>
        <td>
            <button id="<?php echo $products['product_id']; ?>" type="button" class="btn btn-warning button-edit">
                <i class="bi bi-pencil-fill" style="font-size: 15px; color: black;"></i>
            </button>
            <button id="<?php echo $products['product_id']; ?>" type="button" class="btn btn-danger mt-2 button-delete">
                <i class="bi bi-trash" style="font-size: 15px;"></i>
            </button>
        </td>
    </tr>
    <?php
            }
        }
    }

    public function AllProductPagination() {
        // set page content limit
        $cont_limit = 5;
        // check the value of page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        // return page value to 1
        if ($page == null) {
            $page = 1;
        } elseif ($page == 0) {
            $page = 1;
        }

        // get number of available products from database
        $avail_prod = $this->getAvailProducts();
        // get total page show
        $total_page = ceil($avail_prod / $cont_limit);

        ?>
    <div class="hint-text">Showing <b>5</b> out of <b><?php echo $avail_prod; ?></b> entries</div>
    <!-- Pagination -->
    <ul class="pagination justify-content-end">
        <?php
            // if condition for prev button
            if ($page >= 2) {
            ?>
        <li class="page-item">
            <a class="page-link" href="home.php?page=<?php echo $page - 1; ?>">Previous</a>
        </li>
        <?php
            } else {
            ?>
        <li class="page-item disabled">
            <a class="page-link" href="#">Previous</a>
        </li>
        <?php
            }
            // loop for num pages
            for ($i = 1; $i <= $total_page; $i++) {
            ?>
        <li class="page-item">
            <a class="page-link" href="home.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
        <?php
            }
            // if condition for next button
            if ($page == $total_page) {
            ?>
        <li class="page-item disabled">
            <a class="page-link" href="#">Next</a>
        </li>
        <?php
            } else {
            ?>
        <li class="page-item">
            <a class="page-link" href="home.php?page=<?php echo $page + 1; ?>">Next</a>
        </li>
        <?php
            }
            ?>
    </ul>
    <?php
    }

    public function AdminSearched() {
        // set page content limit
        $cont_limit = 5;
        // check the value of page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        // return page value to 1
        if ($page == null) {
            $page = 1;
        } elseif ($page == 0) {
            $page = 1;
        }

        // compute the database limit
        $start_from = ($page - 1) * $cont_limit;

        // get limit data from database
        $result = $this->getSearchedProduct($start_from, $cont_limit);
        // get number of available products from database
        $avail_prod = $this->getAvailSearchedProduct();

        if ($avail_prod == 0) {
        ?>
    <tr>
        <td colspan="8">
            <center>
                <h2 style="color: #31352E;">NO MATCHING ITEMS</h2>
            </center>
        </td>
    </tr>
    <?php
            } else {
                foreach($result as $searched) {
                ?>
    <tr>
        <td><?php echo $searched['product_id']; ?></td>
        <td><?php echo ucwords($searched['product_title']); ?></td>
        <td><?php echo $searched['stock_number']; ?></td>
        <td><?php echo $searched['expiry_date']; ?></td>
        <td><?php echo "₱ " . $searched['price']; ?></td>
        <td><?php echo ucwords($searched['category']); ?></td>
        <td><?php echo $searched['description']; ?></td>
        <td>
            <button id="<?php echo $searched['product_id']; ?>" type="button" class="btn btn-warning button-edit">
                <i class="bi bi-pencil-fill" style="font-size: 15px; color: black;"></i>
            </button>
            <button type="button" id="<?php echo $searched['product_id']; ?>" class="btn btn-danger mt-2 button-delete">
                <i class="bi bi-trash" style="font-size: 15px;"></i>
            </button>
        </td>
    </tr>
    <?php
                }
            }
    }

    public function PaginationSearched() {
        // set page content limit
        $cont_limit = 5;
        // check the value of page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        // return page value to 1
        if ($page == null) {
            $page = 1;
        } elseif ($page == 0) {
            $page = 1;
        }

        // get number of available products from database
        $avail_prod = $this->getAvailSearchedProduct();
        // get total page show
        $total_page = ceil($avail_prod / $cont_limit);

        ?>
    <!-- Pagination -->
    <div class="hint-text">Showing <b>5</b> out of <b><?php echo $avail_prod; ?></b> entries</div>
    <ul class="pagination justify-content-end">
        <?php
            // if condition for prev button
            if ($page >= 2) {
                ?>
        <li class="page-item">
            <a class="page-link"
                href="home.php?search=<?php echo $_GET['search']; ?>&page=<?php echo $page - 1; ?>">Previous
            </a>
        </li>
        <?php
            } else {
                ?>
        <li class="page-item disabled">
            <a class="page-link" href="#">Previous</a>
        </li>
        <?php
            }
            // loop for num pages
            for ($i = 1; $i <= $total_page; $i++) {
            ?>
        <li class="page-item" id="page">
            <a class="page-link"
                href="home.php?search=<?php echo $_GET['search']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?>
            </a>
        </li>
        <?php
            }
            // if condition for next button
            if ($page == $total_page) {
                ?>
        <li class="page-item disabled">
            <a class="page-link" href="#">Next</a>
        </li>
        <?php
            } else {
                ?>
        <li class="page-item">
            <a class="page-link"
                href="home.php?search=<?php echo $_GET['search']; ?>&page=<?php echo $page + 1; ?>">Next
            </a>
        </li>
        <?php
            }
            ?>
    </ul>
    <?php
    }

    // For edit products
    public function getProducts($product_id) {
        $products = $this->getAllProductsByID($product_id);

        return json_encode($products);
    }

    // ##########################################################################
    // Manage Delivery - show all
    public function AdminManageDelivery() {
        // set page content limit
        $cont_limit = 5;
        // check the value of page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        // return page value to 1
        if ($page == null) {
            $page = 1;
        } elseif ($page == 0) {
            $page = 1;
        }

        // compute the database limit
        $start_from = ($page - 1) * $cont_limit;

        // get available deliveries
        $count_orders = $this->getAvailDelivery();
        // get limit data from database
        $result = $this->getDelivery($start_from, $cont_limit);
        
        if($count_orders == 0) {
        ?>
    <tr>
        <td colspan="10">
            <center>
                <h2 style="color: #31352E;">NO ORDERS LISTED</h2>
            </center>
        </td>
    </tr>
    <?php
        } else {
            foreach($result as $delivery) {
                ?>
    <tr>
        <td><?php echo $delivery['delivery_id']; ?></td>
        <td><?php echo $delivery['cart_number']; ?></td>
        <td><?php echo $delivery['username']; ?></td>
        <td><?php echo $delivery['postal']; ?></td>
        <td><?php echo "₱ " . $delivery['sub_total']; ?></td>
        <td><?php echo "₱ " . $delivery['delivery_fee']; ?></td>
        <td><?php echo "₱ " . $delivery['total_price']; ?></td>
        <td><?php echo $delivery['order_date']; ?></td>
        <td><?php echo $delivery['delivery_status']; ?></td>
        <td>
            <button id="<?php echo $delivery['delivery_id']; ?>" type="button" class="btn btn-warning button-edit">
                <i class="bi bi-pencil-fill" style="font-size: 15px; color: black;"></i>
            </button>
            <button id="<?php echo $delivery['delivery_id']; ?>" type="button" class="btn btn-success mt-2 button-view">
                <i class="bi bi-binoculars" style="font-size: 15px;"></i>
            </button>
        </td>
    </tr>
    <?php
            }
        }
    }

    // Manage Delivery - pagination
    public function ManageDeliveryPagination() {
        // set page content limit
        $cont_limit = 5;
        // check the value of page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        // return page value to 1
        if ($page == null) {
            $page = 1;
        } elseif ($page == 0) {
            $page = 1;
        }

        // get number of available delivery from database
        $count_orders = $this->getAvailDelivery();
        // get total page show
        $total_page = ceil($count_orders / $cont_limit);

        ?>
    <div class="hint-text">Showing <b>5</b> out of <b><?php echo $count_orders; ?></b> entries</div>
    <!-- Pagination -->
    <ul class="pagination justify-content-end">
        <?php
            // if condition for prev button
            if ($page >= 2) {
            ?>
        <li class="page-item">
            <a class="page-link" href="manage_delivery.php?page=<?php echo $page - 1; ?>">Previous</a>
        </li>
        <?php
            } else {
            ?>
        <li class="page-item disabled">
            <a class="page-link" href="#">Previous</a>
        </li>
        <?php
            }
            // loop for num pages
            for ($i = 1; $i <= $total_page; $i++) {
            ?>
        <li class="page-item">
            <a class="page-link" href="manage_delivery.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
        <?php
            }
            // if condition for next button
            if ($page == $total_page) {
            ?>
        <li class="page-item disabled">
            <a class="page-link" href="#">Next</a>
        </li>
        <?php
            } else {
            ?>
        <li class="page-item">
            <a class="page-link" href="manage_delivery.php?page=<?php echo $page + 1; ?>">Next</a>
        </li>
        <?php
            }
            ?>
    </ul>
    <?php
    }

    // Manage Delivery - show all
    public function AdminSearchManageDelivery() {
        // set page content limit
        $cont_limit = 5;
        // check the value of page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        // return page value to 1
        if ($page == null) {
            $page = 1;
        } elseif ($page == 0) {
            $page = 1;
        }

        // compute the database limit
        $start_from = ($page - 1) * $cont_limit;

        // get available deliveries
        $count_orders = $this->getSearchedDelivery($start_from, $cont_limit)->rowCount();
        // get limit data from database
        $result = $this->getSearchedDelivery($start_from, $cont_limit)->fetchAll();
        
        if($count_orders == 0) {
        ?>
    <tr>
        <td colspan="10">
            <center>
                <h2 style="color: #31352E;">NO ORDERS LISTED</h2>
            </center>
        </td>
    </tr>
    <?php
        } else {
            foreach($result as $delivery) {
                ?>
    <tr>
        <td><?php echo $delivery['delivery_id']; ?></td>
        <td><?php echo $delivery['cart_number']; ?></td>
        <td><?php echo $delivery['username']; ?></td>
        <td><?php echo $delivery['postal']; ?></td>
        <td><?php echo "₱ " . $delivery['sub_total']; ?></td>
        <td><?php echo "₱ " . $delivery['delivery_fee']; ?></td>
        <td><?php echo "₱ " . $delivery['total_price']; ?></td>
        <td><?php echo $delivery['order_date']; ?></td>
        <td><?php echo $delivery['delivery_status']; ?></td>
        <td>
            <button id="<?php echo $delivery['delivery_id']; ?>" type="button" class="btn btn-warning button-edit">
                <i class="bi bi-pencil-fill" style="font-size: 15px; color: black;"></i>
            </button>
            <button id="<?php echo $delivery['delivery_id']; ?>" type="button" class="btn btn-success mt-2 button-view">
                <i class="bi bi-binoculars" style="font-size: 15px;"></i>
            </button>
        </td>
    </tr>
    <?php
            }
        }
    }

    // Manage Delivery - pagination
    public function SearchedDeliveryPagination() {
        // set page content limit
        $cont_limit = 5;
        // check the value of page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        // return page value to 1
        if ($page == null) {
            $page = 1;
        } elseif ($page == 0) {
            $page = 1;
        }

        // compute the database limit
        $start_from = ($page - 1) * $cont_limit;

        // get available deliveries
        $count_orders = $this->getSearchedDelivery($start_from, $cont_limit)->rowCount();
        // get total page show
        $total_page = ceil($count_orders / $cont_limit);

        ?>
    <div class="hint-text">Showing <b>5</b> out of <b><?php echo $count_orders; ?></b> entries</div>
    <!-- Pagination -->
    <ul class="pagination justify-content-end">
        <?php
            // if condition for prev button
            if ($page >= 2) {
            ?>
        <li class="page-item">
            <a class="page-link" href="manage_delivery.php?page=<?php echo $page - 1; ?>">Previous</a>
        </li>
        <?php
            } else {
            ?>
        <li class="page-item disabled">
            <a class="page-link" href="#">Previous</a>
        </li>
        <?php
            }
            // loop for num pages
            for ($i = 1; $i <= $total_page; $i++) {
            ?>
        <li class="page-item">
            <a class="page-link" href="manage_delivery.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
        <?php
            }
            // if condition for next button
            if ($page == $total_page) {
            ?>
        <li class="page-item disabled">
            <a class="page-link" href="#">Next</a>
        </li>
        <?php
            } else {
            ?>
        <li class="page-item">
            <a class="page-link" href="manage_delivery.php?page=<?php echo $page + 1; ?>">Next</a>
        </li>
        <?php
            }
            ?>
    </ul>
    <?php
    }

    // ######################################################################
    // Canceled Orders
    public function ShowAllCancelOrders() {
        // set page content limit
        $cont_limit = 5;
        // check the value of page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        // return page value to 1
        if ($page == null) {
            $page = 1;
        } elseif ($page == 0) {
            $page = 1;
        }

        // compute the database limit
        $start_from = ($page - 1) * $cont_limit;

        // get available deliveries
        $cancel_orders = $this->getAvailCancel();
        // get limit data from database
        $result = $this->getAllCancel($start_from, $cont_limit);
        
        if($cancel_orders == 0) {
        ?>
    <tr>
        <td colspan="11">
            <center>
                <h2 style="color: #31352E;">NO ORDERS LISTED</h2>
            </center>
        </td>
    </tr>
    <?php
        } else {
            foreach($result as $delivery) {
                ?>
    <tr>
        <td><?php echo $delivery['cancel_id']; ?></td>
        <td><?php echo $delivery['delivery_id']; ?></td>
        <td><?php echo $delivery['cart_number']; ?></td>
        <td><?php echo $delivery['username']; ?></td>
        <td><?php echo $delivery['postal']; ?></td>
        <td><?php echo "₱ " . $delivery['sub_total']; ?></td>
        <td><?php echo "₱ " . $delivery['delivery_fee']; ?></td>
        <td><?php echo "₱ " . $delivery['total_price']; ?></td>
        <td><?php echo $delivery['reason']; ?></td>
        <td><?php echo $delivery['date_canceled']; ?></td>
        <td>
            <button id="<?php echo $delivery['delivery_id']; ?>" type="button" class="btn btn-danger button-delete">
                <i class="bi bi-trash" style="font-size: 15px; color: white;"></i>
            </button>
            <button id="<?php echo $delivery['delivery_id']; ?>" type="button" class="btn btn-success mt-2 button-view">
                <i class="bi bi-binoculars" style="font-size: 15px;"></i>
            </button>
        </td>
    </tr>
    <?php
            }
        }
    }

    // Canceled Orders - pagination
    public function CanceledOrderPagination() {
        // set page content limit
        $cont_limit = 5;
        // check the value of page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        // return page value to 1
        if ($page == null) {
            $page = 1;
        } elseif ($page == 0) {
            $page = 1;
        }

        // get number of available delivery from database
        $count_orders = $this->getAvailCancel();
        // get total page show
        $total_page = ceil($count_orders / $cont_limit);

        ?>
    <div class="hint-text">Showing <b>5</b> out of <b><?php echo $count_orders; ?></b> entries</div>
    <!-- Pagination -->
    <ul class="pagination justify-content-end">
        <?php
            // if condition for prev button
            if ($page >= 2) {
            ?>
        <li class="page-item">
            <a class="page-link" href="canceled_order.php?page=<?php echo $page - 1; ?>">Previous</a>
        </li>
        <?php
            } else {
            ?>
        <li class="page-item disabled">
            <a class="page-link" href="#">Previous</a>
        </li>
        <?php
            }
            // loop for num pages
            for ($i = 1; $i <= $total_page; $i++) {
            ?>
        <li class="page-item">
            <a class="page-link" href="canceled_order.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
        <?php
            }
            // if condition for next button
            if ($page == $total_page) {
            ?>
        <li class="page-item disabled">
            <a class="page-link" href="#">Next</a>
        </li>
        <?php
            } else {
            ?>
        <li class="page-item">
            <a class="page-link" href="canceled_order.php?page=<?php echo $page + 1; ?>">Next</a>
        </li>
        <?php
            }
            ?>
    </ul>
    <?php
    }

    public function AdminSearchCanceledOrder() {
        // set page content limit
        $cont_limit = 5;
        // check the value of page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        // return page value to 1
        if ($page == null) {
            $page = 1;
        } elseif ($page == 0) {
            $page = 1;
        }

        // compute the database limit
        $start_from = ($page - 1) * $cont_limit;

        // get available deliveries
        $count_orders = $this->getSearchedCancel($start_from, $cont_limit)->rowCount();
        // get limit data from database
        $result = $this->getSearchedCancel($start_from, $cont_limit)->fetchAll();
        
        if($count_orders == 0) {
        ?>
    <tr>
        <td colspan="11">
            <center>
                <h2 style="color: #31352E;">NO ORDERS LISTED</h2>
            </center>
        </td>
    </tr>
    <?php
        } else {
            foreach($result as $delivery) {
                ?>
    <tr>
        <td><?php echo $delivery['cancel_id']; ?></td>
        <td><?php echo $delivery['delivery_id']; ?></td>
        <td><?php echo $delivery['cart_number']; ?></td>
        <td><?php echo $delivery['username']; ?></td>
        <td><?php echo $delivery['postal']; ?></td>
        <td><?php echo "₱ " . $delivery['sub_total']; ?></td>
        <td><?php echo "₱ " . $delivery['delivery_fee']; ?></td>
        <td><?php echo "₱ " . $delivery['total_price']; ?></td>
        <td><?php echo $delivery['reason']; ?></td>
        <td><?php echo $delivery['date_canceled']; ?></td>
        <td>
            <button id="<?php echo $delivery['delivery_id']; ?>" type="button" class="btn btn-warning button-edit">
                <i class="bi bi-trash" style="font-size: 15px; color: black;"></i>
            </button>
            <button id="<?php echo $delivery['delivery_id']; ?>" type="button" class="btn btn-success mt-2 button-view">
                <i class="bi bi-binoculars" style="font-size: 15px;"></i>
            </button>
        </td>
    </tr>
    <?php
            }
        }
    }

    public function CancelPaginationSearched() {
        // set page content limit
        $cont_limit = 5;
        // check the value of page
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        // return page value to 1
        if ($page == null) {
            $page = 1;
        } elseif ($page == 0) {
            $page = 1;
        }

        // compute the database limit
        $start_from = ($page - 1) * $cont_limit;

        // get number of available products from database
        $avail_prod = $this->getSearchedCancel($start_from, $cont_limit)->rowCount();
        // get total page show
        $total_page = ceil($avail_prod / $cont_limit);

        ?>
    <!-- Pagination -->
    <div class="hint-text">Showing <b>5</b> out of <b><?php echo $avail_prod; ?></b> entries</div>
    <ul class="pagination justify-content-end">
        <?php
            // if condition for prev button
            if ($page >= 2) {
                ?>
        <li class="page-item">
            <a class="page-link"
                href="home.php?search=<?php echo $_GET['search']; ?>&page=<?php echo $page - 1; ?>">Previous
            </a>
        </li>
        <?php
            } else {
                ?>
        <li class="page-item disabled">
            <a class="page-link" href="#">Previous</a>
        </li>
        <?php
            }
            // loop for num pages
            for ($i = 1; $i <= $total_page; $i++) {
            ?>
        <li class="page-item" id="page">
            <a class="page-link"
                href="home.php?search=<?php echo $_GET['search']; ?>&page=<?php echo $i; ?>"><?php echo $i; ?>
            </a>
        </li>
        <?php
            }
            // if condition for next button
            if ($page == $total_page) {
                ?>
        <li class="page-item disabled">
            <a class="page-link" href="#">Next</a>
        </li>
        <?php
            } else {
                ?>
        <li class="page-item">
            <a class="page-link"
                href="home.php?search=<?php echo $_GET['search']; ?>&page=<?php echo $page + 1; ?>">Next
            </a>
        </li>
        <?php
            }
            ?>
    </ul>
    <?php
    }

    // View specific product
    public function viewspecificItem($prod_id) {
        return $this->specificItem($prod_id);
    }
}   