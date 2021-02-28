
		<h1 style="color: green;">
			Generate a new set of tutorial schedules!
		</h1>

    <h3>
    	Instructions:
    </h3>
		<ol>
		  <li class="">Input Total Days Needed for Tutorial</li>
			<li class="">Input Length of Tutorial in Minutes</li>
			<li class="">Select the Tutor for these Tutorials</li>
			<li style="color: red">If you make a mistake refresh the page to start over.</li>
		</ol>
			<div id="step1">
			<input type="number" id="numsched" name="numsched" max="30" value="1">
	    <input type="number" id="tutleng" maxlength="40" placeholder="Tutorial Length (minutes)">
			<!-- This is the teacher select section. !-->
			<?php
				include_once "model/xml_class.php";
				$teachers = new xml_handler;
				$list = $teachers->getTeachers();
				echo "<label for='teachers'>Choose Teacher:</label>
				<select name='teacher' id='teacher'>
				<option value='<blank>'>None Selected</option>";
				foreach ($list as $row) {
					foreach ($row as $key => $value) {
						echo "<option value='".$key."'>$value</option>";
					}
				}
				echo "</select>";

			 ?>
			<!-- Above is the teacher select section. !-->

			<input type="submit" onClick="gen_dates()" id='gs' value="Get Dates Form!">
			<p id="test"></p>

    </div>
<script>
  var tutleng = 1;
	var tutorName = "";
	// Create a break line element
	var br = document.createElement("br");
	function test(){
		document.getElementById("test").innerText = teacher;
	}


  function gen_dates(){

		if (document.getElementById('tutleng').value > 0 && document.getElementById('numsched').value > 0 && document.getElementById("teacher").value != "<blank>") {
			var totalDates = document.getElementById('numsched').value;
			tutorName = document.getElementById('teacher').value;
			tutleng = document.getElementById('tutleng').value;
			//Hide the first step
			var step1 = document.getElementById("step1");
			step1.innerHTML = '';
	    //Create Date instructions
	    var instruct = document.createElement("h2");
	    instruct.innerText ='Select the dates you want to continue and times you want to start and end the tutorials for that day:';
	    document.getElementById("step1").appendChild(instruct);



			var th = document.createElement('th');
			var tr = document.createElement('tr');
			var td = document.createElement('td');
			var input = document.createElement('input')
			var table = document.createElement('table');

			var setTimeTable = table.cloneNode();
			setTimeTable.setAttribute('id','setTimeTable');
			setTimeTable.setAttribute('border','2f');
			document.getElementById("step1").appendChild(setTimeTable);

			var headerRow = tr.cloneNode();
			headerRow.setAttribute('id','headerRow');
			setTimeTable.appendChild(headerRow)

			var headerDate = th.cloneNode();
			headerDate.innerText = "Dates"
			headerRow.appendChild(headerDate);

			var headerStart = th.cloneNode();
			headerStart.innerText = "Start Time";
			headerRow.appendChild(headerStart);

			var headerEnd = th.cloneNode();
			headerEnd.innerText = "end Time";
			headerRow.appendChild(headerEnd);


	    for (var i = 0; i < totalDates; i++) {

				var aDateRow = tr.cloneNode();
				setTimeTable.appendChild(aDateRow);

				var aDate = td.cloneNode();
				aDateRow.appendChild(aDate);

				var aStart = td.cloneNode();
				aDateRow.appendChild(aStart);

				var anEnd = td.cloneNode();
				aDateRow.appendChild(anEnd);

	      // Create an input element for Date
	    	var dateToAdd = document.createElement("input");
	    	dateToAdd.setAttribute("type", "date");
	    	dateToAdd.setAttribute("name", `${i}`);
	      dateToAdd.setAttribute("class", "dates");
	      aDate.appendChild(dateToAdd);

				var start = document.createElement('input');
				start.setAttribute('type','time');
				start.setAttribute('name',`starttime${i}`);
				start.setAttribute('class','timestart');
				aStart.appendChild(start);


				var end = document.createElement('input');
				end.setAttribute('type','time');
				end.setAttribute('name',`endtime${i}`);
				end.setAttribute('class','timeend');
				anEnd.appendChild(end);

	      document.getElementById('step1').appendChild(br.cloneNode());



	    }


	    var goToStep3 = document.createElement("button");
	    goToStep3.innerText = "Add dates!";
	    goToStep3.setAttribute("id", "selectTimes");
	    goToStep3.setAttribute("value", "selectTimes");
	    goToStep3.setAttribute("onClick", "generateForm()");
	    document.getElementById("step1").appendChild(goToStep3);


		} else {
			window.alert("Tutorials Must Have A Duration That Is More Than Zero, You Must Include At Least One Day, And Select A Tutor For Tutorial");
		}

  }

  //This function generates the submission form for the final form that will post to the server!
  function generateForm(){





		//need to modify this so it takes all dates and all times for those dates
    var allDates =[];
		// don't forget to finish emplementing this!!
		var allStarts = [];
		var allEnds = [];

    for (instance of document.getElementsByClassName('dates')){
         allDates.push(instance.value);
      }
		for (instance of document.getElementsByClassName('timestart')){
				 allStarts.push(instance.value);
			}
		for (instance of document.getElementsByClassName('timeend')){
				 allEnds.push(instance.value);
			}
			document.getElementById('step1').innerHTML='';
			var schedform = document.createElement("form");
			schedform.setAttribute("method", "post");
			schedform.setAttribute('id','dateForm');
			schedform.setAttribute('action','admin.php');
			document.getElementsByTagName("body")[0].appendChild(schedform);

			var h2 = document.createElement('h2')
			var th = document.createElement('th');
			var tr = document.createElement('tr');
			var td = document.createElement('td');
			var input = document.createElement('input')

			var nameInstruct = h2.cloneNode();
			nameInstruct.innerText = "Name This Tutorial: ";
			nameInstruct.setAttribute('id','name');
			document.getElementById('dateForm').appendChild(nameInstruct);

			var tutorialName = input.cloneNode();
			tutorialName.setAttribute('name','tutname');
			tutorialName.setAttribute('type','textbox');
			tutorialName.setAttribute('id','tutname');
			tutorialName.setAttribute('placeholder','Name Your Tutorial');
			document.getElementById('name').appendChild(tutorialName);

      var addInstructions = h2.cloneNode();
      addInstructions.innerText = "Select Blocks to Use for Each Day: ";
      document.getElementById('dateForm').appendChild(addInstructions);


		var count = 0

    allDates.forEach((item, i) => {

			count++;

			var dateObject = {
				date: item,
				start: allStarts[i],
				end: allEnds[i]
			};


      var table = document.createElement("table")
      table.setAttribute('style','width:100%');
      table.setAttribute('border','2f');
      table.setAttribute('id',`times${i}`)
      document.getElementById('dateForm').appendChild(table);

      var header = tr.cloneNode();
      header.setAttribute('id',`header${i}`)
      document.getElementById(`times${i}`).appendChild(header);

      var headerDate = th.cloneNode();
      headerDate.setAttribute('id',`headdate${i}`)
      document.getElementById(`header${i}`).appendChild(headerDate);
      document.getElementById(`headdate${i}`).innerText = item;

      var headerTimes = th.cloneNode();
      headerTimes.setAttribute('id',`headtime${i}`);
      document.getElementById(`header${i}`).appendChild(headerTimes);
      document.getElementById(`headtime${i}`).innerText = "Select All: ";

			var headerSelectAll = input.cloneNode();
			headerSelectAll.setAttribute('id',`checkallDates${count}`);
			headerSelectAll.setAttribute('type','checkbox');
			document.getElementById(`headtime${i}`).appendChild(headerSelectAll);



			var startTime = new Date(`${item} ${dateObject.start}`);
			//var startTime = new Date(`${item} 06:00`);
			var endTime = new Date(`${item} ${dateObject.end}`);

			while (startTime <= endTime) {
				var timesRow = tr.cloneNode();
	      timesRow.setAttribute('id',`timesRow${startTime}`)
	      document.getElementById(`times${i}`).appendChild(timesRow);

				var times = td.cloneNode();
				document.getElementById(`timesRow${startTime}`).appendChild(times);
				times.innerText = startTime.getHours() + ":" + (startTime.getMinutes()<10?'0':'')+startTime.getMinutes();

				var selectBox = td.cloneNode();
				selectBox.setAttribute('id',`selectBox${startTime}`);
				document.getElementById(`timesRow${startTime}`).appendChild(selectBox);
				document.getElementById(`selectBox${startTime}`).innerText = "Use This Timeslot";

				var selectTime = input.cloneNode();
				selectTime.setAttribute ('id',`time${item}`);
				selectTime.setAttribute('type','checkbox');
				selectTime.setAttribute('class',`${dateObject.date}`);
				selectTime.setAttribute('name','checkbox[]');

				selectTime.setAttribute('value',`${startTime}`);
				document.getElementById(`selectBox${startTime}`).appendChild(selectTime);

				startTime = addMinutes(startTime,tutleng);

			}

			document.getElementById(`checkallDates${count}`).onclick = function(){
				var checkboxes = document.getElementsByClassName(`${dateObject.date}`);
			for (var checkbox of checkboxes){
					checkbox.checked = this.checked;
			}
		}

    });

			var tutorOnTut = input.cloneNode();
			tutorOnTut.setAttribute('type','hidden');
			tutorOnTut.setAttribute('value',`${tutorName}`);
			tutorOnTut.setAttribute('name','tutor');
			document.getElementById('dateForm').appendChild(tutorOnTut);

			var submitSlots = input.cloneNode();
			submitSlots.setAttribute('value','submit');
			submitSlots.setAttribute('name','submitSchedule');
			submitSlots.setAttribute('type','submit');
			document.getElementById('dateForm').appendChild(submitSlots);

  }
	function addMinutes(dateTime, minutes){
		 return new Date(dateTime.getTime() + minutes*60000);
	}

		</script>
