<?php
include 'utils/either.php';
include 'utils/readCityInformation.php';
include 'utils/dataParsers.php';
$fileUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vQ8tKS8XyrdIXB-DFPusd_lfYB8b1YapMyDjgB5NezJwc5pt-xqJw-yD17LcKAhg59IZU2n3olUcgYH/pub?output=csv';
$city = 'astana';
if (array_key_exists('city', $_GET)) {
    $city = $_GET['city'];
}
$info = readCityInformation($fileUrl, $city);
$title = either($info[1], 'Сеть супермаркетов для кондитера №1 в СНГ');
$description = either($info[2], '«Мы дарим возможность сделать жизнь слаще и вкуснее, предоставляя качественный широкий ассортимент товаров и высокий уровень сервиса.»');
$links = parseLinks($info[3]);
$images = parseImages($info[4]);
$email = $info[5];
$tiktok = $info[6];
$instagram = $info[7];
$facebook = $info[8];
$twoGis = $info[9];
$youtube = $info[10];
$filialsTitle = $info[11];
$filials = parseFilials($info[12]);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Asdecor - <?=$title?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="manifest" href="./favicon/site.webmanifest">
    <link rel="mask-icon" href="./favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="<?=$description?>">
    <meta name="keywords" content="webpack, webpack-configuration, template, boilerplate, setup, html, css, sass, javascript">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Asdecor">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./style.css">
  </head>
  <body class="background-asdecor">
    <div class="container section__list">
      <div class="section__header">
        <div class="section-header__logo">
          <img src="images/content/asdecor_logo.jpg" alt="Logotype">
        </div>
        <div class="section-header__company-name">
          <?=$title?>
        </div>
      </div>

      <div class="section__main-text">
          <?=$description?>
      </div>

      <div class="section__whatsapp-links">
          <a href="https://www.asdecor.kz" class="btn-link-custom with-thumb" target="_blank">
              <figure class="btn-link-custom__thumb">
                  <i class="bi bi-basket"></i>
              </figure>
              <div class="btn-link-custom__content">
                  <div class="btn-link-custom__title">
                      www.asdecor.kz
                  </div>
                  <div class="btn-link-custom__subtitle">
                      интернет-магазин
                  </div>
              </div>
          </a>
          <?php foreach($links as $key=>$value): ?>
              <a href="<?=$value['link']?>" class="btn-link-custom with-thumb has-animation-blink" target="_blank">
                  <figure class="btn-link-custom__thumb">
                      <i class="bi bi-whatsapp"></i>
                  </figure>
                  <div class="btn-link-custom__content">
                      <div class="btn-link-custom__title">
                          <?=$value['address']?>
                      </div>
                      <div class="btn-link-custom__subtitle">
                          <?=$value['time']?>
                      </div>
                  </div>
              </a>
          <?php endforeach; ?>
      </div>
        <?php if (count($images) > 0): ?>
            <div class="section__carousel">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php foreach($images as $key=>$value): ?>
                            <button type="button" data-bs-target="#carouselExampleIndicators" <?=$key==0 ? 'class="active"' : ''?> data-bs-slide-to="<?=$key?>" aria-current="true" aria-label="Slide <?=$key?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="carousel-inner">
                        <?php foreach($images as $key=>$value): ?>
                            <div class="carousel-item <?=$key==0 ? 'active' : ''?>">
                                <img src="<?=$value?>" class="d-block w-100" alt="...">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        <?php endif; ?>

      <div class="section__social-links">
          <?php if ($email): ?>
              <a href="mailto:<?=$email?>" class="button btn-link-custom">
                  <figure class="btn-link-custom__thumb">
                      <i class="bi bi-envelope"></i>
                  </figure>
              </a>
          <?php endif; ?>
          <?php if ($tiktok): ?>
              <a href="<?=$tiktok?>" class="button btn-link-custom">
                  <figure class="btn-link-custom__thumb">
                      <i class="bi bi-tiktok"></i>
                  </figure>
              </a>
          <?php endif; ?>
          <?php if ($instagram): ?>
              <a href="<?=$instagram?>" class="button btn-link-custom">
                  <figure class="btn-link-custom__thumb">
                      <i class="bi bi-instagram"></i>
                  </figure>
              </a>
          <?php endif; ?>
          <?php if ($facebook): ?>
              <a href="<?=$facebook?>" class="button btn-link-custom">
                  <figure class="btn-link-custom__thumb">
                      <i class="bi bi-facebook"></i>
                  </figure>
              </a>
          <?php endif; ?>
      </div>

        <?php if ($youtube): ?>
            <div class="section__youtube">
                <iframe frameborder="0" src="<?=$youtube?>" allowfullscreen="allowfullscreen" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
            </div>
        <?php endif; ?>


        <?php if ($twoGis): ?>
            <div class="section__2gis">
                <a href="<?=$twoGis?>" class="btn-link-custom with-thumb" target="_blank">
                    <figure class="btn-link-custom__thumb">
                        <i class="bi bi-geo-alt-fill"></i>
                    </figure>
                    <div class="btn-link-custom__content">
                        <div class="btn-link-custom__title">
                            2ГИС АДРЕСА
                        </div>
                    </div>
                </a>
            </div>
        <?php endif; ?>

      <div class="block-break-inner"></div>

      <div class="section__instagram-list">
        <ul>
          <li><?=$filialsTitle?></li>
            <?php foreach($filials as $key=>$value): ?>
                <li><?=$value['title']?> — <a href="https://www.instagram.com/<?=$value['link']?>/" target="_blank"><?=$value['instagram']?></a></li>
            <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </body>
</html>