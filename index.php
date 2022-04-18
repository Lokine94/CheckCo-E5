<?php
session_start();
// Retour registration https://www.checkco.fr/index.php?email=xxxxxxxxxx&key=xxxxxxxx
if (isset($_GET['email']) && isset($_GET['key'])) {

    $email = htmlspecialchars($_GET['email']);
    $key = htmlspecialchars($_GET['key']);

    require_once('connexionMysqlCheck.php');
    if ($connected) {
        require_once('connexionMysql.php');
        $query1 = "SELECT user_id FROM users WHERE email_login = '" . $email . "' AND activ_code = '" . $key . "'";
        $res1 = mysqli_query($connexion, $query1);

        if (mysqli_num_rows($res1) > 0) {
            while ($enreg = mysqli_fetch_array($res1)) {

                $user_id = $enreg['user_id'];
                $query2 = "UPDATE users SET statuts=1, activ_code = ' ' WHERE user_id='" . $user_id . "'";
                $res2 = mysqli_query($connexion, $query2);
                header("Location: activationcpte.php");
            }
        }
    }
}
?>
<!DOCTYPE html>

<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CheckCo</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/all.min.css">
        <link rel="stylesheet" href="assets/css/select2.min.css">
        <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="stylesheet" href="assets/css/style-cookie-aut.css">
        <link rel="stylesheet" href="assets/css/leaflet.css">
        <link rel="stylesheet" href="assets/css/leaflet.fullscreen.css" />

        <link rel="apple-touch-icon" href="assets/images/Checkcoicon629.png">
        <link rel="apple-touch-icon" sizes="57x57" href="assets/images/apple-touch-icon-57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="assets/images/apple-touch-icon-60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="assets/images/apple-touch-icon-72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="assets/images/apple-touch-icon-76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="assets/images/apple-touch-icon-114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="assets/images/apple-touch-icon-120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="assets/images/apple-touch-icon-144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="assets/images/apple-touch-icon-152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon-180.png">
        <link rel="icon" type="image/png" href="assets/images/apple-touch-icon-32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="assets/images/apple-touch-icon-192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="assets/images/apple-touch-icon-96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="assets/images/apple-touch-icon-16.png" sizes="16x16">
        <link rel="shortcut icon" sizes="144x144" href="assets/images/apple-touch-icon-144.png">
        <meta name="msapplication-square310x310logo" content="assets/images/Checkcoicon629.png">
        <link rel="icon" href="assets/images/favicon.ico">
        <!--<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />-->
        <!--<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />-->

        <script src="assets/js/jquery-3.4.1.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/select2.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="assets/js/timepicker.min"></script>
        <script src="assets/js/leaflet.js"></script>
        <script src="assets/js/Leaflet.fullscreen.js"></script>
        <script src="assets/js/Leaflet.fullscreen.min.js"></script>

        <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALQySfwpcsjG8CwVSzc6ujjy3CMXV29cg"></script>-->
        <!--<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>-->
        <!--<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>-->
        <!--<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>-->

    </head>

    <body>
        <header>
            <div class="container-fluid">
                <div class="row align-items-center">


                    <!--                    <div class="col-md-3">
<a class="logo" href="index.php">
<img src="/assets/images/CheckCologo.svg" alt="">
</a>
</div>
<div class="col-md-6">
<div class="header-search mx-auto">
<form action="index.php" method="get">
<input id="tag" name="tag" type="text" placeholder="Que cherchez vous ?" class="field1">
<div class="search-nearby position-relative">
<input id="ville" name="ville" type="text" placeholder="Ville ou CP">
</div>
<button type="submit" class="search-icon">
<svg enable-background="new 0 0 515.558 515.558" viewBox="0 0 515.558 515.558" xmlns="http://www.w3.org/2000/svg">
<path d="m378.344 332.78c25.37-34.645 40.545-77.2 40.545-123.333 0-115.484-93.961-209.445-209.445-209.445s-209.444 93.961-209.444 209.445 93.961 209.445 209.445 209.445c46.133 0 88.692-15.177 123.337-40.547l137.212 137.212 45.564-45.564c0-.001-137.214-137.213-137.214-137.213zm-168.899 21.667c-79.958 0-145-65.042-145-145s65.042-145 145-145 145 65.042 145 145-65.043 145-145 145z" />
</svg>
</button>
</form>
</div>
</div>
<div class="col-md-3">
<div class="header-btns d-flex justify-content-end align-items-center">
<span id="user-name"></span>
<a href="#" class="header-user">
<i class="fas fa-bars"></i>
<img src="assets/images/user.png" alt="">
</a>
</div>
</div> -->

                    <div class="col-md-1">
                        <div class="header-btns d-flex justify-content-end align-items-center">
                            <a href="#" class="header-user">
                                <i class="fas fa-bars"></i>
                                <img src="assets/images/user.png" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="col-md-2">       
                        <span id="user-name"></span>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="header-search mx-auto">
                            <form action="index.php" method="get">
                                <input id="tag" name="tag" type="text" placeholder="Que cherchez vous ?" class="field1">
                                <div class="search-nearby position-relative">
                                    <input id="ville" name="ville" type="text" placeholder="Ville ou CP">
                                </div>
                                <button type="submit" class="search-icon">
                                    <svg enable-background="new 0 0 515.558 515.558" viewBox="0 0 515.558 515.558" xmlns="http://www.w3.org/2000/svg">
                                        <path d="m378.344 332.78c25.37-34.645 40.545-77.2 40.545-123.333 0-115.484-93.961-209.445-209.445-209.445s-209.444 93.961-209.444 209.445 93.961 209.445 209.445 209.445c46.133 0 88.692-15.177 123.337-40.547l137.212 137.212 45.564-45.564c0-.001-137.214-137.213-137.214-137.213zm-168.899 21.667c-79.958 0-145-65.042-145-145s65.042-145 145-145 145 65.042 145 145-65.043 145-145 145z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a class="logo" href="index.php">
                            <img src="/assets/images/CheckCologo.svg" alt="">
                        </a>
                    </div>


                </div>
                <div id='message'></div>
            </div>
        </header>

        <!-- Menu Wrapper -->
        <div class="res-menu-wrapper">
            <div class="res-menu-header">
                <h5 id="info-menu"></h5>
                <a href="#" class="bk-menu">
                    <svg focusable="false" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <g fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M8.3 17l-5-5 5-5M3.2 12h17.6"></path>
                        </g>
                    </svg>
                </a>
            </div>
            <div class="res-menu-area">
                <span>MENU &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" class="close-menu-btn"><i class="fas fa-times"></i></a></span>
                <!-- uy fin ajout -->
                <!-- 17/2/21 uy suppression langue puisqu'il n'y a que le français -->
                <!--            <div class="lang-selector">
<a class="res-lang-btn" href="#">
<i class="fas fa-globe"></i>
Langue
</a>
<div class="lang-menu">
<a class="dropdown-item" href="#">English</a>
<a class="dropdown-item" href="#">Français</a>
</div>
</div> -->
                <!-- uy fin suppression langue -->
                <a href="#" title="" class="regs-btn"><img src="assets/images/user.png" alt="">Inscription Connexion</a>
                <!-- 17/2/21 uy suppression favoris et commentaire pour la 1ère publication  -->
                <a href="#" class="favor-btn" title=""><img src="assets/images/fav-icon.png" alt="">Favoris</a>
                <!--  <a href="#" class="comment-btn" title=""><img src="assets/images/comment-icon.png" alt="">Commentaires</a> -->
                <!-- uy fin suppression favoris commentaire -->
                <!-- ajout fabio 25/03/21 -->
                <a href="#" class="cgu-btn" title=""><img src="assets/images/cgu.png" alt="">CGU - Feedback</a>
                <!-- fin ajout fabio 25/03/21 -->
                <a href="#" class="deconnect" title=""><img src="assets/images/logout.png" alt="">Déconnexion</a>
            </div>
        </div>

        <!-- Responsive Header -->
        <div class="responsive-header">
            <div class="res-logo-area d-flex justify-content-between align-items-center">
                <a class="logo" href="index.php">
                    <img src="assets/images/CheckCologo215.png" alt="">
                </a>
                <a href="#" class="res-menu-btn">
                    <img src="assets/images/menu-btn.png" alt="">
                </a>
            </div>

            <div class="res-filter-bar">
                <div class="res-menu-search">
                    <div class="header-search">
                        <form action="index.php" method="get">
                            <input id="tag_resp" name="tag" type="text" placeholder="Vous cherchez" class="field1">
                            <div class="search-nearby position-relative">
                                <input id="ville_resp" name="ville" type="text" placeholder="Ville ou CP">
                            </div>
                            <button type="submit" class="search-icon">
                                <svg enable-background="new 0 0 515.558 515.558" viewBox="0 0 515.558 515.558" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m378.344 332.78c25.37-34.645 40.545-77.2 40.545-123.333 0-115.484-93.961-209.445-209.445-209.445s-209.444 93.961-209.444 209.445 93.961 209.445 209.445 209.445c46.133 0 88.692-15.177 123.337-40.547l137.212 137.212 45.564-45.564c0-.001-137.214-137.213-137.214-137.213zm-168.899 21.667c-79.958 0-145-65.042-145-145s65.042-145 145-145 145 65.042 145 145-65.043 145-145 145z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div id='message_resp'></div>
                </div>
            </div>
        </div>

        <main>
            <div class="container-fluid p-0">
                <div class="content-container d-lg-flex">
                    <div class="content-display">
                        <div class="store-wrapper">
                            <div class="store-result-title">
                                <h4 class="mb-1">Résultats recommandés pour vous </h4>
                                <div id="enteteres">
                                    <span id="nbres"></span>
                                    <span id="tagres"></span>
                                    <span id="cityres"></span>
                                </div>
                            </div>
                            <div class="store-filter">
                                <div class="filter-select">
                                    <select name="price" id="price" class="critere" multiple="multiple" style="width: 15%;">
                                        <option value="price1">💰</option>
                                        <option value="price2">💰💰</option>
                                        <option value="price3">💰💰💰</option>
                                        <option value="price4">💰💰💰💰</option>
                                        <option value="price5">💰💰💰💰💰</option>
                                    </select>
                                    <select name="notation" id="notation" class="critere" multiple="multiple" style="width: 15%;">
                                        <option value="note1">👍</option>
                                        <option value="note2">👍👍</option>
                                        <option value="note3">👍👍👍</option>
                                        <option value="note4">👍👍👍👍</option>
                                        <option value="note5">👍👍👍👍👍</option>
                                    </select>
                                    <select name="horaires" id="horaires" class="critere" style="width: 15%;">
                                        <option></option>
                                        <option value="open">Ouvert</option>
                                        <!--<option value="openclosed">Fermé</option>-->
                                    </select>
                                    <select name="distance" id="distance" class="critere" style="width: 15%;">
                                        <option></option>
                                        <option value="1km">01 km autour</option>
                                        <option value="2km">02 km autour</option>
                                        <option value="5km">05 km autour</option>
                                        <option value="10km">10 km autour</option>
                                        <!--<option value=">10km">30 km autour</option>-->
                                    </select>
                                </div>
                            </div>
                            <div class="store-filter-result">
                                <div id="container-vignette" class="row">
                                    <div class="block-vignette col-md-4">
                                        <div class="store-item">
                                            <div class="store-img position-relative">
                                                <a href="#" title="" class="view-store"><img id="photovgn" src="assets/images/defaut.jpg"></a>
                                            </div>
                                            <div class="store-info mt-3">
                                                <h4>
                                                    <!-- HERE LIKE-->
                                                    <span class="like-icon" id="like"><i class="fas fa-heart"></i></span>
                                                    <a href="#" title="" id="shoptitle">Boutique André1</a>
                                                </h4>
                                                <p id="shopadrl1" class="mb-0">33 avenue Charles Perraut</p>
                                                <p id="shopadrl2" class="mb-0">06000 Nice</p>
                                                <!--<p id="shopadrl3" class="mb-0"></p>-->

                                                <div class="store-meta">
                                                    <div id='infos'>
                                                        <span id="note"></span>
                                                        <span id="nbavis"></span>
                                                        <span id="pricelev" class="store-price"></span>
                                                        <!--<span id="shopdistance" class="store-distance">10km</span>-->
                                                        <!--<span id="shopid"></span>-->
                                                        <span id="vgn-numero" style="float:right;"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="store-quick-view">
                                                <div class="store-view-wrapper">
                                                    <div class="store-view-content">
                                                        <div class="store-view-img position-relative">
                                                            <!--<img id="photodetail" class="w-pop" src="assets/images/quick-view.jpg" alt="">-->
                                                            <div class="store-view-btns position-absolute">
                                                                <a href="#" title=""><img src="assets/images/heart-icon.png" alt=""></a>
                                                            </div>
                                                            <div class="d-sm-flex align-items-center justify-content-between mb-3">
                                                                <h2 id="shoptitle"></h2>
                                                            </div>
                                                            <a href="#" class="close-view position-absolute"><i class="fas fa-times"></i></a>
                                                        </div>
                                                        <div class="store-view-info">
                                                            <!--<div class="d-sm-flex align-items-center justify-content-between mb-3">
<h4 id="shoptitle" class="mb-0"></h4>
</div>-->
                                                            <p id="shopinfo"></p>
                                                            <div class="store-meta">
                                                                <div class="shop-meta">
                                                                    <span id="note"></span>
                                                                    <span id="nbavis"></span>
                                                                    <span id="pricelev" class="store-price"></span>
                                                                    <!--<span id="shopdistance" class="store-distance"></span>-->
                                                                </div>
                                                            </div>
                                                            <div class="store-detail d-md-flex justify-content-between">
                                                                <ul class="store-contact list-unstyled p-0 m-0">
                                                                    <li>
                                                                        <i class="fas fa-map-marker-alt"></i>
                                                                        <span id="shopadrfull"></span>
                                                                    </li>
                                                                    <li>
                                                                        <i class="fas fa-globe-europe"></i>
                                                                        <a id="shopsite" href="#" title=""></a>
                                                                    </li>
                                                                    <li>
                                                                        <i class="fas fa-phone-alt"></i>
                                                                        <span id="shopphone_1"></span>
                                                                    </li>
                                                                    <li><i class="far fa-clock"></i>
                                                                    </li>

                                                                    <ul class="store-timing list-unstyled p-0 m-0">
                                                                        <!--<li class="d-flex justify-content-between align-items-center">-->

                                                                        <li class="timing d-flex justify-content-between align-items-center">
                                                                            <span class="jour" id="1">Lundi</span>
                                                                            <span class="heure" id="horaire1"></span>
                                                                        </li>
                                                                        <li class="timing d-flex justify-content-between align-items-center">
                                                                            <span class="jour" id="2">Mardi</span>
                                                                            <span class="heure" id="horaire2"></span>
                                                                        </li>
                                                                        <li class="timing d-flex justify-content-between align-items-center">
                                                                            <span class="jour" id="3">Mercredi</span>
                                                                            <span class="heure" id="horaire3"></span>
                                                                        </li>
                                                                        <li class="timing d-flex justify-content-between align-items-center">
                                                                            <span class="jour" id="4">Jeudi</span>
                                                                            <span class="heure" id="horaire4"></span>
                                                                        </li>
                                                                        <li class="timing d-flex justify-content-between align-items-center">
                                                                            <span class="jour" id="5">Vendredi</span>
                                                                            <span class="heure" id="horaire5"></span>
                                                                        </li>
                                                                        <li class="timing d-flex justify-content-between align-items-center">
                                                                            <span class="jour" id="6">Samedi</span>
                                                                            <span class="heure" id="horaire6"></span>
                                                                        </li>
                                                                        <li class="timing d-flex justify-content-between align-items-center">
                                                                            <span class="jour" id="0">Dimanche</span>
                                                                            <span class="heure" id="horaire0"></span>
                                                                        </li>
                                                                    </ul>
                                                                </ul>
                                                            </div>

                                                            <div class="store-comment mt-md-4 mt-sm-3 d-flex justify-content-between align-items-center">
                                                                <div class="store-review">
                                                                    <div class="select-rating-star">
                                                                        <input type="radio" id="star5" name="rating" value="5">
                                                                        <label class="full" for="star5" title="Awesome - 5 stars"></label>

                                                                        <input type="radio" id="star4half" name="rating" value="4 and a half"><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                                                        <input type="radio" id="star4" name="rating" value="4">
                                                                        <label class="full" for="star4" title="Pretty good - 4 stars"></label>

                                                                        <input type="radio" id="star3half" name="rating" value="3 and a half"><label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                                                        <input type="radio" id="star3" name="rating" value="3">
                                                                        <label class="full" for="star3" title="Meh - 3 stars"></label>

                                                                        <input type="radio" id="star2half" name="rating" value="2 and a half"><label class="half" for="star2half" title="OK - 2.5 stars"></label>

                                                                        <input type="radio" id="star2" name="rating" value="2">
                                                                        <label class="full" for="star2" title="Bad - 2 stars"></label>

                                                                        <input type="radio" id="star1half" name="rating" value="1 and a half"><label class="half" for="star1half" title="Bad - 1.5 stars"></label>

                                                                        <input type="radio" id="star1" name="rating" value="1">
                                                                        <label class="full" for="star1" title="Very Bad - 1 star"></label>

                                                                        <input type="radio" id="starhalf" name="rating" value="half">
                                                                        <label class="half" for="starhalf" title="Very Bad - 0.5 stars"></label>
                                                                    </div>
                                                                </div>
                                                                <form class="position-relative">
                                                                    <input type="text" placeholder="Votre commentaire">
                                                                    <button type="submit"><i class="fas fa-paper-plane"></i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="map-display">
                        <div class="store-map">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Favorites -->
        <div class="favor-list card-list">
            <div class="card-header position-relative">
                <a class="card-bk-btn" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12.021" height="12.728" viewBox="0 0 12.021 12.728">
                        <g transform="translate(0.707 0.707)">
                            <g transform="translate(5.657 0) rotate(45)">
                                <line y2="8" transform="translate(0)" fill="none" stroke="#292534" stroke-linecap="round" stroke-width="1" />
                                <line x1="8" transform="translate(0 8)" fill="none" stroke="#292534" stroke-linecap="round" stroke-width="1" />
                            </g>
                        </g>
                    </svg>
                </a>
                <h5 class="mb-0 text-center">Liste des favoris</h5>
            </div>
            <div class="card-content">
                <div class="content-list" id="container-favoris">
                    <!-- TODO: GET REAL LIST -->
                    <div class="block-vignette-favoris">
                        <div class="store-item">
                            <!--          <div class="store-img position-relative">
<a href="#" title="" class="view-store"><img src="assets/images/store2.jpg" id="photovgn" alt=""></a>
<a href="#" class="position-absolute like-icon"><i class="fas fa-heart"></i></a>
</div>
<div class="store-info mt-3">

<h4>
<span class="like-icon selected" id="like"><i class="fas fa-heart"></i></span>
<a href="#" title="" id="shoptitle">Boutique André2</a>
</h4>
<p id="shopadrl1" class="mb-0">33 avenue Charles Perraut</p>
<p id="shopadrl2" class="mb-0">06000 Nice</p>
<p id="shopadrl3" class="mb-0"></p>

<div class="store-meta">
<div id='infos'>
<span id="note"><i id="star" class="fas fa-star"></i>4 </span>
<span id="nbavis">(25)</span>
</div>
</div>
</div>-->
                            <div class="store-img position-relative">
                                <a href="#" title="" class="view-store"><img src="assets/images/pasfavori.png" id="photovgn" alt=""></a>
                                <a href="#" class="position-absolute like-icon"><i class="fas fa-heart"></i></a>
                            </div>
                            <div class="store-info mt-3">
                                <h4>
                                    <span class="like-icon selected" id="like"><i class="fas fa-heart"></i></span>
                                    <a href="#" title="" id="shoptitle"></a>
                                </h4>
                                <p id="shopadrl1" class="mb-0"></p>
                                <p id="shopadrl2" class="mb-0"></p>
                                <p id="shopadrl3" class="mb-0"></p>
                                <div class="store-meta">
                                    <div id='infos'>
                                        <span id="note"><i id="star" class="fas fa-star"></i></span>
                                        <span id="nbavis"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="store-quick-view">
                                <div class="store-view-wrapper">
                                    <div class="store-view-content">
                                        <div class="store-view-img position-relative">
                                            <img src="assets/images/quick-view.jpg" alt="">
                                            <div class="store-view-btns position-absolute">
                                                <a href="#" title=""><img src="assets/images/heart-icon.png" alt=""></a>
                                                <a href="#" title=""><img src="assets/images/icon2.png" alt=""></a>
                                            </div>
                                            <a href="#" class="close-view position-absolute"><i class="fas fa-times"></i></a>
                                        </div>
                                        <div class="store-view-info">
                                            <div class="d-sm-flex align-items-center justify-content-between mb-3">
                                                <h4 id="shoptitle" class="mb-0"></h4>
                                                <div class="store-meta">
                                                    <div>
                                                        <span id="note"><i id="star" class="fas fa-star"></i> </span>
                                                        <span id="nbavis"></span>
                                                        <span id="pricelev" class="store-price"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <p id="shopinfo"></p>
                                            <div class="store-detail justify-content-between">
                                                <ul class="store-contact list-unstyled p-0 m-0">
                                                    <li>
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        <span id="shopdesc"></span>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        <span id="shopadrfull"></span>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-globe-europe"></i>
                                                        <a id="shopsite" href="#" title=""></a>
                                                    </li>
                                                    <li>
                                                        <i class="fas fa-phone-alt"></i>
                                                        <span id="shopphone_1"></span>
                                                    </li>
                                                </ul>
                                                <ul class="store-timing list-unstyled p-0 m-0">
                                                    <li class="d-flex justify-content-between align-items-center">
                                                        <span id="1">Lundi</span>
                                                        <span id="horaire1"></span>
                                                    </li>
                                                    <li class="d-flex justify-content-between align-items-center">
                                                        <span id="2">Mardi</span>
                                                        <span id="horaire2"></span>
                                                    </li>
                                                    <li class="d-flex justify-content-between align-items-center">
                                                        <span id="3">Mercredi</span>
                                                        <span id="horaire3"></span>
                                                    </li>
                                                    <li class="d-flex justify-content-between align-items-center">
                                                        <span id="4">Jeudi</span>
                                                        <span id="horaire4"></span>
                                                    </li>
                                                    <li class="d-flex justify-content-between align-items-center">
                                                        <span id="5">Vendredi</span>
                                                        <span id="horaire5"></span>
                                                    </li>
                                                    <li class="d-flex justify-content-between align-items-center">
                                                        <span id="6">Samedi</span>
                                                        <span id="horaire6"></span>
                                                    </li>
                                                    <li class="d-flex justify-content-between align-items-center">
                                                        <span id="0">Dimanche</span>
                                                        <span id="horaire0"></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- comments -->
        <div class="comments-list card-list">
            <div class="card-header position-relative">
                <a class="card-bk-btn" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12.021" height="12.728" viewBox="0 0 12.021 12.728">
                        <g transform="translate(0.707 0.707)">
                            <g transform="translate(5.657 0) rotate(45)">
                                <line y2="8" transform="translate(0)" fill="none" stroke="#292534" stroke-linecap="round" stroke-width="1" />
                                <line x1="8" transform="translate(0 8)" fill="none" stroke="#292534" stroke-linecap="round" stroke-width="1" />
                            </g>
                        </g>
                    </svg>
                </a>
                <h5 class="mb-0 text-center">Commentaires</h5>
            </div>
            <div class="card-content">
                <div class="content-list">
                    <div class="store-item">
                        <div class="store-comment position-relative">
                            <a href="#" title="" class="view-store">
                                <p id="comment" class="mb-0">Boutique avec plein de nouveautés chaque mois et tendance</p>
                            </a>
                            <a href="#" class="position-absolute like-icon"><img src="assets/images/fav-icon.png" alt=""></a>
                        </div>
                        <div class="store-info mt-3">
                            <div class="store-meta">
                                <div id='infos'>
                                    <span id="note"><i id="star" class="fas fa-star"></i>4 </span>
                                    <span id="nbavis">(25)</span>
                                    <span id="pricelev" class="store-price">€€</span>
                                </div>
                            </div>
                            <h4><a href="#" title="" id="shoptitle">Boutique André3</a></h4>
                            <p id="shopadrl1" class="mb-0">33 avenue Charles Perraut</p>
                            <p id="shopadrl2" class="mb-0">06000 Nice</p>
                            <p id="shopadrl3" class="mb-0"></p>
                            <p id="vgn-numero" style="float:right;">0</p>
                        </div>
                        <div class="store-quick-view">
                            <div class="store-view-wrapper">
                                <div class="store-view-content">
                                    <div class="store-view-img position-relative">
                                        <img src="assets/images/quick-view.jpg" alt="">
                                        <div class="store-view-btns position-absolute">
                                            <a href="#" title=""><img src="assets/images/heart-icon.png" alt=""></a>
                                            <a href="#" title=""><img src="assets/images/icon2.png" alt=""></a>
                                        </div>
                                        <a href="#" class="close-view position-absolute"><i class="fas fa-times"></i></a>
                                    </div>
                                    <div class="store-view-info">
                                        <div class="d-sm-flex align-items-center justify-content-between mb-3">
                                            <h4 id="shoptitle" class="mb-0"></h4>
                                            <div class="store-meta">
                                                <div>
                                                    <span id="note"><i id="star" class="fas fa-star"></i> </span>
                                                    <span id="nbavis"></span>
                                                    <span id="pricelev" class="store-price"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <p id="shopinfo"></p>
                                        <div class="store-detail d-md-flex justify-content-between">
                                            <ul class="store-contact list-unstyled p-0 m-0">
                                                <li>
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <span id="shopadrfull"></span>
                                                </li>
                                                <li>
                                                    <i class="fas fa-globe-europe"></i>
                                                    <a id="shopsite" href="#" title=""></a>
                                                </li>
                                                <li>
                                                    <i class="fas fa-phone-alt"></i>
                                                    <span id="shopphone_1"></span>
                                                </li>
                                            </ul>
                                            <ul class="store-timing list-unstyled p-0 m-0">
                                                <li class="d-flex justify-content-between align-items-center">
                                                    <i class="far fa-clock"></i>
                                                    <span id="1">Lundi</span>
                                                    <span id="horaire1"></span>
                                                </li>
                                                <li class="d-flex justify-content-between align-items-center">
                                                    <span id="2">Mardi</span>
                                                    <span id="horaire2"></span>
                                                </li>
                                                <li class="d-flex justify-content-between align-items-center">
                                                    <span id="3">Mercredi</span>
                                                    <span id="horaire3"></span>
                                                </li>
                                                <li class="d-flex justify-content-between align-items-center">
                                                    <span id="4">Jeudi</span>
                                                    <span id="horaire4"></span>
                                                </li>
                                                <li class="d-flex justify-content-between align-items-center">
                                                    <span id="5">Vendredi</span>
                                                    <span id="horaire5"></span>
                                                </li>
                                                <li class="d-flex justify-content-between align-items-center">
                                                    <span id="6">Samedi</span>
                                                    <span id="horaire6"></span>
                                                </li>
                                                <li class="d-flex justify-content-between align-items-center">
                                                    <span id="0">Dimanche</span>
                                                    <span id="horaire0"></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="store-comment mt-md-4 mt-sm-3 d-flex justify-content-between align-items-center">
                                            <div class="store-review">
                                                <div class="select-rating-star">
                                                    <input type="radio" id="star5" name="rating" value="5">
                                                    <label class="full" for="star5" title="Awesome - 5 stars"></label>

                                                    <input type="radio" id="star4half" name="rating" value="4 and a half"><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                                    <input type="radio" id="star4" name="rating" value="4">
                                                    <label class="full" for="star4" title="Pretty good - 4 stars"></label>

                                                    <input type="radio" id="star3half" name="rating" value="3 and a half"><label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                                    <input type="radio" id="star3" name="rating" value="3">
                                                    <label class="full" for="star3" title="Meh - 3 stars"></label>

                                                    <input type="radio" id="star2half" name="rating" value="2 and a half"><label class="half" for="star2half" title="OK - 2.5 stars"></label>

                                                    <input type="radio" id="star2" name="rating" value="2">
                                                    <label class="full" for="star2" title="Bad - 2 stars"></label>

                                                    <input type="radio" id="star1half" name="rating" value="1 and a half"><label class="half" for="star1half" title="Bad - 1.5 stars"></label>

                                                    <input type="radio" id="star1" name="rating" value="1">
                                                    <label class="full" for="star1" title="Very Bad - 1 star"></label>

                                                    <input type="radio" id="starhalf" name="rating" value="half">
                                                    <label class="half" for="starhalf" title="Very Bad - 0.5 stars"></label>
                                                </div>
                                            </div>
                                            <form class="position-relative">
                                                <input type="text" placeholder="Écrivez votre commentaire ici">
                                                <button type="submit">Envoyer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register -->
        <div class="regsiter-form-card card-list">
            <div class="card-header position-relative">
                <a class="card-bk-btn" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12.021" height="12.728" viewBox="0 0 12.021 12.728">
                        <g transform="translate(0.707 0.707)">
                            <g transform="translate(5.657 0) rotate(45)">
                                <line y2="8" transform="translate(0)" fill="none" stroke="#292534" stroke-linecap="round" stroke-width="1" />
                                <line x1="8" transform="translate(0 8)" fill="none" stroke="#292534" stroke-linecap="round" stroke-width="1" />
                            </g>
                        </g>
                    </svg>
                </a>
                <h5 class="mb-0 text-center">Entrez votre e-mail pour vous inscrire ou voir votre profil</h5>
            </div>
            <div class="card-content">
                <div class="register-form">
                    <form>
                        <input type="email" id="email1" placeholder="Adresse email">
                        <p>L’utilisation de ce site Web implique l’acceptation des Conditions Générales d’Utilisation, sa Politique des Données Personnelles, les conditions de service relatives aux paiements et la Politique de non-discriminations de CheckCo.</p>
                        <button type="button" class="user-confirm">Accepter et continuer</button>
                    </form>
                </div>
            </div>
            <div class='messmenu'></div>
        </div>

        <!-- ajout fabio 25/03/21 -->
        <!-- Conditions générales d'utilisation -->
        <div class="cgu card-list">
            <div class="card-header position-relative">
                <a class="card-bk-btn" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12.021" height="12.728" viewBox="0 0 12.021 12.728">
                        <g transform="translate(0.707 0.707)">
                            <g transform="translate(5.657 0) rotate(45)">
                                <line y2="8" transform="translate(0)" fill="none" stroke="#292534" stroke-linecap="round" stroke-width="1" />
                                <line x1="8" transform="translate(0 8)" fill="none" stroke="#292534" stroke-linecap="round" stroke-width="1" />
                            </g>
                        </g>
                    </svg>
                </a>
                <h5 class="mb-0 text-center">Conditions générales d'utilisation - Feedback</h5>
            </div>
            <div class="card-content">
                <div class="register-form">
                    <div class="pro-user-info">
                        <form>
                            <div class="login-user" id="email_logincgu">
                            </div>
                            <p> </p>
                            <p>ARTICLE 1 - Objet</p>
                            <p>Les présentes « conditions générales d'utilisation » ont pour objet l'encadrement juridique des modalités de mise à disposition des services du site CheckCo et leur utilisation par « l'Utilisateur ».</p>
                            <p> </p>
                            <p>Les conditions générales d'utilisation doivent être acceptées par tout Utilisateur souhaitant accéder au site. Elles constituent le contrat entre le site et l'Utilisateur. L’accès au site par l’Utilisateur signifie son acceptation des présentes conditions générales d’utilisation.</p>
                            <p> </p>
                            <p>En cas de non-acceptation des conditions générales d'utilisation stipulées dans le présent contrat, l'Utilisateur se doit de renoncer à l'achat des services proposés par le site.</p>
                            <p> </p>
                            <p>CheckCo se réserve le droit de modifier unilatéralement et à tout moment le contenu des présentes conditions générales d'utilisation.</p>
                            <p> </p>
                            <p>ARTICLE 2 - Définitions</p>
                            <p>La présente clause a pour objet de définir les différents termes essentiels du contrat :</p>
                            <p> </p>
                            <p>Pour les personnes non majeures les clauses appliquées au client sont appliquées à ses représentants légaux.</p>
                            <p>Utilisateur : ce terme désigne toute personne qui utilise le site ou l'un des services proposés par le site.</p>
                            <p>Contenu utilisateur : ce sont les données transmises par l'Utilisateur au sein du site.</p>
                            <p>Membre : l'Utilisateur devient membre lorsqu'il est identifié sur le site.</p>
                            <p>Identifiant et mot de passe : c'est l'ensemble des informations nécessaires à l'identification d'un Utilisateur sur le site. L'identifiant et le mot de passe permettent à l'Utilisateur d'accéder à des services réservés aux membres du site. Le mot de passe est confidentiel.</p>
                            <p> </p>
                            <p>ARTICLE 3 - Accès aux services</p>
                            <p>Le site permet à l'Utilisateur un accès gratuit aux services suivants :</p>
                            <p> </p>
                            <p>Navigation sur le site CheckCo</p>
                            <p>Mise en relation avec le support par Chat en direct / Mail / Espace client</p>
                            <p>Le site est accessible gratuitement en tout lieu à tout Utilisateur ayant un accès à Internet. Tous les frais supportés par l'Utilisateur pour accéder au service (matériel informatique, logiciels, connexion Internet, etc.) sont à sa charge.</p>
                            <p> </p>
                            <p>Selon le cas :</p>
                            <p> </p>
                            <p>L’Utilisateur non membre n'a pas accès aux services réservés aux membres. Pour cela, il doit s'identifier à l'aide de son identifiant et de son mot de passe.</p>
                            <p> </p>
                            <p>Le site met en œuvre tous les moyens mis à sa disposition pour assurer un accès de qualité à ses services. L'obligation étant de moyens, le site ne s'engage pas à atteindre ce résultat.</p>
                            <p> </p>
                            <p>Tout événement dû à un cas de force majeure ayant pour conséquence un dysfonctionnement du réseau ou des serveurs du site CheckCo n'engage pas la responsabilité de CheckCo.</p>
                            <p> </p>
                            <p>L'accès aux services du site peut à tout moment faire l'objet d'une interruption, d'une suspension, d'une modification sans préavis pour une maintenance, non respect des CGU-CGV ou pour tout autre cas. L'Utilisateur s'oblige à ne réclamer aucune indemnisation suite à l'interruption, à la suspension ou à la modification du présent contrat.</p>
                            <p> </p>
                            <p>ARTICLE 4 - Propriété intellectuelle</p>
                            <p> Les marques, logos, signes et tout autre contenu du site font l'objet d'une protection par le Code de la propriété intellectuelle et plus particulièrement par le droit d'auteur.</p>
                            <p> </p>
                            <p>L'Utilisateur sollicite l'autorisation préalable du site pour toute reproduction, publication, copie des différents contenus.</p>
                            <p> </p>
                            <p>Tout contenu mis en ligne par l'Utilisateur est de sa seule responsabilité. L'Utilisateur s'engage à ne pas mettre en ligne de contenus pouvant porter atteinte aux intérêts de tierces personnes. Tout recours en justice engagé par un tiers lésé contre le site sera pris en charge par l'Utilisateur.</p>
                            <p> </p>
                            <p>Le contenu de l'Utilisateur peut être à tout moment et pour n'importe quelle raison supprimé ou modifié par le site. L'Utilisateur ne reçoit aucune justification et notification préalablement à la suppression ou à la modification du contenu Utilisateur.</p>
                            <p> </p>
                            <p>ARTICLE 5 - Données personnelles</p>
                            <p>Les informations demandées à l’inscription au site sont nécessaires et obligatoires pour la création du compte de l'Utilisateur. En particulier, l'adresse électronique pourra être utilisée par le site pour l'administration, la gestion et l'animation du service.</p>
                            <p> </p>
                            <p>Le site assure à l'Utilisateur une collecte et un traitement d'informations personnelles dans le respect de la vie privée conformément à la loi n°78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers et aux libertés. Le site est déclaré à la CNIL sous le numéro 2151072 v 0.</p>
                            <p> </p>
                            <p>En vertu des articles 39 et 40 de la loi en date du 6 janvier 1978, l'Utilisateur dispose d'un droit d'accès, de rectification, de suppression et d'opposition de ses données personnelles.</p>
                            <p>L'Utilisateur exerce ce droit via :</p>
                            <p> </p>
                            <p>Le formulaire de feedback disponible sur le site dans le menu en sélectionnant CGU - Feedback ;</p>
                            <p> </p>
                            <p>ARTICLE 6 - Responsabilité et force majeure</p>
                            <p>L'Utilisateur s'assure de garder son mot de passe secret. Toute divulgation du mot de passe, quelle que soit sa forme, est interdite.</p>
                            <p> </p>
                            <p>L'Utilisateur assume les risques liés à l'utilisation de son identifiant et mot de passe. Le site décline toute responsabilité.</p>
                            <p> </p>
                            <p>Tout usage du service par l'Utilisateur ayant directement ou indirectement pour conséquence des dommages doit faire l'objet d'une indemnisation au profit du site.</p>
                            <p> </p>
                            <p>Une garantie optimale de la sécurité et de la confidentialité des données transmises n'est pas assurée par le site. Toutefois, le site s'engage à mettre en œuvre tous les moyens nécessaires afin de garantir au mieux la sécurité et la confidentialité des données.</p>
                            <p> </p>
                            <p>La responsabilité du site ne peut être engagée en cas de force majeure ou du fait imprévisible et insurmontable d'un tiers.</p>
                            <p> </p>
                            <p>ARTICLE 7 - Liens hypertextes</p>
                            <p>Le site dispose de quelques liens sortants, cependant les pages web où mènent ces liens n'engagent en rien la responsabilité de CheckCo qui n'a pas le contrôle de ces liens.</p>
                            <p> </p>
                            <p>L'Utilisateur s'interdit donc à engager la responsabilité du site concernant le contenu et les ressources relatives à ces liens sortants.</p>
                            <p> </p>
                            <p>ARTICLE 8 - Évolution du contrat</p>
                            <p>Le site se réserve à tout moment le droit de modifier les clauses stipulées dans le présent contrat.</p>
                            <p> </p>
                            <p> ARTICLE 9 - Durée</p>
                            <p>La durée du présent contrat est indéterminée. Le contrat produit ses effets à l'égard de l'Utilisateur à compter de l'utilisation du service.</p>
                            <p> </p>
                            <p>ARTICLE 10 - Droit applicable et juridiction compétente</p>
                            <p>La législation française s'applique au présent contrat. En cas d'absence de résolution amiable d'un litige né entre les parties, seuls les tribunaux [du ressort de la Cour d'appel de / de la ville de] [Ville] sont compétents.</p>
                            <p> </p>
                            <p>ARTICLE 11 - Acte malveillant</p>
                            <p>Le site CheckCo se réserve le droit d'interrompre le service par une suspension si l'utilisateur effectue des actes illégales ex : Dos, Streaming ... ou met en danger l'infrastructure CheckCo ( Machines, Réseau ... ) Tout actes malveillants qui nous sera donné, se poursuivra par une poursuite judiciaire en vers le client concerné. Le client s'engagera dans ce cas-là à recouvrir la totalité du montant nécessaire à la remise en bon fonctionnement ce qu'il a endommagé.</p>
                            <p> </p>
                            <p>ARTICLE 12 - Prix</p>
                            <p>CheckCo s'accorde le droit de modifier le prix de ses services à tout moment.</p>
                            <p> </p>
                            <p>Tout service actif n'est en aucun cas remboursable.</p>
                            <p> </p>
                            <p>L'Utilisateur est libre de renouveller ou pas son service à sa date anniverssaire.</p>
                            <p> </p>
                            <p>Dans le cas ou une offre change de prix le changement sera effectif pour les service déjà actif.</p>
                            <p> </p>
                            <div class="store-data-fill">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-8">
                                            <span class="extra-feed">Suggestions d'améliorations du site</span>
                                        </div>
                                        <div class="col-4">
                                            <a href="#" class="info-icon">
                                                <img src="assets/images/info-icon.png" alt="">
                                                <div class="smart-info">
                                                    <p>Saisissez vos remarques et améliorations que vous souhaiteriez apportées au site CheckCo</p>
                                                </div>
                                            </a>
                                        </div>
                                        <textarea id="feed"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <button type="submit" class="save-feed">Sauvegarder les suggestions</button>
                    <div class='messmenu'></div>
                </div>
            </div>
        </div>

        <!-- fin ajout fabio 25/03/21 -->

        <!-- Connexion Utilisateur -->
        <div class="regsiter-form-2 card-list">
            <div class="card-header position-relative">
                <a class="card-bk-btn" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12.021" height="12.728" viewBox="0 0 12.021 12.728">
                        <g transform="translate(0.707 0.707)">
                            <g transform="translate(5.657 0) rotate(45)">
                                <line y2="8" transform="translate(0)" fill="none" stroke="#292534" stroke-linecap="round" stroke-width="1" />
                                <line x1="8" transform="translate(0 8)" fill="none" stroke="#292534" stroke-linecap="round" stroke-width="1" />
                            </g>
                        </g>
                    </svg>
                </a>
                <h5 class="user-info mb-0 text-center">Entrez les informations de votre compte</h5>
            </div>
            <div class="card-content">
                <div class="register-form">
                    <form>
                        <div class="form-group">
                            <input type="email" id="email" placeholder="Adresse email" disabled="disabled">
                        </div>
                        <div class="form-group pass-field">
                            <input type="password" id="passInput" placeholder="Mot de passe" disabled="disabled">
                            <label for="passViewL" id="passViewL">Afficher</label>
                        </div>
                        <span id="fiability-pwd" class="pass-strength">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12.888" height="7.5" viewBox="0 0 12.888 7.5">
                                <g transform="translate(0.705 0.705)">
                                    <path d="M27.322,114l4.252,3.675L38.8,111.38" transform="translate(-27.322 -111.38)" fill="none" stroke="#292534" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                </g>
                            </svg>
                            8 caractères alphanumériques dont 1 majuscule
                        </span>
                        <span id="oubli-pwd" class="pass-strength">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12.888" height="7.5" viewBox="0 0 12.888 7.5">
                                <g transform="translate(0.705 0.705)">
                                    <path d="M27.322,114l4.252,3.675L38.8,111.38" transform="translate(-27.322 -111.38)" fill="none" stroke="#292534" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" />
                                </g>
                            </svg>
                            <a href="#" id="pwdoubli" class="theme-color">Mot de passe oublié</a>
                        </span>
                        <button type="button" class="user-check">Se connecter</button>
                        <div class="name-fields">
                            <input type="text" id="prenom" placeholder="Prénom">
                            <input type="text" id="nom" placeholder="Nom">
                        </div>
                        <div id="newpass" class="form-group change-pass pass-field">
                            <input type="password" id="changePass" placeholder="Nouveau mot de passe">
                            <label for="passViewL" id="changeViewL">Afficher</label>
                        </div>
                        <button type="button" class="user-create">Créer un compte</button>
                        <button type="button" class="user-maj">mettre à jour le compte</button>
                        <div></div>
                        <p>L’utilisation de ce site Web implique l’acceptation des Conditions Générales d’Utilisation, sa Politique des Données Personnelles, les conditions de service relatives aux paiements et la Politique de non-discriminations de CheckCo.</p>
                    </form>
                </div>
            </div>
            <div class='messmenu'></div>
        </div>

        <div class="spinner-border text-secondary"></div>
        <!--<a href="#" class="btn-top">top</a>-->
        <a href="#" title="" class="map-btn">Carte<i class="fas fa-map"></i></a>
        <a href="#" title="" class="content-btn">Liste<i class="fas fa-list-ul"></i></a>
        <div id="cookieConsent">Ce site utilise des cookies, <a href="#" target="_blank">en savoir plus</a>.<a class="cookieConsentOK">Accept</a>
        </div>

        <script src="assets/js/script.js"></script>

        <script>
            //let lib_images = '/checkcoV4/assets/images/';
            //let lib_pictures = '/checkcoV4/pictures/';
            let lib_images = 'assets/images/'; // prod
            let lib_pictures = 'pictures/'; // prod
            let lib_pictures2 = 'pictures2/'; // prod
            var nbshopparpage = 51; // nombre de shop par page (21)
            var distancesearch = 20; // Rayon de recherche des boutiques
            var mdpes = '';
            var ides = '';
            let boutique = new Array();
            let liste = new Array();
            let imgicon = new Array();
            var Tmarker = new Array();
            var Tmarkerland = new Array();
            var TinBounds = new Array();
            var TSinBounds = new Array();
            var Tselect = new Array();
            var cpt = 0;
            var existeparam = 0;
            var cookie_email = ' ';
            var cookie_existe = 0;
            var cpte_existe = false;
            var emailenvoye = false;
            var pwdemailenvoye = false;
            var cpte_maj = false;
            var tag = ' ';
            var prix = ' ';
            var notation = ' ';
            var ouverture = ' ';
            var distance = ' ';
            var TUserlocation = new Array();
            var IP = ' ';
            var Userlatitude = 0;
            var Userlongitude = 0;
            var Villelatitude = 0;
            var Villelongitude = 0;
            var Userville = ' ';
            let Tliste = new Array();
            var numpageact = 0;
            var numpagenew = 0;
            var nbpages = 0;
            var nbvignettesaff = 0;

            let ESresponse = {
                "took": 0,
                "timed_out": false,
                "_shards": {
                    "total": 0,
                    "successful": 0,
                    "skipped": 0,
                    "failed": 0
                },
                "hits": {
                    "total": {
                        "value": 0,
                        "relation": " "
                    },
                    "max_score": 0,
                    "hits": [{
                        "_index": " ",
                        "_type": " ",
                        "_id": " ",
                        "_score": 0,
                        "_source": {
                            "full_address": ' ',
                            "city": ' ',
                            "longitude": ' ',
                            "horaire3": ' ',
                            "shop_id": ' ',
                            "notation": ' ',
                            "phone_1": ' ',
                            "zip_code": ' ',
                            "description": ' ',
                            "path": ' ',
                            "horaire6": ' ',
                            "host": ' ',
                            "url": ' ',
                            "phone_2": ' ',
                            "review_nb": ' ',
                            "country": ' ',
                            "title": ' ',
                            "latitude": ' ',
                            "xy": ' ',
                            "message": ' ',
                            "horaire1": ' ',
                            "tags": ' ',
                            "horaire0": ' ',
                            "average_price": ' ',
                            "@version": ' ',
                            "horaire4": ' ',
                            "horaire5": ' ',
                            "horaire2": ' ',
                            "@timestamp": ' ',
                            "column25": ' '
                        }
                    }]
                }
            };
            let user;
            let Tshop = new Array();
            let Tlanding = new Array();
            let TfavoriteShop = new Array();
            let Tphoto = new Array();
            let photo = {
                num: 0,
                shop_id: ' ',
                title: ' ',
                city: ' ',
                numordre: 0
            }
            let menushow = false;
            var IconOn = L.icon({
                iconUrl: lib_images + 'yellow-marker.png'
            });
            var IconOut = L.icon({
                iconUrl: lib_images + 'blue-marker.png'
            });
            var map = {};

            $('.btn-top').addClass('btn-top-hide');
            $('.block-vignette').css("visibility", "hidden");
            $('#enteteres').css("visibility", "hidden");
            $('#pages').css("visibility", "hidden");
            $('#vgn-numero').css("visibility", "hidden");
            $('.spinner-border').hide();

            if ($(window).width() > 1024) {
                $('.store-filter-result').mCustomScrollbar();
                $('#tag').focus();
            } else {
                $('body').mCustomScrollbar();
                $('#tag_resp').focus();
            }

            //-------------- Menu User ------------------------

            $('.res-menu-btn, .header-user').on('click', function() {
                $('.res-menu-wrapper').addClass('show');

                /*$('.res-menu-wrapper').removeClass('show');
            $('body').removeClass('overflow-hid');
            $('body').removeClass('lang-show');
            $('.profile-card-pro').removeClass('show-prfile-pro');
            $('.profile-card').removeClass('show-prfile');
            $('.regsiter-form-2').removeClass('show-regs-2');
            $('.regsiter-form-card').removeClass('show-regs');
            $('.favor-list').removeClass('show-fav');
            $('.comments-list').removeClass('show-comment');*/

            });

            $('.close-menu-btn').on('click', function(e) {
                $('.res-menu-wrapper').removeClass('show');
                e.preventDefault();
            });

            $('.res-lang-btn').on('click', function() {
                $('body').addClass('lang-show');
            });
            $('.bk-menu').on('click', function() {
                $('body').removeClass('lang-show');
            });
            //------------------ Favories -----------------
            $('.favor-btn').on('click', function() {
                affichageFavoris();
                $('body').addClass('overflow-hid');
                $('.favor-list').addClass('show-fav');

            });

            $('.card-bk-btn').on('click', function() {
                $('body').removeClass('overflow-hid');
                $('.favor-list').removeClass('show-fav');
            });

            $('.like-icon').on('click', function(e) {
                console.log("like", e)
            })

            //------------------------ Comments -----------------
            $('.comment-btn').on('click', function() {
                $('body').addClass('overflow-hid');
                $('.comments-list').addClass('show-comment');
            });

            $('.card-bk-btn').on('click', function() {
                $('body').removeClass('overflow-hid');
                $('.comments-list').removeClass('show-comment');
            });

            //---------------- Bouton Map/Liste ---------------------
            $('.map-btn').on('click', function() {
                $('body').addClass('map-show');
            });
            $('.content-btn').on('click', function() {
                $('body').removeClass('map-show');
            });

            /*-------------- Click Btn Top et scroll -------------*/
            $('.btn-top').click(function() {
                $('.store-filter-result').mCustomScrollbar("scrollTo", $('.store-img:first'), {
                    scrollEasing: "easeOutCirc"
                });
            });

            /*------------------ Bannière d'acceptation des cookies */

            /*$(document).ready(function() {
            if (getCookie("checkco") === null) {
                setTimeout(function() {
                    $("#cookieConsent").fadeIn(700);
                }, 1000);
                $(".cookieConsentOK").click(function() {
                    $("#cookieConsent").fadeOut(700);
                    /*$cookie_options = array(
                        'expires' => time() + 60 * 60 * 24 * 30,
                        'path' => '/',
                        'domain' => '.domain.com', // leading dot for compatibility or use subdomain
                        'secure' => true, // or false
                        'httponly' => false, // or false
                        'samesite' => 'None' // None || Lax || Strict
                    );
                    setcookie('checkco', 1, time() + 730 * 24 * 3600, '/', null, false, true);
                   //setcookie('cors-cookie', 'my-site-cookie', $cookie_options);
                });
            }
        });*/

            RechercheConnexion(); // recherche si connexion compte
            ExisteParam(); // Recherche si existance de paramètres url
            AffichageProfileUser();
            AffichageCGU();
            Deconnexion();

            if ($('#ville').val().length == 0) {
                RechercheLocation();
            }

            // get favorites
            $.ajax({
                type: 'GET',
                url: 'getfavorites.php',
                dataType: 'json',
                async: false,
                success: function(resp) {
                    for (var i = 0; i < resp.length; i++) {
                        TfavoriteShop.push(resp[i]);
                    };
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
            // end get favorite

            if (existeparam == 1) { //  recherche de la liste des shops
                RechercheListeBoutique();
            } else { // affichage de la landing page
                RechercheLandingpage();
            }
            /*=============================== Fonctions ==============================================*/

            /*---------- récupération des variables paramètres dans l'url via le serveur */
            function ExisteParam() {

                <?php
                $existe = 0;
                $tag = ' ';
                $ville = ' ';

                if (isset($_GET['tag'])) {
                    $existe = 1;
                    $tag = $_GET['tag'];
                    if (isset($_GET['ville'])) {
                        $ville = $_GET['ville'];
                    }
                }
                ?>
                existeparam = <?php echo "'" . $existe . "'"; ?>;
                tag = <?php echo "'" . $tag . "'"; ?>;
                ville = <?php echo "'" . $ville . "'"; ?>;

                if (existeparam == 1) {
                    $('#tag').val(tag);
                    $('#ville').val(ville);
                    $('#tag_resp').val(tag);
                    $('#ville_resp').val(ville);
                }
            }

            function RechercheConnexion() {

                getCookie('email');

                <?php
                if (isset($_COOKIE['email'])) {
                    if (!empty($_COOKIE['email'])) {
                        $email = $_COOKIE['email']; // email connexion
                        $cexiste = 1;
                    }
                } else {
                    $email = '';
                    $cexiste = 0;
                }
                ?>
                cookie_email = <?php echo "'" . $email . "'"; ?>; // email de connexion
                cookie_existe = <?php echo "'" . $cexiste . "'"; ?>; // connexion O/N

                if (cookie_existe == 1) {

                    var email = cookie_email;
                    data1 = "eml=" + email;
                    $.ajax({
                        type: 'POST',
                        url: 'searchname.php',
                        data: data1,
                        dataType: 'json',
                        success: function(response) {
                            var name = response;
                            nom = name.surname;
                            prenom = name.name;
                            nom = nom.charAt(0).toUpperCase() + nom.slice(1);
                            prenom = prenom.charAt(0).toUpperCase() + prenom.slice(1);
                            $('#user-name').text(prenom + ' ' + nom);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus);
                            console.log(errorThrown);
                        }
                    });

                } else {
                    $('#user-name').text(' ');
                }
                console.log('cookie email ' + cookie_email);
                console.log('cookie existe ' + cookie_existe);
            }

            function Deconnexion() {

                $('.deconnect').on('click', function() {
                    eraseCookie('email');
                    $('#user-name').text(' ');
                    cookie_email = ' ';
                    cookie_existe = 0;
                    $('.res-menu-wrapper').removeClass('show');
                });
            }

            function deletecookie() {
                $.ajax({
                    type: 'POST',
                    url: 'deletecookie.php',
                    dataType: 'text',
                    success: function(response) {},
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                        console.log(errorThrown);
                    },
                    async: false
                });
            }

            function createcookie(email, prenom, nom) {

                eraseCookie('email');
                setCookie('email', email, 1);
                nom = nom.charAt(0).toUpperCase() + nom.slice(1);
                prenom = prenom.charAt(0).toUpperCase() + prenom.slice(1);
                $('#user-name').text(prenom + ' ' + nom);
                cookie_email = email;
                cookie_existe = 1;
            }

            function setCookie(key, value, expiry) {
                var expires = new Date();
                expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
                document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
            }

            function getCookie(key) {
                var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
                return keyValue ? keyValue[2] : null;
            }

            function eraseCookie(key) {
                var keyValue = getCookie(key);
                setCookie(key, ' ', -1);
            }

            function AffichageCGU() {

                $('.cgu-btn').on('click', function() {
                    $('.info-menu').text(' ');
                    $('.messmenu').text(' ');
                    $('#feed').val(' ');
                    $('body').addClass('overflow-hid');
                    $('.cgu').addClass('show-cgu');
                    $('.pro-user-info').addClass('show');
                    $('.pro-user-info').css('display', 'block');
                    $('.cgu').scrollTop(0);

                    if (cookie_existe == 1) {
                        $('#email_logincgu').text(cookie_email);
                    } else {
                        $('#email_logincgu').text('E-mail');
                        $('.messmenu').text('Connectez-vous à votre compte');
                    }
                    console.log('cookie existe ' + cookie_existe);
                    console.log('email ' + $('#email_login').text());
                });

                $('.cgu .card-bk-btn').on('click', function() {
                    $('.save-feed').off('click');
                    $('.messmenu').text(' ');
                    $('#info-menu').text(' ');
                    $('body').removeClass('overflow-hid');
                    $('.cgu').removeClass('show-cgu');
                    $('.pro-user-info').removeClass('show');
                    $('.pro-user-info').css('display', 'none');
                });

                $('.save-feed').on('click', function() {

                    if ($('#feed').val().length < 2) {
                        $('.messmenu').text('renseignez une suggestion');
                        $('.cgu').scrollTop(0);
                    } else {

                        var feed = $('#feed').val().toLowerCase();
                        feed = removespecialchar(feed);
                        feed = encode(feed);

                        var emllog = $('#email_logincgu').text();
                        var data = 'emllog=' + emllog + '&feed=' + feed;

                        feed = {};
                        $.ajax({
                            type: 'POST',
                            url: 'creationfeed.php',
                            data: data,
                            dataType: 'json',
                            success: function(response) {

                                feed = response;
                                console.log('response ', feed);
                                if (feed.maj == true) {
                                    $('.save-feed').off('click');
                                    $('.messmenu').text(' ');
                                    $('#info-menu').text(' ');
                                    $('body').removeClass('overflow-hid');
                                    $('.cgu').removeClass('show-cgu');
                                    $('.pro-user-info').removeClass('show');
                                    $('.pro-user-info').css('display', 'none');
                                    $('#info-menu').text('Vos suggestions ont bien été enregistrées');
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus);
                                console.log(errorThrown);
                            }
                        });
                    }
                });
            }

            function AffichageProfileUser() {

                $('.regs-btn').on('click', function() { // "Inscription / Profile"

                    $('.messmenu').text(' ');
                    $('#email').val('');
                    $('#passInput').val('');
                    $('#nom').val('');
                    $('#prenom').val('');
                    $('#changePass').val('');
                    var nbpwdoubli = 0;

                    document.getElementById('email').disabled = false;
                    document.getElementById('passInput').disabled = false;
                    $('#prenom').css('visibility', 'hidden');
                    $('#nom').css('visibility', 'hidden');
                    $('#newpass').css('visibility', 'hidden');
                    $('#fiability-pwd').css('visibility', 'hidden');
                    $('#oubli-pwd').css('visibility', 'visible');
                    $('.user-check').css('visibility', 'visible');
                    $('.user-create').css('visibility', 'hidden');
                    $('.user-maj').css('visibility', 'hidden');


                    $('body').addClass('overflow-hid');
                    $('.regsiter-form-2').addClass('show-regs-2');

                    $('.user-check').on('click', function() { // "se connecter"

                        if ($('#email').val().length == 0) { // email obligatoire
                            $('.messmenu').text('email obligatoire');
                        } else {

                            user = {};
                            var email = $('#email').val();
                            // ajout Uy pour checker le mdp
                            //                            data = "eml=" + email;
                            var mdp = $('#passInput').val();
                            data = "eml=" + email + "&pwd=" + mdp;
                            // fin ajout Uy
                            $.ajax({
                                type: 'POST',
                                url: 'searchuser.php',
                                data: data,
                                dataType: 'json',
                                success: majCompte,
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }
                            });
                        }
                    });

                    $('#pwdoubli').on('click', function() { // "mot de passe oublié"

                        if ($('#email').val().length == 0) { // email obligatoire
                            $('.messmenu').text('email obligatoire');
                        } else {
                            if (nbpwdoubli > 0) { // email déjà envoyé
                                $('.messmenu').text('Un email avec vos identifiants vous a déjà été transmis');
                            } else { // email pas encore envoyé
                                nbpwdoubli++;
                                data = "eml=" + $('#email').val() + "&pwd=" + ' ' + "&nom=" + ' ' + "&prenom=" + ' ' + "&statut=" + 0;
                                $.ajax({
                                    type: 'POST',
                                    url: 'creationmajcompte.php',
                                    data: data,
                                    dataType: 'json',
                                    success: function(resp) {
                                        user = {};
                                        user = resp;
                                        if (user.existe == false) {
                                            $('.messmenu').text("compte inexistant");
                                        } else {
                                            if (user.emailenvoye == true) {
                                                $('.messmenu').text("Un email rappelant vos identifiants a été envoyé");
                                            }
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.log(textStatus);
                                        console.log(errorThrown);
                                    }
                                });
                            }
                        }
                    });
                });

                // retour menu précédent
                $('.regsiter-form-2 .card-bk-btn').on('click', function() {
                    $('.user-check').off('click');
                    $('.user-maj').off('click');
                    $('.user-create').off('click');
                    $('#pwdoubli').off('click');
                    $('.messmenu').text(' ');
                    $('#info-menu').text(' ');
                    $('body').removeClass('overflow-hid');
                    $('.regsiter-form-2').removeClass('show-regs-2');
                });
            }

            function majCompte(response) {

                $('.messmenu').text('');
                var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/g; // --> /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/g

                user = {};
                user = response;

                if (user.existe == true) { // compte existant

                    if (user.statuts == 0) { // compte non activé => envoi email

                        data = "eml=" + $('#email').val() + "&pwd=" + $('#passInput').val() + "&nom=" + ' ' + "&prenom=" + ' ' + "&statut=" + 0;
                        user = {};
                        objxhr = $.ajax({
                            type: 'POST',
                            url: 'creationmajcompte.php',
                            data: data,
                            dataType: 'json',
                            async: false,
                            success: function(resp) {},
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus);
                                console.log(errorThrown);
                            }
                        });
                        user = JSON.parse(objxhr.responseText);
                        if (user.emailenvoye == true) {
                            $('.messmenu').text("Activez votre compte avec l'email envoyé");
                        }

                    } else { // compte activé

                        if ($('#passInput').val().length == 0) {
                            $('.messmenu').text('mot de passe obligatoire');
                        } else {
                            if (user.passwd != $('#passInput').val()) {
                                $('.messmenu').text('mot de passe incorrect');
                            } else { // login OK => affichage prénom nom password

                                createcookie(user.email_login, user.name, user.surname);
                                document.getElementById('email').disabled = true;
                                document.getElementById('passInput').disabled = true;
                                $('#prenom').css('visibility', 'visible');
                                $('#nom').css('visibility', 'visible');
                                $('#newpass').css('visibility', 'visible');
                                $('.user-check').css('visibility', 'hidden');
                                $('.user-maj').css('visibility', 'visible');

                                $('#nom').val(user.surname);
                                $('#prenom').val(user.name);
                                var mdp = $('#passInput').val();
                                $('#changePass').val(mdp);

                                $('.user-maj').on('click', function() { // "mettre à jour le compte"

                                    $('.user-check').off('click');
                                    if ($('#nom').val() == user.surname && $('#prenom').val() == user.name && $('#changePass').val() == $('#passInput').val()) {
                                        $('.messmenu').text('données identiques');
                                    } else {
                                        var majcpt = false;
                                        if ($('#nom').val().length == 0) {
                                            $('.messmenu').text('nom non renseigné');
                                        } else {
                                            if ($('#prenom').val().length == 0) {
                                                $('.messmenu').text('prénom non renseigné');
                                            } else {
                                                if ($('#changePass').val().length < 8) {
                                                    $('.messmenu').text('longueur mot de passe < 8 caractères');
                                                } else {
                                                    if (!regex.test($('#changePass').val())) {
                                                        $('.messmenu').text('mot de passe non alphanumérique avec 1 maj.');
                                                    } else {
                                                        majcpt = true;
                                                    }
                                                }
                                            }
                                        }

                                    }
                                    if (majcpt == true) { // maj données compte
                                        //console.log("maj compte");

                                        data = "eml=" + $('#email').val() + "&pwd=" + $('#changePass').val() + "&nom=" + $('#nom').val() + "&prenom=" + $('#prenom').val() + "&statut=" + 1;
                                        user = {};
                                        $.ajax({
                                            type: 'POST',
                                            url: 'creationmajcompte.php',
                                            data: data,
                                            dataType: 'json',
                                            async: false,
                                            success: function(response) {
                                                //console.log('retour majcompte');
                                                user = response;
                                                if (user.maj == true) {
                                                    $('.user-check').off('click');
                                                    $('.user-maj').off('click');
                                                    $('.user-create').off('click');
                                                    $('body').removeClass('overflow-hid'); // retour menu principal
                                                    $('.profile-card-pro').removeClass('show-prfile-pro');
                                                    $('.profile-card').removeClass('show-prfile');
                                                    $('.regsiter-form-2').removeClass('show-regs-2');
                                                    $('.regsiter-form-card').removeClass('show-regs');
                                                    $('#info-menu').text('votre compte a été mis à jour');
                                                    nom = user.surname;
                                                    prenom = user.name;
                                                    nom = nom.charAt(0).toUpperCase() + nom.slice(1);
                                                    prenom = prenom.charAt(0).toUpperCase() + prenom.slice(1);
                                                    $('#user-name').text(prenom + ' ' + nom);
                                                }
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                                console.log(textStatus);
                                                console.log(errorThrown);
                                            }
                                        });
                                    } // maj compte ok
                                }); // sauvegarder
                            } // pwd correct
                        } // pwd renseigné

                    } // compte activé
                } else { // compte inexistant

                    $('#oubli-pwd').css('visibility', 'hidden');

                    if (user.email_check == false) {
                        $('.messmenu').text('email incorrect');
                    } else {
                        if ($('#passInput').val().length == 0) {
                            $('.messmenu').text('mot de passe obligatoire');
                        } else {
                            if ($('#passInput').val().length < 8) {
                                $('.messmenu').text('longueur mot de passe < 8 caractères');
                            } else {
                                if (!regex.test($('#passInput').val())) {
                                    $('.messmenu').text('mot de passe non alphanumérique avec 1 maj.');
                                } else { // login OK => affichage prénom nom password

                                    createcookie(user.email_login, user.name, user.surname);
                                    document.getElementById('email').disabled = true;
                                    document.getElementById('passInput').disabled = true;
                                    $('#prenom').css('visibility', 'visible');
                                    $('#nom').css('visibility', 'visible');
                                    $('#fiability-pwd').css('visibility', 'visible');
                                    $('.user-check').css('visibility', 'hidden');
                                    $('.user-create').css('visibility', 'visible');

                                    $('.user-create').on('click', function() { // "créer un compte"

                                        if ($('#prenom').val().length == 0) {
                                            $('.messmenu').text('prénom non renseigné');
                                        } else {
                                            if ($('#nom').val().length == 0) {
                                                $('.messmenu').text('nom non renseigné');
                                            } else {
                                                //console.log("création compte");
                                                $('.user-check').off('click');

                                                data = "eml=" + $('#email').val() + "&pwd=" + $('#passInput').val() + "&nom=" + $('#nom').val() + "&prenom=" + $('#prenom').val() + "&statut=" + 0;
                                                user = {};
                                                $.ajax({
                                                    type: 'POST',
                                                    url: 'creationmajcompte.php',
                                                    data: data,
                                                    dataType: 'json',
                                                    success: function(response) {
                                                        //console.log('retour créationcompte');
                                                        user = response;
                                                        if (user.maj == true) {
                                                            //createcookie($('#email').val());
                                                            $('.user-check').off('click');
                                                            $('.user-maj').off('click');
                                                            $('.user-create').off('click');
                                                            $('body').removeClass('overflow-hid'); // retour menu principal
                                                            $('.profile-card-pro').removeClass('show-prfile-pro');
                                                            $('.profile-card').removeClass('show-prfile');
                                                            $('.regsiter-form-2').removeClass('show-regs-2');
                                                            $('.regsiter-form-card').removeClass('show-regs');
                                                            $('#info-menu').text("votre compte a été créé, activez-le avec l'email envoyé");
                                                            nom = user.surname;
                                                            prenom = user.name;
                                                            nom = nom.charAt(0).toUpperCase() + nom.slice(1);
                                                            prenom = prenom.charAt(0).toUpperCase() + prenom.slice(1);
                                                            $('#user-name').text(prenom + ' ' + nom);
                                                        }
                                                    },
                                                    error: function(jqXHR, textStatus, errorThrown) {
                                                        console.log(textStatus);
                                                        console.log(errorThrown);
                                                    }
                                                });

                                            } // nom non renseigné
                                        } //prénom non renseigné
                                    });
                                } // mot de passe alphanumérique dont 1 majuscule
                            } // mot de passe longueur correct
                        } // password renseigné
                    } // email correct

                } // compte inexistant
            }

            function RechercheLocation() {

                navigator.geolocation.watchPosition(success, error);
            }

            function success(position) {

                Userlatitude = position.coords.latitude;
                Userlongitude = position.coords.longitude;
                console.log('Userlat ' + Userlatitude + ' long ' + Userlongitude);

                var data = 'lat=' + Userlatitude + '&lon=' + Userlongitude;
                objxhr = $.ajax({
                    type: 'POST',
                    url: 'recherchecity.php',
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response) {},
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });

                var coord = JSON.parse(objxhr.responseText);
                if (coord.city != '') {
                    $('#ville').val(coord.city);
                    $('#ville_resp').val(coord.city);
                    $('#message').text(' ');
                }
            }

            function error(err) {
                console.log(err)
            }

            function MajContentScroll(number) {

                if ($(window).width() > 1024) {
                    $('.store-filter-result').mCustomScrollbar("update");
                    $('.store-filter-result').mCustomScrollbar("scrollTo", $('.store-img:first'), {
                        scrollEasing: "easeOutCirc"
                    });
                } else {
                    $('.store-filter-result').mCustomScrollbar("update");
                    $('body').mCustomScrollbar("scrollTo", 0, {
                        scrollEasing: "easeOutCirc"
                    });
                }
            }

            function SurvolVignetteChangeColorMarker() {
                var j = 0;
                var texte = ' ';
                var id = ' ';
                var len = 0;

                $('#container-vignette').children().each(function(index, value) { // changement couleur vignette et marker

                    $(this).mouseover(function() {
                        texte = $(this).find('#vgn-numero').text();
                        j = parseInt(texte);
                        changeMarker(j, "on");
                        $(this).find('#photovgn').css("box-shadow", "3px 3px #F7D362");

                        $(this).mouseout(function() {
                            changeMarker(j, "out");
                            $(this).find('#photovgn').css("box-shadow", "none");
                        });
                    });
                    len = $('.block-vignette').length;
                    if (index == len - 1) { // last element
                        $(this).css("visibility", "hidden");
                    }
                });
            }

            function changeMarker(record_id, type) {
                for (i in Tmarker) {
                    if (Tmarker[i].record_id == record_id) {

                        if (type == "on") {
                            Tmarker[i].setIcon(IconOn)
                        } else {
                            Tmarker[i].setIcon(IconOut)
                        }
                    }
                }
            }

            function compare(a, b) {
                if (a.lgdistance < b.lgdistance) {
                    return -1;
                }
                if (a.lgdistance > b.lgdistance) {
                    return 1;
                }
                return 0;
            }

            function existe(file) {
                var http = new XMLHttpRequest();
                http.open('HEAD', file, false);
                http.send();
                if (http.status == 404) {
                    return false;
                } else {
                    return true;
                }
            }

            function formatTitle(text) {
                text = text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
                if (text.length > 28) {
                    text = text.substring(0, 28);
                }
                return text;
            }

            function imgerror(element, img) {

                $(element).attr('src', lib_images + 'defaut.jpg');
                /*$(element).attr('src', img).on("error", function() {
                $(element).attr('src', lib_images + 'defaut.jpg');
            });*/
            }

            function removeaccents(texte) {
                var str;
                var accents = [
                    /[\300-\306]/g, /[\340-\346]/g, // A, a
                    /[\310-\313]/g, /[\350-\353]/g, // E, e
                    /[\314-\317]/g, /[\354-\357]/g, // I, i
                    /[\322-\330]/g, /[\362-\370]/g, // O, o
                    /[\331-\334]/g, /[\371-\374]/g, // U, u
                    /[\321]/g, /[\361]/g, // N, n
                    /[\307]/g, /[\347]/g, // C, c
                ];
                var chars = ['A', 'a', 'E', 'e', 'I', 'i', 'O', 'o', 'U', 'u', 'N', 'n', 'C', 'c'];

                for (var i = 0; i < accents.length; i++) {
                    str = str.replace(accents[i], chars[i]);
                }
                return str;
            }

            function removespecialchar(string) {
                var str;
                var spechar = ["+", "_", "$", "£", "µ", "%", "§", "<", ">", "`", "@", "^", "¨", "(", ")",
                               "{", "}", "=", ".", ",", ":", ";", "!", "?", "#", "[", "]", "°", "|", "¤",
                              ];
                var char = ['', '', '', '', '', '', '', '', '', '',
                            '', '', '', '', '', '', '', '', '', '',
                            '', '', '', '', '', '', '', '', '', ''
                           ];

                for (var i = 0; i < spechar.length; i++) {
                    string = string.replace(spechar[i], char[i]);
                }
                string = string.replace(/&/g, "");
                string = string.replace(/\*+/g, " ");
                string = string.replace(/,/g, "");
                string = string.replace(/\//g, "");
                string = string.replace(/\\/g, "");
                string = string.replace(/["]+/g, " ");
                return string;
            }
            /*----------------- Recherche symbole price review distance */

            function getprice(number) {
                var symbol = ' ';
                switch (number) {
                    case '1':
                        symbol = '€';
                        break;
                    case '2':
                        symbol = '€€';
                        break;
                    case '3':
                        symbol = '€€€';
                        break;
                    case '4':
                        symbol = '€€€€';
                        break;
                    default:
                        symbol = ' ';
                }
                return symbol;
            }

            function getclassprice(number) {
                var classprice = ' ';
                switch (number) {
                    case '1':
                        classprice = 'price1';
                        break;
                    case '2':
                        classprice = 'price2';
                        break;
                    case '3':
                        classprice = 'price3';
                        break;
                    case '4':
                        classprice = 'price4';
                        break;
                    default:
                        classprice = ' ';
                }
                return classprice;
            }

            // Notation => class = .mauvais / .moyen / .bon / .qualite_note
            function getclassnotation(note) {
                var classnote = ' ';
                var number = parseInt(note);
                var resultnote = Math.trunc(number);
                classnote = 'note' + resultnote;
                return classnote;
            }

            function getdistancelevel(number) {
                var level = 0;
                if (number < 1.6) {
                    level = 1;
                } else if (number < 3.6) {
                    level = 2;
                } else if (number < 7.6) {
                    level = 5;
                } else if (number < 12.6) {
                    level = 10;
                } else {
                    level = 99;
                }
                return level;
            }

            function getlinehoraire(horaire) { // Format = '08:12:14:18' => 08h00 12h00 - 14h00 18h00
                var ligne = ' ';
                var data1 = ' ';
                var data2 = ' ';
                var Thour = horaire.split(':');
                if (parseInt(Thour[0]) != 0 && parseInt(Thour[3]) != 0) {
                    if (parseInt(Thour[0]) < 10) { // 1er nombre
                        data1 = '0' + Thour[0] + ':00';
                    } else {
                        data1 = Thour[0] + ':00';
                    }
                    if (parseInt(Thour[3]) < 10) { // 4ème nombre
                        data2 = '0' + Thour[3] + ':00';
                    } else {
                        data2 = Thour[3] + ':00';
                    }
                    ligne = data1 + ' - ' + data2;
                } else {
                    if (parseInt(Thour[0]) != 0 && parseInt(Thour[1]) != 0) {
                        if (parseInt(Thour[0]) < 10) { // 1er nombre
                            data1 = '0' + Thour[0] + ':00';
                        } else {
                            data1 = Thour[0] + ':00';
                        }
                        if (parseInt(Thour[1]) < 10) { // 4ème nombre
                            data2 = '0' + Thour[1] + ':00';
                        } else {
                            data2 = Thour[1] + ':00';
                        }
                        ligne = data1 + ' - ' + data2;
                    } else {
                        if (parseInt(Thour[2]) != 0 && parseInt(Thour[3]) != 0) {
                            if (parseInt(Thour[2]) < 10) { // 1er nombre
                                data1 = '0' + Thour[2] + ':00';
                            } else {
                                data1 = Thour[2] + ':00';
                            }
                            if (parseInt(Thour[3]) < 10) { // 4ème nombre
                                data2 = '0' + Thour[3] + ':00';
                            } else {
                                data2 = Thour[3] + ':00';
                            }
                            ligne = data1 + ' - ' + data2;
                        } else {
                            ligne = 'Fermé';
                        }
                    }
                }
                return ligne;
            }

            function getshopopening(Tabhour) { // Tableau des lignes horaires au format '08:12:14:18'
                var open = 'closed';
                var heuremin = 0.0;
                var datejour = new Date();
                var jour = datejour.getDay();
                var heures = datejour.getHours();
                var minutes = datejour.getMinutes();
                heuremin = heures + (minutes / 60); // ex: 8,5 h
                var Thour = Tabhour[jour].split(':'); // ligne du jour correspondant à celui de la date du jour
                if (parseInt(Thour[0]) != 0 && parseInt(Thour[3]) != 0) {
                    if (parseInt(Thour[0]) < heuremin && heuremin < parseInt(Thour[3])) {
                        open = 'open';
                    }
                } else {
                    if (parseInt(Thour[0]) != 0 && parseInt(Thour[1]) != 0) {
                        if (parseInt(Thour[0]) < heuremin && heuremin < parseInt(Thour[1])) {
                            open = 'open';
                        }
                    } else {
                        if (parseInt(Thour[2]) != 0 && parseInt(Thour[3]) != 0) {
                            if (parseInt(Thour[2]) < heuremin && heuremin < parseInt(Thour[3])) {
                                open = 'open';
                            }
                        }
                    }
                }
                return open;
            }

            /*------------- Maj du tableau des top visibilité des markers si Modification zoom carte */

            function MajVisibilityMarkers() {

                var LatLngBounds = map.getBounds();
                //console.log("Zoom LatLngBounds ", LatLngBounds);

                for (var i = 0; i < Tmarker.length; i++) {

                    if (LatLngBounds.contains(Tmarker[i].getLatLng()) && Tselect[i] == true) {
                        TinBounds[i] = true;
                        //console.log('Tmarker[' + i + '] ' + Tmarker[i].getLatLng());

                    } else {
                        TinBounds[i] = false;
                    }
                    //console.log("Contains: Tselect[" + i + "] " + Tselect[i] + " TinBounds[" + i + "] " + TinBounds[i]);
                    //console.log("lat " + Tshop[i].latitude + " long " + Tshop[i].longitude);
                }
            }

            /*-------------- On réaffiche la liste des vignettes si modification du zoom de la carte */

            function AffichageVignettesMapChange() {

                $('.spinner-border').show();
                /*------------- Si l'affichage des markers visibles a été modifié : comparaison avant/après  */
                //console.log("Reaffichage avant comparaison");
                //console.log("TS " + TSinBounds);
                //console.log("T " + TinBounds);

                if (TSinBounds.join() != TinBounds.join()) { // Réaffichage vignettes dont markers visibles sur map
                    /* Sauvegarde du tableau des markers visibles O/N  */
                    for (i = 0; i < TinBounds.length; i++) {
                        TSinBounds[i] = TinBounds[i];
                    }

                    /*------ on efface toutes les vignettes sauf la dernière qui est le modèle pour recréer les vignettes */
                    var nbvignettes = $('#container-vignette').children().length - 1;

                    $('#container-vignette').children().not('.block-vignette:last').remove(); // delete all vignettes sauf modèle
                    var pricelev = ' ';
                    var note = ' ';
                    var numordre = 1; // numero ordre vignette dans la page
                    nbvignettesaff = 0;

                    for (let i = 0; i < Tshop.length; i++) {

                        //console.log('i= ' + i + " Marker " + Tmarker[i].record_id + " n° " + Tshop[i].numero + " " + TinBounds[i]);
                        if (TinBounds[i] == true) { // Affichage de la vignette correspondante au marker visible

                            AfficherUneVignette(numordre, i);
                            numordre++; // numero ordre vignette dans la page
                            nbvignettesaff++;

                            //Store Popup
                            $('.store-img').on('click', function() {
                                $(this).parent().addClass('show');
                                $('body').addClass('store-modal');
                            });

                            $('.close-view').on('click', function() {
                                $('.store-item').removeClass('show');
                                $('body').removeClass('store-modal');
                            });

                        } // fin boucle vignette correspondante

                    } // fin boucle for

                    $('.block-vignette:first').appendTo('#container-vignette'); // vignette modèle à la fin des vignettes
                    MajContentScroll(nbvignettesaff);

                } // fin boucle comparaison tableau sauvegarde
                $('.spinner-border').hide();
            }

            function affichageFavoris() {
                $('#container-favoris').children().not('.block-vignette-favoris:last').remove(); // delete all vignettes sauf modèle

                TfavoriteShop = []

                $.ajax({
                    type: 'GET',
                    url: 'getfavorites.php',
                    dataType: 'json',
                    async: false,
                    success: function(resp) {
                        for (var i = 0; i < resp.length; i++) {
                            TfavoriteShop.push(resp[i]);
                        };
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });

                for (let i = 0; i < TfavoriteShop.length; i++) {
                    const shop = TfavoriteShop[i];
                    console.log(shop)
                    $('.block-vignette-favoris:first').clone().insertAfter('.block-vignette-favoris:last').css("visibility", "hidden");
                    $('#container-favoris').children().eq(i).css("visibility", "visible");

                    $('#container-favoris').children().eq(i).find('#shoptitle').text(shop.title);
                    $('#container-favoris').children().eq(i).find('#shopdesc').text(shop.description);
                    $('#container-favoris').children().eq(i).find('#shopadrl1').text(shop.full_address.split(',')[0]);
                    $('#container-favoris').children().eq(i).find('#shopadrl2').text(shop.full_address.split(',')[1]);
                    $('#container-favoris').children().eq(i).find('#shopinfo').text(shop.description);
                    $('#container-favoris').children().eq(i).find('#shopsite').text(shop.url);
                    $('#container-favoris').children().eq(i).find('#horaire0').text(shop.horaire0);
                    $('#container-favoris').children().eq(i).find('#horaire1').text(shop.horaire1);
                    $('#container-favoris').children().eq(i).find('#horaire2').text(shop.horaire2);
                    $('#container-favoris').children().eq(i).find('#horaire3').text(shop.horaire3);
                    $('#container-favoris').children().eq(i).find('#horaire4').text(shop.horaire4);
                    $('#container-favoris').children().eq(i).find('#horaire5').text(shop.horaire5);
                    $('#container-favoris').children().eq(i).find('#horaire6').text(shop.horaire6);
                    $('#container-favoris').children().eq(i).find('#shopphone_1').text(shop.phone_1);
                    // like 
                    $('#container-favoris').children().eq(i).find('#like').on('click', function(e) {
                        const class_list = Array.from(e.currentTarget.classList)
                        const shop_id = shop.shop_id;
                        if (class_list.includes("selected")) {
                            // remove
                            objxhr = $.ajax({
                                type: 'GET',
                                url: 'removefavorites.php?shop_id=' + shop_id,
                                success: function(resp) {

                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }
                            });

                            $(this).removeClass("selected");
                        } else {
                            // add 
                            objxhr = $.ajax({
                                type: 'GET',
                                url: 'addfavorites.php?shop_id=' + shop_id,
                                success: function(resp) {

                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }
                            });

                            $(this).addClass("selected");

                        }
                    });


                    // notation 
                    var notation = shop.notation;
                    if (notation == '0') {
                        notation = ' ';
                    };
                    $('#container-favoris').children().eq(i).find('#note').text(notation);
                    // star
                    $('#container-favoris').children().eq(i).find('i#star').remove();
                    var note = parseInt(Object.values(shop.notation));
                    j = 0;
                    while (j < note) {
                        $('#container-favoris').children().eq(i).find('#note').prepend('<i id="star" class="fas fa-star"></i>');
                        j++;
                    }
                    // nbavis
                    var avistext = ' ';
                    if (shop.review_nb != '0') {
                        avistext = ' (' + shop.review_nb + ')';
                    }
                    $('#container-favoris').children().eq(i).find('#nbavis').text(avistext);


                    var img1 = lib_pictures + shop.shop_id + '.JPG';
                    // var img2 = lib_pictures + Tshop[ind].shop_id + '.PNG';
                    $('#container-favoris').children().eq(i).find('#photovgn').attr('src', img1).on("error", function() {
                        $(this).attr('src', lib_images + 'defaut.jpg');
                        $(this).on('click', function() {
                            console.log("click")
                            $(this).parents(".store-item").addClass("show");
                        })
                    });

                    $('#container-favoris').children().eq(i).find('.close-view').on("click", function() {
                        $(this).parents(".store-item").removeClass("show");
                    });

                    // info 
                    $('#container-favoris').children().eq(i).find("#shopinfo").find('#shopdesc').text(shop.description);

                }


            }

            function RechercheLandingpage() {

                //---------------- Recherche des shops de la landingpage
                $('.spinner-border').show();

                $.ajax({
                    type: 'POST',
                    url: 'landingpage.php',
                    dataType: 'json',
                    success: AffichageLandingpage,
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            }

            function AffichageLandingpage(response) {

                //---------------- Création map -----------------------------

                var Centerlatitude = 46.5132; // 46.871500 46.768196;
                var Centerlongitude = 0.1033; // 1.821778  2.432664;

                map = L.map('map').setView([Centerlatitude, Centerlongitude], 6);

                //map.addControl(new L.Control.Fullscreen());

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    tap: false
                }).addTo(map);

                //----------------------------------------------------------

                var marker;
                var urlmarker = ' ';

                //------------------- Affichage des shops landing page ------------------------*/

                nbvignettesaff = 0;
                Tlanding = response;
                var obj;

                for (var i = 0; i < Tlanding.length; i++) {
                    obj = Tlanding[i];
                    Tshop.push(obj);

                    Tshop[i].shopdistance = ' ';

                    Tshop[i].adrl1 = Tshop[i].full_address.toLowerCase();
                    Tshop[i].adrl1 = Tshop[i].adrl1.replace(/\s*,\s*/g, ' '); // remove comma
                    Tshop[i].adrl1 = Tshop[i].adrl1.replace(/france/gi, ' ');
                    Tshop[i].adrl2 = ' ';
                    Tshop[i].adrl3 = ' ';

                    Tshop[i].horaire = new Array();
                    var Thoraire = new Array();
                    Thoraire[0] = Tshop[i].horaire0;
                    Thoraire[1] = Tshop[i].horaire1;
                    Thoraire[2] = Tshop[i].horaire2;
                    Thoraire[3] = Tshop[i].horaire3;
                    Thoraire[4] = Tshop[i].horaire4;
                    Thoraire[5] = Tshop[i].horaire5;
                    Thoraire[6] = Tshop[i].horaire6;

                    if (Thoraire[0] == '0:0:0:0' && Thoraire[1] == '0:0:0:0' && Thoraire[2] == '0:0:0:0' && Thoraire[3] == '0:0:0:0' && Thoraire[4] == '0:0:0:0' && Thoraire[5] == '0:0:0:0' && Thoraire[6] == '0:0:0:0') {
                        Tshop[i].horaire[0] = ' ';
                        Tshop[i].horaire[1] = ' ';
                        Tshop[i].horaire[2] = ' ';
                        Tshop[i].horaire[3] = ' ';
                        Tshop[i].horaire[4] = ' ';
                        Tshop[i].horaire[5] = ' ';
                        Tshop[i].horaire[6] = ' ';
                        Tshop[i].open = ' ';
                    } else {
                        for (j = 0; j < 7; j++) {
                            Tshop[i].horaire[j] = getlinehoraire(Thoraire[j]); // Format = '08:12:14:18'
                        }
                        Tshop[i].open = getshopopening(Thoraire);
                    }
                    Tshop[i].numero = i + 1;

                    //--------------- Définition des markers et event de la map ----------------------

                    nblat = parseFloat(Tshop[i].latitude);
                    nblong = parseFloat(Tshop[i].longitude);

                    //Tshop[i].review_nb = 26;
                    //Tshop[i].notation = '4.2';
                    //Tshop[i].average_price = '3';

                    var image = Tshop[i].imgid;
                    var title = formatTitle(Tshop[i].title);
                    var adrl1 = Tshop[i].adrl1;
                    var nbavis = ' ';
                    if (Tshop[i].review_nb != 0) {
                        nbavis = ' (' + Tshop[i].review_nb + ')';
                    }
                    var notation = Tshop[i].notation;
                    if (notation == '0') {
                        notation = ' ';
                    };
                    var note = parseInt(Object.values(Tshop[i].notation));
                    var nbstar = '';
                    var j = 0;
                    while (j < note) {
                        nbstar += '<i id="star" class="fas fa-star"></i>';
                        j++;
                    };
                    //var price = getprice(Tshop[i].average_price);
                    var price = parseInt(Object.values(Tshop[i].average_price));
                    var nbprice = ' ';
                    var j = 0;
                    while (j < price) {
                        nbprice += '<i id="dollar" class="fas fa-comment-dollar"></i>';
                        j++;
                    };

                    var num = Tshop[i].numero;

                    var html_code = '<div class="store-item"><div class="store-img position-relative"><img id="photovgn" src="' + image + '"></div><div class="store-info mt-3"><h4>' + title + '</h4><span class="mb-0">' + adrl1 + '</span><div class="store-meta"><div id="infos"><span id="note">' + nbstar + ' ' + notation + '</span><span id="nbavis">' + nbavis + '</span><span id="pricelev" class="store-price">' + nbprice + '</span><span id="vgn-numero" style="float:right;visibility:hidden;">' + num + '</span></div></div></div></div>';

                    var markerLatlong = new L.LatLng(nblat, nblong);
                    var marker = new L.Marker(markerLatlong, {
                        icon: IconOut
                    }).addTo(map)
                    .bindPopup(html_code, {
                        maxWidth: "200",
                        maxHeight: "260"
                    });
                    Tmarker.push(marker);
                    Tmarker[i].record_id = i + 1;

                    TinBounds[i] = true; /* Markers visibles */
                    TSinBounds[i] = true; /* Sauvegarde des Markers visibles */
                    Tselect[i] = true; /* Init Markers sélection critères */

                    marker.on('mouseover', function(e) {
                        e.target.setIcon(IconOn);
                    });
                    marker.on('mouseout', function(e) {
                        e.target.setIcon(IconOut);
                    });
                    //-------------------------------------------------------------------------------

                    AfficherUneVignette(Tshop[i].numero, i);

                    $('.store-img').on('click', function() { //store Popup
                        $(this).parent().addClass('show');
                        $('body').addClass('store-modal');
                    });
                    $('.close-view').on('click', function() {
                        $('.store-item').removeClass('show');
                        $('body').removeClass('store-modal');
                    });
                    nbvignettesaff++;

                } // boucle for

                $('.spinner-border').hide();
                $('.block-vignette:first').appendTo('#container-vignette'); // vignette modèle à la fin des vignettes
                $('#block-map').css("visibility", "visible");
                $('#map').css("visibility", "visible");

                MajContentScroll(nbvignettesaff);
                SurvolVignetteChangeColorMarker();
            }

            function RechercheListeBoutique() {
                var ville = $('#ville').val().replace(/^\s+/, '').replace(/\s+$/, ''); // enlever espaces
                // uy
                ville = ville.normalize('NFD').replace(/[\u0300-\u036f]/g, "");
                // uy
                $('#ville').val(ville);
                $('#ville_resp').val(ville);

                if ($('#ville').val().length == 0) {
                    if ($('#tag').val().length == 0) {
                        $('#message').text('Données de recherche et ville obligatoires');
                        $('#message_resp').text('Données de recherche et ville obligatoires');
                    } else {
                        $('#message').text('Saisissez une ville ou localisez-vous');
                        $('#message_resp').text('Saisissez une ville ou localisez-vous');
                    }
                } else {
                    if ($('#tag').val().length == 0) {
                        $('#message').text('Données de recherche obligatoires');
                        $('#message_resp').text('Données de recherche obligatoires');
                    } else {
                        $('#message').text(' ');
                        $('#message_resp').text(' ');
                        $('.spinner-border').show();

                        data = "tag=" + $('#tag').val();
                        $.ajax({
                            type: 'POST',
                            url: 'requestelastic.php',
                            data: data,
                            dataType: 'json',
                            success: Affichageboutiques,
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus);
                                console.log(errorThrown);
                            }
                        });
                    }
                }
            }

            function Affichageboutiques(response) {

                var Thits = response.hits.hits;
                var score = ' ';
                var obj = {}
                var objxhr = {}
                var resultat = ' ';
                var occord = 0;
                /*---------------- affichage entête résultats ---------------------------*/
                var valeur = ' ';
                // uy nbshopparpage a 51 en erreur remplacé par Tshop.length
                //          valeur = nbshopparpage + ' résultats'; // nombre résultats
                valeur = Tshop.length + ' résultat'; // nombre résultats
                $('#nbres').text(valeur);

                valeur = $('#tag').val(); // Tag résultats
                $('#tagres').text(valeur);
                valeur = $('#ville').val(); // Ville résultats
                $('#cityres').text(valeur);

                /*---------------- Recherche latitude/longitude de la ville -----------------*/

                var data = 'address=' + $('#ville').val();
                objxhr = $.ajax({
                    type: 'POST',
                    url: 'recherchelatlong.php',
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response) {},
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });

                var coord = JSON.parse(objxhr.responseText);
                if (coord.latitude != 0 && coord.longitude != 0) {
                    Villelatitude = coord.latitude;
                    Villelongitude = coord.longitude;
                    $('#ville').val(coord.city);
                    $('#ville_resp').val(coord.city);
                    $('#cityres').text(coord.city);
                }

                console.log('ville lat ' + Villelatitude + ' long ' + Villelongitude);
                $('#enteteres').css("visibility", "visible");

                //---------------- Création map -----------------------------

                var Centerlatitude = Villelatitude;
                var Centerlongitude = Villelongitude;

                map = L.map('map').setView([Centerlatitude, Centerlongitude], 10);

                //map.addControl(new L.Control.Fullscreen());

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    tap: false
                }).addTo(map);

                //----------------------------------------------------------

                var marker;
                var urlmarker = ' ';

                //------------------- Affichage des résultats Elasticsearch ------------------------*/
                var k = 0; // nb shop

                Tphoto = [];
                ThitsShop = [];
                nbvignettesaff = 0;
                $('#container-vignette').children().not('.block-vignette:last').remove(); //delete all vig sauf modèle
                var Reflatitude = 0;
                var Reflongitude = 0;
                if (Villelatitude != 0 && Villelongitude != 0) {
                    Reflatitude = Villelatitude;
                    Reflongitude = Villelongitude;
                } else {
                    if (Userlatitude != 0 && Userlongitude != 0) {
                        Reflatitude = Userlatitude;
                        Reflongitude = Userlongitude;
                    } else {
                        Reflatitude = Centerlatitude;
                        Reflongitude = Centerlongitude;
                    }
                }
                var shoplat = {};
                var shoplong = {};
                var shoplatitude = 0;
                var shoplongitude = 0;
                var distance = 0;

                //------------- Tri des résultats sur la distance ------------------------
                if (Thits.length > 0) {

                    for (var i = 0; i < Thits.length; i++) {
                        score = Thits[i]._score;
                        obj = Thits[i]._source;

                        shoplat = obj.latitude;
                        shoplong = obj.longitude;
                        shoplatitude = parseFloat(shoplat);
                        shoplongitude = parseFloat(shoplong);
                        distance = 0;

                        if (shoplatitude != 0 && shoplongitude != 0) { // on calcule la distance ville-shop
                            distance = getDistance(Reflatitude, Reflongitude, shoplatitude, shoplongitude);
                        }
                        ThitsShop.push(obj);
                        ThitsShop[i].lgdistance = distance;
                    }
                }
                ThitsShop.sort(compare);
                //--------------------------------------------------------------------------

                //if (Thits.length > 0) {
                if (ThitsShop.length > 0) {

                    //for (var i = 0; i < Thits.length; i++) {
                    for (var i = 0; i < ThitsShop.length; i++) {

                        /*score = Thits[i]._score;
                    obj = Thits[i]._source;

                    shoplat = obj.latitude;
                    shoplong = obj.longitude;
                    shoplatitude = parseFloat(shoplat);
                    shoplongitude = parseFloat(shoplong);
                    distance = 0;

                    if (shoplatitude != 0 && shoplongitude != 0) { // on calcule la distance ville-shop
                        distance = getDistance(Reflatitude, Reflongitude, shoplatitude, shoplongitude);
                    }*/

                        var parmdistance = distancesearch + 1;
                        //if (distance < parmdistance && distance != 0) {
                        if (ThitsShop[i].lgdistance < parmdistance && ThitsShop[i].lgdistance != 0) {

                            //Tshop.push(obj);
                            Tshop.push(ThitsShop[i]);

                            //---- inits ---------
                            //Tshop[k].horaire0 = "0:0:0:0";
                            //Tshop[k].horaire1 = "9:12:14:17";
                            //Tshop[k].horaire2 = "8:12:13:17";
                            //Tshop[k].horaire3 = "10:12:0:0";
                            //Tshop[k].horaire4 = "8:12:13:17";
                            //Tshop[k].horaire5 = "8:12:13:17";
                            //Tshop[k].horaire6 = "9:11:0:0";
                            //Tshop[k].url = "www.website.com";
                            //Tshop[k].phone_1 = "01 23 45 58 67";
                            //---- inits ---------

                            Tshop[k].shopdistance = ' ' + Math.floor(Tshop[k].lgdistance) + 'km';
                            Tshop[k].distance = getdistancelevel(Tshop[k].lgdistance); // 0, 1, 2, 5, 10, 99

                            Tshop[k].adrl1 = Tshop[k].full_address.toLowerCase();
                            Tshop[k].adrl1 = Tshop[k].adrl1.replace(/\s*,\s*/g, ' '); // remove comma
                            Tshop[k].adrl1 = Tshop[k].adrl1.replace(/france/gi, ' ');
                            Tshop[k].adrl2 = ' ';
                            Tshop[k].adrl3 = ' ';

                            if (Tshop[k].description == null) {
                                Tshop[k].description = ' ';
                            }
                            if (Tshop[k].url == null) {
                                Tshop[k].url = ' ';
                            }
                            if (Tshop[k].phone_1 == null) {
                                Tshop[k].phone_1 = ' ';
                            }
                            if (Tshop[k].phone_2 == null) {
                                Tshop[k].phone_2 = ' ';
                            }
                            if (Tshop[k].tags == null) {
                                Tshop[k].tags = ' ';
                            }
                            if (Tshop[k].notation == null) {
                                Tshop[k].notation = 0;
                            }
                            if (Tshop[k].review_nb == null) {
                                Tshop[k].review_nb = 0;
                            }
                            if (Tshop[k].average_price == null) {
                                Tshop[k].average_price = 0;
                            }

                            Tshop[k].horaire = new Array();
                            var Thoraire = new Array();
                            Thoraire[0] = Tshop[k].horaire0;
                            Thoraire[1] = Tshop[k].horaire1;
                            Thoraire[2] = Tshop[k].horaire2;
                            Thoraire[3] = Tshop[k].horaire3;
                            Thoraire[4] = Tshop[k].horaire4;
                            Thoraire[5] = Tshop[k].horaire5;
                            Thoraire[6] = Tshop[k].horaire6;

                            if (Thoraire[0] == '0:0:0:0' && Thoraire[1] == '0:0:0:0' && Thoraire[2] == '0:0:0:0' && Thoraire[3] == '0:0:0:0' && Thoraire[4] == '0:0:0:0' && Thoraire[5] == '0:0:0:0' && Thoraire[6] == '0:0:0:0') {
                                Tshop[k].horaire[0] = ' ';
                                Tshop[k].horaire[1] = ' ';
                                Tshop[k].horaire[2] = ' ';
                                Tshop[k].horaire[3] = ' ';
                                Tshop[k].horaire[4] = ' ';
                                Tshop[k].horaire[5] = ' ';
                                Tshop[k].horaire[6] = ' ';
                                Tshop[k].open = ' ';
                            } else {
                                for (j = 0; j < 7; j++) {

                                    Tshop[k].horaire[j] = getlinehoraire(Thoraire[j]); // Format = '08:12:14:18'
                                }
                                Tshop[k].open = getshopopening(Thoraire);
                            }
                            Tshop[k].numero = k + 1;
                            Tshop[k].page = Math.ceil(Tshop[k].numero / nbshopparpage); // arrondi à l'entier sup
                            Tshop[k].score = score;

                            // Recherche des critères et classes associées
                            Tshop[k].classprice = getclassprice(Tshop[k].average_price);
                            Tshop[k].classnotation = getclassnotation(Tshop[k].notation);
                            if (Tshop[k].distance <= 10) {
                                Tshop[k].classdistance = Tshop[k].distance + 'km';
                            } else {
                                Tshop[k].classdistance = '>10km';
                            };
                            //Tshop[k].imgid = lib_pictures + Tshop[k].shop_id + '.JPG';
                            //--------------- Définition des markers et event de la map ----------------------

                            nblat = parseFloat(Tshop[k].latitude);
                            nblong = parseFloat(Tshop[k].longitude);

                            //---- inits ---------
                            //Tshop[k].review_nb = 26;
                            //Tshop[k].notation = '4.2';
                            //Tshop[k].average_price = '4';
                            //Tshop[k].description = 'Boutique de fruits, légumes, graines, noix, épices';
                            //---- inits ---------

                            var title = formatTitle(Tshop[k].title);
                            var adrl1 = Tshop[k].adrl1;
                            var nbavis = ' ';
                            if (Tshop[k].review_nb != '0') {
                                nbavis = ' (' + Tshop[k].review_nb + ')';
                            }
                            var notation = Tshop[k].notation;
                            if (notation == '0') {
                                notation = ' ';
                            };

                            var note = parseInt(Object.values(Tshop[k].notation));
                            var nbstar = '';
                            var j = 0;
                            while (j < note) {
                                nbstar += '<i id="star" class="fas fa-star"></i>';
                                j++;
                            };
                            //var price = getprice(Tshop[k].average_price);
                            var price = parseInt(Object.values(Tshop[k].average_price));
                            var nbprice = '';
                            var j = 0;
                            while (j < price) {
                                nbprice += '<i id="dollar" class="fas fa-comment-dollar"></i>';
                                j++;
                            };

                            var distance = Tshop[k].shopdistance;
                            var num = Tshop[k].numero;

                            var image1 = lib_pictures + Tshop[k].shop_id + '.JPG';
                            var image2 = "'" + lib_pictures + Tshop[k].shop_id + ".JPG'";
                            // onerror="imgerror(this,' + image2 + ')"

                            var html_code = '<div class="store-item"><div class="store-img position-relative"><img id="photovgn" src="' + image1 + '" onerror="imgerror(this)"></div><div class="store-info mt-3"><h4>' + title + '</h4><span class="mb-0">' + adrl1 + '</span><div class="store-meta"><div id="infos"><span id="note">' + nbstar + ' ' + notation + '</span><span id="nbavis">' + nbavis + '</span><span id="pricelev" class="store-price">' + nbprice + '</span><span id="vgn-numero" style="float:right;visibility:hidden;">' + num + '</span></div></div></div></div>';

                            var markerLatlong = new L.LatLng(nblat, nblong);
                            var marker = new L.Marker(markerLatlong, {
                                icon: IconOut
                            }).addTo(map)
                            .bindPopup(html_code, {
                                maxWidth: "200",
                                maxHeight: "260"
                            });
                            Tmarker.push(marker);
                            Tmarker[k].record_id = k + 1;

                            TinBounds[k] = true; /* Markers visibles */
                            TSinBounds[k] = true; /* Sauvegarde des Markers visibles */
                            Tselect[k] = true; /* Init Markers sélection critères / affichés */

                            marker.on('mouseover', function(e) {
                                e.target.setIcon(IconOn);
                            });
                            marker.on('mouseout', function(e) {
                                e.target.setIcon(IconOut);
                            });

                            //------------affichage des premières shop ----------------------------

                            if (k < nbshopparpage) {

                                /*photo = {};
                            photo.num = Tshop[k].numero;
                            photo.shop_id = Tshop[k].shop_id;
                            photo.title = Tshop[k].title;
                            photo.city = Tshop[k].city;
                            photo.numordre = Tshop[k].numero;
                            Tphoto.push(photo);*/
                                //image = lib_pictures + Tshop[k].shop_id + '.JPG';
                                /*if (!existe(image)) {
                                //image = domain + lib_pictures + Tshop[k].shop_id + '.PNG';
                                //if (!existe(image)) {
                                image = lib_images + 'defaut.jpg';
                                //}
                            }*/
                                //Tshop[k].imgid = image;

                                /*html_code = '<div class="store-item"><div class="store-img position-relative"><img id="photovgn" src="' + image + '"></div><div class="store-info mt-3"><h4>' + title + '</h4><span class="mb-0">' + adrl1 + '</span><div class="store-meta"><div id="infos"><span id="note">' + nbstar + ' ' + notation + '</span><span id="nbavis">' + nbavis + '</span><span id="pricelev" class="store-price">' + price + '</span><span id="shopdistance" class="store-distance">' + distance + '</span><span id="vgn-numero" style="float:right;visibility:hidden;">' + num + '</span></div></div></div></div>';
                            Tmarker[k]._popup.setContent(html_code);*/

                                nbvignettesaff++;
                                AfficherUneVignette(Tshop[k].numero, k);

                                $('.store-img').on('click', function() { //store Popup
                                    $(this).parent().addClass('show');
                                    $('body').addClass('store-modal');
                                });
                                $('.close-view').on('click', function() {
                                    $('.store-item').removeClass('show');
                                    $('body').removeClass('store-modal');
                                });

                            } else {
                                map.removeLayer(Tmarker[k]); // suppression du marker sur la map
                                TinBounds[k] = false; // init tableau markers visibles
                                TSinBounds[k] = false;
                                Tselect[k] = false;
                            }
                            k++; // nb shop
                        } // fin if distance < 35km
                    } // fin boucle Thits
                    $('.block-vignette:first').appendTo('#container-vignette'); // vignette modèle à la fin
                    SurvolVignetteChangeColorMarker();

                    //------------affichage des premières shop ----------------------------

                    /*var data = {
                    'json': JSON.stringify(Tphoto)
                };
                $.ajax({
                    type: 'POST',
                    url: 'searchimage.php',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        var Tliste = response;
                        var obj;

                        for (var i = 0; i < Tliste.length; i++) {

                            obj = Tliste[i];
                            Tshop[i].imgid = obj.imgid;
                            Tshop[i].width = obj.width;
                            Tshop[i].height = obj.height;

                            AfficherUneVignette(Tshop[i].numero, i);

                            $('.store-img').on('click', function() { //store Popup
                                $(this).parent().addClass('show');
                                $('body').addClass('store-modal');
                            });
                            $('.close-view').on('click', function() {
                                $('.store-item').removeClass('show');
                                $('body').removeClass('store-modal');
                            });
                        }
                        $('.block-vignette:first').appendTo('#container-vignette'); // vignette modèle à la fin
                        SurvolVignetteChangeColorMarker();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });*/
                    //-------------------------------------------------------------------------------------

                    var valeur = '';
                    if (Tshop.length > nbshopparpage) {
                        valeur = Tshop.length + ' résultats (' + nbshopparpage + ' affichés du + prêt au + loin )'; // nb résultats après recherche distance
                    } else {
                        valeur = Tshop.length + ' résultats';
                    }
                    $('#nbres').text(valeur);

                    $('#block-map').css("visibility", "visible");
                    $('#map').css("visibility", "visible");

                    MajContentScroll(nbvignettesaff);

                    $('.spinner-border').hide();

                } else { // Aucun résultats
                    $('.spinner-border').hide();
                } // Fin boucle résultats

                SurvolVignetteChangeColorMarker();

                /*------------- Maj du tableau des top visibilité des markers si Modification zoom carte */
                map.on('zoomend', function(e) {
                    MajVisibilityMarkers();
                    AffichageVignettesMapChange();
                    SurvolVignetteChangeColorMarker();
                });

                map.on('dragend', function(e) {
                    MajVisibilityMarkers();
                    AffichageVignettesMapChange();
                    SurvolVignetteChangeColorMarker();
                });

                /*-------------- Sélection filtres prix, notation, horaires, distance -------------*/

                $('.critere').change(function() { // Maj critères de sélection du prix

                    $('.spinner-border').show();
                    var valeur = [];
                    // Recherche des valeurs critères de prix sélectionnées
                    valeur = $('#price').val();
                    var Tprice = [];
                    var price = ' ';
                    var length_price = $(":selected", '#price').length;

                    for (j = 0; j < length_price; j++) {
                        price = valeur[j];
                        Tprice.push(price);
                    }
                    // Recherche des valeurs critères de notation sélectionnées
                    valeur = $('#notation').val();
                    var Tnotation = [];
                    var notation = ' ';
                    var length_notation = $(":selected", '#notation').length;

                    for (j = 0; j < length_notation; j++) {
                        notation = valeur[j];
                        Tnotation.push(notation);
                    }
                    // Recherche de la valeur critère d'horaires sélectionnée
                    var valhoraire = false;
                    if ($('#horaires').val()) {
                        valhoraire = true;
                        var horaire = $('#horaires').val();
                    } else {
                        valhoraire = false;
                    }
                    // Recherche de la valeur critère de distance sélectionnée
                    var valdistance = false;
                    var Tdistance = [];
                    if ($('#distance').val()) {
                        valdistance = true;
                        var distance = $('#distance').val();

                        if (distance == '1km') {
                            Tdistance.push('1km');
                        }
                        if (distance == '2km') {
                            Tdistance.push('1km');
                            Tdistance.push('2km');
                        }
                        if (distance == '5km') {
                            Tdistance.push('1km');
                            Tdistance.push('2km');
                            Tdistance.push('5km');
                        }
                        if (distance == '10km') {
                            Tdistance.push('1km');
                            Tdistance.push('2km');
                            Tdistance.push('5km');
                            Tdistance.push('10km');
                        }
                        if (distance == '>10km') {
                            Tdistance.push('1km');
                            Tdistance.push('2km');
                            Tdistance.push('5km');
                            Tdistance.push('10km');
                            Tdistance.push('>10km');
                        }
                    } else {
                        valdistance = false;
                    }

                    map.setZoom(10); // réinitialisation du zoom map
                    $('#container-vignette').children().not('.block-vignette:last').remove(); //delete all vig sauf modèle

                    var numordre = 1; // numero ordre vignette dans la page
                    nbvignettesaff = 0;
                    Tphoto = [];

                    for (i = 0; i < Tshop.length; i++) {

                        if (nbvignettesaff < nbshopparpage) { // affichage des 50 1ères shop
                            Tselect[i] = true;
                            var nbpricetrue = 0;
                            if (length_price >= 1) {
                                if (jQuery.inArray(Tshop[i].classprice, Tprice) !== -1) {
                                    nbpricetrue++; // nb choix price correspondant à la boutique (€, €€, €€€, €€€€)
                                }
                                if (nbpricetrue == 0) {
                                    Tselect[i] = false;
                                }
                            }
                            var nbnotationtrue = 0;
                            if (length_notation >= 1) {
                                if (jQuery.inArray(Tshop[i].classnotation, Tnotation) !== -1) {
                                    nbnotationtrue++; // nb choix notation corresp au shop (*, **, ***, ****, *****)
                                }
                                if (nbnotationtrue == 0) {
                                    Tselect[i] = false;
                                }
                            }
                            var nbhorairetrue = 0;
                            if (valhoraire == true) {
                                if (horaire == 'open') { // Parcours des valeurs Horaires saisies
                                    if (Tshop[i].open == 'open') {
                                        nbhorairetrue++; // nb choix horaires correspondant à la boutique (open, openclosed)
                                    }
                                } else { // openclosed
                                    nbhorairetrue++;
                                }
                                if (nbhorairetrue == 0) {
                                    Tselect[i] = false;
                                }
                            }
                            var nbdistancetrue = 0;
                            if (valdistance == true) {
                                if (jQuery.inArray(Tshop[i].classdistance, Tdistance) !== -1) {
                                    nbdistancetrue++; // nb choix distance du shop (1, 1/2, 1/2/5, 1/2/5/10, 1/2/5/10/>10)
                                }
                                if (nbdistancetrue == 0) {
                                    Tselect[i] = false;
                                }
                            }
                            if (Tselect[i] == true) {

                                photo = {};
                                photo.num = Tshop[i].numero;
                                photo.shop_id = Tshop[i].shop_id;
                                photo.title = Tshop[i].title;
                                photo.city = Tshop[i].city;
                                Tphoto.push(photo);

                                //AfficherUneVignette(numordre, i);

                                map.addLayer(Tmarker[i]); // affichage du marker sur la map
                                TinBounds[i] = true; // init tableau markers visibles
                                TSinBounds[i] = true;
                                numordre++;
                                nbvignettesaff++;
                            } else {
                                map.removeLayer(Tmarker[i]); // suppression du marker sur la map
                                TinBounds[i] = false; // init tableau markers visibles
                                TSinBounds[i] = false;
                            }

                        } else {
                            map.removeLayer(Tmarker[i]); // suppression du marker sur la map
                            TinBounds[i] = false; // init tableau markers visibles
                            TSinBounds[i] = false;
                        }
                        //================================================================

                    } // fin boucle for Tshop

                    //------------affichage des premières shop ----------------------------
                    var indicetab = 0;
                    var data = {
                        'json': JSON.stringify(Tphoto)
                    };
                    $.ajax({
                        type: 'POST',
                        url: 'searchimage.php',
                        data: data,
                        dataType: 'json',
                        success: function(response) {
                            var Tliste = response;
                            var obj;

                            for (var i = 0; i < Tliste.length; i++) {

                                obj = Tliste[i];

                                indtab = obj.num - 1;
                                Tshop[indtab].imgid = obj.imgid;
                                Tshop[indtab].width = obj.width;
                                Tshop[indtab].height = obj.height;

                                AfficherUneVignette(i, indtab); // i : ordre ds la page / indicetab : indice tableau


                                $('.store-img').on('click', function() { //store Popup
                                    $(this).parent().addClass('show');
                                    $('body').addClass('store-modal');
                                });
                                $('.close-view').on('click', function() {
                                    $('.store-item').removeClass('show');
                                    $('body').removeClass('store-modal');
                                });
                            }
                            SurvolVignetteChangeColorMarker();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus);
                            console.log(errorThrown);
                        }
                    });
                    $('.block-vignette:first').appendTo('#container-vignette'); // vignette modèle à la fin
                    MajContentScroll(nbvignettesaff);

                    $('.spinner-border').hide();

                    SurvolVignetteChangeColorMarker();

                }); // fin event choix critères change

            } // fin Affichageboutiques

            function AfficherUneVignette(numero, ind) { // numero = ordre dans la page / ind = indice dans tshop

                $('.block-vignette:first').clone().insertAfter('.block-vignette:last').css("position", "relative");
                $('#container-vignette').children().eq(numero).css("visibility", "visible");


                var notation = Tshop[ind].notation;
                if (notation == '0') {
                    notation = ' ';
                };
                $('#container-vignette').children().eq(numero).find('#note').text(notation);

                $('#container-vignette').children().eq(numero).find('i#dollar').remove();
                var prix = parseInt(Object.values(Tshop[ind].average_price));
                var j = 0;
                var text = '';
                while (j < prix) {
                    text += '<i id="dollar" class="fas fa-comment-dollar"></i>';
                    j++;
                }
                $('#container-vignette').children().eq(numero).find('#pricelev').prepend(text);

                $('#container-vignette').children().eq(numero).find('i#star').remove();
                var note = parseInt(Object.values(Tshop[ind].notation));
                j = 0;
                while (j < note) {
                    $('#container-vignette').children().eq(numero).find('#note').prepend('<i id="star" class="fas fa-star"></i>');
                    j++;
                }
                var avistext = ' ';
                if (Tshop[ind].review_nb != '0') {
                    avistext = ' (' + Tshop[ind].review_nb + ')';
                }

                $('#container-vignette').children().eq(numero).find('#nbavis').text(avistext);

                var opentext = ' ';
                if (Tshop[ind].open == 'closed') {
                    opentext = 'Fermé';
                } else {
                    opentext = 'Ouvert';
                }
                $('#container-vignette').children().eq(numero).find('#open').text(opentext);
                var distancetext = ' ';

                distancetext = Tshop[ind].shopdistance;
                $('#container-vignette').children().eq(numero).find('#shopdistance').text(distancetext);

                var title = formatTitle(Tshop[ind].title);

                $('#container-vignette').children().eq(numero).find('#shoptitle').text(title);

                if (TfavoriteShop.find(s => {
                    return s.shop_id === Tshop[ind].shop_id
                })) {
                    $('#container-vignette').children().eq(numero).find('#like').addClass("selected");
                }

                $('#container-vignette').children().eq(numero).find('#like').on('click', function(e) {
                    const class_list = Array.from(e.currentTarget.classList)
                    const shop_id = Tshop[ind].shop_id;
                    if (class_list.includes("selected")) {
                        // remove
                        objxhr = $.ajax({
                            type: 'GET',
                            url: 'removefavorites.php?shop_id=' + shop_id,
                            success: function(resp) {

                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus);
                                console.log(errorThrown);
                            }
                        });

                        $(this).removeClass("selected");
                    } else {
                        // add 
                        objxhr = $.ajax({
                            type: 'GET',
                            url: 'addfavorites.php?shop_id=' + shop_id,
                            success: function(resp) {

                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus);
                                console.log(errorThrown);
                            }
                        });

                        $(this).addClass("selected");

                    }
                });

                $('#container-vignette').children().eq(numero).find('#shopdesc').text(Tshop[ind].description);
                $('#container-vignette').children().eq(numero).find('#shopadrfull').text(Tshop[ind].full_address);
                $('#container-vignette').children().eq(numero).find('#shopadrl1').text(Tshop[ind].adrl1);
                $('#container-vignette').children().eq(numero).find('#shopadrl2').text(Tshop[ind].adrl2);
                $('#container-vignette').children().eq(numero).find('#shopadrl3').text(Tshop[ind].adrl3);
                $('#container-vignette').children().eq(numero).find('#shopinfo').text(Tshop[ind].description);
                $('#container-vignette').children().eq(numero).find('#shopsite').text(Tshop[ind].url);
                $('#container-vignette').children().eq(numero).find('#horaire1').text(Tshop[ind].horaire[1]);
                $('#container-vignette').children().eq(numero).find('#horaire2').text(Tshop[ind].horaire[2]);
                $('#container-vignette').children().eq(numero).find('#horaire3').text(Tshop[ind].horaire[3]);
                $('#container-vignette').children().eq(numero).find('#horaire4').text(Tshop[ind].horaire[4]);
                $('#container-vignette').children().eq(numero).find('#horaire5').text(Tshop[ind].horaire[5]);
                $('#container-vignette').children().eq(numero).find('#horaire6').text(Tshop[ind].horaire[6]);
                $('#container-vignette').children().eq(numero).find('#horaire0').text(Tshop[ind].horaire[0]);
                $('#container-vignette').children().eq(numero).find('#shopphone_1').text(Tshop[ind].phone_1);
                $('#container-vignette').children().eq(numero).find('#vgn-numero').text(Tshop[ind].numero);

                //------------------------- à modifier - vérif affichage images
                // uy initial debut
                /*var img1 = lib_pictures + Tshop[ind].shop_id + '.JPG';
            var img2 = lib_pictures + Tshop[ind].shop_id + '.PNG';
            $('#container-vignette').children().eq(numero).find('#photovgn').attr('src', img1).on("error", function() {
                $(this).attr('src', lib_images + 'defaut.jpg');
            });*/

                //            var img1 = lib_pictures + Tshop[ind].shop_id + '.JPG';
                //            $('#container-vignette').children().eq(numero).find('#photovgn').attr('src', img1);

                // uy initial fin

                // uy maj debut
                var img1 = lib_pictures + Tshop[ind].shop_id + '.JPG';
                // var img2 = lib_pictures + Tshop[ind].shop_id + '.PNG';
                $('#container-vignette').children().eq(numero).find('#photovgn').attr('src', img1).on("error", function() {
                    $(this).attr('src', lib_images + 'defaut.jpg');
                });

                //            var img1 = lib_pictures + Tshop[ind].shop_id + '.JPG';
                //            $('#container-vignette').children().eq(numero).find('#photovgn').attr('src', img1);

                // uy maj fin
                // mise en bold de la ligne horaire du jour (today ligne)
                var datetoday = new Date();
                var jourtoday = datetoday.getDay();
                var idjour = '#' + jourtoday;
                var idhoraire = '#horaire' + jourtoday;
                $('#container-vignette').children().eq(numero).find(idjour).css("font-weight", "bold");
                $('#container-vignette').children().eq(numero).find(idhoraire).css("font-weight", "bold");

            }

            function getDistance(lat1, lon1, lat2, lon2) {
                var R = 6371; // Radius of the earth in km
                var dLat = deg2rad(lat2 - lat1); // deg2rad below
                var dLon = deg2rad(lon2 - lon1);
                var a =
                    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                var d = R * c; // Distance in km
                return d;
            }

            function deg2rad(deg) {
                return deg * (Math.PI / 180)
            }
        </script>

    </body>

</html>