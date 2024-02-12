$( document ).ready( function () {

	setTimeout(function(){ $('[data-toggle="tooltip"]').tooltip({
		container: 'body'
	}); }, 3000);
	
	
	$('.modal_close').on('hidden.bs.modal', function (e) {
		console.log(this.id);
		if(this.id != 'modal-add-person')
		{
			window.location.reload();
		}
	})

	
	
	$( '#search_by' ).change( function () {

		var search_by = $( '#search_by' ).val();
		if ( search_by == '' ) {
			$( '#search_value' ).removeAttr( 'required' );
		}
		else {
			$( "#search_value" ).prop( 'required', true );
		}
	} );
	
	//$('#search_date').parents().eq(2).hide();
	$('#search_date').attr("autocomplete","off");
	
	
	

	
} );



// Start login 
$( document ).on( 'submit', '#frm', function ( e ) {
	e.preventDefault();
	send_ajax_request( 'frm', '', 'N' );
	//grecaptcha.reset();
} );
// End login 

// Start forget password  
$( document ).on( 'submit', '#frm_forgot_password', function ( e ) {
	e.preventDefault();
	send_ajax_request( 'frm_forgot_password', 'modal-forget', 'N' );
} );
// End forget password

// Start Contact 
$( document ).on( 'submit', '#frm_add_config', function ( e ) {
	e.preventDefault();
	send_ajax_request( 'frm_add_config', 'modal-add-config', 'N' );
	$("#frm_add_config").trigger("reset");
} );
// End Contact 
// Start Contact 
$( document ).on( 'submit', '#frm_add_educonfig', function ( e ) {
	e.preventDefault();
	send_ajax_request( 'frm_add_educonfig', 'modal-add-educonfig', 'N' );
	$("#frm_add_educonfig").trigger("reset");
} );
// End Contact 
// Start Contact 
$( document ).on( 'submit', '#frm_add_data', function ( e ) {
	e.preventDefault();
	send_ajax_request( 'frm_add_data', 'modal-add-university', 'N' );
} );
// End Contact 

// Start Contact 
$( document ).on( 'submit', '#frm_add_csv', function ( e ) {
	e.preventDefault();
	send_ajax_request( 'frm_add_csv', 'modal-upload-csv', 'N' );
} );
// End Contact 

 
 

// Add person  Start
$( document ).on( 'submit', '#frm_add_person', function ( e ) {
	e.preventDefault();
	var tab = $( '#tab' ).val();
	send_ajax_request( 'frm_add_person', 'modal-add-person', 'Y' );
} );
// Add person End

// Add person  Start
$( document ).on( 'submit', '#frm_add_person_order', function ( e ) {
	e.preventDefault();
	var tab = $( '#tab' ).val();
	send_ajax_request( 'frm_add_person_order', 'modal-add-person', 'N' );
} );
// Add person End

// Chnage client status Start
$( document ).on( 'submit', '#frm_active_person', function ( e ) {
	e.preventDefault();
	send_ajax_request( 'frm_active_person', 'modal-active-person', 'Y' )
} );
// Chnage client status End

// Delete client Start
$( document ).on( 'submit', '#frm_remove_data', function ( e ) {
	e.preventDefault();
	send_ajax_request( 'frm_remove_data', 'modal-remove-data', 'Y' )
} );
// Delete client End

//  Add Attendance
$( document ).on( 'submit', '#frm_attendance', function ( e ) {
	e.preventDefault();
	send_ajax_request( 'frm_attendance', '', 'R');
} );
// Add  Attendance

//  Add notes
$( document ).on( 'submit', '#frm_add_notes', function ( e ) {
	e.preventDefault();
	send_ajax_request( 'frm_add_notes', '', '');	
	var note_source = $("#source").val();
	var source_id = $("#note_source_id").val();
	load_notes(note_source,source_id,"notes_list");	
	$("#frm_add_notes").trigger("reset");
	$("#note_details").focus().keyup();
} );
// Add  notes


// Change Password Start

$( document ).on( 'submit', '#frm_change_password', function ( e ) {
	e.preventDefault();
	send_ajax_request( 'frm_change_password', 'modal-change-password', 'N' )
} );



//  Upload docs Start
$( document ).on( 'submit', '#frm_upload_doc', function ( e ) {
	e.preventDefault();
	send_ajax_request( 'frm_upload_doc', 'modal-upload-doc', 'N');
} );
// Upload docs End

$( document ).on( 'keyup blur', '.allowOnlyNumeric', function ( event ) {
	var node = $( this );
	node.val( node.val().replace( /[^0-9]/g, '' ) );
} );
$( '.allowOnlyNumeric' ).bind( 'input propertychange', function () {
	var node = $( this );
	node.val( node.val().replace( /[^0-9]/g, '' ) );
} );
$( document ).on( 'keyup blur', '.allowOnlyAlphabets', function ( event ) {
	var node = $( this );
	node.val( node.val().replace( /[^a-zA-Z ]/g, '' ) );
} );
$( '.allowOnlyAlphabets' ).bind( 'input propertychange', function () {
	var node = $( this );
	node.val( node.val().replace( /[^a-zA-Z ]/g, '' ) );
} );
$( document ).on( 'keyup blur', '.allowAlphaNumeric', function ( event ) {
	var node = $( this );
	node.val( node.val().replace( /[^a-zA-Z0-9]/g, '' ) );
} );
$( document ).on( 'keyup blur', '.nospace', function ( event ) {
	var node = $( this );
	node.val( node.val().replace(/ /g,'') );
} );
$( '.allowAlphaNumeric' ).bind( 'input propertychange', function () {
	var node = $( this );
	node.val( node.val().replace( /[^a-zA-Z0-9]/g, '' ) );
} );
$( document ).on( 'keyup blur', '.allowOnlyNumericSpace', function ( event ) {
	var node = $( this );
	node.val( node.val().replace( /[^0-9 ]/g, '' ) );
} );
$( '.allowOnlyNumericSpace' ).bind( 'input propertychange', function () {
	var node = $( this );
	node.val( node.val().replace( /[^0-9 ]/g, '' ) );
} );
$( document ).on( 'keyup blur', '.allowAlphaNumericSpace', function ( event ) {
	var node = $( this );
	node.val( node.val().replace( /[^a-zA-Z0-9 ]/g, '' ) );
} );
$( '.allowAlphaNumericSpace' ).bind( 'input propertychange', function () {
	var node = $( this );
	node.val( node.val().replace( /[^a-zA-Z0-9 ]/g, '' ) );
} );
$( document ).on( 'keyup blur', '.allowNumericFloat', function ( event ) {
	var node = $( this );
	node.val( node.val().replace( /[^0-9\.]/g, '' ) );
} );
$( '.allowNumericFloat' ).bind( 'input propertychange', function () {
	var node = $( this );
	node.val( node.val().replace( /[^0-9\.]/g, '' ) );
} );
$( document ).on( 'keyup blur', '.allowNumericAmount', function ( event ) {
	var node = $( this );
	//  node.val(node.val().replace(/[^0-9\s.]+|\.(?!\d)/g, ''));
	node.val( node.val().replace( /[^0-9\.]/g, '' ) );
} );
$( document ).on( 'blur', '.validateFloat', function ( event ) {
	var value = $( this ).val();
	var valid = ( value.match( /^-?\d*(\.\d+)?$/ ) )
	if ( !valid ) {
		$( this ).val( 0 );
	}
} );
$( document ).on( 'keyup blur', '.makeAlphabetsCapital', function ( event ) {
	this.value = this.value.toUpperCase();
} );
$( document ).on( 'keyup blur', '.removeChars', function ( event ) {
	var node = $( this );
	var stringToGoIntoTheRegex = $( this ).data( 'regex' );
	var regex = new RegExp( stringToGoIntoTheRegex, "g" );
	node.val( node.val().replace( regex, '' ) );
} );


$( document ).on( 'keyup blur', '.removeChars_enter', function ( event ) {
	if (Event.keyCode != 13)
	{
		var node = $( this );
		var stringToGoIntoTheRegex = $( this ).data( 'regex' );
		var regex = new RegExp( stringToGoIntoTheRegex, "g" );
		node.val( node.val().replace( regex, '' ) );
	}
} );

$( '.removeChars' ).bind( 'input propertychange', function () {
	var node = $( this );
	var stringToGoIntoTheRegex = $( this ).data( 'regex' );
	var regex = new RegExp( stringToGoIntoTheRegex, "g" );
	node.val( node.val().replace( regex, '' ) );
} );

$(document).on('blur', '.validateEmail', function (event) {
        var userinput = $(this).val();
        if (userinput != '') {
            var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
            if (!pattern.test(userinput)) {
                alert('Enter a valid e-mail address');
				$(this).val("");
				$(this).focus();
            }
        }
    });
	
	 

	$(document).on('blur', '#validity1', function () {
		var x = parseInt($("#validity1").val());
		//alert(x);
		var s = new Date().addHours(x).toString();
		//alert(s);
		var ssd = s.split("GMT");
		var d = new Date(ssd[0]);
		var date12 = d.toLocaleDateString();
		date12 = date12.split("/");
		//alert(date12);
		if(date12[0] < 10)
		{
			date12[0] = "0"+date12[0];
		}
		if(date12[1] < 10)
		{
			date12[1] = "0"+date12[1];
		}
		date12 = date12[2]+"-"+date12[0]+"-"+date12[1];
		$("#exp").text(date12);
        $("#validity2").val(date12);
    });
	
	
	$( document ).on( 'blur', '.chk_email_exist', function () {
	$('#auth').hide();
	var request_url = $('#email_auth').val();
	var email_address =   $('#email').val()
	if(email_address == '')
	{
		return false;
	}
	$.ajax
	({
		type: "POST",
		url: request_url,
		data: "email_address="+email_address,
		beforeSend: function () {
			$('.chk_email_exist').addClass('load_txt');   //removeClass
			$('.btn ').attr('disabled', 'disabled');
		},
		success: function (data) {
			$('.chk_email_exist').removeClass('load_txt');
			$('.btn ').removeAttr('disabled');
			var obj = $.parseJSON(data); 
			var msg_code = obj.msg_code;    
			if ( msg_code == '00' ) {				
				$('#auth_email').empty().append( '<span class="text-success"><i class="icon fas fa-check"></i> Email verified.</span>');
				$('#auth_email').show();
			}
			else {
				$('#auth_email').html( '<span class="text-danger"><i class="icon fas fa-ban"></i> Email already exist!</span>');
				$('#auth_email').show();
				$('#email').val('');				
			}
		}
	});

} );

$( document ).on( 'focusout', 'input', function () {

	var message = $(this).val();
	if(/<(br|basefont|hr|input|source|frame|param|area|meta|!--|col|link|option|base|img|wbr|!DOCTYPE|a|abbr|acronym|address|applet|article|aside|audio|b|bdi|bdo|big|blockquote|body|button|canvas|caption|center|cite|code|colgroup|command|datalist|dd|del|details|dfn|dialog|dir|div|dl|dt|em|embed|fieldset|figcaption|figure|font|footer|form|frameset|head|header|hgroup|h1|h2|h3|h4|h5|h6|html|i|iframe|ins|kbd|keygen|label|legend|li|map|mark|menu|meter|nav|noframes|noscript|object|ol|optgroup|output|p|pre|progress|q|rp|rt|ruby|s|samp|script|section|select|small|span|strike|strong|style|sub|summary|sup|table|tbody|td|textarea|tfoot|th|thead|time|title|tr|track|tt|u|ul|var|video).*?>|<(video).*?<\/\2>/i.test(message) == true) {
	alert('HTML Tag are not allowed');
	$(this).val("");
	e.preventDefault();
	}
});

$(document).on('keyup blur', '.removeChars', function (event) {
    var node = $(this);
    var stringToGoIntoTheRegex = $(this).data('regex');
    var regex = new RegExp(stringToGoIntoTheRegex, "g");
    node.val(node.val().replace(regex, ''));
});

// Add lead   Start
$( document ).on( 'submit', '#frm_add_lead', function ( e ) {
	e.preventDefault();
	var tab = $( '#tab' ).val();
	send_ajax_request( 'frm_add_lead', 'modal-add-lead', 'Y' );
} );
// Add lead End
// Delete lead Start
$( document ).on( 'submit', '#frm_remove_lead', function ( e ) {
	e.preventDefault();
	send_ajax_request('frm_remove_lead', 'modal-remove-lead', 'Y')
} );
// Delete lead End


// Add IP  Start
$( document ).on( 'submit', '#frm_access_ip', function ( e ) {
	e.preventDefault();
	var tab = $( '#tab' ).val();
	send_ajax_request( 'frm_access_ip', 'modal-add_access_ip', 'Y' );
} );
// Add IP  End

// Delete IP Address Start
$( document ).on( 'submit', '#frm_remove_ip', function ( e ) {
	e.preventDefault();
	send_ajax_request('frm_remove_ip', 'modal-remove-ip', 'Y')
} );
// Delete IP Address End





function randomPassword() {
	var length = 12;
	var chars = "abcdefghjkmnpqrstuvwxyz!@#%*()-+ABCDEFGHJKMNP123456789";
	//var chars = "1234567890";
	var pass = "";
	for ( var x = 0; x < length; x++ ) {
		var i = Math.floor( Math.random() * chars.length );
		pass += chars.charAt( i );
	}
	return pass;
}

function generate() {
	//$('.password').removeAttr('disabled');
	$('.password').val( randomPassword() );
	var pass = $(".password")[0];	
	$('.password').select();
	document.execCommand("copy");  
	$('#clipboard').fadeIn(2000);
	$('#clipboard').fadeOut(2000);
}

function check_active_login() {
	$.ajax( {
		url: 'check_active_login.php',
		data: '',
		success: function ( data ) {
		},
		type: 'POST'
	} );
	}


function send_ajax_request( from_id, modal_id, reload_table, div_hide = '', div_show = '', div_append = "" ) {
	var frm = new FormData( $( '#' + from_id )[ 0 ] );
	var request_url = $( "#" + from_id + " input[name=url]" ).val();
	$.ajax
		( {
			type: "POST",
			url: request_url,
			data: frm,
			processData: false,
			contentType: false,
			beforeSend: function () {
				if(reload_table != 'NOP')
				{
					$( "#loading" ).show();
				}
			},
			success: function ( data ) {
				$( "#loading" ).hide();
				//console.log( data );
				try {
					var obj = $.parseJSON( data );
					var msg_code = obj.msg_code;
					var msg = obj.msg;
					//console.log( obj );
					if ( msg_code != '00' ) {
						Swal.fire( {
							type: 'error',
							title: 'Error',
							text: msg
						} )
						
						if(msg_code == '007')
						{
							window.location.reload();
						}
					}
					else {
						//console.log( 'swal' );
						if ( reload_table != 'APPEND' && reload_table != 'PAYMENT' && reload_table != 'NOP' ) {
							Swal.fire( {
								type: 'success',
								title: 'Success',
								text: msg,
								timer: 2000
							} )
						}
						
						if(obj.notReload == 'Y')
						{
							$('#customer_id').attr("data-source","customer_order");
							$('#customer_id').append(obj.res_data).trigger('change');							
							$('#customer_id').val(obj.res_val).trigger('change');
							$('#customer_id').attr("data-source","customer");
							$('#customer_id').change();
							$('#modal-add-person').modal('hide');
						}
						
						if ( reload_table == 'Y' ) {
							//console.log( 'load_table' );
							$("#"+from_id).trigger("reset");
							var page11 = $( ".pagination" ).find( ".active" ).attr( 'p' );
							loadTableRecords( page11 );
							if(modal_id != '')
							{
								$( '#' + modal_id ).modal( 'hide' );
							}
						}
						else if(reload_table == 'NOP')
						{
							var page11 = $( ".pagination" ).find( ".active" ).attr( 'p' );
							loadTableRecords( page11 );
						}
						else if(reload_table == 'M')
						{
							$( '#' + modal_id ).modal( 'hide' );
							$("#"+from_id).trigger("reset");
						}
						else if(reload_table == 'F')
						{
							$("#"+from_id).trigger("reset");
						}
						else if(reload_table == 'R')
						{
							//window.location.reload();
							setTimeout( function () {								 
									window.location.reload()
							}, 2000 );
						}
						else if ( reload_table == 'N' ) {
							//console.log( 'redirect' );
							if(modal_id != '')
							{
								$( '#' + modal_id ).modal( 'hide' );
							}
							setTimeout( function () {
								if ( obj.hasOwnProperty( 'redirect' ) ) {
									window.location.href = obj.redirect;
								}
							}, 1000 );
							
							
							
						}
						else if ( reload_table == 'NW' ) {
							if ( obj.hasOwnProperty( 'redirect' ) ) {
								
								var win = window.open(obj.redirect, '_blank');
								if (win) {
									win.focus();
								} else {
									alert('Please allow popups for this website');
								}
								window.location.href = obj.redirect1;
							}
							
						}
						else if ( reload_table == 'APPEND' ) {
							if ( obj.hasOwnProperty( 'data' ) ) {

								$( '#' + div_append ).append( obj.data );
								$( '#' + div_hide ).hide();
								$( '#' + div_show ).show();
							}
						}
						else if ( reload_table == 'PAYMENT' ) {
							$( "#loading" ).show();
							if ( obj.hasOwnProperty( 'redirect' ) ) {
								
								window.location.href = obj.redirect;
								/*
								$.popupWindow( obj.redirect, {
									onUnload: function () {
										//window.opener.reload();
										$( "#loading" ).hide();
										window.location.href = 'http://localhost/saga/index.php?7Qf+gGu6kxPfev0o4rMcdiQu';
									},
								} );
								*/
							}
						}
					}
				}
				catch ( error ) {
					console.log( 'error' );
					if (from_id == 'frm_po_entry')
					{
						//window.location.reload();
					}
					Swal.fire( {
						type: 'error',
						title: '!!Error!!',
						text: 'Invalid response received from server'
					} )
				}
			},
			error: function ( jqXHR, exception ) {
				$( "#loading" ).hide();
				var msg = '';
				if ( jqXHR.status === 0 ) {
					msg = 'Not connect.\n Verify Network.';
				} else if ( jqXHR.status == 404 ) {
					msg = 'Requested page not found. [404]';
				} else if ( jqXHR.status == 500 ) {
					msg = 'Internal Server Error [500].';
				} else if ( exception === 'parsererror' ) {
					msg = 'Requested JSON parse failed.';
				} else if ( exception === 'timeout' ) {
					msg = 'Time out error.';
				} else if ( exception === 'abort' ) {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
				
				if (from_id == frm_po_entry)
				{
					window.location.reload();
				}
				
				Swal.fire( {
					type: 'error',
					title: '!!Error!!',
					text: msg
				} )
			}
		} );
}

function showpassword() 
{
	if($("input[name=password]").attr("type") === "password") 
	{
		$("input[name=password]").attr("type","text");
	} 
	else
	{
		$("input[name=password]").attr("type","password");
	}
}

function copyToclipboard(txt_id)
{
	$('#'+txt_id).select();	 
	document.execCommand("copy");  	
	$('#clipboard').fadeIn(500);
	$('#clipboard').fadeOut(2000);
	$('#'+txt_id).hide();
}
function snackbar(msg) {
  $('#snackbar').text(msg);
  $('#snackbar').addClass('show');
  setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
}

function countTextAreaChar(txtarea, maxLimit,label){
    var len = $(txtarea).val().length;
    if (len > maxLimit) $(txtarea).val($(txtarea).val().slice(0, maxLimit));
    else $('#'+label).text((len) +"/"+maxLimit);
    }

function edit_config(id) 
{
	var element = $('#'+id).data(); 
	var type = $('#'+id).data('type'); 
	$.each(element, function (index, data) {			
			if(index == 'lead_source_id')
			{
				$('#'+index).val(data).trigger('change');
			}
			else
			{				
				$('#'+index).val(data);	
			}
	});
	$('.modal-title').text("Update Config");	
	$('#lead_id').val(lead_id);	
	$('#add_lead').hide();
	$('#lead_details').keyup();
	$('#update_lead').show();
	$( '#modal-add-lead' ).modal( 'show' );
	
}
function edit_config(id)
	{
		var record_id = $('#'+id).data('id');		
		var percentage = $('#'+id).data('last_education_percentage');		
		var fees = $('#'+id).data('university_fees');		
		var expenses = $('#'+id).data('living_expenses');		
		$('#edit_id').val(record_id);
		$('#m-title').html('Update Config');
		$('#submit').hide();
		$('#update').show();
		$('#frm_add_config #education_percentage').val(percentage);		
		$('#frm_add_config #uni_fees').val(fees);		
		$('#frm_add_config #expense').val(expenses);		
		$('#modal-add-config').modal('show');
	}
	function add_logo(id)
	{
		var record_id = $('#'+id).data('id');				
		$('#edit_id').val(record_id);	
		$('#uploadimageModal').modal('show');
	}
function edit_uni_data(id)
	{
		var record_id = $('#'+id).data('id');		
		var name = $('#'+id).data('name');		
		var qualification = $('#'+id).data('qualification');		
		var gpa = $('#'+id).data('gpa');		
		var cost_of_living = $('#'+id).data('cost_of_living');		
		var cost_of_tution = $('#'+id).data('cost_of_tution');		
		var application_fee = $('#'+id).data('application_fee');		
		var pte = $('#'+id).data('pte');		
		var ielts = $('#'+id).data('ielts');		
		var toefl = $('#'+id).data('toefl');		
		var duolingo = $('#'+id).data('duolingo');		
		var uni_tat = $('#'+id).data('uni_tat');		
		var university_rank = $('#'+id).data('university_rank');		
		var acceptance_rate = $('#'+id).data('acceptance_rate');		
		var extra_test = $('#'+id).data('extra_test');				
		$('#edit_id').val(record_id);
		$('#m-title').html('Update Data');
		$('#submit').hide();
		$('#update').show();
		$('#frm_add_data #uni_name').val(name);		
		$('#frm_add_data #qualification').val(qualification);		
		$('#frm_add_data #gpa').val(gpa);		
		$('#frm_add_data #cost_of_living').val(cost_of_living);		
		$('#frm_add_data #tution_cost').val(cost_of_tution);		
		$('#frm_add_data #fees').val(application_fee);		
		$('#frm_add_data #pte').val(pte);		
		$('#frm_add_data #ielts').val(ielts);		
		$('#frm_add_data #toefl').val(toefl);		
		$('#frm_add_data #duolingo').val(duolingo);		
		$('#frm_add_data #tat').val(uni_tat);		
		$('#frm_add_data #uni_rank').val(university_rank);		
		$('#frm_add_data #acceptance_rate').val(acceptance_rate);		
		$('#frm_add_data #extra_test').val(extra_test);
		// Triggering Select2 to update the selected option
		$('#frm_add_data #extra_test').trigger('change');
		$('#modal-add-university').modal('show');
	}
function delete_popup(id)
	{
		var record_id = $('#'+id).data('id');		
		$('#del_record_id').val(record_id);	
		$('#modal-remove-data').modal('show');
	}