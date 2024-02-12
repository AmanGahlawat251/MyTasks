
function send_ajax_request( from_id, modal_id, reload_table, div_hide = '', div_show = '', div_append = "" ) {
	var frm = new FormData( $( '#' + from_id )[ 0 ] );
	var request_url = $( "#" + from_id + " input[name=url]" ).val();
	$.ajax
		( {
			type: "POST",
			url: 'ajax.php',
			data: frm,
			processData: false,
			contentType: false,
			beforeSend: function () {
				$( "#loading" ).show();
				//return false;
			},
			success: function ( data ) {
				$( "#loading" ).hide();
				//console.log( data );
				try {
					var obj = $.parseJSON( data );
					var msg_code = obj.msg_code;
					
					if(obj.reg_msg){
							var msg = obj.reg_msg;
						}else{
						var msg = obj.msg;
						}
					//console.log( obj );
					
					if ( msg_code != '00' ) {
						
						Swal.fire( {
							type: 'error',
							title: 'Error',
							text: msg
						} )
						
						
						//alert(msg);
						
						
						if(msg_code == '007')
						{
							window.location.reload();
						}
					}
					else {
						//console.log( 'swal '+from_id );
						if ( reload_table != 'APPEND' && reload_table != 'PAYMENT' && from_id != 'frm') {
							/*
							Swal.fire( {
								type: 'success',
								title: 'Success',
								text: msg,
								timer: 2000
							} )
							*/
							//alert(msg);
						}
						if ( msg_code == '00' ) {
						
						if(reload_table == 'F'){
							 
							
						}else{
							Swal.fire( {
								type: 'success',
								title: 'Success',
								text: msg,
								timer: 2000
							} ) 
						}
						
						
					
						if (reload_table == 'Y' ) {
							//console.log( 'load_table' );
							$("#"+from_id).trigger("reset");
							var page11 = $( ".pagination" ).find( ".active" ).attr( 'p' );
							loadTableRecords( page11 );
							$( '#' + modal_id ).modal( 'hide' );
						}
						else if(reload_table == 'M')
						{
							$( '#' + modal_id ).modal( 'hide' );
							$("#"+from_id).trigger("reset");
						}
						else if(reload_table == 'DLOD')
						{
							$( '#' + modal_id ).modal( 'hide' );
							$("#"+from_id).trigger("reset");
							$("#download_reports").click();
							
							
							
						}
						else if(reload_table == 'F')
						{
							Swal.fire({
							title: 'Success',
							text: msg,
							showDenyButton: false,
							showCancelButton: false,
							confirmButtonText: 'Ok',
							denyButtonText: '',
							}).then((result) => {
								//console.log(result);
							if (result) {
								$("#"+from_id).trigger("reset");
							setTimeout( function () {
							window.location.href = 'index.php';
							}, 1000 );
							}
							})
							
						}
						else if(reload_table == 'S')
						{
							$("#"+from_id).trigger("reset");
							setTimeout( function () {
							window.location.href = 'guard.php';
							}, 2000 );
						}
						else if (reload_table == 'N' ) {
							console.log( 'redirect '+obj.redirect );
							setTimeout( function () {
								if ( obj.hasOwnProperty( 'redirect' ) ) {
									window.location.href = obj.redirect;
								}
							}, 1000 );
						}
						
						
						}
					}
				}
				catch ( error ) {
					console.log( 'error' );
					/*
					Swal.fire( {
						type: 'error',
						title: '!!Error!!',
						text: 'Invalid response received from server'
					} )
					*/
					alert('Invalid response received from server');
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
				/*
				Swal.fire( {
					type: 'error',
					title: '!!Error!!',
					text: msg
				} )
				*/
				alert(msg);
			}
		} );
}
$( document ).on( 'click', '.btnPrev', function () {
		$('.sw-btn-prev').click();
})
$(document).on('click', '#step1', function () {
    var checkboxes = $('input[name="purpose"]:checked');
    var bachelorsPercentage = $('#bachelors_percentage_input').val();
    var grade12Percentage = $('#grade_percentage_input').val();

    if (checkboxes.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Please select your highest education level!',
            timer: 2000
        });
        return false;
    }

    if ($('#bachelors_div').is(':visible') && bachelorsPercentage === '') {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Please enter your percentage for the selected education level!',
            timer: 2000
        });
        return false;
    }

    if ($('#grade12').is(':visible') && grade12Percentage === '') {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Please enter your percentage for the selected education level!',
            timer: 2000
        });
        return false;
    }

    // If all validations pass, proceed to the next step
    $('.sw-btn-next').click();
	  // Scroll up smoothly
    $('html, body').animate({
        scrollTop: 0
    }, 'slow');
});
$( document ).on( 'click', '#step2', function () {
	$('.sw-btn-next').click();
	  // Scroll up smoothly
    $('html, body').animate({
        scrollTop: 0
    }, 'slow');

} );
$(document).on('click', '#step3', function () {
    // Validation for English test checkboxes
    var exam_checkboxes = $('input[name="exam"]:checked');
    if (exam_checkboxes.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Please select which English test you have taken or planning to take!',
            timer: 2000
        });
        return false;
    }

    // Validation for individual score inputs
    if ($('#all_score').is(':visible')) {
        var listeningScore = $('#listening_score').val();
        var readingScore = $('#reading_score').val();
        var speakingScore = $('#speaking_score').val();
        var writingScore = $('#writing_score').val();
        var overallScore = $('#overall_score').val();

        if (listeningScore === '' || readingScore === '' || speakingScore === '' || writingScore === '' || overallScore === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Please enter all the score values!',
                timer: 2000
            });
            return false;
        }
    }

    // Validation for Duolingo score inputs
    if ($('#duolingo_score').is(':visible')) {
        var literacyScore = $('#duo_listening_score').val();
        var conversationScore = $('#duo_reading_score').val();
        var comprehensionScore = $('#duo_speaking_score').val();
        var productionScore = $('#duo_writing_score').val();
        var duolingoOverallScore = $('#duo_overall_score').val();

        if (literacyScore === '' || conversationScore === '' || comprehensionScore === '' || productionScore === '' || duolingoOverallScore === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Please enter all the Duolingo score values!',
                timer: 2000
            });
            return false;
        }
    }

    // If all validations pass, proceed to the next step
    $('.sw-btn-next').click();
	  // Scroll up smoothly
    $('html, body').animate({
        scrollTop: 0
    }, 'slow');
});
function showUniversities() {
        // Change the current browser location to 'listing_new.php'
		var education = $('input[name="education_checkbox"]:checked');
		if (education.length === 0) {
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops...',
			  text: 'Please select education!',
			  timer: 2000
			});
			return false;
		  }else{
			document.getElementById('frm_filter').submit();
		  }
      }
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
	