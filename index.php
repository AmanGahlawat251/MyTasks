<?php 
error_reporting(E_ALL);
session_start();

if (isset($_SESSION['show_all'])) {
    // Unset the specific session variable
    unset($_SESSION['show_all']);
}
require_once('backend/includes/autoload.php');
require_once('backend/includes/constant.php');
$mysqli = new MySqliDriver();
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

      .vms_steps {
        display: none !important;
      }

      .tab-content {
        height: 100% !important;
      }

      .toolbar2 {
        padding: .8rem;
      }

      .toolbar2>.btn {
        display: inline-block;
        text-decoration: none;
        text-align: center;
        text-transform: none;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        margin-left: .2rem;
        margin-right: .2rem;
        cursor: pointer;
      }

      .toolbar2>.btn.disabled,
      .sw .toolbar2>.btn:disabled {
        opacity: .65;
      }

      .toolbar2 > .btn
{
  color: #fff;
  background-color: #131313;
  border: 1px solid #131313;
  padding: .375rem .75rem;
  border-radius: .25rem;
  font-weight: 400;
}
.capitalize{
	text-transform: capitalize;
}
.is-invalid {
    border: 1px solid red; /* Border color for invalid input */
    color: red; /* Text color for invalid input */
}
    </style>
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
    <main class=" align-items-center vectorGraphic">
      <div class="container">
		<div class="row justify-content-center align-items-center">
        <!--<h3 class="wizard-title mt-3 mb-2" style="text-align: center;"> Find University </h3>-->
        <div id="smartwizard" class="form-wizard order-create mt-2" style="padding: 10px;">
          <ul class="nav nav-wizard" style="display:none;">
            <li>
              <a class="nav-link" href="#percentage">
                <span>1</span>
              </a>
            </li>
            <li>
              <a class="nav-link" href="#fees">
                <span>2</span>
              </a>
            </li>
            <li>
              <a class="nav-link" href="#score">
                <span>3</span>
              </a>
            </li>
            <li>
              <a class="nav-link" href="#persue">
                <span>4</span>
              </a>
            </li>
            <!--<li><a class="nav-link" href="#government_identity"><span>5</span></a></li>-->
          </ul>
		  <form id="frm_filter" method="post" action="listing_new.php">
          <div class="tab-content mt-4" style="position: relative;overflow: hidden;">
            <div id="percentage" class="tab-pane text-center" role="tabpanel">
              <h5 class="bd-wizard-step-title"></h5>
              <h2 class="section-heading">What is your highest education level? </h2>
              <div class="purpose-radios-wrapper">
                <div class="purpose-radio">
                  <input type="radio" name="purpose" id="branding" onclick="board(this.value)" class="purpose-radio-input" value="Grade 12">
                  <label for="branding" class="purpose-radio-label">
                    <!--<span class="label-icon">
                      <img src="assets/images/number-12.png" alt="branding" class="label-icon-default pngs">
                      <img src="assets/images/number-12.png" alt="branding" class="label-icon-active pngs">
                    </span>-->
                    <span class="label-text">Grade 12</span>
                  </label>
                </div>
                <div class="purpose-radio">
                  <input type="radio" name="purpose" id="mobile-design" onclick="board(this.value)" class="purpose-radio-input" value="3Year">
                  <label for="mobile-design" class="purpose-radio-label">
                    <!--<span class="label-icon">
                      <img src="assets/images/3.png" alt="branding" class="label-icon-default pngs">
                      <img src="assets/images/3.png" alt="branding" class="label-icon-active pngs">
                    </span>-->
                    <span class="label-text">3-yr Bachelor's</span>
                  </label>
                </div>
                <div class="purpose-radio">
                  <input type="radio" name="purpose" id="web-design" onclick="board(this.value)" class="purpose-radio-input" value="4Year">
                  <label for="web-design" class="purpose-radio-label">
                   <!-- <span class="label-icon">
                      <img src="assets/images/4.png" alt="branding" class="label-icon-default pngs">
                      <img src="assets/images/4.png" alt="branding" class="label-icon-active pngs">
                    </span>-->
                    <span class="label-text">4-yr Bachelor's</span>
                  </label>
                </div>
				<div id="bachelors_div" style="display:none;">
                <h6 class="mt-4 capitalize">What was your score/percentage in selected Education Level?</h6>
                <div class="form-group row justify-content-center">
                  <label for="bachelors_percentage_input" class="sr-only"></label>
                  <input type="text" name="bachelors_percentage_input" id="bachelors_percentage_input"  class="form-control removeChars" data-regex="[^0-9.]" placeholder="Percentage%">
                </div>
				</div>
				<div id="grade12" style="display:none;">
				<div class="col-lg-12 mt-2" >
				  <h6 class="mt-4 capitalize">What was your score/percentage in selected Education Level?</h6>

				  <div class="row">
					<div class="col-md-3">
					  
					</div>
					<div class="col-md-3">
					  <div class="form-group">
						<label for="select_board" class="sr-only"></label>
						<select name="select_board" id="select_board" class="form-control form-select" style="width: 100% !important;">
						  <option value="CBSE">CBSE</option>
						  <option value="ISCE">ISCE</option>
						  <option value="STATE">STATE</option>
						  <option value="IGCSE">IGCSE</option>
						  <option value="NIOS">NIOS</option>
						</select>
					  </div>
					</div>
					<div class="col-md-3">
					  <div class="form-group">
						<label for="grade_percentage_input" class="sr-only"></label>
                  <input type="text" name="grade_percentage_input" id="grade_percentage_input" class="form-control removeChars" data-regex="[^0-9.]" placeholder="Percentage%">
					  </div>
					</div>

					
					<div class="col-md-3">
					  
					</div>
				  </div>
				</div>
              </div>
              </div>
              <div class="toolbar2 toolbar-bottom-2" role="toolbar" style="text-align: center;">
                <button class="btn btn-primary" id="step1" type="button">Next</button>
              </div>
            </div>
            <div id="fees" class="tab-pane" role="tabpanel">
			<h5 class="bd-wizard-step-title"></h5>
              <h2 class="section-heading" style="text-align: center;">Tution Fees/ expenses? </h2>
              <h6 class="mt-4 text-center capitalize">Please select the expected range for University Tuition Fees?</h6>
              <div class="col-lg-12 mt-2">
                <div class="wrapper">
                  <div class="values">
                    <span id="range1"> 0 </span>
                    <span> &dash; </span>
                    <span id="range2"> 100 </span>
                  </div>
                  <div class="col-lg-12 mt-2">
                    <div class="slider-track"></div>
                  </div>
                  <input type="range"  min="1000" max="100000" value="25000" id="slider-1" oninput="slideOne()">
                  <input type="range" min="1000" max="100000" value="75000" id="slider-2" oninput="slideTwo()">
                  <!-- Hidden input field for range 1 -->
                  <input type="hidden" id="hidden-range-1" name="hidden_range_1" value="">
                  <!-- Hidden input field for range 2 -->
                  <input type="hidden" id="hidden-range-2" name="hidden_range_2" value="">
                </div>
              </div>
              <h6 class="mt-4 text-center capitalize">Please indicate your living expenses?</h6>
              <div class="col-lg-12">
                <div class="wrapper">
                  <div class="values">
                    <span id="range3"> 0 </span>
                    <span> &dash; </span>
                    <span id="range4"> 100 </span>
                  </div>
                  <div class="">
                    <div class="col-lg-12 mt-2">
                      <div class="slider-track2"></div>
                    </div>
                    <input type="range" min="1000" max="100000" value="25000" id="slider-3" oninput="slideThree()">
                    <input type="range" min="1000" max="100000" value="75000" id="slider-4" oninput="slideFour()">
                  </div>
                  <!-- Hidden input field for range 3 -->
                  <input type="hidden" id="hidden-range-3" name="hidden_range_3" value="40">
                  <!-- Hidden input field for range 4 -->
                  <input type="hidden" id="hidden-range-4" name="hidden_range_4" value="60">
                </div>
              </div>
              <div class="toolbar2 toolbar-bottom-2 margin2" role="toolbar" style="text-align: center;">
                <button class="btn btn-primary btnPrev" type="button">Previous</button>
                <button class="btn btn-primary" id="step2" type="button">Next</button>
              </div>
            </div>
            <div id="score" class="tab-pane text-center" role="tabpanel">
			<h5 class="bd-wizard-step-title"></h5>
              <h4 class="section-heading "> Which english test you have taken ? </h4>
              <div class="purpose-radios-wrapper">
                <div class="purpose-radio">
                  <input type="radio" name="exam" id="branding0" onclick="exams(this.value)" class="purpose-radio-input" value="PTE">
                  <label for="branding0" class="purpose-radio-label ">
                    <span class="label-icon">
                      <img src="images/PTE-logo.png" alt="branding" class="label-icon-default pngs">
                    </span>
                    <span class="label-text">PTE</span>
                  </label>
                </div>
                <div class="purpose-radio">
                  <input type="radio" name="exam" id="mobile-design1" onclick="exams(this.value)" class="purpose-radio-input" value="IELTS">
                  <label for="mobile-design1" class="purpose-radio-label ">
                    <span class="label-icon">
                      <img src="images/IELTS_logo.png" alt="branding" class="label-icon-default pngs">
                    </span>
                    <span class="label-text">IELTS</span>
                  </label>
                </div>
                <div class="purpose-radio">
                  <input type="radio" name="exam" id="web-design1" onclick="exams(this.value)" class="purpose-radio-input" value="TOEFL">
                  <label for="web-design1" class="purpose-radio-label ">
                    <span class="label-icon">
                      <img src="images/TOEFL_logo.png" alt="branding" class="label-icon-default pngs">
                    </span>
                    <span class="label-text">TOEFL</span>
                  </label>
                </div>
                <div class="purpose-radio">
                  <input type="radio" name="exam" id="web-design12" onclick="exams(this.value)" class="purpose-radio-input" value="DUOLINGO">
                  <label for="web-design12" class="purpose-radio-label ">
                    <span class="label-icon">
                      <img src="images/Duolingo-logo.png" alt="branding" class="label-icon-default pngs">
                    </span>
                    <span class="label-text">DUOLINGO</span>
                  </label>
                </div>
				<!--<div id="default_score">
                <h6 class="mt-4">Enter Your Score?</h6>
                <div class="form-group row justify-content-center">
                  <label for="firstName" class="sr-only"></label>
                  <input type="text" name="score_input" id="score_input" class="form-control" placeholder="Enter your score">
                </div>
				</div>-->
				<div id="all_score" style="display:none;">
				<div class="col-lg-12 mt-2" >
				  <h6 class="mt-4 capitalize">Enter Your Scores</h6>
					<div class="error-message text-danger"></div>
				  <div class="row">
					<div class="col-md-3">
					  <div class="form-group">
						<label for="listeningScore" class="sr-only">Listening Score</label>
						<input type="text" name="listening_score" id="listening_score" class="form-control removeChars" data-regex="[^0-9.]" min="0" max="9" oninput="validateScore(this)" placeholder="Listening score">
					  </div>
					</div>

					<div class="col-md-3">
					  <div class="form-group">
						<label for="readingScore" class="sr-only">Reading Score</label>
						<input type="text" name="reading_score" id="reading_score" oninput="validateScore(this)" class="form-control removeChars" data-regex="[^0-9.]" placeholder="Reading score">
					  </div>
					</div>
					
					<div class="col-md-3">
					  <div class="form-group">
						<label for="readingScore" class="sr-only">Speaking Score</label>
						<input type="text" name="speaking_score" id="speaking_score" oninput="validateScore(this)" class="form-control removeChars" data-regex="[^0-9.]" placeholder="Speaking score">
					  </div>
					</div>
					
					<div class="col-md-3">
					  <div class="form-group">
						<label for="readingScore" class="sr-only">Writing Score</label>
						<input type="text" name="writing_score" id="writing_score" oninput="validateScore(this)" data-regex="[^0-9.]" class="form-control removeChars" placeholder="Writing score">
					  </div>
					</div>
					
					
				  </div>
				</div>
				 <div class="col-lg-12 text-center">
					  <div class="form-group justify-content-center" style="display: flex;">
						<label for="readingScore" class="sr-only">Overall Score</label>
						<input type="text" name="overall_score" id="overall_score" oninput="validateScore(this)" data-regex="[^0-9.]" class="form-control removeChars" placeholder="Overall score">
					  </div>
					</div>
					
				</div>
				
				<div id="duolingo_score" style="display:none;">
				<div class="col-lg-12 mt-2" >
				  <h6 class="mt-4 capitalize">Enter Your Scores</h6>
					<div class="error-message text-danger"></div>
				  <div class="row">
					<div class="col-md-3">
					  <div class="form-group">
						<label for="listeningScore" class="sr-only">Listening Score</label>
						<input type="text" name="duo_listening_score" id="duo_listening_score" oninput="validateScore(this)" data-regex="[^0-9.]" class="form-control removeChars" placeholder="Literacy score">
					  </div>
					</div>

					<div class="col-md-3">
					  <div class="form-group">
						<label for="readingScore" class="sr-only">Reading Score</label>
						<input type="text" name="duo_reading_score" id="duo_reading_score" oninput="validateScore(this)" data-regex="[^0-9.]" class="form-control removeChars" placeholder="Conversation score">
					  </div>
					</div>
					
					<div class="col-md-3">
					  <div class="form-group">
						<label for="readingScore" class="sr-only">Speaking Score</label>
						<input type="text" name="duo_speaking_score" id="duo_speaking_score" oninput="validateScore(this)" data-regex="[^0-9.]" class="form-control removeChars" placeholder="Comprehension score">
					  </div>
					</div>
					
					<div class="col-md-3">
					  <div class="form-group">
						<label for="readingScore" class="sr-only">Writing Score</label>
						<input type="text" name="duo_writing_score" id="duo_writing_score" oninput="validateScore(this)" data-regex="[^0-9.]" class="form-control removeChars" placeholder="Production score">
					  </div>
					</div>
					
					
				  </div>
				</div>
				 <div class="col-lg-12 text-center">
					  <div class="form-group justify-content-center" style="display: flex;">
						<label for="readingScore" class="sr-only">Overall Score</label>
						<input type="text" name="duo_overall_score" id="duo_overall_score" oninput="validateScore(this)" data-regex="[^0-9.]" class="form-control removeChars" placeholder="Overall score">
					  </div>
					</div>
					
				</div>

              </div>
              <div class="toolbar2 toolbar-bottom-2" role="toolbar" style="text-align: center;">
                <button class="btn btn-primary btnPrev" type="button">Previous</button>
                <button class="btn btn-primary" id="step3" type="button">Next</button>
              </div>
            </div>
            <div id="persue" class="tab-pane text-center" role="tabpanel">
			<h5 class="bd-wizard-step-title"></h5>
              <h2 class="section-heading"> Which education to pursue in USA ? </h2>
              <div class="purpose-radios-wrapper"> <?php
			 $edu_sql =  "select *  from " . EDUCONFIG . "";
			 $result = $mysqli->executeQry($edu_sql);
			 while ($edu_row = $mysqli->fetch_assoc($result)) {
				 if($edu_row['persue'] == 'Masters'){
					 $img = 'assets/images/bachelor.png';
				 }else{
					  $img = 'assets/images/graduation-hat.png';
				 }
		   ?> <div class="purpose-radio">
                  <input type="radio" name="education_checkbox" id="branding<?php echo $edu_row['id']?>" class="purpose-radio-input" value="<?php echo $edu_row['persue'];?>">
                  <label for="branding<?php echo $edu_row['id'];?>" class="purpose-radio-label ">
                    <span class="label-icon">
                      <img src="<?php echo $img;?>" alt="branding" class="label-icon-default pngs">
                    </span>
                    <span class="label-text"> <?php echo $edu_row['persue'];?> </span>
                  </label>
                </div> <?php }?> </div>
              <div class="toolbar2 toolbar-bottom-2 mt-4" role="toolbar" style="text-align: center;">
                <button class="btn btn-primary btnPrev" type="button">Previous</button>
                <button class="btn btn-primary" id="show_uni_btn" onclick="showUniversities()" type="button">Show Universities</button>
              </div>
            </div>
          </div>
		  </form>
        </div>
      </div>
      </div>
      </div>
    </main>
    <footer itemtype="https://schema.org/WPFooter" itemscope="itemscope" id="colophon" role="contentinfo">
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js"></script>
    <script src="js/custom-script.js?v=
																																																						<?php echo date('YmdHis');?>">
    </script>
    <script src="backend/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="backend/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!--<script src="assets/js/jquery.steps.min.js"></script><script src="assets/js/bd-wizard.js"></script>-->
    <script>
     $(document).ready(function () {
  // Initialize SmartWizard
  $('#smartwizard').smartWizard({
    // other options...
    keyboardSettings: { keyNavigation: false },
  });
});
	  // Add this function to your script
		function validateScore(input) {
    var selectedTest = $('input[name="exam"]:checked').val();
    var score = parseFloat(input.value);
    var maxScore;
    var errorMessageClass = '.error-message';

    switch (selectedTest) {
        case 'IELTS':
            maxScore = 9;
            minScore = 0;
            break;
        case 'PTE':
            maxScore = 90;
			minScore = 10;
            break;
        case 'TOEFL':
            maxScore = 120;
			minScore = 0;
            break;
        case 'DUOLINGO':
            maxScore = 160;
			minScore = 0;
            break;
        default:
            maxScore = 0;
    }

    var errorMessageElements = document.querySelectorAll(errorMessageClass);

    if (isNaN(score) || score < minScore || score > maxScore) {
        // Display a red warning and disable the Next button
        input.classList.add('is-invalid');
        errorMessageElements.forEach(function(element) {
            element.textContent = "Please enter scores between " + minScore + " and " + maxScore;
        });
        document.getElementById('step3').disabled = true;
    } else {
        // Remove the warning and enable the Next button
        input.classList.remove('is-invalid');
        errorMessageElements.forEach(function(element) {
            element.textContent = "";
        });
        document.getElementById('step3').disabled = false;
    }
}

// Modify your existing exams function
// Modify your existing exams function
function exams(val) {
    // Clear error messages
    $('.error-message').text("");

    if (val != 'DUOLINGO') {
        // Clear input values for IELTS scores
        $('input[name^="listening_score"], input[name^="reading_score"], input[name^="speaking_score"], input[name^="writing_score"], input[name^="overall_score"]').val("");
        
        $('#default_score').hide();
        $('#duolingo_score').hide();
        $('#all_score').show();
        // Remove is-invalid class and enable Next button for IELTS scores
        $('input[name^="listening_score"], input[name^="reading_score"], input[name^="speaking_score"], input[name^="writing_score"], input[name^="overall_score"]').removeClass('is-invalid');
        document.getElementById('step3').disabled = false;
    } else {
        // Clear input values for Duolingo scores
        $('input[name^="duo_listening_score"], input[name^="duo_reading_score"], input[name^="duo_speaking_score"], input[name^="duo_writing_score"], input[name^="duo_overall_score"]').val("");
        
        $('#default_score').hide();
        $('#all_score').hide();
        $('#duolingo_score').show();
        // Remove is-invalid class and enable Next button for Duolingo scores
        $('input[name^="duo_listening_score"], input[name^="duo_reading_score"], input[name^="duo_speaking_score"], input[name^="duo_writing_score"], input[name^="duo_overall_score"]').removeClass('is-invalid');
        document.getElementById('step3').disabled = false;
    }
}


	 function board(val){
		if(val != 'Grade 12'){
			$('#grade12').hide();
			$('#bachelors_div').show();
		}else{
			$('#grade12').show();
			$('#bachelors_div').hide();
		}
     }
    </script>
    <script>
    window.onload = function () {
  slideOne();
  slideTwo();
  slideThree();
  slideFour();
};

let sliderOne = document.getElementById("slider-1");
let sliderTwo = document.getElementById("slider-2");
let sliderThree = document.getElementById("slider-3");
let sliderFour = document.getElementById("slider-4");
let displayValOne = document.getElementById("range1");
let displayValTwo = document.getElementById("range2");
let displayValThree = document.getElementById("range3");
let displayValFour = document.getElementById("range4");
let hiddenRange1 = document.getElementById("hidden-range-1");
let hiddenRange2 = document.getElementById("hidden-range-2");
let hiddenRange3 = document.getElementById("hidden-range-3");
let hiddenRange4 = document.getElementById("hidden-range-4");
let minGap = 0;
let sliderTrack = document.querySelector(".slider-track");
let sliderTrack2 = document.querySelector(".slider-track2");
let sliderMaxValue = document.getElementById("slider-1").max;
let slider2MaxValue = document.getElementById("slider-3").max;


function slideOne() {
  if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
    sliderOne.value = parseInt(sliderTwo.value) - minGap;
  }
  displayValOne.textContent = '$' + sliderOne.value;
  hiddenRange1.value = sliderOne.value;
  hiddenRange2.value = sliderTwo.value; // Add this line to update hiddenRange2
  fillColor();
}

function slideTwo() {
  if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
    sliderTwo.value = parseInt(sliderOne.value) + minGap;
  }
  displayValTwo.textContent = '$' + sliderTwo.value;
  hiddenRange2.value = sliderTwo.value;
  fillColor();
}

function slideThree() {
  if (parseInt(sliderFour.value) - parseInt(sliderThree.value) <= minGap) {
    sliderThree.value = parseInt(sliderFour.value) - minGap;
  }
  displayValThree.textContent = '$' + sliderThree.value;
  hiddenRange3.value = sliderThree.value;
  hiddenRange4.value = sliderFour.value; // Add this line to update hiddenRange4
  fillColor2();
}

function slideFour() {
  if (parseInt(sliderFour.value) - parseInt(sliderThree.value) <= minGap) {
    sliderFour.value = parseInt(sliderThree.value) + minGap;
  }
  displayValFour.textContent = '$' + sliderFour.value;
  hiddenRange4.value = sliderFour.value;
  fillColor2();
}

function fillColor() {
  percent1 = (sliderOne.value / sliderMaxValue) * 100;
  percent2 = (sliderTwo.value / sliderMaxValue) * 100;
  sliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}% , #000 ${percent1}% , #000 ${percent2}%, #dadae5 ${percent2}%)`;
}

function fillColor2() {
  percent1 = (sliderThree.value / slider2MaxValue) * 100;
  percent2 = (sliderFour.value / slider2MaxValue) * 100;
  sliderTrack2.style.background = `linear-gradient(to right, #dadae5 ${percent1}% , #000 ${percent1}% , #000 ${percent2}%, #dadae5 ${percent2}%)`;
}
	  
// JavaScript function to focus on the next tab and scroll to it
function focusOnNextTabAndScroll() {
    // Get the currently active tab
    var activeTab = document.querySelector('.tab-pane.active');
    
    // Find the next tab
    var nextTab = activeTab.nextElementSibling;
    
    // If there is a next tab
    if (nextTab) {
        // Focus on the next tab
        nextTab.focus();
        
        // Scroll to the next tab
        nextTab.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

// Add an event listener to the "Next" button to call the function when clicked
document.getElementById('step1').addEventListener('click', focusOnNextTabAndScroll);
document.getElementById('step2').addEventListener('click', focusOnNextTabAndScroll);
document.getElementById('step3').addEventListener('click', focusOnNextTabAndScroll);

    </script>
	
  </body>
</html>