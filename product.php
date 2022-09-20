<?php
include 'utils/readProductInformation.php';
$fileUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vSDmCxlzh1PrQRp3sNQOLwm1atnW8XWzkZm1EapXedUR6ZFW-UQG2J4C1ESaedlRl93iuUfmsn7q4-X/pub?output=csv';
$productId = '';
if (array_key_exists('product', $_GET)) {
    $productId = $_GET['product'];
}
$product = readProductInformation($fileUrl, $productId);
$images = ['https://images.satu.kz/157800228_w640_h640_slivki-naturalnye-mila.jpg', 'https://images.satu.kz/142097358_w640_h640_forma-razemnaya-antiprigarnaya.jpg'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$product ? $product['title'] : 'Продукт не найден'?> - Asdecor</title>
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="manifest" href="./favicon/site.webmanifest">
    <link rel="mask-icon" href="./favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="<?=$product ? $product['shortDescription'] : ''?> - Asdecor">
    <meta name="keywords" content="webpack, webpack-configuration, template, boilerplate, setup, html, css, sass, javascript">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Asdecor">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<header>
    <div class="container-sm">
        <a href="https://asdecor.kz" class="base_link">
            <img src="images/content/logo.jpg" alt="Asdecor.kz">
        </a>
    </div>
</header>
<?php if (!$product): ?>
<div class="container-sm my-3">
    <h1 class="product-title">Продукт не найден</h1>
</div>
<?php else: ?>

    <div class="container-sm mt-3">
        <?php if (count($product['images']) > 0): ?>
            <div class="image-carousel">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php foreach($product['images'] as $key=>$value): ?>
                            <button type="button" data-bs-target="#carouselExampleIndicators" <?=$key==0 ? 'class="active"' : ''?> data-bs-slide-to="<?=$key?>" aria-current="true" aria-label="Slide <?=$key?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="carousel-inner">
                        <?php foreach($product['images'] as $key=>$value): ?>
                            <div class="carousel-item <?=$key==0 ? 'active' : ''?> product-image">
                                <img src="<?=$value?>" class="d-block w-100" alt="...">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (count($product['images']) > 1): ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="container-sm my-1">
        <div class="d-flex w-100 align-items-start">
            <div class="product-code">
                Артикул: <?=$product['code']?>
                <br>
            </div>
            <?php if ($product['more_link']): ?>
                <a href="<?=$product['more_link']?>" target="_blank" class="base_link ml-auto">
                    <button class="btn btn-outline-danger btn-xs">Подробнее
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-circle-fill" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814l-3.5-2.5z"></path>
                    </svg></button>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="container-sm my-2">
        <h1 class="product-title">
            <?=$product['title']?>
        </h1>
    </div>
    <?php if ($product['price']): ?>
    <div class="container-sm my-2">
        <div class="product-prices">
            <?php if ($product['old_price']): ?>
            <div class="product-old_price">
                <?=$product['old_price']?>
            </div>
            <?php endif; ?>
            <div class="product-price">
                <?=$product['price']?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($product['description']): ?>
    <div class="container-sm my-2">
        <h4 class="section-heading">Описание:</h4>
        <p class="section-paragraph">
            <?=$product['description']?>
        </p>
    </div>
    <?php endif; ?>

    <?php if ($product['advantages']): ?>
    <div class="container-sm my-2">
        <h4 class="section-heading">Преимущества:</h4>
        <p class="section-paragraph">
            <?=$product['advantages']?>
        </p>
    </div>
    <?php endif; ?>

    <?php if ($product['characteristics']): ?>
    <div class="container-sm my-2">
        <h4 class="section-heading">Характеристики:</h4>
        <p class="section-paragraph">
            <?=$product['characteristics']?>
        </p>
    </div>
    <?php endif; ?>

    <?php if ($product['additional']): ?>
    <div class="container-sm my-2">
        <p class="section-paragraph">
            <?=$product['additional']?>
        </p>
    </div>
    <?php endif; ?>

<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>