<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Find University</title>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel="stylesheet" href="./style.css">
</head>
<style>
.authincation {
  position: absolute;
  width: 100%;
  min-height: 100vh;
  display: flex;
  padding: 30px 0;
  align-items: center;
}
.custom-center {
    margin-left: auto;
    margin-right: auto;
    text-align: center;
}
input[type="range"] {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  width: 100%;
  outline: none;
  position: absolute;
  margin: auto;
  top: -40px;
  bottom: 0;
  background-color: transparent;
  pointer-events: none;
}
.slider-track {
  width: 100%;
  height: 8px;
  position: absolute;
  margin: auto;
  top: 0;
  bottom: 40px;
  border-radius: 5px;
}.slider-track2 {
  width: 100%;
  height: 8px;
  position: absolute;
  margin: auto;
  top: 0;
  bottom: 40px;
  border-radius: 5px;
}
input[type="range"]::-webkit-slider-runnable-track {
  -webkit-appearance: none;
  height: 5px;
}
input[type="range"]::-moz-range-track {
  -moz-appearance: none;
  height: 5px;
}
input[type="range"]::-ms-track {
  appearance: none;
  height: 5px;
}
input[type="range"]::-webkit-slider-thumb {
  -webkit-appearance: none;
  height: 1.7em;
  width: 1.7em;
  background-color: #33bb8e;
  cursor: pointer;
  margin-top: -9px;
  pointer-events: auto;
  border-radius: 50%;
}
input[type="range"]::-moz-range-thumb {
  -webkit-appearance: none;
  height: 1.7em;
  width: 1.7em;
  cursor: pointer;
  border-radius: 50%;
  background-color: #fff;
  pointer-events: auto;
  border: 1px solid rgba(0, 0, 0, 0.5);;
}
input[type="range"]::-ms-thumb {
  appearance: none;
  height: 1.7em;
  width: 1.7em;
  cursor: pointer;
  border-radius: 50%;
  background-color: #fff;
  pointer-events: auto;
}
input[type="range"]:active::-webkit-slider-thumb {
  background-color: #ffffff;
  border: 1px solid #33bb8e;
}
.values {
  background-color: #33bb8e;
  width: 25%;
  position: relative;
  margin: auto;
  padding: 4px 0;
  border-radius: 5px;
  text-align: center;
  font-weight: 500;
  font-size: 12px;
  color: #ffffff;
}
.values:before {
  content: "";
  position: absolute;
  height: 0;
  width: 0;
  border-top: 15px solid #33bb8e;
  border-left: 15px solid transparent;
  border-right: 15px solid transparent;
  margin: auto;
  bottom: -9px;
  left: 0;
  right: 0;
}
.wrapper {
  position: relative;
  background-color: #ffffff;
  padding: 0 40px 0 40px;
  border-radius: 10px;
}
.container {
  position: relative;
  width: 100%;
  padding-left: 0 !important;
  padding-right: 0 !important;
}
</style>
<body>
     <div class="authincation">
   
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-12 col-md-8">
	   
	

	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!-- Wizard container -->
		            <div class="wizard-container">
		                <div class="card wizard-card" data-color="red" id="wizard">
		                    <form action="" method="">
		                <!--        You can switch " data-color="blue" "  with one of the next bright colors: "green", "orange", "red", "purple"             -->

		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
		                        		Find University
		                        	</h3>
		                    	</div>
								<div class="wizard-navigation" style="display:none;">
									<ul>
			                            <li><a href="#details" data-toggle="tab">Account</a></li>
			                            <li><a href="#captain" data-toggle="tab">Room Type</a></li>
			                            <li><a href="#description" data-toggle="tab">Extra Details</a></li>
			                            <li><a href="#last" data-toggle="tab">Extra Details</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="details">
		                            	<div class="row">
			                            	<div class="col-sm-12">
			                                	<h4 class="info-text"> What is your highest education level?</h4>
			                            	</div>
		                                	
		                                	<div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Grade 12th">
		                                                <input type="radio" name="qualification" value="Grade 12">
		                                                <div class="icon">
		                                                    <i class="material-icons">book</i>
		                                                </div>
		                                                <h6>Grade 12</h6>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="3yr Bachelor's Degree">
		                                                <input type="radio" name="qualification" value="Code">
		                                                <div class="icon">
		                                                    <i class="material-icons">book</i>
		                                                </div>
		                                                <h6>3yr Bachelor's Degree</h6>
		                                            </div>
		                                        </div>
												<div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="4yr Bachelor's Degree">
		                                                <input type="radio" name="qualification" value="Code">
		                                                <div class="icon">
		                                                    <i class="material-icons">book</i>
		                                                </div>
		                                                <h6>4yr Bachelor's Degree</h6>
		                                            </div>
		                                        </div>
												<div class="col-sm-12 custom-center">
													<h4 class="info-text"> What was your score/percentage in selected education level?</h4>
													
													<div class="col-sm-4">
														
													</div><div class="col-sm-4">
														<div class="form-group">
															<input name="percentage" type="text" class="form-control" placeholder="Percentage %">
														</div>
													</div><div class="col-sm-4">
														
													</div>
												</div>
		                            	</div>
		                            </div>
		                            <div class="tab-pane" id="captain">
		                                <h4 class="info-text">Please select the expected range for university tution fees? </h4>
		                                <div class="row">
		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        <div class="col-sm-12" style="margin-top:10px">
		                                           <div class="wrapper">
													  <div class="values">
														<span id="range1">
														  0
														</span>
														<span> &dash; </span>
														<span id="range2">
														  100
														</span>
													  </div>
													  <div class="container">
														<div class="slider-track"></div>
														<input type="range" min="0" max="100" value="40" id="slider-1" oninput="slideOne()">
														<input type="range" min="0" max="100" value="60" id="slider-2" oninput="slideTwo()">
													  </div>
													</div>
		                                        </div>
		                                    </div>
		                                </div>
										<h4 class="info-text">Please indicate your living expenses? </h4>
		                                <div class="row">
		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        <div class="col-sm-12" style="margin-top:10px">
		                                           <div class="wrapper">
													  <div class="values">
														<span id="range3">
														  0
														</span>
														<span> &dash; </span>
														<span id="range4">
														  100
														</span>
													  </div>
													  <div class="container">
														<div class="slider-track2"></div>
														<input type="range" min="0" max="100" value="40" id="slider-3" oninput="slideThree()">
														<input type="range" min="0" max="100" value="60" id="slider-4" oninput="slideFour()">
													  </div>
													</div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="tab-pane" id="description">
		                                <div class="row">
			                            	<div class="col-sm-12">
			                                	<h4 class="info-text"> Which englishtest you have taken OR are planning to take ?</h4>
			                            	</div>
		                                	
		                                	<div class="col-sm-3">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="PTE">
		                                                <input type="radio" name="pte" value="pte">
		                                                <div class="icon">
		                                                    <i class="material-icons">flight</i>
		                                                </div>
		                                               <h6>PTE</h6>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-3">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="IELTS">
		                                                <input type="radio" name="ielts" value="ielts">
		                                                <div class="icon">
		                                                    <i class="material-icons">flight</i>
		                                                </div>
		                                                <h6>IELTS</h6>
		                                            </div>
		                                        </div>
												<div class="col-sm-3">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="TOEFL">
		                                                <input type="radio" name="qualification" value="toefl">
		                                                <div class="icon">
		                                                    <i class="material-icons">flight</i>
		                                                </div>
		                                                <h6>TOEFL</h6>
		                                            </div>
		                                        </div>
												<div class="col-sm-3">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="DUOLINGO">
		                                                <input type="radio" name="duolingo" value="duolingo">
		                                                <div class="icon">
		                                                    <i class="material-icons">flight</i>
		                                                </div>
		                                                <h6>DUOLINGO</h6>
		                                            </div>
		                                        </div>
												<div class="col-sm-12 custom-center">
													<h4 class="info-text"> Enter Your Score?</h4>
													
													<div class="col-sm-4">
														
													</div><div class="col-sm-4">
														<div class="form-group">
															<input name="score" type="text" class="form-control" placeholder="score">
														</div>
													</div><div class="col-sm-4">
														
													</div>
												</div>
		                            	</div>
		                            </div>  
									<div class="tab-pane" id="last">
		                                <div class="row">
			                            	<div class="col-sm-12">
			                                	<h4 class="info-text"> Which education to persue in USA ?</h4>
			                            	</div>
		                                	<div class="col-sm-2">
											</div>
		                                	<div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="PTE">
		                                                <input type="radio" name="pte" value="pte">
		                                                <div class="icon">
		                                                    <i class="material-icons">school</i>
		                                                </div>
		                                               <h6>PTE</h6>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="IELTS">
		                                                <input type="radio" name="ielts" value="ielts">
		                                                <div class="icon">
		                                                    <i class="material-icons">school</i>
		                                                </div>
		                                                <h6>IELTS</h6>
		                                            </div>
		                                        </div>
												<div class="col-sm-2">
												</div>
												
		                            	</div>
		                            </div>
		                        </div>
	                        	<div class="wizard-footer">
	                            	<div class="text-center">
	                                    <input type='button' class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='Continue' />
	                                    <a href='#' class='btn btn-finish btn-fill btn-danger btn-wd' name='finish' value='Show University' >Show University</a>
	                                </div>
	                                <!--<div class="pull-left">
	                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />

	                                </div>-->
	                                <div class="clearfix"></div>
	                        	</div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	    	</div> <!-- row -->
	    	 <div class="footer">
	        <div class="container text-center">
	             Made with <i class="fa fa-heart heart"></i> by <a href="javascript:void(0);" target="_blank">Find University</a>
	        </div>
	    </div>
		</div> <!--  big container -->

	   
	</div>
	</div>
	</div>
	</div>
</body>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script  src="./script.js"></script>

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
let minGap = 0;
let sliderTrack = document.querySelector(".slider-track");
let sliderTrack2 = document.querySelector(".slider-track2");
let sliderMaxValue = document.getElementById("slider-1").max;
let slider2MaxValue = document.getElementById("slider-3").max;

function slideOne() {
  if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
    sliderOne.value = parseInt(sliderTwo.value) - minGap;
  }
  displayValOne.textContent = sliderOne.value;
  fillColor();
}
function slideTwo() {
  if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
    sliderTwo.value = parseInt(sliderOne.value) + minGap;
  }
  displayValTwo.textContent = sliderTwo.value;
  fillColor();
}
function slideThree() {
  if (parseInt(sliderFour.value) - parseInt(sliderThree.value) <= minGap) {
    sliderThree.value = parseInt(sliderFour.value) - minGap;
  }
  displayValThree.textContent = sliderThree.value;
  fillColor2();
}
function slideFour() {
  if (parseInt(sliderFour.value) - parseInt(sliderThree.value) <= minGap) {
    sliderThree.value = parseInt(sliderFour.value) + minGap;
  }
  displayValFour.textContent = sliderThree.value;
  fillColor2();
}
function fillColor() {
  percent1 = (sliderOne.value / sliderMaxValue) * 100;
  percent2 = (sliderTwo.value / sliderMaxValue) * 100;
  sliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}% , #33bb8e ${percent1}% , #33bb8e ${percent2}%, #dadae5 ${percent2}%)`;
}function fillColor2() {
  percent1 = (sliderThree.value / slider2MaxValue) * 100;
  percent2 = (sliderFour.value / slider2MaxValue) * 100;
  sliderTrack2.style.background = `linear-gradient(to right, #dadae5 ${percent1}% , #33bb8e ${percent1}% , #33bb8e ${percent2}%, #dadae5 ${percent2}%)`;
}
</script>
</body>
</html>
