
<?php
session_start();
require_once('backend/includes/autoload.php');
require_once('backend/includes/constant.php');
$mysqli = new MySqliDriver();
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
	$tution_fees_min = $_POST['hidden_range_1'];
	$tution_fees_max = $_POST['hidden_range_2'];
	$expenses_min = $_POST['hidden_range_3'];
	$expenses_max = $_POST['hidden_range_4'];
	$education_type = $_POST['education_checkbox'];
	$qualification = $_POST['purpose'];
	$exam = strtolower($_POST['exam']);
	if(isset($_POST['purpose']) && ($_POST['purpose'] == '3Year' || $_POST['purpose'] == '4Year')) {

		$gpa = $_POST['bachelors_percentage_input'];
		$board = '';
	} else {
		$gpa = $_POST['grade_percentage_input'];
		$board = $_POST['select_board'];
	}
	
	if(isset($_POST['duo_overall_score']) && $_POST['duo_overall_score'] != '') {
		$overall_score = $_POST['duo_overall_score'];
	}else{
		$overall_score = $_POST['overall_score'];
	}
	if (isset($_POST['exam']) && $_POST['exam'] == 'DUOLINGO') {
		$listening_score = $_POST['duo_listening_score'];
		$reading_score = $_POST['duo_reading_score'];
		$speaking_score = $_POST['duo_speaking_score'];
		$writing_score = $_POST['duo_writing_score'];
		
	} else {
		$listening_score = $_POST['listening_score'];
		$reading_score = $_POST['reading_score'];
		$speaking_score = $_POST['speaking_score'];
		$writing_score = $_POST['writing_score'];
		
	}
}else {
        // Redirect to another page if the form is not submitted
        header('Location: index.php');
        exit();
    }	
	$percentage = $gpa;
	$min_gpa = intval($gpa) - 5;
	$max_gpa = intval($gpa) + 5;
	$min_tution_fees = $tution_fees_min - 5000;
	$max_tution_fees = $tution_fees_max + 5000;
	$min_expenses = $expenses_min - 5000;
	$max_expenses = $expenses_max + 5000;
	 //$con = "qualification = '".$qualification."' AND $exam = '".$overall_score."' AND gpa >= '".$min_gpa."' AND gpa <= '".$max_gpa."' AND  cost_of_living >= '".$min_expenses."' AND cost_of_living <= '".$max_expenses."'"; 
	$con = "(education_type = '".$education_type."' ) AND ($exam = '".$overall_score."' OR $exam = 0 OR $exam = '') AND (qualification = '".$qualification."' OR qualification = '') AND  (gpa >= '".$min_gpa."' AND gpa <= '".$max_gpa."' OR gpa = 0 OR gpa = '') AND (cost_of_tution >= ".$tution_fees_min." AND cost_of_tution <= ".$tution_fees_max." OR cost_of_tution = 0 OR cost_of_tution = '') AND (cost_of_living >= ".$expenses_min." AND cost_of_living <= ".$expenses_max." OR cost_of_living = 0 OR cost_of_living = '')";
	 $sql = "SELECT * FROM ". DATA . " WHERE ". $con ." ORDER BY university_rank ASC"; 
	$result = $mysqli->executeQry($sql);

	$sql123 = "select count(id) as count_rows from " . DATA . " where  " . $con;
	$result123 = $mysqli->executeQry($sql123);
	$num_arr = $mysqli->fetch_array($result123);
	$num = $num_arr['count_rows']; 
	if($num == 0){
		
		$num = 1;
	}else{
		$num = $num;
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Find University</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="vendor/jquery-smartwizard/dist/css/smart_wizard.min.css" rel="stylesheet">
    <link rel="stylesheet" href="backend/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/bd-wizard.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dc.css">
  </head>
  <body>
    <style>
      h1 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        /* Bold */
      }

      p {
        font-family: 'Montserrat', sans-serif;
        font-weight: 400;
        /* Regular */
      }

      body {
        font-family: 'Montserrat', sans-serif;
      }

      .dc-docpostholder {
        position: relative;
      }

      .dc-docpostimg:hover+.login-overlay,
      .login-overlay:hover {
        opacity: 1;
      }

      .login-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        border-radius: 4px;
      }

      .login-form {
        text-align: center;
      }

      .login-form {
        text-align: center;
      }

.badge-danger
{
  color: #fff;
  background-color: #ff4a52 !important;
}   
#resetBtn {
        background-color: #FF4A52;
        color: #fff;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
      }

      button {
        padding: 10px;
        margin: 5px;
        border: none;
        border-radius: 25px;
        cursor: pointer;
      }

      #seeMoreButton {
        padding: 10px;
        margin: 5px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        background-color: #DE1939;
        /* red color */
        color: white;
        transition: background-color 0.3s ease, color 0.3s ease;
      }

      #resetBtn:hover {
        background-color: #000;
      }#seeMoreButton:hover {
        background-color: #000;
      }

      .form-control {
        width: 100% !important;
      }

      .top_rank_uni_card_uni_logo_wrapper__vruFJ {
        position: absolute;
        top: -30px;
        background: #fff;
        border: 1px solid #eff2f5;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        max-width: 115px;
        min-width: 115px;
        height: 60px;
      }
		#preloader {
  position: fixed;
  width: 100%;
  height: 100%;
  z-index: 99999;
  left: 0;
  top: 0;
  background-color: #fff; }

.loader {
  height: 20px;
  width: 250px;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto; }
  .loader--dot {
    animation-name: loader;
    animation-timing-function: ease-in-out;
    animation-duration: 2s;
    animation-iteration-count: infinite;
    height: 20px;
    width: 20px;
    border-radius: 100%;
    background-color: black;
    position: absolute;
    border: 2px solid white; }
    .loader--dot:first-child {
      background-color: #ff4a52;
      animation-delay: 0.5s; }
    .loader--dot:nth-child(2) {
      background-color: #000;
      animation-delay: 0.4s; }
    .loader--dot:nth-child(3) {
      background-color: #ff4a52;
      animation-delay: 0.3s; }
    .loader--dot:nth-child(4) {
      background-color: #000;
      animation-delay: 0.2s; }
    .loader--dot:nth-child(5) {
      background-color: #ff4a52;
      animation-delay: 0.1s; }
    .loader--dot:nth-child(6) {
      background-color: #000;
      animation-delay: 0s; }
  .loader--text {
    position: absolute;
    top: 200%;
    left: 0;
    right: 0;
    width: 4rem;
    margin: auto; }
  .loader:after {
    content: "Loading";
    font-weight: bold;
    top: 30px;
    left: 50%;
    transform: translateX(-50%);
    position: absolute;
    animation-name: loading-text;
    animation-duration: 2s;
    animation-iteration-count: infinite; }

@keyframes loader {
  15% {
    transform: translateX(0); }
  45% {
    transform: translateX(230px); }
  65% {
    transform: translateX(230px); }
  95% {
    transform: translateX(0); } }

@keyframes loading-text {
  0% {
    content: "Loading"; }
  25% {
    content: "Loading."; }
  50% {
    content: "Loading.."; }
  75% {
    content: "Loading..."; } }
olor: #555 !important;
}
    </style>
	<!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <div class="loader--dot"></div>
            <div class="loader--dot"></div>
            <div class="loader--dot"></div>
            <div class="loader--dot"></div>
            <div class="loader--dot"></div>
            <div class="loader--dot"></div>
            <div class="loader--text"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <div id="header" class="transparent_header_off" data-color="">
      <div class="header_top_bar" style="background-color:#0a0a0a">
        <div class="container">
          <div class="clearfix">
            <!-- Header Top bar Login -->
            <div class="pull-right">
              <div class="header_login_url">
                <a href="https://admitletter.com/user-account/">
                  <i class="fa fa-user"></i>Login </a>
                <span class="vertical_divider"></span>
                <a href="https://admitletter.com/user-account/?mode=register">Register</a>
              </div>
            </div>
            <!-- Header top bar Socials -->
            <div class="pull-right">
              <div class="header_top_bar_socs">
                <ul class="clearfix">
                  <li>
                    <a href="https://www.facebook.com/">
                      <i class="fab fa-facebook"></i>
                    </a>
                  </li>
                  <li>
                    <a href="https://www.instagram.com/">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="pull-right xs-pull-left">
              <ul class="top_bar_info clearfix">
                <li>
                  <i class="fa fa-phone"></i> +91 8360 051 494
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="header_default header_default">
        <div class="container">
          <div class="row">
            <div class="col-md-3 col-sm-12 col-xs-12">
              <div class="logo-unit">
                <a href="https://admitletter.com/">
                  <img class="img-responsive logo_transparent_static visible" src="http://admitletter.com/wp-content/uploads/2024/01/Untitled-design-37-e1706525485290.png" style="width: 150px;" alt="Admit Letter">
                </a>
              </div>
              <!-- Navbar toggle MOBILE -->
              <button type="button" class="navbar-toggle collapsed hidden-lg hidden-md" data-toggle="collapse" data-target="#header_menu_toggler">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <!-- md-3 -->
            <!-- MObile menu -->
            <div class="col-xs-12 col-sm-12 visible-xs visible-sm">
              <div class="collapse navbar-collapse header-menu-mobile" id="header_menu_toggler">
                <ul class="header-menu clearfix">
                  <li id="menu-item-51181" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-50547 current_page_item menu-item-51181">
                    <a href="https://admitletter.com/" aria-current="page">Home</a>
                    <div class="magic_line" style="max-width: 0px;"></div>
                  </li>
                  <li id="menu-item-53084" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-53084">
                    <a href="https://admitletter.com/about-us/">About Us</a>
                    <div class="magic_line" style="max-width: 0px;"></div>
                  </li>
                  <li id="menu-item-50265" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-50265">
                    <a href="https://admitletter.com/our-packages/">Our Packages</a>
                    <div class="magic_line" style="max-width: 0px;"></div>
                  </li>
                  <li id="menu-item-50266" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-50266">
                    <a href="#">Find Universities</a>
                    <div class="magic_line" style="max-width: 0px;"></div>
                  </li>
                  <li id="menu-item-52980" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-52980">
                    <a href="https://admitletter.com/study-in-usa/">Study In USA</a>
                    <div class="magic_line" style="max-width: 0px;"></div>
                  </li>
                  <li id="menu-item-53207" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-53207">
                    <a href="https://admitletter.com/contact-us/">Contact Us</a>
                    <div class="magic_line" style="max-width: 0px;"></div>
                  </li>
                  <li>
                    <form role="search" method="get" id="searchform-mobile" action="https://admitletter.com/">
                      <div class="search-wrapper">
                        <input placeholder="Search..." type="text" class="form-control search-input" value="" name="s">
                        <button type="submit" class="search-submit">
                          <i class="fa fa-search"></i>
                        </button>
                      </div>
                    </form>
                    <div class="magic_line" style="max-width: 0px;"></div>
                  </li>
                </ul>
              </div>
            </div>
            <!-- Desktop menu -->
            <div class="col-md-9 col-sm-9 col-sm-offset-0 hidden-xs hidden-sm">
              <div class="stm_menu_toggler" data-text="Menu"></div>
              <div class="header_main_menu_wrapper clearfix" style="margin-top:22px;">
                <div class="pull-right hidden-xs right_buttons">
                  <div class="stm_lms_wishlist_button not-logged-in">
                    <a href="https://admitletter.com/user-account/" data-text="Favorites" style="color: #0a0101;">
                      <i class="far fa-heart mtc_h"></i>
                    </a>
                  </div>
                  <div class="search-toggler-unit" style="margin-left: 78px;">
                    <div class="search-toggler" data-toggle="modal" data-target="#searchModal" style="color: #0a0101; display:none;"></div>
                  </div>
                </div>
                <div class="collapse navbar-collapse pull-right">
                  <ul class="header-menu clearfix">
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-50547 current_page_item menu-item-51181">
                      <a href="https://admitletter.com/" aria-current="page">Home</a>
                      <div class="magic_line line_visible" style="max-width: 45.9px;"></div>
                    </li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-53084">
                      <a href="https://admitletter.com/about-us/">About Us</a>
                      <div class="magic_line" style="max-width: 76.7px;"></div>
                    </li>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-50265">
                      <a href="https://admitletter.com/our-packages/">Our Packages</a>
                      <div class="magic_line" style="max-width: 117.2px;"></div>
                    </li>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-50266">
                      <a href="#">Find Universities</a>
                      <div class="magic_line" style="max-width: 142.317px;"></div>
                    </li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-52980">
                      <a href="https://admitletter.com/study-in-usa/">Study In USA</a>
                      <div class="magic_line" style="max-width: 103.467px;"></div>
                    </li>
                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-53207">
                      <a href="https://admitletter.com/contact-us/">Contact Us</a>
                      <div class="magic_line" style="max-width: 94.683px;"></div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- md-8 desk menu -->
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </div>
    </div>
    <main class=" align-items-center">
      <div class="container">
        <div class="row justify-content-center align-self-center">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
            <div class="dc-sectionhead dc-text-center">
              <div class="dc-sectiontitle margin2">
                <h2> <?php echo $num;?> Relevant <em><?php if($num == 0 ||  $num > 1){echo'Universities';}else{echo'University';}?></em> Found </h2>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"> 
<div>
Applied Filters: 
              <span class="badge badge-danger">Education Type : <?php echo $education_type;?></span>
              <span class="badge badge-danger">Last Qualification : <?php echo $qualification;?></span>
              <span class="badge badge-danger">GPA : <?php echo $gpa.'%';?></span>
              <span class="badge badge-danger">Tution Fees : $<?php echo $_POST['hidden_range_1'];?> - $<?php echo $_POST['hidden_range_2'];?></span>
              <span class="badge badge-danger">Living Expenses : $<?php echo $_POST['hidden_range_3'];?> - $<?php echo $_POST['hidden_range_4'];?></span>
              <span class="badge badge-danger"><?php echo $_POST['exam'];?> Overall Score : <?php echo $overall_score;?></span>
</div>
				<!--<?php //if($num > 0) {?>-->
			 <div class="dc-docfeatured" id="first_data_div">
				
              <div class="row"> <?php
                $counter = 0;
                while ($rows = $mysqli->fetch_assoc($result)){
                    extract($rows);
				
            ?> <div class="col-md-4">
                  <div class="dc-docpostholder">
                    <a href="#">
                      <figure class="dc-docpostimg">
                        <img loading="lazy" width="" height="" class="dc-image-res" src="images/Massachusetts.jpg" alt="Flores Emily">
                      </figure>
                    </a>
                    <div class="dc-docpostcontent" style="min-height: 219px;">
                      <a class="top_rank_uni_card_uni_logo_wrapper__vruFJ" href="#">
                        <span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
                          <span style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
                            <img style="display:block;max-width:100%;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0" alt="" aria-hidden="true" src="data:image/svg+xml,%3csvg%20
																														xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%2792%27%20height=%2737%27/%3e">
                          </span>
                          <img alt="University Logo" src="images/Harvard-University-Logo-c73cc2ce-21d3-47d5-9871-ab0f257abf96.png" decoding="async" data-nimg="intrinsic" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: medium; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;" srcset="images/Harvard-University-Logo-c73cc2ce-21d3-47d5-9871-ab0f257abf96.png">
                          <noscript>
                            <img alt="University Logo" srcSet="images/Harvard-University-Logo-c73cc2ce-21d3-47d5-9871-ab0f257abf96.png" decoding="async" data-nimg="intrinsic" style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%" loading="lazy" />
                          </noscript>
                        </span>
                      </a>
                      <div class="top_rank_uni_card_uni_rank__icLc_" style="position: absolute;right: 20px;top: 10px;font-size: 16px;font-weight: 500;color: #219653;">Rank:
                        <!-- -->#
                        <!-- --> <?php if($university_rank > 0){echo $university_rank;}else{echo 'N/A';}?>
                        <!-- -->
                      </div>
                      <div class="dc-title">
                        <div class="dc-doc-specilities-tag">
                          <a class="top_rank_uni_card_uni_name__yRzcW" href="#"> <?php echo $name;?> </a>
                          <ul class="dc-docinfo">
                            <li>
                              <em>
                                <i class="fa fa-hourglass-half" style="color: #f1c40f;"></i> University TAT : <?php if($uni_tat > 0){echo $uni_tat;}else{echo'N/A';}?> </em>
                            </li>
                          </ul>
                          <ul class="dc-docinfo">
                            <li>
                              <em>
                                <i class="fa fa-check-circle" style="color: #f1c40f;"></i> Acceptance Rate : <?php if($acceptance_rate > 0){echo $acceptance_rate.'%';}else{echo'N/A';}?> </em>
                            </li>
                          </ul>
                          <ul class="dc-docinfo">
                            <li>
                              <em>
                                <i class="fa fa-file-text" style="color: #f1c40f;"></i> Extra Test Required : <?php echo $extra_test;?> </em>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> <?php
                    $counter++;
					if (!(isset($_SESSION['show_all']) && $_SESSION['show_all'] == '1')) {
                    if ($num > 2 && $counter == 2) {
                        // Display the blurred div after the second record if there are more than 2 records
                ?> <div class="col-md-4" id="blur_div">
                  <div class="dc-docpostholder">
                    <figure class="dc-docpostimg">
                      <img width="" height="" class="dc-image-res" src="images/blur.png" style="filter: blur(1px);" alt="Flores Emily">
                    </figure>
                    <div class="login-overlay" id="loginOverlay">
                      <div class="login-form">
                        <button type="button" data-target="#dc-loginpopup" data-toggle="modal" id="seeMoreButton">Click to see more</button>
                      </div>
                    </div>
                  </div>
                </div> <?php 
                    break;
                }
				}
            }
			if (!(isset($_SESSION['show_all']) && $_SESSION['show_all'] == '1')) {
				if ($num <= 2) {
					// Display the blurred div after the loop if there are 2 or fewer records
				?> 
					<div class="col-md-4" id="blur_div">
					  <div class="dc-docpostholder">
						<figure class="dc-docpostimg">
						  <img width="" height="" class="dc-image-res" src="images/blur.png" style="filter: blur(1px);" alt="Flores Emily">
						</figure>
						<div class="login-overlay" id="loginOverlay">
						  <div class="login-form">
							<button type="button" data-target="#dc-loginpopup" data-toggle="modal" id="seeMoreButton">View More Dream University</button>
						  </div>
						</div>
					  </div>
					</div> <?php 
				}
			}
    ?> </div>
            </div>
			<div class="dc-docfeatured" id="all_data_div">

			</div>
          </div> 
			<?php //}
			//else{?>
				<!---<div class="col-md-12 mt-4">
                                <div class="error-content-box" style="text-align:center;">
                                <img src="images/404.png" alt="404" class="img-fluid">
                                <h2 class="item-title">Sorry! No Result Found</h2>

                                 <button type="button"  id="resetBtn">Reset Filters</button>
                                </div>
                                </div>-->

			<?php //}?>
        </div>
      </div>
    </main>
    <footer itemtype="https://schema.org/WPFooter" itemscope="itemscope" id="colophon" role="contentinfo" style="padding-top: 50px;">
      <div class="footer-width-fixer">
        <div data-elementor-type="wp-post" data-elementor-id="50334" class="elementor elementor-50334" data-elementor-post-type="elementor-hf">
          <section class="elementor-section elementor-top-section elementor-element elementor-element-6b663a71 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="6b663a71" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
              <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-64ce7a45" data-id="64ce7a45" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                  <section class="elementor-section elementor-inner-section elementor-element elementor-element-6522e611 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="6522e611" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-background-overlay"></div>
                    <div class="elementor-container elementor-column-gap-default">
                      <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-43e7f434" data-id="43e7f434" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                          <div class="elementor-element elementor-element-4fe30ebe elementor-widget elementor-widget-heading" data-id="4fe30ebe" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                              <h2 class="elementor-heading-title elementor-size-default">Get exclusive updates and opportunities! </h2>
                            </div>
                          </div>
                          <div class="elementor-element elementor-element-99f725e elementor-widget elementor-widget-text-editor" data-id="99f725e" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                              <p>Subscribe now for the latest insights delivered to your inbox.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-5b87eb1" data-id="5b87eb1" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                          <div class="elementor-element elementor-element-5ce7d13c elementor-widget elementor-widget-jkit_mailchimp" data-id="5ce7d13c" data-element_type="widget" data-widget_type="jkit_mailchimp.default">
                            <div class="elementor-widget-container">
                              <div class="jeg-elementor-kit jkit-mailchimp style-inline jeg_module_50547_7_65b90b84e8dc6">
                                <form method="post" class="jkit-mailchimp-form" data-listed="" data-success-message="Successfully listed this email" data-error-message="Something went wrong">
                                  <div class="jkit-mailchimp-message"></div>
                                  <div class="jkit-form-wrapper email-form">
                                    <div class="jkit-mailchimp-email jkit-input-wrapper input-container">
                                      <div class="jkit-form-group">
                                        <div class="jkit-input-element-container jkit-input-group">
                                          <input type="email" name="email" class="jkit-email jkit-form-control " placeholder="Your Email" required="">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="jkit-submit-input-holder jkit-input-wrapper">
                                      <button type="submit" class="jkit-mailchimp-submit position-before" name="jkit-mailchimp"> Subscribe </button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </div>
          </section>
          <section class="elementor-section elementor-top-section elementor-element elementor-element-198e3c29 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="198e3c29" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
            <div class="elementor-background-overlay"></div>
            <div class="elementor-container elementor-column-gap-default">
              <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-682ac43c" data-id="682ac43c" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                  <section class="elementor-section elementor-inner-section elementor-element elementor-element-176b8de7 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="176b8de7" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                      <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-7aac1968" data-id="7aac1968" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                          <div class="elementor-element elementor-element-cff5831 elementor-widget elementor-widget-heading" data-id="cff5831" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                              <h4 class="elementor-heading-title elementor-size-default">Navigation</h4>
                            </div>
                          </div>
                          <div class="elementor-element elementor-element-8c103cc elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="8c103cc" data-element_type="widget" data-widget_type="icon-list.default">
                            <div class="elementor-widget-container">
                              <ul class="elementor-icon-list-items">
                                <li class="elementor-icon-list-item">
                                  <a href="https://admitletter.com/home-final/">
                                    <span class="elementor-icon-list-text">Home</span>
                                  </a>
                                </li>
                                <li class="elementor-icon-list-item">
                                  <a href="https://admitletter.com/about-us-2/">
                                    <span class="elementor-icon-list-text">About Us</span>
                                  </a>
                                </li>
                                <li class="elementor-icon-list-item">
                                  <a href="https://admitletter.com/home-final/#packages">
                                    <span class="elementor-icon-list-text">Packages</span>
                                  </a>
                                </li>
                                <li class="elementor-icon-list-item">
                                  <a href="https://admitletter.com/study-in-usa/">
                                    <span class="elementor-icon-list-text">Study In USA</span>
                                  </a>
                                </li>
                                <li class="elementor-icon-list-item">
                                  <a href="#">
                                    <span class="elementor-icon-list-text">Blog</span>
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-24389b53" data-id="24389b53" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                          <div class="elementor-element elementor-element-3849e69 elementor-widget elementor-widget-heading" data-id="3849e69" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                              <h4 class="elementor-heading-title elementor-size-default">Quick Links</h4>
                            </div>
                          </div>
                          <div class="elementor-element elementor-element-5d17669e elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="5d17669e" data-element_type="widget" data-widget_type="icon-list.default">
                            <div class="elementor-widget-container">
                              <ul class="elementor-icon-list-items">
                                <li class="elementor-icon-list-item">
                                  <a href="https://admitletter.com/home-final/?preview_id=50547&amp;preview_nonce=6c5aa91ffa&amp;preview=true#">
                                    <span class="elementor-icon-list-text">Find Universities</span>
                                  </a>
                                </li>
                                <li class="elementor-icon-list-item">
                                  <a href="#">
                                    <span class="elementor-icon-list-text">Contact Us</span>
                                  </a>
                                </li>
                                <li class="elementor-icon-list-item">
                                  <a href="#">
                                    <span class="elementor-icon-list-text">Terms &amp; Conditions</span>
                                  </a>
                                </li>
                                <li class="elementor-icon-list-item">
                                  <a href="#">
                                    <span class="elementor-icon-list-text">Privacy Policy</span>
                                  </a>
                                </li>
                                <li class="elementor-icon-list-item">
                                  <a href="#">
                                    <span class="elementor-icon-list-text">Disclaimer</span>
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-6ec348d1" data-id="6ec348d1" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                          <div class="elementor-element elementor-element-5a23acb8 elementor-widget elementor-widget-heading" data-id="5a23acb8" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                              <h4 class="elementor-heading-title elementor-size-default">Contact Us</h4>
                            </div>
                          </div>
                          <div class="elementor-element elementor-element-ee109b5 elementor-widget elementor-widget-google_maps" data-id="ee109b5" data-element_type="widget" data-widget_type="google_maps.default">
                            <div class="elementor-widget-container">
                              <style>
                                /*! elementor - v3.18.0 - 20-12-2023 */
                                .elementor-widget-google_maps .elementor-widget-container {
                                  overflow: hidden
                                }

                                .elementor-widget-google_maps .elementor-custom-embed {
                                  line-height: 0
                                }

                                .elementor-widget-google_maps iframe {
                                  height: 300px
                                }
                              </style>
                              <div class="elementor-custom-embed">
                                <iframe loading="lazy" src="https://maps.google.com/maps?q=B-Block%2C%20BHIVE%20Workspace%20-%20No.112%2C%20AKR%20Tech%20Park%2C%20%22A%22%20and%2C%207th%20Mile%20Hosur%20Rd%2C%20Krishna%20Reddy%20Industrial%20Area%2C%20Bengaluru%2C%20Karnataka%20560068&amp;t=m&amp;z=10&amp;output=embed&amp;iwloc=near" title="B-Block, BHIVE Workspace - No.112, AKR Tech Park, &quot;A&quot; and, 7th Mile Hosur Rd, Krishna Reddy Industrial Area, Bengaluru, Karnataka 560068" aria-label="B-Block, BHIVE Workspace - No.112, AKR Tech Park, &quot;A&quot; and, 7th Mile Hosur Rd, Krishna Reddy Industrial Area, Bengaluru, Karnataka 560068"></iframe>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                  <section class="elementor-section elementor-inner-section elementor-element elementor-element-079ab9b elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="079ab9b" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}" style="margin-top: -120px;">
                    <div class="elementor-container elementor-column-gap-default">
                      <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-c6e9155" data-id="c6e9155" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                          <div class="elementor-element elementor-element-6d20f75 elementor-widget elementor-widget-image" data-id="6d20f75" data-element_type="widget" data-widget_type="image.default">
                            <div class="elementor-widget-container">
                              <img loading="lazy" width="3374" height="3374" src="https://admitletter.com/wp-content/uploads/2024/01/Bhavika-Logo-Admitletter.com-color-palette-Sample-creative-3-3374x3374.png" class="attachment-full size-full wp-image-53136" alt="" decoding="async" srcset="https://admitletter.com/wp-content/uploads/2024/01/Bhavika-Logo-Admitletter.com-color-palette-Sample-creative-3-3374x3374.png 3374w, https://admitletter.com/wp-content/uploads/2024/01/Bhavika-Logo-Admitletter.com-color-palette-Sample-creative-3-e1706593018816-150x150.png 150w, https://admitletter.com/wp-content/uploads/2024/01/Bhavika-Logo-Admitletter.com-color-palette-Sample-creative-3-e1706593018816-75x75.png 75w, https://admitletter.com/wp-content/uploads/2024/01/Bhavika-Logo-Admitletter.com-color-palette-Sample-creative-3-e1706593018816-129x129.png 129w, https://admitletter.com/wp-content/uploads/2024/01/Bhavika-Logo-Admitletter.com-color-palette-Sample-creative-3-e1706593018816-69x69.png 69w, https://admitletter.com/wp-content/uploads/2024/01/Bhavika-Logo-Admitletter.com-color-palette-Sample-creative-3-e1706593018816-300x300.png 300w, https://admitletter.com/wp-content/uploads/2024/01/Bhavika-Logo-Admitletter.com-color-palette-Sample-creative-3-e1706593018816-100x100.png 100w" sizes="(max-width: 3374px) 100vw, 3374px">
                            </div>
                          </div>
                          <div class="elementor-element elementor-element-bb2aa7e e-grid-align-mobile-left elementor-shape-rounded elementor-grid-0 e-grid-align-center elementor-widget elementor-widget-social-icons" data-id="bb2aa7e" data-element_type="widget" data-widget_type="social-icons.default">
                            <div class="elementor-widget-container">
                              <div class="elementor-social-icons-wrapper elementor-grid">
                                <span class="elementor-grid-item">
                                  <a class="elementor-icon elementor-social-icon elementor-social-icon-instagram elementor-animation-grow elementor-repeater-item-e2b49f1" href="https://www.instagram.com/admitletter" target="_blank">
                                    <span class="elementor-screen-only">Instagram</span>
                                    <svg class="e-font-icon-svg e-fab-instagram" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
                                    </svg>
                                  </a>
                                </span>
                                <span class="elementor-grid-item">
                                  <a class="elementor-icon elementor-social-icon elementor-social-icon-facebook elementor-animation-grow elementor-repeater-item-2ed494e" href="https://www.facebook.com/admitletter " target="_blank">
                                    <span class="elementor-screen-only">Facebook</span>
                                    <svg class="e-font-icon-svg e-fab-facebook" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path>
                                    </svg>
                                  </a>
                                </span>
                                <span class="elementor-grid-item">
                                  <a class="elementor-icon elementor-social-icon elementor-social-icon-youtube elementor-animation-grow elementor-repeater-item-78c5df6" target="_blank">
                                    <span class="elementor-screen-only">Youtube</span>
                                    <svg class="e-font-icon-svg e-fab-youtube" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path>
                                    </svg>
                                  </a>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="elementor-element elementor-element-e373889 elementor-align-center elementor-mobile-align-left elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="e373889" data-element_type="widget" data-widget_type="icon-list.default">
                            <div class="elementor-widget-container">
                              <ul class="elementor-icon-list-items">
                                <li class="elementor-icon-list-item">
                                  <a href="tel:+91%208360051494">
                                    <span class="elementor-icon-list-text" style="font-size: 15px;">+91 8360 051 494</span>
                                  </a>
                                </li>
                                <li class="elementor-icon-list-item">
                                  <span class="elementor-icon-list-text" style="font-size: 15px;">info@admitletter.com</span>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                  <div class="elementor-element elementor-element-63e202dc elementor-widget-divider--view-line elementor-widget elementor-widget-divider" data-id="63e202dc" data-element_type="widget" data-widget_type="divider.default">
                    <div class="elementor-widget-container">
                      <div class="elementor-divider">
                        <span class="elementor-divider-separator"></span>
                      </div>
                    </div>
                  </div>
                  <section class="elementor-section elementor-inner-section elementor-element elementor-element-3fb5058d elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="3fb5058d" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-default">
                      <div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-5b75e36d" data-id="5b75e36d" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                          <div class="elementor-element elementor-element-536f1be4 elementor-widget elementor-widget-text-editor" data-id="536f1be4" data-element_type="widget" data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                              <p style="font-size: 15px !important;">Copyright © 2024 Admitletter. All Rights Reserved.</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </footer>
    <div class="modal fade dc-loginformpop" role="dialog" id="dc-loginpopup">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="dc-modalcontent modal-content">
          <div class="dc-loginformholds">
            <div class="dc-loginheader text-center">
				<span class="mt-2">Please enter your details to see list of Universities that matches your profile.</span>
              <a href="javascript:;" class="dc-closebtn close dc-close" data-dismiss="modal" aria-label="Close">
                <i class="fa fa-times"></i>
              </a>
            </div>
            <form class="dc-formtheme dc-loginform do-login-form" id="user_deatils_form">
              <fieldset>
                <div class="form-group">
                  <input type="text" name="username" class="form-control" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                  <input type="text" name="phone" class="form-control removeChars" data-regex="[^0-9+]" maxlength="13" placeholder="Mobile number" required>
                </div>
				
                <div class="dc-logininfo" style="text-align:center;">
					<input type='hidden' name='education_type' value="<?php echo $education_type; ?>" />
					<input type='hidden' name='last_qualification' value="<?php echo $qualification; ?>" />
					<input type='hidden' name='board' value="<?php echo $board; ?>" />
					<input type='hidden' name='gpa' value="<?php echo $percentage; ?>" />
					<input type='hidden' name='tution_fees_min_value' value="<?php echo $tution_fees_min; ?>" />
					<input type='hidden' name='tution_fees_max_value' value="<?php echo $tution_fees_max; ?>" />
					<input type='hidden' name='expenses_min_value' value="<?php echo $expenses_min; ?>" />
					<input type='hidden' name='expenses_max_value' value="<?php echo $expenses_max; ?>" />
					<input type='hidden' name='exam_type' value="<?php echo $_POST['exam']; ?>" />
					<input type='hidden' name='listening_score' value="<?php echo $listening_score; ?>" />
					<input type='hidden' name='reading_score' value="<?php echo $reading_score; ?>" />
					<input type='hidden' name='speaking_sore' value="<?php echo $speaking_score; ?>" />
					<input type='hidden' name='writing_score' value="<?php echo $writing_score; ?>" />
					<input type='hidden' name='overall_score' value="<?php echo $overall_score; ?>" />
                   <button type="button" id="resetBtn" data-id="" value="">Show List</button>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.steps.min.js"></script>
	<script src="backend/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="backend/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>

	$(document).ready(function () {
	setTimeout(function () {
   $("#preloader").hide();
  }, 2000);
  $('#resetBtn').on('click', function () {
      // If validation passes, submit the form via AJAX
      var formData = $('.do-login-form').serialize(); // Serialize form data
		var tabData = {
        tab: 'submit_user_deatils',
      };

      // Merge form data and tab data
      formData += '&' + $.param(tabData);
      $.ajax({
        type: 'POST',
        url: 'ajax.php', // Replace with your backend endpoint
        data: formData,
		dataType:"json",
		beforeSend: function () {
                $('#preloader').show(); 
            },
        success: function (data) {
			//console.log(data);return false;
			if(data.msg_code == '00'){
				 $('#all_data_div').html(data.html);
				 $('#dc-loginpopup').modal('hide');
				 $("#user_deatils_form").trigger("reset");
				 $('#first_data_div').hide();
				 $('#all_data_div').show();
				setTimeout(function () {
				   $("#preloader").hide();
				  }, 2000);
			}else{
				$("#preloader").hide();
				$('#dc-loginpopup').modal('hide');
				 $("#user_deatils_form").trigger("reset");
					Swal.fire( {
								type: 'success',
								title: 'Success',
								text: 'Thank you for sharing your details, our consultants will contact you shortly. Redirecting to the home page.',
								timer: 3000
							} ) 
							setTimeout( function () {
							window.location.href = 'index.php';
							}, 3000 );
			}
        },
        
      });
    
  });

  function validateForm() {
    // Add your validation logic here
    var fullName = $('input[name="username"]').val();
    var email = $('input[name="email"]').val();
    var phone = $('input[name="phone"]').val();

    // Example: Simple check if fields are not empty
    if (fullName.trim() === '' || email.trim() === '' || phone.trim() === '') {
      return false;
    }

    // You can add more complex validation rules as needed

    return true;
  }
});

	</script>
  </body>
</html>