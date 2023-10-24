



stepsWizard = $(".tab-wizard").steps({
	headerTag: "h5",
	bodyTag: "section",
	transitionEffect: "fade",
	titleTemplate: '<span class="step">#index#</span> #title#',
	labels: {
		finish: "Confirm"
	},
	forceMoveForward : false,
	onStepChanging: function(event, currentIndex, newIndex) {


		if (newIndex === 1) {
			var response = false;

			var booking_date = $('#booking_date').val();
			var start_time = $('#start_time').val();
			var end_time = $('#end_time').val();

			if(booking_date == '' || booking_date == undefined){
				alert('Please select Booking Date!');
				return false;
			}
			else if(start_time == '' || start_time == undefined){
				alert('Please select Booking Start Time!');
				return false;
			}
			else if(end_time == '' || end_time == undefined){
				alert('Please select Booking End Time!');
				return false;
			}


			$.ajax({
				type: "GET",
				url: "checkavailability.php",
				data: {
					_token: $("#csrf").val(),
					booking_date: booking_date,
					start_time: start_time,
					end_time: end_time,
				},
				async: false,
				dataType: 'json',
				success: function(data) {
		
					
				
		
				
					console.log(data[0]);

					
					if(data[0] == 0){
					
						response = true;
					}
					else{
						response = false;
					}

					console.log(response);
		
					$('#bookdt').val(booking_date);
					$('#booktime').val(start_time+' - '+end_time);
					$('#court_no').val(data[1]);
				}
			});

			if(response == false){
				alert('Sorry there is no Court available at selected date & time!');
			}
			return response;

		}
		else{
			return true;
		}
	},
	onStepChanged: function (event, currentIndex, priorIndex) {
		$('.steps .current').prevAll().addClass('disabled');
	},
	onFinished: function (event, currentIndex) {
		$("#submitbtn").trigger("click"); 
		
	}
});


