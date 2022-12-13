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
$add_title = parseDescription($info[14]);
$add_links = parseLinks($info[13]);
$store_link = $info[15];
?>
<!DOCTYPE html>
<html lang="en" class="background-asdecor">
  <head>
    <meta charset="UTF-8">
    <title>Asdecor - <?=$title?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="manifest" href="./favicon/site.webmanifest">
    <link rel="mask-icon" href="./favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="description" content="<?=$description?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Asdecor">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./style.css">
  </head>
  <body class="taplink-page">
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
	  <?php if($add_title): ?>
	  <div class="section-header__company-name section__main-bordered">
          <?=$add_title?>
      </div>
      <?php endif; ?>
      <div class="section__whatsapp-links">
		  <?php if($store_link): ?>
          <a href="https://<?=$store_link?>" class="btn-link-custom with-thumb" target="_blank">
              <figure><svg data-mode="stroke" xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" stroke-width="1" stroke="#343a40" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M7 10l5-6 5 6"></path><path d="M21 10l-2 8a2 2.5 0 0 1-2 2H7a2 2.5 0 0 1-2-2l-2-8z"></path><circle cx="12" cy="15" r="2"></circle></svg></figure>
              <div class="btn-link-custom__content">
                  <div class="btn-link-custom__title">
                      <?=$store_link?>
                  </div>
                  <div class="btn-link-custom__subtitle">
                      интернет-магазин
                  </div>
              </div>
          </a>
		  <?php endif; ?>
          <?php foreach($links as $key=>$value): ?>
              <a href="<?=$value['link']?>" class="btn-link-custom with-thumb has-animation-blink" target="_blank">
                  <figure><svg data-mode="stroke" xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" stroke-width="1" stroke="#343a40" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21l1.65-3.8a9 9 0 1 1 3.4 2.9L3 21"></path><path d="M9 10a.5.5 0 0 0 1 0V9a.5.5 0 0 0-1 0v1a5 5 0 0 0 5 5h1a.5.5 0 0 0 0-1h-1a.5.5 0 0 0 0 1"></path></svg></figure>
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
                      <i class="bi bi-youtube"></i>
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

		<div class="section__whatsapp-links">
          <?php foreach($add_links as $key=>$value): ?>
              <a href="<?=$value['link']?>" class="btn-link-custom has-animation-blink" target="_blank">
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
		
		

        <?php if ($twoGis): ?>
            <div class="section__2gis">
                <a href="<?=$twoGis?>" class="btn-link-custom with-thumb" target="_blank">
                    <figure class="btn-link-custom__thumb">
                        <i class="bi bi-geo-alt-fill"></i>
                    </figure>
                    <div class="btn-link-custom__content">
                        <div class="btn-link-custom__title">
                            АДРЕСА МАГАЗИНОВ
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
		<div class="section__youtube">
			<iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d9124269.567621171!2d61.21050274220041!3d48.131605172142805!3m2!1i1024!2i768!4f13.1!2m1!1sasdecor%20kazakhstan!5e0!3m2!1sru!2sus!4v1663945714013!5m2!1sru!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
		<div class="section__youtube">
                <iframe frameborder="0" src="https://www.youtube.com/embed/ZMqNmXHaD9g" allowfullscreen="allowfullscreen" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
            </div>
		<div class="section__youtube">
                <iframe frameborder="0" src="https://www.youtube.com/embed/BlouDhcws3A" allowfullscreen="allowfullscreen" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
		</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </body>
</html>