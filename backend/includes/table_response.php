<?php
include 'check_session.php';
 
if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') 
{
	echo "<script language='javascript' type='text/javascript'>";
    echo "alert('Request not identified as ajax request');";
    echo "</script>";
	$URL="index.php";
	echo "<script>location.href='$URL'</script>";
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	echo "<script language='javascript' type='text/javascript'>";
    echo "alert('Bad Request method');";
    echo "</script>";
	$URL="index.php";
	echo "<script>location.href='$URL'</script>";
}
#print_r($_POST);
extract($_REQUEST);
$table = "";
if ($tab == 'view_university_data')
{
	$con = "";
	if (!isset($sort_param))
    $sort_param = "id";

	if (!isset($page) || $page < 1) {
		$page = 1;
	}

	if (!isset($disp_rec) || $disp_rec == "") {
		$disp_rec = 10;
		$per_page = 10;
	}

	if (isset($record_limit)) {
		$disp_rec = $record_limit;
		$per_page = $disp_rec;
	}

	if (isset($page)) {
		$start    = (($page - 1) * $disp_rec);
		$cur_page = $page;
	} else {
		$page  = 1;
		$start = 1;
	}
		
	
	
	$sql = "select * from ".DATA." where 1 ".$con." order by id DESC limit ".$start.",".$disp_rec;
	$result = $mysqli->executeQry($sql) ; 
	 
	
	$sql123 = "select count(id) as count_rows from ".DATA." where 1 ".$con;
	$result123 = $mysqli->executeQry($sql123) ; 
	$num_arr = $mysqli->fetch_array($result123);
	$num = $num_arr['count_rows'];
	$row = "";	 
	
	if($num > 0)
	{						
		$count             = $num;
		$no_of_paginations = ceil($count / $per_page);
		$cur_page          = $cur_page;
		$previous_btn      = true;
		$next_btn          = true;
		$first_btn         = true;
		$last_btn          = true;
	      
		$table = '
		<div class="card-body"><div class="row">
			<div class="col-md-3">
				<div class="form-group pull-left">
					<label for="input" class="control-label">Record Limit:<span></span></label>					
						<select name="record_limit_change" id="record_limit_change" class="form-control">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="30">30</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="120">120</option>
							<option value="150">150</option>
							<option value="200">200</option>
						</select>			
					
				</div>
			</div>
			<div class="col-md-6"></div>

			<div class="col-md-3">
				<div class="form-group pull-right">
					<label for="input" class="control-label">Search:<span></span></label>					
					<input type="text" id="live_search" class="form-control" />				
				</div>
			</div>
		</div>
		<input type="hidden" id="total_records" value="'.$num.'">
		<div style="margin: 2px; float: left;"></div>
		<table id="dynamic_table" class="table table-bordered table-striped">
		<thead>
		<tr>
		<th><nobr>#</nobr></th>';
		
			$table .= '<th><nobr>Action</nobr></th>';
		
		$table .= '<th><nobr>University Name</nobr></th>';		
		$table .= '<th><nobr>Education Type</nobr></th>';		
		$table .= '<th><nobr>Rank</nobr></th>
		<th><nobr>TAT</nobr></th>
		<th><nobr>University Acceptance Rate</nobr></th>
		<th><nobr>Last Qualification</nobr></th>
		<th><nobr>GPA(%)</nobr></th>
		<th><nobr>Cost of living</nobr></th>
		<th><nobr>Cost of tution</nobr></th>
		<th><nobr>Application Fee</nobr></th>
		<th><nobr>PTE</nobr></th>
		<th><nobr>IELTS</nobr></th>
		<th><nobr>TOEFL</nobr></th>
		<th><nobr>DUOLINGO</nobr></th>
		<th><nobr>Added On</nobr></th>			
		</tr>
		</thead>	
		<tbody id="tbody">';
			if($num>0)
			{
				$n = 1;
				$data = "";
				while($rows = $mysqli->fetch_assoc($result))
				{	 									
					$country_code = '';
					$i = ($start + $n);
				
				
					foreach($rows as $key => $value)
					{
						$data .= "data-".$key."='".$value."' ";											
					}
								
					extract($rows);
				
					$btn = "&nbsp;&nbsp;<span style='cursor:pointer;' class='btn btn-outline-info btn-xs' data-hover='tooltip' ".$data." onclick='edit_uni_data(this.id);' data-id='".$mysqli->encode($id)."'  data-placement='top' title='Click here edit' id='".$id."' ><i class='fa  fa-edit'></i></span>";
					$del_btn = "&nbsp;&nbsp;<span style='cursor:pointer;' class='btn btn-outline-danger btn-xs' data-hover='tooltip' ".$data." onclick='delete_popup(this.id);' data-id='".$mysqli->encode($id)."'  data-placement='top' title='Click here edit' id='".$id."' ><i class='fa  fa-trash'></i></span>";
					$logo_btn = "&nbsp;&nbsp;<label class='btn btn-outline-success btn-xs' data-hover='tooltip' ".$data." data-placement='top' title='Click here to add logo' style='margin-top: 8px;'>
					<input type='file' name='image' class='image' style='display:none;' id='image".$id."' data-row-id='".$id."'>
					<img id='image' src='' style='max-width: 100%; max-height: 100%;'>
					<img id='hidden_cropped_image' style='display: none;'> <!-- Hidden img tag for form submission -->
					<i class='fa fa-camera'></i>
				</label>";
				$banner_btn = "&nbsp;&nbsp;<label class='btn btn-outline-success btn-xs' data-hover='tooltip' ".$data." data-placement='top' title='Click here to add Banner' style='margin-top: 8px;'>
					<input type='file' name='banner' class='banner' style='display:none;' id='banner".$id."' data-row-id='".$id."'>
					<img id='banner' src='' style='max-width: 100%; max-height: 100%;'>
					<img id='hidden_cropped_banner' style='display: none;'> <!-- Hidden img tag for form submission -->
					<i class='fa fa-film'></i>
				</label>";

					if($university_rank > 0){
						$university_rank = $university_rank;
					}else{
						$university_rank = '';
					}
					if($gpa > 0){
						$gpa = $gpa.'%';
					}else{
						$gpa = '';
					}
					/* if($gpa > 0){
						$gpa = $gpa.'%';
					}else{
						$gpa = 'N/A';
					}
					if($acceptance_rate > 0){
						$acceptance_rate = $acceptance_rate.'%';
					}else{
						$acceptance_rate = 'N/A';
					}
					if($uni_tat > 0){
						$uni_tat = $uni_tat.'%';
					}else{
						$uni_tat = 'N/A';
					}
					if($qualification != ''){
						$qualification = $qualification;
					}else{
						$qualification = 'N/A';
					} */
					if($pte > 0){
						$pte = $pte;
					}else{
						$pte = '';
					}if($ielts > 0){
						$ielts = $ielts;
					}else{
						$ielts = '';
					}if($toefl > 0){
						$toefl = $toefl;
					}else{
						$toefl = '';
					}if($duolingo > 0){
						$duolingo = $duolingo;
					}else{
						$duolingo = '';
					}
					$table .= "<tr>";
					$table .= "<td><nobr>".$i."</nobr></td>";
								
					$table .= "<td><nobr>";
					$table .= $btn;
					$table .= $del_btn;
					$table .= $logo_btn;
					$table .= $banner_btn;
					$table .="</nobr></td>";
					$table .= "<td><nobr>".$name."</nobr></td>";
					$table .= "<td><nobr>".$education_type."</nobr></td>";
					$table .= "<td><nobr>".$university_rank."</nobr></td>";
					$table .= "<td><nobr>".$uni_tat."</nobr></td>";									
					$table .= "<td><nobr>".$acceptance_rate."</nobr></td>";									
					$table .= "<td><nobr>".$qualification."</nobr></td>";									
					$table .= "<td><nobr>".$gpa."</nobr></td>";									
					$table .= "<td><nobr>$".$cost_of_living."</nobr></td>";									
					$table .= "<td><nobr>$".$cost_of_tution."</nobr></td>";									
					$table .= "<td><nobr>".$application_fee."</nobr></td>";									
					$table .= "<td><nobr>".$pte."</nobr></td>";									
					$table .= "<td><nobr>".$ielts."</nobr></td>";									
					$table .= "<td><nobr>".$toefl."</nobr></td>";									
					$table .= "<td><nobr>".$duolingo."</nobr></td>";									
					$table .= "<td><nobr>".$mysqli->formatdate($created_on,"j-M-Y h:i:A")."</nobr></td>";							
					$n++;
					$data = "";
				}
			}
			$table .= '</tbody></table></div>';	
			$table .= '<div style="background-color:#fff;" class="card-footer">';				
			$table .= $mysqli->custompaging($cur_page, $no_of_paginations, $previous_btn, $next_btn, $first_btn, $last_btn);
			$table .= '</div>';	
	}

	else
	{
		$table = '<div class="card-body"><div class="alert alert-danger"><strong>!!</strong> No record found.</div></div>';
	}
}
if ($tab == 'view_leads')
{
	$con = "";
	if (!isset($sort_param))
    $sort_param = "id";

	if (!isset($page) || $page < 1) {
		$page = 1;
	}

	if (!isset($disp_rec) || $disp_rec == "") {
		$disp_rec = 10;
		$per_page = 10;
	}

	if (isset($record_limit)) {
		$disp_rec = $record_limit;
		$per_page = $disp_rec;
	}

	if (isset($page)) {
		$start    = (($page - 1) * $disp_rec);
		$cur_page = $page;
	} else {
		$page  = 1;
		$start = 1;
	}
		
	
	
	$sql = "select * from ".LEADS." where 1 ".$con." order by id DESC limit ".$start.",".$disp_rec;
	$result = $mysqli->executeQry($sql) ; 
	 
	
	$sql123 = "select count(id) as count_rows from ".LEADS." where 1 ".$con;
	$result123 = $mysqli->executeQry($sql123) ; 
	$num_arr = $mysqli->fetch_array($result123);
	$num = $num_arr['count_rows'];
	$row = "";	 
	
	if($num > 0)
	{						
		$count             = $num;
		$no_of_paginations = ceil($count / $per_page);
		$cur_page          = $cur_page;
		$previous_btn      = true;
		$next_btn          = true;
		$first_btn         = true;
		$last_btn          = true;
	      
		$table = '
		<div class="card-body"><div class="row">
			<div class="col-md-3">
				<div class="form-group pull-left">
					<label for="input" class="control-label">Record Limit:<span></span></label>					
						<select name="record_limit_change" id="record_limit_change" class="form-control">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="30">30</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="120">120</option>
							<option value="150">150</option>
							<option value="200">200</option>
						</select>			
					
				</div>
			</div>
			<div class="col-md-6"></div>

			<div class="col-md-3">
				<div class="form-group pull-right">
					<label for="input" class="control-label">Search:<span></span></label>					
					<input type="text" id="live_search" class="form-control" />				
				</div>
			</div>
		</div>
		<input type="hidden" id="total_records" value="'.$num.'">
		<div style="margin: 2px; float: left;"></div>
		<table id="dynamic_table" class="table table-bordered table-striped">
		<thead>
		<tr>
		<th><nobr>#</nobr></th>';
		
		$table .= '<th><nobr>Name</nobr></th>';		
		$table .= '<th><nobr>Email</nobr></th>';		
		$table .= '<th><nobr>Contact No.</nobr></th>
		<th><nobr>Education Type</nobr></th>
		<th><nobr>Last Qualification</nobr></th>
		<th><nobr>Board</nobr></th>
		<th><nobr>GPA(%)</nobr></th>
		<th><nobr>Cost of living</nobr></th>
		<th><nobr>Cost of tution</nobr></th>
		<th><nobr>Exam Name</nobr></th>
		<th><nobr>Listening Score</nobr></th>
		<th><nobr>Reading Score</nobr></th>
		<th><nobr>Speaking Score</nobr></th>
		<th><nobr>Writing Score</nobr></th>
		<th><nobr>Overall Score</nobr></th>
		<th><nobr>Added On</nobr></th>			
		</tr>
		</thead>	
		<tbody id="tbody">';
			if($num>0)
			{
				$n = 1;
				$data = "";
				while($rows = $mysqli->fetch_assoc($result))
				{	 									
					$country_code = '';
					$i = ($start + $n);
				
				
					foreach($rows as $key => $value)
					{
						$data .= "data-".$key."='".$value."' ";											
					}
								
					extract($rows);
				
					if($gpa > 0){
						$gpa = $gpa.'%';
					}else{
						$gpa = '';
					}
					$expenses = '$'.$expenses_min_value.' - $'.$expenses_max_value;
					$tution_fees = '$'.$tution_fees_min_value.' - $'.$tution_fees_max_value;
					
					$table .= "<tr>";
					$table .= "<td><nobr>".$i."</nobr></td>";
					$table .= "<td><nobr>".$name."</nobr></td>";
					$table .= "<td><nobr>".$email."</nobr></td>";
					$table .= "<td><nobr>".$phone."</nobr></td>";
					$table .= "<td><nobr>".$education_type."</nobr></td>";									
					$table .= "<td><nobr>".$last_qualification."</nobr></td>";									
					$table .= "<td><nobr>".$board."</nobr></td>";									
					$table .= "<td><nobr>".$gpa."</nobr></td>";									
					$table .= "<td><nobr>".$expenses."</nobr></td>";											
					$table .= "<td><nobr>".$tution_fees."</nobr></td>";									
					$table .= "<td><nobr>".$exam_type."</nobr></td>";									
					$table .= "<td><nobr>".$listening_score."</nobr></td>";									
					$table .= "<td><nobr>".$reading_score."</nobr></td>";									
					$table .= "<td><nobr>".$speaking_sore."</nobr></td>";									
					$table .= "<td><nobr>".$writing_score."</nobr></td>";									
					$table .= "<td><nobr>".$overall_score."</nobr></td>";									
					$table .= "<td><nobr>".$mysqli->formatdate($recTimeStamp,"j-M-Y h:i:A")."</nobr></td>";							
					$n++;
					$data = "";
				}
			}
			$table .= '</tbody></table></div>';	
			$table .= '<div style="background-color:#fff;" class="card-footer">';				
			$table .= $mysqli->custompaging($cur_page, $no_of_paginations, $previous_btn, $next_btn, $first_btn, $last_btn);
			$table .= '</div>';	
	}

	else
	{
		$table = '<div class="card-body"><div class="alert alert-danger"><strong>!!</strong> No record found.</div></div>';
	}
}
if ($tab == 'view_config')
{
	$con = "";
	if (!isset($sort_param))
    $sort_param = "id";

	if (!isset($page) || $page < 1) {
		$page = 1;
	}

	if (!isset($disp_rec) || $disp_rec == "") {
		$disp_rec = 10;
		$per_page = 10;
	}

	if (isset($record_limit)) {
		$disp_rec = $record_limit;
		$per_page = $disp_rec;
	}

	if (isset($page)) {
		$start    = (($page - 1) * $disp_rec);
		$cur_page = $page;
	} else {
		$page  = 1;
		$start = 1;
	}
		
	
	
	$sql = "select * from ".CONFIG." where 1 ".$con." order by id DESC limit ".$start.",".$disp_rec;
	$result = $mysqli->executeQry($sql) ; 
	 
	
	$sql123 = "select count(id) as count_rows from ".CONFIG." where 1 ".$con;
	$result123 = $mysqli->executeQry($sql123) ; 
	$num_arr = $mysqli->fetch_array($result123);
	$num = $num_arr['count_rows'];
	$row = "";	 
	
	if($num > 0)
	{						
		$count             = $num;
		$no_of_paginations = ceil($count / $per_page);
		$cur_page          = $cur_page;
		$previous_btn      = true;
		$next_btn          = true;
		$first_btn         = true;
		$last_btn          = true;
	      
		$table = '
		<div class="card-body"><div class="row">
			<div class="col-md-3">
				<div class="form-group pull-left">
					<label for="input" class="control-label">Record Limit:<span></span></label>					
						<select name="record_limit_change" id="record_limit_change" class="form-control">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="30">30</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="120">120</option>
							<option value="150">150</option>
							<option value="200">200</option>
						</select>			
					
				</div>
			</div>
			<div class="col-md-6"></div>

			<div class="col-md-3">
				<div class="form-group pull-right">
					<label for="input" class="control-label">Search:<span></span></label>					
					<input type="text" id="live_search" class="form-control" />				
				</div>
			</div>
		</div>
		<input type="hidden" id="total_records" value="'.$num.'">
		<div style="margin: 2px; float: left;"></div>
		<table id="dynamic_table" class="table table-bordered table-striped">
		<thead>
		<tr>
		<th><nobr>#</nobr></th>';
		
			$table .= '<th><nobr>Action</nobr></th>';
		
		$table .= '<th><nobr>University Last Percentage</nobr></th>';		
		$table .= '<th><nobr>Fees</nobr></th><th>
		<nobr>Last Living Expense</nobr></th>		
		</tr>
		</thead>	
		<tbody id="tbody">';
			if($num>0)
			{
				$n = 1;
				$data = "";
				while($rows = $mysqli->fetch_assoc($result))
				{	 									
					$country_code = '';
					$i = ($start + $n);
				
				
					foreach($rows as $key => $value)
					{
						$data .= "data-".$key."='".$value."' ";											
					}
								
					extract($rows);
				
					$btn = "&nbsp;&nbsp;<span style='cursor:pointer;' class='btn btn-outline-info btn-xs' data-hover='tooltip' ".$data." onclick='edit_config(this.id);' data-id='".$mysqli->encode($id)."'  data-placement='top' title='Click here edit' id='".$id."' ><i class='fa  fa-edit'></i></span>";
				
					$table .= "<tr>";
					$table .= "<td><nobr>".$i."</nobr></td>";
								
					$table .= "<td><nobr>".$btn."</nobr></td>";
					$table .= "<td><nobr>".$last_education_percentage."</nobr></td>";
					$table .= "<td><nobr>".$university_fees."</nobr></td>";
					$table .= "<td><nobr>".$living_expenses."</nobr></td>";											
					$n++;
					$data = "";
				}
			}
			$table .= '</tbody></table></div>';	
			$table .= '<div style="background-color:#fff;" class="card-footer">';				
			$table .= $mysqli->custompaging($cur_page, $no_of_paginations, $previous_btn, $next_btn, $first_btn, $last_btn);
			$table .= '</div>';	
	}

	else
	{
		$table = '<div class="card-body"><div class="alert alert-danger"><strong>!!</strong> No record found.</div></div>';
	}
}
if ($tab == 'view_edu_config')
{
	$con = "";
	if (!isset($sort_param))
    $sort_param = "id";

	if (!isset($page) || $page < 1) {
		$page = 1;
	}

	if (!isset($disp_rec) || $disp_rec == "") {
		$disp_rec = 10;
		$per_page = 10;
	}

	if (isset($record_limit)) {
		$disp_rec = $record_limit;
		$per_page = $disp_rec;
	}

	if (isset($page)) {
		$start    = (($page - 1) * $disp_rec);
		$cur_page = $page;
	} else {
		$page  = 1;
		$start = 1;
	}
		
	
	
	$sql = "select * from ".EDUCONFIG." where 1 ".$con." order by id DESC limit ".$start.",".$disp_rec;
	$result = $mysqli->executeQry($sql) ; 
	 
	
	$sql123 = "select count(id) as count_rows from ".EDUCONFIG." where 1 ".$con;
	$result123 = $mysqli->executeQry($sql123) ; 
	$num_arr = $mysqli->fetch_array($result123);
	$num = $num_arr['count_rows'];
	$row = "";	 
	
	if($num > 0)
	{						
		$count             = $num;
		$no_of_paginations = ceil($count / $per_page);
		$cur_page          = $cur_page;
		$previous_btn      = true;
		$next_btn          = true;
		$first_btn         = true;
		$last_btn          = true;
	      
		$table = '
		<div class="card-body"><div class="row">
			<div class="col-md-3">
				<div class="form-group pull-left">
					<label for="input" class="control-label">Record Limit:<span></span></label>					
						<select name="record_limit_change" id="record_limit_change" class="form-control">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="30">30</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="120">120</option>
							<option value="150">150</option>
							<option value="200">200</option>
						</select>			
					
				</div>
			</div>
			<div class="col-md-6"></div>

			<div class="col-md-3">
				<div class="form-group pull-right">
					<label for="input" class="control-label">Search:<span></span></label>					
					<input type="text" id="live_search" class="form-control" />				
				</div>
			</div>
		</div>
		<input type="hidden" id="total_records" value="'.$num.'">
		<div style="margin: 2px; float: left;"></div>
		<table id="dynamic_table" class="table table-bordered table-striped">
		<thead>
		<tr>
		<th><nobr>#</nobr></th>';	
		$table .= '<th><nobr>Education Name</nobr></th>
		</tr>
		</thead>	
		<tbody id="tbody">';
			if($num>0)
			{
				$n = 1;
				$data = "";
				while($rows = $mysqli->fetch_assoc($result))
				{	 									
					$country_code = '';
					$i = ($start + $n);
				
				
					foreach($rows as $key => $value)
					{
						$data .= "data-".$key."='".$value."' ";											
					}
								
					extract($rows);
				
					$btn = "&nbsp;&nbsp;<span style='cursor:pointer;' class='btn btn-outline-info btn-xs' data-hover='tooltip' ".$data." onclick='edit_config(this.id);' data-id='".$mysqli->encode($id)."'  data-placement='top' title='Click here edit' id='".$id."' ><i class='fa  fa-edit'></i></span>";
				
					$table .= "<tr>";
					$table .= "<td><nobr>".$i."</nobr></td>";
					$table .= "<td><nobr>".$persue."</nobr></td>";											
					$table .= "</tr>";											
					$n++;
					$data = "";
				}
			}
			$table .= '</tbody></table></div>';	
			$table .= '<div style="background-color:#fff;" class="card-footer">';				
			$table .= $mysqli->custompaging($cur_page, $no_of_paginations, $previous_btn, $next_btn, $first_btn, $last_btn);
			$table .= '</div>';	
	}

	else
	{
		$table = '<div class="card-body"><div class="alert alert-danger"><strong>!!</strong> No record found.</div></div>';
	}
}



echo $table ;


	