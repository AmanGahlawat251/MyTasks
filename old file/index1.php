<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Find University</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bd-wizard.css">
</head>
<body>
<style>
.pngs{
	width : 38px !important;
}
input[type="range"] {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  width: 100%;
  outline: none;
  position: absolute;
  margin: auto;
  top: 45px;
  bottom: 0;
  background-color: transparent;
  pointer-events: none;
}
.slider-track {
  width: 100%;
  height: 8px;
  position: absolute;
  margin: auto;
  top: 45px;
  bottom: 40px;
  border-radius: 5px;
}.slider-track2 {
  width: 100%;
  height: 8px;
  position: absolute;
  margin: auto;
  top: 45px;
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
  border-radius: 10px;
}
</style>
  <header>
    <nav class="navbar navbar-expand-sm navbar-light bg-white">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="assets/images/logo.svg" alt="logo"></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
          aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main class="d-flex align-items-center">
    <div class="container">
	<h3 class="wizard-title mt-3 mb-2" style="text-align: center;">
		                        		Find University
		                        	</h3>
        <div id="wizard">
          <h3>Step 1 Title</h3>
          <section>
           <h5 class="bd-wizard-step-title"></h5>
           <h2 class="section-heading">What is your highest education level? </h2>
           
           <div class="purpose-radios-wrapper">
              <div class="purpose-radio">
                  <input type="radio" name="purpose" id="branding" class="purpose-radio-input" value="Branding" checked>
                 <label for="branding" class="purpose-radio-label">
                   <span class="label-icon">
                     <img src="assets/images/number-12.png" alt="branding" class="label-icon-default pngs">
                     <img src="assets/images/number-12.png" alt="branding" class="label-icon-active pngs">
                   </span> 
                   <span class="label-text">Grade 12</span>
                 </label>
                </div>
                <div class="purpose-radio">
                   <input type="radio" name="purpose" id="mobile-design" class="purpose-radio-input" value="Moile Design">
                  <label for="mobile-design" class="purpose-radio-label">
                    <span class="label-icon">
                      <img src="assets/images/3.png" alt="branding" class="label-icon-default pngs">
                      <img src="assets/images/3.png" alt="branding" class="label-icon-active pngs">
                    </span>
                    <span class="label-text">3-yr Bachelor's</span>
                  </label>
                 </div>
                 <div class="purpose-radio">
                     <input type="radio" name="purpose" id="web-design" class="purpose-radio-input" value="Web Design">
                    <label for="web-design" class="purpose-radio-label">
                      <span class="label-icon">
                        <img src="assets/images/4.png" alt="branding" class="label-icon-default pngs">
                        <img src="assets/images/4.png" alt="branding" class="label-icon-active pngs">
                      </span>
                      <span class="label-text">4-yr Bachelor's</span>
                    </label>
                   </div>
				   <h4 class="mt-4">What was your score/percentage in selected education level?</h4>
				   <div class="form-group">
              <label for="firstName" class="sr-only"></label>
              <input type="text" name="firstName" id="firstName" class="form-control" placeholder="Percentage%">
            </div>
           </div>
          </section>
          <h3>Step 2 Title</h3>
          <section>
            <h5 class="bd-wizard-step-title"></h5>
				<div class="col-sm-12 mt-2">
				<h4 class="mt-4">Please select the expected range for university tution fees?</h4>
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
					  <div class="">
						<div class="slider-track"></div>
						<input type="range" min="0" max="100" value="40" id="slider-1" oninput="slideOne()">
						<input type="range" min="0" max="100" value="60" id="slider-2" oninput="slideTwo()">
					  </div>
					</div>
				</div>
				<div class="col-sm-12" style="margin-top: 3rem !important;">
				<h4 class="mt-4">Please indicate your living expenses?</h4>
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
					  <div class="">
						<div class="slider-track2"></div>
						<input type="range" min="0" max="100" value="40" id="slider-3" oninput="slideThree()">
						<input type="range" min="0" max="100" value="60" id="slider-4" oninput="slideFour()">
					  </div>
					</div>
				</div>
          </section>
          <h3>Step 3 Title</h3>
          <section>
              <h5 class="bd-wizard-step-title"></h5>
           <h2 class="section-heading"> Which english test you have taken OR are planning to take ? </h2>
           
           <div class="purpose-radios-wrapper">
              <div class="purpose-radio">
                  <input type="radio" name="purpose" id="branding" class="purpose-radio-input" value="Branding" checked>
                 <label for="branding" class="purpose-radio-label">
                   <span class="label-icon">
                     <img src="assets/images/letter-p.png" alt="branding" class="label-icon-default pngs">
                     <img src="assets/images/letter-p.png" alt="branding" class="label-icon-active pngs">
                   </span> 
                   <span class="label-text">PTE</span>
                 </label>
                </div>
                <div class="purpose-radio">
                   <input type="radio" name="purpose" id="mobile-design" class="purpose-radio-input" value="Moile Design">
                  <label for="mobile-design" class="purpose-radio-label">
                    <span class="label-icon">
                      <img src="assets/images/letter-i.png" alt="branding" class="label-icon-default pngs">
                      <img src="assets/images/letter-i.png" alt="branding" class="label-icon-active pngs">
                    </span>
                    <span class="label-text">IELTS</span>
                  </label>
                 </div>
                 <div class="purpose-radio">
                     <input type="radio" name="purpose" id="web-design" class="purpose-radio-input" value="Web Design">
                    <label for="web-design" class="purpose-radio-label">
                      <span class="label-icon">
                        <img src="assets/images/letter-t.png" alt="branding" class="label-icon-default pngs">
                        <img src="assets/images/letter-t.png" alt="branding" class="label-icon-active pngs">
                      </span>
                      <span class="label-text">TOEFL</span>
                    </label>
                   </div>
				   <div class="purpose-radio">
                     <input type="radio" name="purpose" id="web-design" class="purpose-radio-input" value="Web Design">
                    <label for="web-design" class="purpose-radio-label">
                      <span class="label-icon">
                        <img src="assets/images/letter-d.png" alt="branding" class="label-icon-default pngs">
                        <img src="assets/images/letter-d.png" alt="branding" class="label-icon-active pngs">
                      </span>
                      <span class="label-text">DUOLINGO</span>
                    </label>
                   </div>
				   <h4 class="mt-4">Enter Your Score?</h4>
				   <div class="form-group">
              <label for="firstName" class="sr-only"></label>
              <input type="text" name="firstName" id="firstName" class="form-control" placeholder="Score">
            </div>
           </div>
          </section>
		  <h3>Step 4 Title</h3>
          <section>
              <h5 class="bd-wizard-step-title"></h5>
           <h2 class="section-heading"> Which education to persue in USA ? </h2>
           
           <div class="purpose-radios-wrapper">
              <div class="purpose-radio">
                  <input type="radio" name="purpose" id="branding" class="purpose-radio-input" value="Branding" checked>
                 <label for="branding" class="purpose-radio-label">
                   <span class="label-icon">
                     <img src="assets/images/graduation-hat.png" alt="branding" class="label-icon-default pngs">
                     <img src="assets/images/graduation-hat.png" alt="branding" class="label-icon-active pngs">
                   </span> 
                   <span class="label-text">Bachelors</span>
                 </label>
                </div>
                <div class="purpose-radio">
                   <input type="radio" name="purpose" id="mobile-design" class="purpose-radio-input" value="Moile Design">
                  <label for="mobile-design" class="purpose-radio-label">
                    <span class="label-icon">
                      <img src="assets/images/graduation-hat.png" alt="branding" class="label-icon-default pngs">
                      <img src="assets/images/graduation-hat.png" alt="branding" class="label-icon-active pngs">
                    </span>
                    <span class="label-text">Masters</span>
                  </label>
                 </div>
           </div>
          </section>
        </div>
    </div>
  </main>
  <footer>
    <p class="font-weight-medium text-center text-small">
      <a href="#" target="_blank" class="text-dark"></a>
    </p>
  </footer>
 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.steps.min.js"></script>
  <script src="assets/js/bd-wizard.js"></script>
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
