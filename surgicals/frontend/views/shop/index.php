<section class="srch">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="search-box">
                    <input type="text" class="search" name="search">
                    <i class="fa fa-search search-icon"></i>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="shop-products">
    <div class="container">
        <div class="row">

            <?php
            for ($x = 0; $x <= 6; $x++) {?>
            
            <div class="col-lg-3 col-md-4">
                <div class="product-box">
                    <img src="/assets/images/banner/banner-01.png">
                    <h1>Bigmuscles Nutrition Real Mass Gainer [1Kg, Chocolate] | Lean Whey Protein Muscle Mass Gainer.</h1>
                    <span class="quantity">1kg Supplement</span>
                    <div class="reviews">
                        <span class="ratings">3<i class="fa fa-star"></i></span>
                        <span class="reviews-num">
                            (12 Reviews)
                        </span>
                    </div>
                    <div class="price">k
                        <h2>₹1,199</h2><del>₹1.599</del><span class="discount">43% off</span>
                    </div>
                    <a class="cart-btn">Add To Cart</a>
                </div>
            </div>

            <?php
               }
            ?>
        </div>
    </div>
</section>


<section class="pagination-section">
    <div class="container">
        <div class="row">
            <ul class="pagination">
                <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active">
                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </div>
    </div>
</section>


<?php $this->registerCss('

.search-box {
    margin: auto;
    max-width: 550px;
    display: flex;
    margin-bottom: 15px;
}

input.search {
    margin: 0;
    height: 30px;
    padding: 5px;
}

.search-icon {
    line-height: 30px;
    padding: 0 15px;
    background: #57bce2;
    color: #fff;
}


.product-box {
    padding: 10px;
    box-shadow: 0 0 10px 1px #dbdbdb;
    margin: 15px 0;
}

.product-box img {
    width: 100px;
    display: block;
    margin: auto;
    margin-bottom: 15px;
}

.product-box h1 {
    font-size: 18px;
    margin: 0;
}

.product-box .quantity {
    font-size: 14px;
    font-weight: 600;
    color: #424242;
}

span.ratings {
    background: #FF5C58;
    padding: 0 6px;
    border-radius: 5px;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
}

.stars {
    display: inline-block;
}

.ratings .fa-star{
    display: inline-blok;
    margin-left: 2px;
}

.price h2 {
    font-size: 20px;
    font-weight: 700;
    display: inline-block;
}

.price del {
    margin-left: 6px;
}

span.discount {
    margin-left: 6px;
    color: #4cb145;
    font-weight: 600;
}

a.cart-btn {
    display: inline-block;
    padding: 5px 10px;
    background: #57bce2;
    color: #fff !important;
    font-weight: 700;
}

.pagination li a {
    font-size: 16px;
    line-height: 14px;
    font-weight: 500;
    display: inline-block;
    height: unset;
    width: max-content;
}
.pagination{
    margin-bottom: 20px;
    margin-top: 30px;
}
.pagination-section .row{
    justify-content: center;
}
');?>