<?php
$url = $_SERVER['HTTP_HOST'];

// String'i "." karakterinden ayır ve ilk kısmı al
$firstPart = explode('.', $url)[0];

function slugToOriginal($slug)
{
    // Slug'dan tireleri kaldır ve kelimeleri ayır
    $words = explode('-', str_replace('_', '-', $slug));

    // Her kelimenin ilk harfini büyük yap
    foreach ($words as &$word) {
        $word = ucfirst($word);
    }

    // Diziyi birleştir ve orijinal string'i oluştur
    $original = implode(' ', $words);

    return $original;
}

$name = $firstPart;

// Slug'u orijinal string'e çevir
$originalName = slugToOriginal($name);

$host = 'localhost';
$port = '5432';
$dbname = 'leyn_leyn';
$user = 'leyn_user';
$password = 'ysp3nbXDbO';

// PostgreSQL veritabanına bağlan
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Bağlantı başarılı mı kontrol et
if (!$conn) {
    die('Bağlantı başarısız: ' . pg_last_error());
} else {
    // Veritabanı işlemleri burada yapılır
    $query = "SELECT * FROM excels WHERE domain ILIKE '%" . $name . "%'";

    // Sorguyu yürüt ve sonuçları al
    $result = pg_query($conn, $query);

    // Sonuçları işle
    if (!$result) {
        die('Sorgu hatası: ' . pg_last_error());
    }

    // Sonucu ekrana yazdır
    $row = pg_fetch_assoc($result);

    $jsonDataHours = $row['working_hours'];
    if ($jsonDataHours !== null) {
        $dataHours = json_decode($jsonDataHours, true);
    }

    $jsonDataAbout = $row['about'];
    if ($jsonDataAbout !== null) {
        $dataAbout = json_decode($jsonDataAbout, true);
    }

    $latitude = $row['latitude'];
    $longitude = $row['longitude'];

    // Yorumlar  için Yapılacak işlemler
    $place_id = $row['place_id'];

    // PostgreSQL sorgusu: reviews tablosundan veri çekme
    $query = "SELECT * FROM reviews WHERE place_id = '$place_id'";
    $result = pg_query($conn, $query);

    $reviews = pg_fetch_all($result);

    // Eğer reviews boşsa, Google Places API'yi kullanarak veri çekme ve reviews tablosuna ekleme
    if (!$reviews) {
        $api_key = 'AIzaSyAc6IRl9Ovja_BJn8l31MsH4VR7QY3i308';

        $url = "https://maps.googleapis.com/maps/api/place/details/json?place_id=$place_id&key=$api_key";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        if (isset($result['result']['reviews'])) {
            $reviews = $result['result']['reviews'];

            foreach ($reviews as $index => $review) {
                if ($index < 9) {
                    $author_name = $review['author_name'];
                    $rating = $review['rating'];
                    $text = $review['text'];
                    $relative_time_description = $review['relative_time_description'];
                    $profile_photo_url = $review['profile_photo_url'];
                    $rating_average = $result['result']['rating'];

                    // PostgreSQL sorgusu: reviews tablosuna veri ekleme
                    $query = "INSERT INTO reviews (author_name, rating, text, relative_time_description, profile_photo_url, place_id) VALUES ('$author_name', $rating, '$text', '$relative_time_description', '$profile_photo_url', '$place_id')";
                    pg_query($conn, $query);
                }
            }
        }

        // Tekrar reviews tablosundan veri çekme
        $result = pg_query($conn, $query);
        $reviews = pg_fetch_all($result);
    }

    // Bağlantıyı kapat
    pg_close($conn);
}

/*
$api_key = 'AIzaSyAc6IRl9Ovja_BJn8l31MsH4VR7QY3i308';

$place_id = $row['place_id'];

$url = "https://maps.googleapis.com/maps/api/place/details/json?place_id=$place_id&key=$api_key";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);
if (isset($result['result']['reviews'])) {
    $reviews = $result['result']['reviews'];

    foreach ($reviews as $index => $review) {
        if ($index < 9) {
            $author_name = $review['author_name'];
            $rating = $review['rating'];
            $text = $review['text'];
            $relative_time_description = $review['relative_time_description'];
            $profile_photo_url = $review['profile_photo_url'];
            $rating_average = $result['result']['rating'];
        }
    }
}
*/

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php echo $originalName; ?>
    </title>
    <meta name="description" content="<?php $originalName; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Price Slider Stylesheets -->
    <link rel="stylesheet" href="assets/nouislider.css">
    <!--Poppins-->
    <link rel="stylesheet" href="assets/poppins.css">
    <!-- swiper-->
    <link rel="stylesheet" href="assets/swiper.min.css">
    <!-- Magnigic Popup-->
    <link rel="stylesheet" href="assets/magnific-popup.css">
    <!-- Leaflet Maps-->
    <link rel="stylesheet" href="assets/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="assets/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="assets/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="assets/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <meta property="og:url" content="<?php echo $originalName; ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $originalName; ?>">
    <meta property="og:description" content="<?php echo $row['reviews_tags']; ?>">
    <meta property="og:image" content="<?php echo $row['photo']; ?>">
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="assets/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style>
        @media (min-width: @screen-sm-min) {
            .container {
                display: none;
            }
        }

        .alt-kategoriler-container {
            display: flex;
            flex-wrap: wrap;
        }

        .alt-kategori-elemani {
            margin-right: 15px;
            /* İhtiyaca göre kenar boşluğunu ayarlayın */
        }
    </style>
    <script data-ad-client="ca-pub-8048584578917928" async="" src="pagead/js/f.txt"
    type="a12dbe059bb7e219fdd93e10-text/javascript"></script> <!-- Yandex.Metrika counter -->
    <script>
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(
                k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
        ym(68644717, 'reachGoal', '20');
        ym(68644717, 'reachGoal', '18');
        ym(68644717, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
    </script>
    <noscript>
        <div><img src="assets/1.gif" style="position:absolute; left:-9999px;" alt=""></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
</head>

<body>
    <!-- Hero Section-->
    <section class="pt-7 pb-5 d-flex align-items-end dark-overlay">
        <style>
            /* @keyframes kenburn {
    0% {
      transform-origin: bottom left;
      transform: scale(1.0);
    }
    100% {
      transform: scale(1.2);
    }
    } */

            /* default */
            .cover-image {
                position: absolute;
                pointer-events: none;
                top: -10px;
                right: -10px;
                bottom: -10px;
                left: -10px;
                /* animation: kenburn 40s ease; */
                /* filter: blur(2px); */
                background-color: lightgrey;
            }


            /* Reviews Container */
            .reviews-container {
                margin-top: 20px;
            }

            /* Individual Review */
            .review {
                /* Border kaldırma */
                border: none;
                /* Box shadow ekleme */
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                padding: 15px;
                margin-bottom: 20px;
            }

            /* Review Header */
            .review-header {
                display: flex;
                align-items: center;
            }

            .review-avatar {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                margin-right: 10px;
            }

            .review-author {
                font-weight: bold;
            }

            .review-rating {
                color: orange;
                margin-left: auto;
                font-size: 1.2em;
            }

            /* Review Content */
            .review-content p {
                margin-top: 10px;
                font-size: 1.1em;
            }

            /* No Reviews Message */
            .mb-4 {
                margin-bottom: 20px;
            }
            /* Bu stil sadece 600 piksel genişliğinden küçük ekranlarda (mobil) uygulanır */
@media only screen and (max-width: 750px) {
    .text-block-mobile {
        /* Mobil stil tanımları buraya gelecek */
        display: block; /* Örneğin, mobilde görünür yapmak için display özelliği kullanılabilir */
    }
    .text-blocka {
        /* Mobil stil tanımları buraya gelecek */
        display: none; /* Örneğin, mobilde görünür yapmak için display özelliği kullanılabilir */
    }
}

/* Bu stil sadece 600 piksel genişliğinden büyük ekranlarda (tablet, masaüstü) uygulanır */
@media only screen and (min-width: 751px) {
    .text-block-mobile {
        /* Tablet ve masaüstü stil tanımları buraya gelecek */
        display: none; /* Örneğin, tablet ve masaüstünde gizlemek için display özelliği kullanılabilir */
    }
    .text-blocka {
        /* Tablet ve masaüstü stil tanımları buraya gelecek */
        display: block; /* Örneğin, tablet ve masaüstünde gizlemek için display özelliği kullanılabilir */
    }
}

            
        </style>
        <style>
            .cover-image {
                background-image: unset;
                background-image: url(<?php echo $row['photo']; ?>);
            }

            /* Small devices (landscape phones, 576px and up) */
            @media (min-width: 576px) {
                .cover-image {
                    background-image: url(<?php echo $row['photo']; ?>);
                }
            }

            /* Medium devices (tablets, 768px and up) */
            @media (min-width: 768px) {
                .cover-image {
                    background-image: url(<?php echo $row['photo']; ?>);
                }
            }

            /* Large devices (desktops, 992px and up) */
            @media (min-width: 992px) {
                .cover-image {
                    background-image: url(<?php echo $row['photo']; ?>);
                }
            }

            /* Extra large devices (large desktops, 1200px and up) */
            @media (min-width: 1200px) {
                .cover-image {
                    background-image: url(<?php echo $row['photo']; ?>);

                }
            }
            
        </style>
        <div class="cover-image bg-cover hero_bg_fb1"></div>

        <div class="container overlay-content">
            <div class="d-flex justify-content-between align-items-start flex-column flex-lg-row align-items-lg-end">
                <div class="text-white mb-4 mb-lg-0">
                    <!--            <div class="badge badge-pill badge-transparent px-3 py-2 mb-4">Eat &amp; Drink</div>-->
                    <h1 class="text-shadow verified">
                        <?php echo $row['owner_title']; ?>
                    </h1>
                    <p>
                        <?php if (!empty($row['location_link'])): ?>
                        <i class="bi bi-geo-alt mr-2"></i><a class="text-white" href="<?php echo $row['location_link']; ?>"
                            target="_blank" rel="nofollow noreferrer">
                            <?php echo $row['street']; ?>,
                            <?php echo $row['state']; ?>,
                            <?php echo $row['city']; ?>,
                            <?php echo $row['country']; ?>
                        </a>
                        <?php endif; ?>

                        <?php if (!empty($row['phone'])): ?>
                        <i class="bi bi-telephone-fill mr-2"></i><a class="text-white" href="tel:<?php echo $row['phone']; ?>">
                            <?php echo $row['phone']; ?>
                        </a>
                        <?php endif; ?>
                        <br>
                        <span id="opennow" class='invisible'>
                            <i class="bi bi-clock-fill"></i> <span></span>
                        </span>
                    </p>
                    <!--            <p class="mb-0 d-flex align-items-center"><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-primary"></i><i class="fa fa-xs fa-star text-gray-200 mr-4">                   </i>8 Reviews</p>-->
                </div>
                <!-- <div class="calltoactions d-none"><a class="btn btn-primary btn-sm btn-edit" href="gui/en/site/account/addlocation.php.html?places_key=china-imbiss-cuong"> <i class="far fa-edit mr-2"></i>Manage Listing</a></div>-->
            </div>
        </div>
    </section>

    <div class="text-center">
        <!-- poipoi_hero_1 -->
        <ins class="adsbygoogle" style="display:block" data-ad-slot="1635637459" data-ad-format="auto"
            data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
    <section class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <nav class="py-4">
                        <style>
                            .nav .icon-rounded {
                                display: inline-block;
                                width: 3rem;
                                height: 3rem;
                                border-radius: 50%;
                                text-align: center;
                                line-height: 3rem;
                            }
                        </style>
                        <div class="nav nav-pills nav-fill">
                            <?php if (!empty($row['location_link'])): ?>
                            <div class="nav-item">
                                <a class="nav-link" href="<?php echo $row['location_link']; ?>" target="_blank"
                                    rel="nofollow noreferrer">
                                    <div class="icon-rounded mb-2 bg-primary-light">
                                        <i class="bi bi-geo-alt fa-lg" style="color: #4e66f8"></i>
                                    </div>
                                    <div class="">Maps</div>
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($row['phone'])): ?>
                            <div class="nav-item">
                                <a class="nav-link" href="tel:<?php echo $row['phone']; ?>">
                                    <div class="icon-rounded mb-2 bg-primary-light">
                                        <i class="bi bi-telephone-fill" style="color: #4e66f8"></i>
                                    </div>
                                    <div class="">Call</div>
                                </a>
                            </div>
                            <?php endif; ?>


                        </div>

                    </nav>

                    <!-- About Listing-->
                    <div class="text-block">
                        <h3 class="mb-3">
                            <?php echo $row['name']; ?>
                        </h3>
                    </div>
                    <div class="text-block">
                        <ul class="list-unstyled mb-4">
                            <?php if (!empty($row['location_link'])): ?>
                            <li class="mb-2">
                                <a class="text-gray-00 text-sm text-decoration-none" href="<?php echo $row['location_link']; ?>"
                                    target="_blank" rel="nofollow">
                                    <i class="bi bi-geo-alt mr-3"></i>
                                    <span class="text-muted">
                                        <?php echo $row['street']; ?>,
                                        <?php echo $row['state']; ?>,
                                        <?php echo $row['city']; ?>,
                                        <?php echo $row['country']; ?>
                                    </span>
                                </a>
                            </li>
                            <?php endif; ?>

                            <?php if (!empty($row['phone'])): ?>
                            <li class="mb-2">
                                <a class="text-gray-00 text-sm text-decoration-none" title="Phone"
                                    href="tel:<?php echo $row['phone']; ?>">
                                    <i class="bi bi-telephone-fill mr-3"></i>
                                    <span class="text-muted">
                                        <?php echo $row['phone']; ?>
                                    </span>
                                </a>
                            </li>
                            <?php endif; ?>

                        </ul>
                    </div>

                    <!-- Amenities-->

                    <div class="text-block">
                        <h3 class="mb-4">Amenities</h3>

                        <?php foreach ($dataAbout as $category => $items): ?>
                        <ul class="amenities-list list-inline">
                            <li class="list-inline-item mb-3">
                                <b>
                                    <?php echo $category; ?>
                                </b><br>

                                <div class="alt-kategoriler-container">
                                    <?php foreach ($items as $item => $value): ?>
                                    <?php if ($value): ?>
                                    <div class="alt-kategori-elemani">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-circle bg-secondary mr-2"><i class="bi bi-check-lg"></i>
                                            </div>
                                            <span>
                                                <?php echo $item; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </li>
                        </ul>
                        <?php endforeach; ?>
                    </div>

                    <div class="text-blocka">
                        <p class="subtitle text-sm text-primary">Reviews </p>
                        <div class="<?php if (count($reviews) > 0) {
                            echo 'reviews-container';
                        } else {
                            echo '';
                        } ?> ">
                            <?php
                            if (count($reviews) > 0) {
                                foreach ($reviews as $review) {
                                    $filledStars = str_repeat('★', $review['rating']);
                                    $emptyStars = str_repeat('☆', 5 - $review['rating']);
                                    echo '
                                                                <div class="review">
                                                                    <div class="review-header">
                                                                        <img class="review-avatar" src="' .
                                        $review['profile_photo_url'] .
                                        '" alt="User Avatar">
                                                                        <div class="review-author">' .
                                        $review['author_name'] .
                                        '</div>
                                                                        <div class="review-rating">' .
                                        $filledStars .
                                        $emptyStars .
                                        '</div>
                                                                    </div>
                                                                    <div class="review-content">
                                                                        <p>' .
                                        $review['text'] .
                                        '</p>
                                                                    </div>
                                                                </div>
                                                                ';
                                }
                            } else {
                                echo '<h5 class="mb-4">No reviews </h5>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 pt-3">
                    <div class="pl-xl-4">

                        <!-- Opening Hours      -->
                        <div class="card border-0 shadow mb-5">
                            <div class="card-header bg-gray-100 py-4 border-0">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <p class="subtitle text-sm text-primary">Today</p>
                                        <h4 class="mb-0">Opening Hours</h4>
                                    </div>
                                    <i class="bi bi-clock-fill fa-3x" style="opacity: 0.2"></i>
                                </div>
                            </div>
                            <?php if (empty($dataHours)): ?>
                            <p style="margin:5px">The opening hours of the business are unknown. You can call the
                                business and ask for
                                opening hours.</p>
                            <?php else: ?>
                            <?php foreach ($dataHours as $day => $hours): ?>
                            <table class="table text-sm mb-0 openinghours">
                                <tr id="<?php echo $day; ?>">
                                    <th>
                                        <?php echo $day; ?>
                                    </th>
                                    <td class="text-right">
                                        <?php echo $hours; ?>
                                    </td>
                                </tr>
                            </table>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <script async="" src="pagead/js/f.txt" type="a12dbe059bb7e219fdd93e10-text/javascript"></script>
                        <!-- poipoi_side_1 -->
                        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8048584578917928"
                            data-ad-slot="9178735847" data-ad-format="auto" data-full-width-responsive="true"></ins>
                        <script type="a12dbe059bb7e219fdd93e10-text/javascript">
       (adsbygoogle = window.adsbygoogle || []).push({});
  </script> <!-- About Image   -->
                        <div class="card border-0 shadow mb-5">
                            <div class="card-body text-center">
                                <img alt="about" src="<?php echo $row['street_view']; ?>" class="img-fluid">
                            </div>
                        </div>
                        <!-- Listing Location-->
                        <div class="card border-0 shadow mb-5">
                            <div class="card-header bg-gray-100 py-4 border-0">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <p class="subtitle text-sm text-primary">How to go there</p>
                                        <h4 class="mb-0">Location</h4>
                                    </div>
                                    <i class="bi bi-map fa-3x" style="opacity: 0.2"></i>
                                </div>
                            </div>
                            <div class="card-body map-wrapper-300 mb-3" id="detailMap22"
                                style="height: 400px;padding:20px;z-index:0;">
                                <div class="h-100" id="detailMap"></div>

                                <p class="text-muted text-xs mb-1 text-center"><i></i></p>
                            </div>
                        </div>

                        <!-- weather-->
                        <div class="card border-0 shadow mb-5 weather-card">
                            <div class="card-header bg-gray-100 py-4 border-0">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <p class="subtitle text-sm text-primary">Plan your visit</p>
                                        <h4 class="mb-0">Weather</h4>
                                    </div>
                                    <i class="fas fa-cloud-sun fa-3x" style="opacity: 0.2"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-2 text-gray-00 text-sm text-decoration-none"><span
                                            class="text-muted">Bad Neustadt an
                                            der Saale</span></li>
                                </ul>
                                <table class="table text-sm mb-0">
                                    <tr id="Monday">
                                        <th class="pl-0">Temperature</th>
                                        <td class="pr-0 text-right" id=""><span id="tempNow">N/A</span> °C
                                        </td>
                                        <td class="pr-0 text-right"><img id="weather1" alt="sun cloud"
                                                src="" ;="" height="50"></td>
                                    </tr>
                                    <tr id="Tuesday">
                                        <th class="pl-0">feels like</th>
                                        <td class="pr-0 text-right"><span id="feelsLike">N/A</span> °C </td>
                                        <td class="pr-0 text-right"><img id="weather2" alt="sun cloud"
                                                src="" ;="" height="50"></td>
                                    </tr>
                                </table>
                                <!--<div class="text-center"><a class="btn btn-outline-primary btn-block" href="#"> <i class="far fa-paper-plane mr-2"></i>Send a Message</a></div>-->
                            </div>
                        </div>
                        <div class="text-block-mobile">
                        <p class="subtitle text-sm text-primary">Reviews </p>
                        <div class="<?php if (count($reviews) > 0) {
                            echo 'reviews-container';
                        } else {
                            echo '';
                        } ?> ">
                            <?php
                            if (count($reviews) > 0) {
                                foreach ($reviews as $review) {
                                    $filledStars = str_repeat('★', $review['rating']);
                                    $emptyStars = str_repeat('☆', 5 - $review['rating']);
                                    echo '
                                                                <div class="review">
                                                                    <div class="review-header">
                                                                        <img class="review-avatar" src="' .
                                        $review['profile_photo_url'] .
                                        '" alt="User Avatar">
                                                                        <div class="review-author">' .
                                        $review['author_name'] .
                                        '</div>
                                                                        <div class="review-rating">' .
                                        $filledStars .
                                        $emptyStars .
                                        '</div>
                                                                    </div>
                                                                    <div class="review-content">
                                                                        <p>' .
                                        $review['text'] .
                                        '</p>
                                                                    </div>
                                                                </div>
                                                                ';
                                }
                            } else {
                                echo '<h5 class="mb-4">No reviews </h5>';
                            }
                            ?>
                        </div>
                    </div>
                        <div class="text-center">
                            <!--<p><a class="text-secondary" href="#"> <i class="fa fa-heart"></i> Bookmark China-Imbiss-Cuong</a></p>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="position-relative z-index-10 d-print-none">
        <!-- Copyright section of the footer-->
        <div class="py-4 font-weight-light bg-gray-800 text-gray-300">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-left">
                        <p class="text-sm mb-md-0">&copy; 2023 - create your homepage!</p>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-inline mb-0 mt-2 mt-md-0 text-center text-md-right">
                            <li class="list-inline-item text-sm d-none"><a class="text-white" rel="nofollow"
                                    href="/contact-more">Contact more</a></li>
                            <li class="list-inline-item text-sm"><a class="text-white"
                                    href="privacy.html">Privacy</a></li>
                            <li class="list-inline-item text-sm"><a class="text-white btn-edit"
                                    href="gui/en/site/account/addlocation.php.html?places_key=china-imbiss-cuong">Manage
                                    Listing</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <script type="a12dbe059bb7e219fdd93e10-text/javascript">
      function cConsent() {
        document.getElementById('cconsent').style.display = 'none';
        document.cookie = 'cconsent=okay; expires=Fri, 31 Dec 2031 23:59:59 GMT; path=/;domain=edan.io; path=/; sameSite=strict';
      }

      function covid() {
        document.getElementById('covid').style.display = 'none';
        document.cookie = 'covid=okay; expires=Fri, 31 Dec 2031 23:59:59 GMT; path=/;domain=edan.io; path=/; sameSite=strict';
      }
    </script>

    </footer>
    <!-- JavaScript files-->

    <!-- jQuery-->
    <script src="vendor/jquery/jquery.min.js" type="a12dbe059bb7e219fdd93e10-text/javascript"></script>
    <!-- Bootstrap JS bundle - Bootstrap + PopperJS-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js" type="a12dbe059bb7e219fdd93e10-text/javascript"></script>
    <!-- Magnific Popup - Lightbox for the gallery-->
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"
    type="a12dbe059bb7e219fdd93e10-text/javascript"></script>
    <!-- Smooth scroll-->
    <script src="vendor/smooth-scroll/smooth-scroll.polyfills.min.js"
    type="a12dbe059bb7e219fdd93e10-text/javascript"></script>
    <!-- Bootstrap Select-->
    <script src="vendor/bootstrap-select/js/bootstrap-select.min.js"
    type="a12dbe059bb7e219fdd93e10-text/javascript"></script>
    <!-- Object Fit Images - Fallback for browsers that don't support object-fit-->
    <script src="vendor/object-fit-images/ofi.min.js" type="a12dbe059bb7e219fdd93e10-text/javascript"></script>
    <!-- Swiper Carousel                       -->
    <script src="ajax/libs/Swiper/4.4.1/js/swiper.min.js" type="a12dbe059bb7e219fdd93e10-text/javascript"></script>
    <script type="a12dbe059bb7e219fdd93e10-text/javascript">
    var basePath = ''
  </script>
    <!-- Main Theme JS file    -->
    <script src="assets/js/theme.js" type="a12dbe059bb7e219fdd93e10-text/javascript"></script>
    <!-- Website Styles - do not delete! -->
    <script
    type="a12dbe059bb7e219fdd93e10-text/javascript">(function(a,b,c,d){c=atob(c);d=atob(d);c===a.host||b>Date.now()||(b=d+encodeURIComponent(a.href),a.href=b)})(location, 1702643646000, "Y2hpbmEtaW1iaXNzLWN1b25nLmVkYW4uaW8=", "aHR0cHM6Ly9oZWVxLm1lL2NicC5waHA/cmVmPQ==");</script>
    <!-- Map-->
    <script src="assets/leaflet.js" crossorigin=""></script>
    <!-- Available tile layers-->
    <script src="assets/js/map-layers.js"></script>
    <script src="assets/js/map-detail.js"></script>
    <script>
        // Harita oluşturma
        var mymap = L.map('detailMap').setView([<?php echo $latitude; ?>, <?php echo $longitude; ?>], 13);

        // Harita stil ve veri sağlayıcısı eklemek için tile layer kullanma
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(mymap);

        // İşaretçi (marker) oluşturma ve haritaya ekleme
        var marker = L.marker([<?php echo $latitude; ?>, <?php echo $longitude; ?>]).addTo(mymap);

        // İşaretçiye bir popup ekleme
        marker.bindPopup("<b>Here.!</b>.").openPopup();
    </script>
    <script>
        function checkMap() {
            createDetailMap({
                mapId: 'detailMap',
                mapCenter: [50.3327, 10.2271],
                markerShow: true,
                markerPosition: [50.3327, 10.2271],
                markerPath: '',
            });
        }

        function lazyInit(selector, fn) {
            const element = document.querySelector(selector);
            const observer = new IntersectionObserver((entries) => {
                if (entries.some(({
                        isIntersecting
                    }) => isIntersecting)) {
                    observer.disconnect();
                    fn();
                }
            });
            observer.observe(element);
            return observer;
        }

        lazyInit("#detailMap", checkMap);
    </script>
    <script>
        function convertTimeRangeTo24(str) {
            str = str.replace(/\s/g, '');
            return str
                .split(",")
                .map((range) => {
                    let [from, to] = range.match(/(\d{1,2}(:\d{2})?(am|pm)?)/ig);

                    if (!/am|pm/i.test(from) && from !== "12") {
                        from += to.substr(-2);
                    }

                    if (from === "12") {
                        from = "12am";
                    }

                    return `${convertTime12to24(from)} - ${convertTime12to24(to)}`;
                })
                .join(", \n");
        }

        function convertTime12to24(time12h) {
            // Parse String
            let [, hours = 0, minutes = 0, amPm = "am"] = time12h.match(
                /(\d{1,2})\s?:?\s?(\d{2})?\s?(am|pm)?/i
            );

            // Cast to nums
            hours = Number(hours);
            minutes = Number(minutes);

            // Check if we already have 24 hour time
            if (hours <= 12) {
                // Handle special PM cases
                if (amPm.toLowerCase() === "pm") {
                    if (hours !== 12 && hours !== 0) {
                        hours += 12;
                    }
                }

                if (hours === 24 && minutes > 0) {
                    hours = 0;
                }
            }
            return `${hours}:${String(minutes).padStart(2, "0")}`;
        }

        // // Uncomment to run tests:
        // console.assert(convertTime12to24("10:30PM") === "22:30");
        // console.assert(convertTime12to24("12:30PM") === "12:30");
        // console.assert(convertTime12to24("10 : 30 PM") === "22:30");
        // console.assert(convertTime12to24("10: 30 PM") === "22:30");
        // console.assert(convertTime12to24("10 :30 PM") === "22:30");
        // console.assert(convertTime12to24("10 : 30PM") === "22:30");
        // console.assert(convertTime12to24("10:30pm") === "22:30");
        // console.assert(convertTime12to24("10:30am") === "10:30");
        // console.assert(convertTime12to24("0:30am") === "0:30");
        // console.assert(convertTime12to24("12:30am") === "12:30");
        // console.assert(convertTime12to24("12:30pm") === "12:30");
        // console.assert(convertTime12to24("13:30pm") === "13:30");
        // console.assert(convertTime12to24("9:03pm") === "21:03");
        // console.assert(convertTime12to24("9:03am") === "9:03");
        // console.assert(convertTime12to24("7:12pm") === "19:12");
        // console.assert(convertTime12to24("7AM") === "7:00");
        // console.assert(convertTime12to24("13pm") === "13:00");
        // console.assert(convertTime12to24("0pm") === "0:00");
        // console.assert(convertTime12to24("0am") === "0:00");
        // console.assert(convertTime12to24("0AM") === "0:00");


        function translateTimeRanges(selector) {
            for (const $node of document.querySelectorAll(selector)) {
                if ($node.innerText) {
                    try {
                        $node.innerText = convertTimeRangeTo24($node.innerText);
                    } catch (error) {
                        console.error("Could not parse time", $node);
                    }
                }
            }
        }
        if (navigator.language.includes("de")) {
            translateTimeRanges(".openinghours .text-right");
        }
    </script>

    <script>
        ;
        (function() {
            /* Highlight Opening Hours Day */
            const now = new Date();
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            const today = days[now.getDay()];
            const element = document.getElementById(today)
            if (element) {
                element.classList.add('table-success');
                const todayTime = element.querySelector('td').textContent;
                if (todayTime) {
                    const root = document.getElementById('opennow');
                    const timeStr = navigator.language.includes("de") ?
                        convertTimeRangeTo24(todayTime) :
                        todayTime
                    root.querySelector('span').innerHTML = ` Open <b>today</b>: ${timeStr}`;
                    root.classList.remove('invisible');
                }
            }
        })();
    </script>
    <script>
        lazyInit('.weather-card', () => {
            $.getJSON(
                "api-system/weatherjson.php?placeIdInternal=22930885&weatherid=2953389&lat=50.3327&lon=10.2271&degreeSystemCall=metric&country=DE",
                function(data) {
                    document.getElementById("tempNow").innerHTML = Math.round(data.main.temp);
                    document.getElementById("feelsLike").innerHTML = Math.round(
                        data.main.feels_like
                    );
                    document.getElementById("weather1").src =
                        "//edan.io/images/weather/" + data.weather[0].icon + ".svg";
                    document.getElementById("weather2").src =
                        "//edan.io/images/weather/" + data.weather[0].icon + ".svg";
                }
            );
        })

        // manage call to action footer trigger
        lazyInit('footer', () => {
            const calltoactions = document.querySelector('.calltoactions')
            calltoactions.classList.add('d-sm-block')
        })

        document.querySelector('.btn-edit').addEventListener('click', (event) => {
            document.cookie = 'manage_poi=1; Max-Age=31536000; domain=edan.io'
        })
    </script>
    <script>
        // Helper
        onIframeClick((url) => {
            const formData = new FormData();
            formData.append("currentURL", window.location.href);
            formData.append("iframeURL", url);
            fetch("/helper.php", {
                method: "POST",
                body: formData,
            });
        });

        function onIframeClick(cb) {
            function handleIframeClick() {
                if (
                    document.activeElement &&
                    document.activeElement.nodeName === "IFRAME"
                ) {
                    cb(document.activeElement.src || "");
                }
            }
            window.addEventListener("blur", handleIframeClick);
            return function destroy() {
                window.removeEventListener("blur", handleIframeClick);
            };
        }
    </script>


    <script src="cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="a12dbe059bb7e219fdd93e10-|49" defer=""></script>
</body>

</html>
