<?php
include "vendor/autoload.php";
use GuzzleHttp\Client;

function displayIndex() {
    $token = '68fdfd2d440e0ef76ead7e303ad5b4349ee93ffb2da32866754e2f7d6eb28393a1b97ad2d418216dd6a2dc903859472a4987eb77bc447894d74b07776312aa0105dc4ad8cf6d54669f611690a082cea62995f32e5aa48edadb6f50dec365bf3ccbcefcaa2578c7c1d42a50576529ad422641de96438ccb3d7ede5352e03b5c55';

    $client = new Client([
        'base_uri' => 'http://localhost:1337/api/'
    ]);

    $headers = [
        'Authorization' => 'Bearer ' . $token,        
        'Accept'        => 'application/json',
    ];

    $response = $client->request('GET', 'home', [
        'headers' => $headers
    ]);

    $body = $response->getBody();
    $decoded_response = json_decode($body);
    return $decoded_response;
}


$index = displayIndex();
//var_dump($index)

$headerLogo = $index->data->attributes->headerLogo;
$heroSection = $index->data->attributes->heroSection;
$featuredProducts = $index->data->attributes->featuredProducts;
$latestProducts = $index->data->attributes->latestProducts;
$testimonials= $index->data->attributes->testimonials;
$footerLogo = $index->data->attributes->footerLogo;
$footerSlogan= $index->data->attributes->footerSlogan;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RedStore | Ecommerce Website Design</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="index.html"><img src=<?php echo $headerLogo;?> alt="logo" width="125px"></a>
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="products.html">Products</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="">Contact</a></li>
                        <li><a href="account.html">Account</a></li>
                    </ul>
                </nav>
                <a href="cart.html"><img src="images/cart.png" width="30px" height="30px"></a>
                <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
            <div class="row">
                <div class="col-2">
                    <h1><?php echo $heroSection->title;?></h1>
                    <p><?php echo $heroSection->description;?></p>
                    <a href="" class="btn"><?php echo $heroSection->buttonText;?>&#8594;</a>
                </div>
                <div class="col-2">
                    <img src="images/image1.png">
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->

    <div class="categories">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <img src="images/category-1.jpg">
                </div>
                <div class="col-3">
                    <img src="images/category-2.jpg">
                </div>
                <div class="col-3">
                    <img src="images/category-3.jpg">
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products -->

    <div class="small-container">
        <h2 class="title">Featured Products</h2>
        <div class="row">
        <?php foreach ($featuredProducts as $featuredProduct){?>
            <div class="col-4">
                <a href="product_details.html"><img src=<?php echo $featuredProduct->image;?>></a>
                <h4><?php echo $featuredProduct->name;?></h4>
                <div class="rating" data-stars="5">
                    <?php for($i=1; $i <= $featuredProduct->stars; $i++){?>
                        <i class="fa fa-star"></i>
                    <?php } ?>
                    <?php for($i=1; $i <= 5-$featuredProduct->stars; $i++){?>
                        <i class="fa fa-star-o"></i>
                    <?php } ?>
                </div>
                <p><?php echo $featuredProduct->price;?></p>
            </div>
        <?php } ?>
        </div>

        <h2 class="title">Latest Products</h2>
        <div class="row">
        <?php foreach ($latestProducts as $latestProduct){?>
            <div class="col-4">
                <img src=<?php echo $latestProduct->image;?>>
                <h4><?php echo $latestProduct->name;?></h4>
                <div class="rating" data-stars="5">
                    <?php for($i=1; $i <= $latestProduct->stars; $i++){?>
                        <i class="fa fa-star"></i>
                    <?php } ?>
                    <?php for($i=1; $i <= 5-$latestProduct->stars; $i++){?>
                        <i class="fa fa-star-o"></i>
                    <?php } ?>
                </div>
                <p><?php echo $latestProduct->price;?></p>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- Offer -->
    <div class="offer">
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="images/exclusive.png" class="offer-img">
                </div>
                <div class="col-2">
                    <p>Exclusively Available on RedStore</p>
                    <h1>Smart Band 4</h1>
                    <small>The Mi Smart Band 4 fearures a 39.9%larger (than Mi Band 3) AMOLED color full-touch display
                        with adjustable brightness, so everything is clear as can be.<br></small>
                    <a href="products.html" class="btn">Buy Now &#8594;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonial -->
    <div class="testimonial">
        <div class="small-container">
            <div class="row">
            <?php foreach ($testimonials as $feedback){?>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p><?php echo $feedback->testimonial;?></p>
                    <div class="rating" data-stars="5">
                    <?php for($i=1; $i <= $feedback->stars; $i++){?>
                        <i class="fa fa-star"></i>
                    <?php } ?>
                    <?php for($i=1; $i <= 5-$feedback->stars; $i++){?>
                        <i class="fa fa-star-o"></i>
                    <?php } ?>
                </div>
                    <img src=<?php echo $feedback->picture;?>>
                    <h3><?php echo $feedback->name;?></h3>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Brands -->

    <div class="brands">
        <div class="small-container">
            <div class="row">
                <div class="col-5">
                    <img src="images/logo-godrej.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-oppo.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-coca-cola.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-paypal.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-philips.png">
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Download Our App</h3>
                    <p>Download App for Android and ios mobile phone.</p>
                    <div class="app-logo">
                        <img src="images/play-store.png">
                        <img src="images/app-store.png">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src=<?php echo $footerLogo;?>>
                    <p><?php echo $footerSlogan;?></p>
                </div>
                <div class="footer-col-3">
                    <h3>Useful Links</h3>
                    <ul>
                        <li>Coupons</li>
                        <li>Blog Post</li>
                        <li>Return Policy</li>
                        <li>Join Affiliate</li>
                    </ul>
                </div>
                <div class="footer-col-4">
                    <h3>Follow Us</h3>
                    <ul>
                        <li>Facebook</li>
                        <li>Twitter</li>
                        <li>Instagram</li>
                        <li>Youtube</li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="copyright">Copyright 2022- Samwit Adhikary</p>
        </div>
    </div>

    <!-- javascript -->

    <script>
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px";
        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px"
            }
            else {
                MenuItems.style.maxHeight = "0px"
            }
        }
    </script>

</body>

</html>