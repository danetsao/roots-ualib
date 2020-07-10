<?php
// TODO
// 1. comment out everything that ins't part of the form
// 2. move scripts to separate file
// 3. add conditional to content-page.php
// 4. test!

<!DOCTYPE html>
<html lang="en">
    <!-- Security Authorization Form: Network and Voyager Access: collapse panels-->     
    <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" type="text/css" href="stylesheet.css">     
        
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
    <!-- Javascript -->
    
	<script type='text/javascript' src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script type='text/javascript' src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type='text/javascript'>
		// JQuery functions
		$(function() { 	
			// Check to see if any Voyager Access has been requested
			$('.voyager').click(function() {				
				var checkedBoxes = $('.voyager:checked').length;
				
				if(checkedBoxes > 0) {
					$('#voyager_access_requested').val("YES");
				} else {
					$('#voyager_access_requested').val("NO");
				}
				
			});
			
			// Check to see if any Departmental Share Access has been requested
			$('.departmental_share_access').click(function() {				
				var checkedBoxes = $('.departmental_share_access:checked').length;
				
				if(checkedBoxes > 0) {
					$('#departmental_share_access_requested').val("YES");
				} else {
					$('#departmental_share_access_requested').val("NO");
				}
			});	
			
			$('.web_services').click(function() {	
				var webServices = $('.web_services:checked').length;
				
				if(webServices > 0) {
					$('#web_services_requested').val("YES");
				} else {
					$('#web_services_requested').val("NO");
				}
			});
		});
	</script>


	<script type="text/javascript">
   jQuery(document).ready(function($){

		//Mappings JSON object.  The person maintaining department mappings should use Excel to export a CSV file with departments as the first column and department groups associated with that department in subsequent columns.  

		//A tool like http://www.convertcsv.com/csv-to-json.htm can then be used to get a JSON object from that file.  This definitely isn't the most elegant way to do this -- I may give something like http://papaparse.com/ a try if this list ends up needing to be regenerated often
		

		departmentsToGroups = {
   "A.S. Williams III Americana Collection": {
      "FIELD2": "GROUP-SPECIAL_COLLECTIONS",
      "FIELD3": "GROUP-KBOX-USERS",
      "FIELD4": "GROUP-DIGITAL_PROJECTS",
      "FIELD5": "GROUP-DIGITAL_PROJECTS_RO",
      "FIELD6": "GROUP-WILLIAMS_PRINT",
      "FIELD7": "ALL-LIB",
      "FIELD8": "CollectionDevelopment",
      "FIELD9": "LB-WilliamsCollections-Staff",
      "FIELD10": "LIB-UXAG",
      "FIELD11": "",
      "FIELD12": "",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Annex Services": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-ANNEX",
      "FIELD4": "GROUP-ANNEX01",
      "FIELD5": "GROUP-CIRCULATION",
      "FIELD6": "GROUP-ANNEX_PRINT",
      "FIELD7": "ALL-LIB",
      "FIELD8": "CollectionDevelopment",
      "FIELD9": "LIB-UXAG",
      "FIELD10": "",
      "FIELD11": "",
      "FIELD12": "",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Area Computing Services": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "WORKSTATION ADMINS",
      "FIELD4": "GROUP-OLT",
      "FIELD5": "GROUP-NETADMIN",
      "FIELD6": "GROUP-HELPDESK",
      "FIELD7": "GROUP-ACS_PRINT",
      "FIELD8": "GROUP-LIBSYS_EMAIL",
      "FIELD9": "OLT",
      "FIELD10": "OLT-ACS-GLOBAL",
      "FIELD11": "OLT-ACS-STAFF",
      "FIELD12": "OLT-ACS-STUDENTS",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Bruno Business Library": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-ERESERVES",
      "FIELD4": "GROUP-3DBRUNO_EMAIL",
      "FIELD5": "GROUP-CALBRUNO_EMAIL",
      "FIELD6": "Circulation Working Discussion Group (CWDG)",
      "FIELD7": "ALL-LIB",
      "FIELD8": "CollectionDevelopment",
      "FIELD9": "LIB-UXAG",
      "FIELD10": "",
      "FIELD11": "",
      "FIELD12": "",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Business Office": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-BUDGET",
      "FIELD4": "GROUP-BUSINESS",
      "FIELD5": "GROUP-ADMINISTRATION",
      "FIELD6": "GROUP-ARLSTATS",
      "FIELD7": "GROUP-HR",
      "FIELD8": "GROUP-ENVIROMENT",
      "FIELD9": "GROUP-BUSINESS_PRINT",
      "FIELD10": "ALL-LIB",
      "FIELD11": "CollectionDevelopment",
      "FIELD12": "LIB-UXAG",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Circulation Department": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-CIRCULATION",
      "FIELD4": "GROUP-ILL",
      "FIELD5": "GROUP-CIRCMAIL_EMAIL",
      "FIELD6": "GROUP-GORGRES_EMAIL",
      "FIELD7": "GROUP-ERESERVES",
      "FIELD8": "GROUP-ILLSTAFF_EMAIL",
      "FIELD9": "GROUP-CIRC_PRINT",
      "FIELD10": "ALL-LIB",
      "FIELD11": "Circulation Working Discussion Group (CWDG)",
      "FIELD12": "CollectionDevelopment",
      "FIELD13": "LIB-UXAG",
      "FIELD14": "RI-CIRC-GLOBAL",
      "FIELD15": "RI-CIRC-STAFF",
      "FIELD16": "RI-CIRC-STUDENTS"
   },
   "Digital Humanities Center": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-ADHC",
      "FIELD4": "GROUP-ADHC_PRINT",
      "FIELD5": "ALL-LIB",
      "FIELD6": "CollectionDevelopment",
      "FIELD7": "LIB-UXAG",
      "FIELD8": "",
      "FIELD9": "",
      "FIELD10": "",
      "FIELD11": "",
      "FIELD12": "",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Digital Services": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-DIGITAL_PROJECTS",
      "FIELD4": "GROUP-DIGITAL_PROJECTS_RO",
      "FIELD5": "GROUP-DIGITAL_PRINT",
      "FIELD6": "ALL-LIB",
      "FIELD7": "CollectionDevelopment",
      "FIELD8": "LIB-UXAG",
      "FIELD9": "OLT-DS",
      "FIELD10": "",
      "FIELD11": "",
      "FIELD12": "",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Gorgas Information Services": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-INFORMATION",
      "FIELD4": "GROUP-MUSICLIB_EMAIL",
      "FIELD5": "GROUP-GIS_PRINT",
      "FIELD6": "ALL-LIB",
      "FIELD7": "CollectionDevelopment",
      "FIELD8": "LIB-UXAG",
      "FIELD9": "",
      "FIELD10": "",
      "FIELD11": "",
      "FIELD12": "",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Assessment & Government Information": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-GOV_DOCS",
      "FIELD4": "GROUP-GOVDOCS_PRINT",
      "FIELD5": "ALL-LIB",
      "FIELD6": "CollectionDevelopment",
      "FIELD7": "LIB-UXAG",
      "FIELD8": "LIBINSIGHT",
      "FIELD9": "",
      "FIELD10": "",
      "FIELD11": "",
      "FIELD12": "",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Hoole Special Collections": {
      "FIELD2": "GROUP-SPECIAL_COLLECTIONS",
      "FIELD3": "GROUP-KBOX-USERS",
      "FIELD4": "GROUP-HOOLEILL_EMAIL",
      "FIELD5": "GROUP-ARCHIVES_DATABASE",
      "FIELD6": "GROUP-ARCHIVES-EMAIL",
      "FIELD7": "GROUP-HOOLE_PRINT",
      "FIELD8": "ALL-LIB",
      "FIELD9": "Circulation Working Discussion Group (CWDG)",
      "FIELD10": "CollectionDevelopment",
      "FIELD11": "HL-SPECIALCOLLECTIONS",
      "FIELD12": "LIB-GUEST-EZPROXY",
      "FIELD13": "LIB-UXAG",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Institutional Repository Services": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-IRANNEX",
      "FIELD4": "GROUP-IR_EMAIL",
      "FIELD5": "GROUP-IR_PRINT",
      "FIELD6": "ALL-LIB",
      "FIELD7": "CollectionDevelopment",
      "FIELD8": "LIB-UXAG",
      "FIELD9": "",
      "FIELD10": "",
      "FIELD11": "",
      "FIELD12": "",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Interlibrary Loan": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-ILL",
      "FIELD4": "GROUP-ILLSTAFF_EMAIL",
      "FIELD5": "GROUP-CIRCULATION",
      "FIELD6": "GROUP-ERESERVES",
      "FIELD7": "GROUP-CIRCMAIL_EMAIL",
      "FIELD8": "GROUP-GORGRES_EMAIL",
      "FIELD9": "ALL-LIB",
      "FIELD10": "CollectionDevelopment",
      "FIELD11": "LIB-UXAG",
      "FIELD12": "GROUP-CIRC_PRINT",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Library Administration": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-DEAN",
      "FIELD4": "GROUP-DEAN&SEC",
      "FIELD5": "GROUP-ARLSTATS",
      "FIELD6": "GROUP-ASSESSMENT",
      "FIELD7": "GROUP-BUDGET",
      "FIELD8": "GROUP-ADMINISTRATION",
      "FIELD9": "GROUP-DIGIHUM",
      "FIELD10": "GROUP-INFOLIT",
      "FIELD11": "GROUP-ADMIN_PRINT",
      "FIELD12": "ALL-LIB",
      "FIELD13": "CollectionDevelopment",
      "FIELD14": "Hathitrust",
      "FIELD15": "LIB-UXAG",
      "FIELD16": ""
   },
   "McLure Education Library": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-EDUCATION",
      "FIELD4": "GROUP-MCLUREILL_EMAIL",
      "FIELD5": "GROUP-MCLURELIB_EMAIL",
      "FIELD6": "GROUP-3DMCLURE_EMAIL",
      "FIELD7": "GROUP-CALMCLURE_EMAIL",
      "FIELD8": "GROUP-EDUCATION_PRINT",
      "FIELD9": "ALL-LIB",
      "FIELD10": "Circulation Working Discussion Group (CWDG)",
      "FIELD11": "LIB-UXAG",
      "FIELD12": "",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Digital Services": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-DIGITAL_PROJECTS",
      "FIELD4": "GROUP-DIGITAL_PROJECTS_RO",
      "FIELD5": "GROUP-SPECIAL_COLLECTIONS",
      "FIELD6": "GROUP-DIGITAL_PRINT",
      "FIELD7": "ALL-LIB",
      "FIELD8": "CollectionDevelopment",
      "FIELD9": "LIB-UXAG",
      "FIELD10": "OLT-DS",
      "FIELD11": "",
      "FIELD12": "",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Resource Acquisitions & Discovery": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-CATALOGING",
      "FIELD4": "GROUP-ACQUISITIONS",
      "FIELD5": "GROUP-ERESOURCES",
      "FIELD6": "GROUP-ERM-LICENSES",
      "FIELD7": "GROUP-METADATA",
      "FIELD8": "GROUP-LIBRARYACQ_EMAIL",
      "FIELD9": "GROUP-RUSHCATS_EMAIL",
      "FIELD10": "GROUP-CATALOG_DEPT_EMAIL",
      "FIELD11": "GROUP-RAD_PRINT",
      "FIELD12": "ALL-LIB",
      "FIELD13": "CollectionDevelopment",
      "FIELD14": "LIB-UXAG",
      "FIELD15": "OLT-ERES",
      "FIELD16": "Resource-Acquisitions-Discovery"
   },
   "Rodgers Library for Science and Engineering": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-SCIENCE_ENGINEERING",
      "FIELD4": "GROUP-SELILL_EMAIL",
      "FIELD5": "GROUP-3DRODGERS_EMAIL",
      "FIELD6": "GROUP-CALRODGERS_EMAIL",
      "FIELD7": "GROUP-SCENGLIB_EMAIL",
      "FIELD8": "GROUP-SCI_PRINT",
      "FIELD9": "ALL-LIB",
      "FIELD10": "CollectionDevelopment",
      "FIELD11": "LIB-UXAG",
      "FIELD12": "RL-CIRC-STAFF",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Sanford Media Center": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-MEDIA_SERVICES",
      "FIELD4": "GROUP-SMC_EMAIL",
      "FIELD5": "GROUP-SMC_PRINT",
      "FIELD6": "ALL-LIB",
      "FIELD7": "CollectionDevelopment",
      "FIELD8": "LIB-UXAG",
      "FIELD9": "SMC-STAFF",
      "FIELD10": "",
      "FIELD11": "",
      "FIELD12": "",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   },
   "Web Technologies and Development": {
      "FIELD2": "GROUP-KBOX-USERS",
      "FIELD3": "GROUP-WEBDEV_EMAIL",
      "FIELD4": "GROUP-OLT",
      "FIELD5": "GROUP-GOTS-EMAIL",
      "FIELD6": "GROUP-WEB_SERVICES",
      "FIELD7": "GROUP-WEBDEV_PRINT",
      "FIELD8": "ALL-LIB",
      "FIELD9": "CollectionDevelopment",
      "FIELD10": "LIB-UXAG",
      "FIELD11": "OLT-WEB",
      "FIELD12": "OLT-WID",
      "FIELD13": "",
      "FIELD14": "",
      "FIELD15": "",
      "FIELD16": ""
   }
}


		//Field 8 is the departmental dropdown
		$('#field8').change(function(obj){
		   

			//Get the selected department
			var department = $("select option:selected" )[0].textContent;

			//Uncheck currently checked departmental boxes
			$('#collapse4 .checkbox input:checked').each(function(){
			    this.checked = false;
			});
			
			//Uncheck currently checked email distribution groups
			$('#collapse5 .checkbox input:checked').each(function(){
			    this.checked = false;
			});


			//Get groups to add from overly large array above
			var groupsToAdd = departmentsToGroups[department];

			//Declare array groups will be added to
			var groupsToAddArray = [];


			//Get groups to add from overly large array above
			Object.keys(groupsToAdd).forEach(function(key){
			  if (groupsToAdd[key] != ''){
			  	groupsToAddArray.push(groupsToAdd[key]);
		  	  }
			});

			for (i = 0; i < groupsToAddArray.length; i++){

			  //Process group name for comparison with value in HTML -- alternatively, the HTML values could be changed to match the groups.
			  var currentGroupName = groupsToAddArray[i];
				if (currentGroupName.slice(0,5) == 'GROUP'){
					var currentGroupName = currentGroupName.trim();
					var currentGroupName = currentGroupName.slice(6);
					var currentGroupName = currentGroupName.replace(/-/g, ' ');
					var currentGroupName = currentGroupName.replace(/_/g, ' ');		
				}
				

			  //Build selector for checkbox
			  var selector = 'input[value="' + currentGroupName + '"]';

			  //Debugging
			  //console.log(selector);

			  //Check selected box 
			  $(selector).each(function(){
			    this.checked = true; 
			  });
			}
			
			  // Check to see if any Voyager Access has been requested (it's not triggered by a departmental selection, so it shouldn't be).  
				var checkedBoxes = $('.voyager:checked').length;
			
				if(checkedBoxes > 0) {
					$('#voyager_access_requested').val("YES");
				} else {
					$('#voyager_access_requested').val("NO");
				}
				
				// Check to see if any Departmental Share Access has been requested
				var checkedBoxes = $('.departmental_share_access:checked').length;
				
				if(checkedBoxes > 0) {
					$('#departmental_share_access_requested').val("YES");
				} else {
					$('#departmental_share_access_requested').val("NO");
				}
				
				// Check to see if any Web Services Access has been requested
				var webServices = $('.web_services:checked').length;
				
				if(webServices > 0) {
					$('#web_services_requested').val("YES");
				} else {
					$('#web_services_requested').val("NO");
				}

		});
		
		//Autofill AD telephone and email based on name selection
		$('#AssociateDean').change(function(obj){
			
					if ($(this).val() == 'Tom Wilson'){
						$('#AssociateDeanPhone').val('2299');
						$('#AssociateDeanEmail').val('tcwilson@ua.edu');
					}
					if ($(this).val() == 'Millie Jackson'){
						$('#AssociateDeanPhone').val('5008');
						$('#AssociateDeanEmail').val('mljackson@ua.edu');
					}
					if ($(this).val() == 'Lorraine Madway'){
						$('#AssociateDeanPhone').val('0513');
						$('#AssociateDeanEmail').val('lmadway@ua.edu');
					}
					if ($(this).val() == 'Emily Decker'){
						$('#AssociateDeanPhone').val('3497');
						$('#AssociateDeanEmail').val('endecker@ua.edu');
					}
				});
				
		 //Hide AD row when student is selected for employee type, show it when faculty/staff is selected
			$('input[name="OBKey_Employee_Type_1"]').change(function(obj){
			   console.log("change!");
				 var employeeTypeValue = $(this).val(); 
				 //console.log("this val is " + employeeTypeValue);
				if (employeeTypeValue == 'STUDENT/GTA/INTERN'){
					$('#AssociateDean').val('');
					$('#AssociateDeanPhone').val('');
					$('#AssociateDeanEmail').val('');
					$('#AssociateDean').removeAttr('required');
					$('#AssociateDeanPhone').removeAttr('required');
					$('#AssociateDeanEmail').removeAttr('required');
					$('#ADRow').hide();
				}
				else {
					$('#ADRow').show();				
					$('#AssociateDean').prop('required', true);
					$('#AssociateDeanPhone').prop('required', true);
					$('#AssociateDeanEmail').prop('required', true);					
				}
			});

    });
	</script>

    <title>Network & Voyager Access</title>
	</head>
	
	<body> 
		<div class="container">
			<img src="https://imageweb.ua-net.ua.edu/AppNet/images/librariesk_black.png" alt="UA Libraries Logo" style="width:150px;height:60px">
            <!--
               OBTEST: https://imageweb-test.ua-net.ua.edu/AppNet/images/librariesk_black.png
               OBPROD: https://imageweb.ua-net.ua.edu/AppNet/images/librariesk_black.png
            -->
				<h1 class="h2">Security Authorization Form</h1>
				<h2 class="h3">Network & Voyager Access</h2>
         <hr>
		
			<form name="form" action="https://imageweb.ua-net.ua.edu/Public/LoginFormProc.aspx?FromLoginFormProc=true" method="post">
            <!--
               OBTEST: https://imageweb-test.ua-net.ua.edu/Public/LoginFormProc.aspx?FromLoginFormProc=true
               OBPROD: https://imageweb.ua-net.ua.edu/Public/LoginFormProc.aspx?FromLoginFormProc=true
            -->
			
				<!-- Begin Required OnBase Fields -->
				<div id="loginformprocparams"> 
					<input type="hidden" name="LanguageParam" value="en-us" />
					<input type="hidden" name="OBWeb_FinalTargetPage" value="https://intranet.lib.ua.edu/acsforms/saForm/landing.html"/>
					<input type="hidden" name="OBDocumentType" value="884" /><!-- OBTEST: 755 OBPROD: 884 -->
					<input type="hidden" name="OBWeb_Redirect" value="https://intranet.lib.ua.edu/acsforms/saForm/landing.html"/>
				</div>
				<input type="hidden" id="voyager_access_requested" name="OBKey_UL_Voyager_Access_Requested_1" value="NO" />
				<input type="hidden" id="departmental_share_access_requested" name="OBKey_UL_Departmental_Share_Access_Requested_1" value="NO" />
				<input type="hidden" id="web_services_requested" name="OBKey_UL_Web_Services_Requested_1" value="NO" />
				<!-- End Required OnBase Fields -->
				
				<div class="row">
						<div class="col-md-4">
							<fieldset class="form-group">
								<label for="field1">
									Effective Date: 
								</label>
								<input required type="date" class="form-control" name="OBKey_Effective_Date_1" id="field1">
							</fieldset>
						</div>
					</div>
		
					<div class="row">
								<p style="font-weight:700; padding-left: 15px;">Request Type</p>
						<div class="col-md-2">
							<fieldset class="form-group">
								<label class="radio-inline">
									<input required type="radio" name="OBKey_Request_Type_1" value="Add Employee">
									Add new employee
								</label>
							</fieldset>
						</div>
						<div class="col-md-4">
							<fieldset class="form-group">
								<label class="radio-inline">
									<input type="radio" name="OBKey_Request_Type_1" value="Change Info">
									Change to info/requirements of existing account
								</label>
							</fieldset>
						</div>
						<div class="col-md-4">
							<fieldset class="form-group">
								<label class="radio-inline">
									<input type="radio" name="OBKey_Request_Type_1" value="Transfer">
									Transfer to another dept within the libraries
								</label>
							</fieldset>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-7">
							<fieldset class="form-group">
								<label for="field2">
									Employee Name (First Middle Last)
								</label>
									<input required type="text" class="form-control" name="OBKey_Employee_Name_1" id="field2" >
							</fieldset>
						</div>
						<div class="col-md-5">
							<fieldset class="form-group">
								<label for="field3">
									Current User ID (for existing users) <em>NOT CWID</em>
								</label>
									<input type="text" class="form-control" name="OBKey_UL_User_ID_1" id="field3">
							</fieldset>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-4">
							<fieldset class="form-group">
								<label for="field4">
									Position Title
								</label>
									<input required type="text" class="form-control" name="OBKey_Position_Title_1" id="field4">
							</fieldset>
						</div>
						<div class="col-md-3">
							<fieldset class="form-group">
								<label for="field5">
									Work Telephone (last 4 digits) 
								</label>
									<input required type="text" class="form-control" name="OBKey_Office_Phone_1" id="field5">
							</fieldset>
						</div>	
						<div class="col-md-5">
							<fieldset class="form-group">
								<label for="field6">
									Email Address <small>(enter an address the user currently has access to)</small>

								</label>
									<input required type="email" class="form-control" name="OBKey_Employee_Email_1" id="field6">
							</fieldset>
						</div>	
					</div>	
					
					<div class="row">
						<div class="col-md-2">
							<fieldset class="form-group">
								<label for="field7">
									Office Room Number
								</label>
									<input required type="text" class="form-control" name="OBKey_Room_Number_1" id="field7">
							</fieldset>
						</div>	
						<div class="col-md-3">
							<fieldset class="form-group">
								<label for="field8">
									Department
								</label>
									<select required class="form-control" name="OBKey_Department_1" id="field8">
									<option value="" disabled selected hidden>Choose A Department</option>
									<option value="williams">A.S. Williams III Americana Collection</option>
									<option value="annex">Annex Services</option>
									<option value="acs">Area Computing Services</option>
									<option value="govdocs">Assessment & Government Information</option>
									<option value="bruno">Bruno Business Library</option>
									<option value="businessoffice">Business Office</option>
									<option value="circulation">Circulation Department</option>
									<option value="dhc">Digital Humanities Center</option>
									<option value="digitalservices">Digital Services</option>
									<option value="gis">Gorgas Information Services</option>
									<option value="hoole">Hoole Special Collections</option>
									<option value="ir">Institutional Repository Services</option>
									<option value="ill">Interlibrary Loan</option>
									<option value="libadmin">Library Administration</option>
									<option value="mclure">McLure Education Library</option>
									<option value="acquisitions">Resource Acquisitions &amp; Discovery</option>
									<option value="rodgers">Rodgers Library for Science and Engineering</option>
									<option value="smc">Sanford Media Center</option>
									<option value="webservices">Web Technologies and Development</option>
									</select>
							</fieldset>
						</div>	
				
		
						<div class="col-md-3">
							<p id="employeeType" style="font-weight:700;">Employee Type</p>
							<div class="row">
								<div class="col-md-4">
									<fieldset class="form-group">
										<label class="radio-inline">
											<input required type="radio" name="OBKey_Employee_Type_1" value="FACULTY/PROFESSIONAL">
											Faculty
										</label>
									</fieldset>
								</div>
								<div class="col-md-4">
									<fieldset class="form-group">
										<label class="radio-inline">
											<input type="radio" name="OBKey_Employee_Type_1" value="STAFF">
											Staff 
										</label>
									</fieldset>
								</div>
								<div class="col-md-4">
									<fieldset class="form-group">
										<label class="radio-inline">
											<input type="radio" name="OBKey_Employee_Type_1" value="STUDENT/GTA/INTERN">
											Student
										</label>
									</fieldset>
								</div>
							</div>	
						</div>
					</div>
					
					<div class="row">	
						<div class="col-md-4">
							<fieldset class="form-group">
								<label for="field13">
									Submitter
								</label>
								<input required type="text" class="form-control" name="OBKey_Submitter_1" id="field13">
							</fieldset>
						</div>
						<div class="col-md-3">
							<fieldset class="form-group">
								<label for="field14">
									Submitter's Telephone (last 4 digits)
								</label>
								<input required type="text" class="form-control" name="OBKey_Submitters_Phone_Number_1" id="field14">
							</fieldset>
						</div>
						<div class="col-md-5">
							<fieldset class="form-group">
								<label for="field15">
									Submitter's Email
								</label>
								<input required type="email" class="form-control" name="OBKey_Submitters_Email_1" id="field15">
							</fieldset>
						</div>	
					</div>
					
					<div class="row" id="ADRow">						
						<div class="col-md-4">
							<fieldset class="form-group">
								<label for="AssociateDean">
									Associate Dean
								</label>
								<select required class="form-control" name="OBKey_Associate_Dean_Name_1" id="AssociateDean">
								  <option selected></option>
									<option>Tom Wilson</option>
									<option>Millie Jackson</option>
									<option>Lorraine Madway</option>
									<option>Emily Decker</option>
								</select>
							</fieldset>
						</div>
						<div class="col-md-3">
							<fieldset class="form-group">
								<label for="AssociateDeanPhone">
									Associate Dean's Telephone (last 4 digits)
								</label>
								<input type="text" class="form-control" name="OBKey_Associate_Dean_Phone_1" id="AssociateDeanPhone">
							</fieldset>
						</div>
						<div class="col-md-5">
							<fieldset class="form-group">
								<label for="AssociateDeanEmail">
									Associate Dean's Email
								</label>
								<input type="email" class="form-control" name="OBKey_Associate_Dean_Email_1" id="AssociateDeanEmail">
							</fieldset>
						</div>	
					</div>
					
					
						<h2>Account Access</h2>
							<p>Please note: Voyager Profiles-One selection is required for each module. <em>Access will only be given for selected items.</em> If no selections are made, the form may be sent back.</p>
							<p>Descriptions of the various profiles are <a href="https://intranet.lib.ua.edu/olt/resources">on the intranet</a>.</p>
		
<div class="panel-group" id="accordion">
<!--first panel-->
	<div class="panel panel-default">
	    <div class="panel-heading">
			<h4 class="panel-title">
			    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">A1. Acquisitions Profiles</a>
			</h4>
		</div>  
		<div id="collapse1" class="panel-collapse collapse">
			<div class="panel-body">
			  	<div class="form-group">
					<div class="checkbox">
					<label>
			        <input type="checkbox" class="voyager" name="OBKey_UL_Acquisitions_Profiles_1" value="Acq - HS - Comb">
				    Acq - HS - Comb
					</label>
					</div>	
				    <div class="checkbox"> 
					<label>
			        <input type="checkbox" class="voyager" name="OBKey_UL_Acquisitions_Profiles_2" value="Acq - HS - Ser"> 
				    Acq - HS - Ser
					</label>	
					</div>  
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Acquisitions_Profiles_3" value="Acq - Ser - kr "> 
					Acq - Ser - kr 
					</label>
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Acquisitions_Profiles_4" value="AcqStu">
					AcqStu 
					</label>
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Acquisitions_Profiles_5" value="Acquisitions - Mono2">	
					Acquisitions - Mono2
					</label>
					</div>	
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Acquisitions_Profiles_6" value="Acquisitions - Monographs">
					Acquisitions - Monographs 
					</label>
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Acquisitions_Profiles_7" value="Acquisitions - Serials">
					Acquisitions - Serials
					</label>
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Acquisitions_Profiles_8" value="Acquisitions Supervisor">
					Acquisitions Supervisor 
					</label>
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Acquisitions_Profiles_9" value="Acquisitions - PromptCat">
					Acquisitions - PromptCat
					</label>
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Acquisitions_Profiles_10" value="Business Office I">
					Business Office I 
					</label>
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Acquisitions_Profiles_11" value="Business Office II">
					Business Office II 
					</label>
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Acquisitions_Profiles_12" value="Selector/Binding">
					Selector/Binding
					</label>
					</div>
				</div>	
			</div>	
		</div>	
	</div>	
<!--second panel-->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">A2. Cataloging Profiles</a>
				</h4>
		</div>
		<div id="collapse2" class="panel-collapse collapse"> 
			<div class="panel-body"> 
				<div class="form-group">
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Cataloging_Profiles_1" value="AcqCat">
					AcqCat
					</label>
					</div>	
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Cataloging_Profiles_2" value="CatViewOnly">
					CatViewOnly
					</label> 
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Cataloging_Profiles_3" value="Catalog Assistant I">
					Catalog Assistant I
					</label>
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Cataloging_Profiles_4" value="Catalog Assistant II">
					Catalog Assistant II 
					</label>
					</div> 
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Cataloging_Profiles_5" value="Catalog External">
					Catalog External
					</label>
					</div>	
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Cataloging_Profiles_6" value="Catalog Supervisor">
					Catalog Supervisor
					</label>
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Cataloging_Profiles_6" value="Catalog Supervisor II">
					Catalog Supervisor II
					</label>
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Cataloging_Profiles_7" value="Copy Catalog">
					Copy Catalog
					</label>
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Cataloging_Profiles_8" value="Copy Catalog GPO">
					Copy Catalog GPO 
					</label>
					</div>	
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Cataloging_Profiles_9" value="HS Catalog">
					HS Catalog
					</label>
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Cataloging_Profiles_9" value="HS Catalog Assistant">
					HS Catalog Assistant
					</label>
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Cataloging_Profiles_10" value="HSL Cataloging">
					HSL Cataloging
					</label>
					</div>
					<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Cataloging_Profiles_11" value="Reserves">
					Reserves
					</label>
					</div>	
					<div class="checkbox">
					<label> 
					<input type="checkbox" class="voyager" name="OBKey_UL_Cataloging_Profiles_12" value="Student GPO">
					Student GPO 
					</label>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--third panel-->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
		    	<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">A3. Circulation Profiles</a>
				</h4>
		</div>
		<div id="collapse3" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="form-group">
				
				<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_1" value="CircCat">
					CircCat
					</label>
				</div>
				<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_2" value="CircOperSpecColl">
					CircOperSpecColl
					</label>
				</div>
				<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_3" value="CircOperWPatronEdit">
					CircOperW/Patron_Edit_tmp
					</label>
				</div>
				<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_4" value="CircOper">
					CircOperator
					</label>
				</div>
				<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_5" value="CircOperPlus">
					CircOperatorPlus</label>
				</div>
				<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_6" value="CircPatronViewOnly">
					CircPatronViewOnly
					</label>
				</div>
				<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_7" value="CircSelector/Acq Gifts">
					CircSelector/Acq Gifts
					</label>
				</div>	
				<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_8" value="CircSupervisor">
					CircSupervisor
					</label>
				</div>	
				<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_9" value="CircSuperSSN">
					CircSupervisorSSN
					</label>
				</div>	
				<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_10" value="CircReserve">
					CircWithReserve
					</label>
				</div>
				<div class="checkbox"> 
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_11" value="HS Circ">
					HS Circ
					</label>
				</div>
				<div class="checkbox"> 
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_12" value="HS Circ Operator">
					HS Circ Operator
					</label>
				</div>
				<div class="checkbox">				
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_13" value="HS Circ/Res">
					HS Circ/Res
					</label>
				</div>
				<div class="checkbox"> 
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_14" value="Media Center Students">
					Media Center Students
					</label>
				</div>
				<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_15" value="Selfchk"> 
					Selfchk
					</label>
				</div>
				<div class="checkbox"> 
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_16" value="WRCStaff">
					WRCStaff	
					</label>
				</div>
				<div class="checkbox">
					<label>
					<input type="checkbox" class="voyager" name="OBKey_UL_Circulation_Profiles_17" value="WRCStudent">
					WRCStudent
					</label>
				</div>
			  </div>
          	</div>			
	  	</div>
   	</div>
<!--fourth panel-->
	<div class="panel panel-default">
	    <div class="panel-heading">
			<h4 class="panel-title">
			    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">B. Departmental Share and Print Access <small>  (Choose all that apply)</small></a>
			</h4>
		</div>  
		<div id="collapse4" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="form-group">
					<div class="row">				
						<div class="col-md-3">
				
				<div class="checkbox"> 
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_1" value="ACADEMIC LABS" />
								ACADEMIC LABS
								</label>
						    </div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_2" value="ACQUISITIONS" />
								ACQUISITIONS
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_57" value="ACS PRINT" />
								ACS PRINT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_3" value="ADHC" />
								ADHC
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_58" value="ADHC PRINT" />
								ADHC PRINT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_4" value="ADMINISTRATION" />
								ADMINISTRATION
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_59" value="ADMIN PRINT" />
								ADMIN PRINT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_5" value="ANNEX" />
								ANNEX
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_6" value="ANNEX01" />
								ANNEX01
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_60" value="ANNEX PRINT" />
								ANNEX PRINT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_7" value="ARCHIVES DATABASE" />
								ARCHIVES DATABASE
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_8" value="ARLSTATS" />
								ARLSTATS
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_9" value="ASSESSMENT" />
								ASSESSMENT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_62" value="CALBRUNO EMAIL" />
								BRUNO CALENDAR
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_10" value="BUDGET" />
								BUDGET
								</label>
							</div>	
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_11" value="BUSINESS" />
								BUSINESS
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_63" value="BUSINESS PRINT" />
								BUSINESS PRINT
								</label>
							</div>
						</div>	
						
						<div class="col-md-3">
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_12" value="CATALOGING" />
								CATALOGING
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_14" value="CIRCULATION" />
								CIRCULATION
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_64" value="CIRC PRINT" />
								CIRC PRINT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_15" value="DEAN" />
								DEAN
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_16" value="DEAN&SEC" />
								DEAN&SEC
								</label>
							</div>

							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_17" value="DIGIHUM" />
								DIGIHUM
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_65" value="DIGITAL PRINT" />
								DIGITAL PRINT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_18" value="DIGITAL PROJECTS" />
								DIGITAL PROJECTS
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_19" value="DIGITAL PROJECTS RO" />
								DIGITAL PROJECTS RO
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_20" value="EDUCATION" />
								EDUCATION
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_66" value="EDUCATION PRINT" />
								EDUCATION PRINT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_21" value="ENVIROMENT" />
								ENVIRONMENT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_22" value="ERESERVES" />
								ERESERVES
								</label>
							</div>
							<div class="checkbox">
								<label>	
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_23" value="ERESOURCES" />
								ERESOURCES
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_24" value="ERM LICENSES" />
								ERM-LICENSES
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_67" value="GIS PRINT" />
								GIS PRINT
								</label>
							</div>
						</div>
					
						<div class="col-md-3">
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_27" value="GOV DOCS" />
								GOV DOCS
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_68" value="GOVDOCS PRINT" />
								GOV DOCS PRINT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_28" value="HELPDESK" />
								HELP DESK
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_69" value="HOOLE PRINT" />
								HOOLE PRINT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_30" value="HR" />
								HR
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_31" value="ILL" />
								ILL
								</label>
							</div>	

							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_33" value="INFOLIT" />
								INFOLIT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_34" value="INFORMATION" />
								INFORMATION
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_70" value="IRANNEX" />
								IR ANNEX
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_71" value="IR PRINT" />
								IR PRINT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_35" value="JSTOR" />
								JSTOR
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_36" value="KBOX USERS" />
								KBOX USERS
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_37" value="LIBNAS1 RW ACCESS" />
								LIBNAS1 RW ACCESS
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_85" value="LIBINSIGHT" />
								LIBINSIGHT
								</label>
							</div>

							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_42" value="MEDIA SERVICES" />
								MEDIA SERVICES
								</label>
							</div>			
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_43" value="METADATA" />
								METADATA
								</label>
							</div>				
						</div>	
					
						<div class="col-md-3">
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_86" value="NDNP PROJECT" />
								NDNP PROJECT
								</label>
							</div>				
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_83" value="NETADMIN" />
								NETADMIN
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_45" value="OLT" />
								OLT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_75" value="RAD PRINT" />
								RAD PRINT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_47" value="SCIENCE ENGINEERING" />
								SCIENCE ENGINEERING
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_81" value="SCI PRINT" />
								SCIENCE PRINT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_78" value="SMC PRINT" />
								SMC PRINT
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_50" value="SPECIAL COLLECTIONS" />
								SPECIAL COLLECTIONS
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="web_services" name="OBKey_UL_Departmental_Share_Access_51" value="WEB SERVICES" />
								WEB SERVICES
								</label>
							</div>	
							<div class="checkbox">
								<label>
								<input type="checkbox" class="web_services" name="OBKey_UL_Departmental_Share_Access_52" value="WEB LIBGUIDES" />
								WEB LIBGUIDES
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="web_services" name="OBKey_UL_Departmental_Share_Access_53" value="WEB LIBANSWERS" />
								WEB LIBANSWERS
								</label>
              </div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="web_services" name="OBKey_UL_Departmental_Share_Access_54" value="WEB LIBCAL" />
								WEB LIBCAL 
								</label>
							</div>
							<div class="checkbox">	
								<label>
								<input type="checkbox" class="web_services" name="OBKey_UL_Departmental_Share_Access_79" value="WEBDEV PRINT" />
								WEBDEV PRINT
								</label>
							</div>
							<div class="checkbox">	
								<label>
								<input type="checkbox" class="web_services" name="OBKey_UL_Departmental_Share_Access_80" value="WILLIAMS PRINT" />
								WILLIAMS PRINT
								</label>
							</div>
							<div class="checkbox">	
								<label>
								<input type="checkbox" class="departmental_share_acces" name="OBKey_UL_Departmental_Share_Access_84" value="WORKSTATION ADMINS" />
								WORKSTATION ADMINS
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_56" value="OTHER" />Other
								</label>
								<label>
								<input type="text" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_Other_1" />
								</label>
							</div>	
				
				
				
				
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
<!--fifth panel-->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">C. Departmental Email and Email Distribution Groups <small>(Choose all that apply)</small></a>
			</h4>
		</div>
		<div id="collapse5" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="row">
					<div class="form-group">
						<div class="col-md-6" id="email-left-col">
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_1" value="ALL-LIB">
									ALL-LIB
								</label>
              </div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_61" value="3DBRUNO EMAIL" />
								BRUNO 3D PRINTING EMAIL
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_13" value="CIRCMAIL EMAIL" />
								CIRCMAIL EMAIL
								</label>
							</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_2" value="WDG">
									Circulation Working Discussion Group (CWDG)
								</label>
				    		</div>									
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_3" value="CollectionDevelopment">
										Collection Development
									</label>
				    		</div>					    		
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_25" value="GORGRES EMAIL" />
								GORGRES EMAIL
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_26" value="GOTS EMAIL" />
								GOTS EMAIL
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_24" value="ARCHIVES EMAIL" />
								ARCHIVES EMAIL
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_25" value="CATALOG DEPT EMAIL" />
								CATALOG DEPT EMAIL
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_26" value="SCENGLIB EMAIL" />
								SCENGLIB EMAIL
								</label>
							</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_4" value="Hathitrust">
									Hathitrust Request
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_5" value="HL-SPECIALCOLLECTIONS">
									HL-SPECIALCOLLECTIONS
								</label>
				    		</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_29" value="HOOLEILL EMAIL" />
								HOOLEILL EMAIL 
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_32" value="ILLSTAFF EMAIL" />
								ILL STAFF EMAIL 
								</label>
							</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_6" value="LB-WilliamsCollections-Staff">
									LB-WilliamsCollections-Staff
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_27" value="LIB-GUEST-EZProxy">
									LIB-GUEST-EZProxy
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_7" value="LIB-UXAG">
									LIB-UXAG
								</label>
				    		</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_38" value="LIBRARYACQ EMAIL" />
								LIBRARYACQ EMAIL
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_39" value="LIBSYS EMAIL" />
								LIBSYS EMAIL
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_72" value="3DMCLURE EMAIL" />
								MCLURE 3D PRINTING EMAIL
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_73" value="CALMCLURE EMAIL" />
								MCLURE CALENDAR EMAIL
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_40" value="MCLUREILL EMAIL" />
								MCLUREILL EMAIL 
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_41" value="MCLURELIB EMAIL" />
								MCLURELIB EMAIL 
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_74" value="MUSICLIB EMAIL" />
								MUSIC LIBRARY EMAIL
								</label>
							</div>
						</div>
						<div class="col-md-6" id="email-right-col">
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_8" value="OLT">
									OLT
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
									<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_9" value="OLT-ACS-GLOBAL">
									OLT-ACS-GLOBAL
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_10" value="OLT-ACS-STAFF">
									OLT-ACS-STAFF
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_11" value="OLT-ACS-STUDENTS">
									OLT-ACS-STUDENTS
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_12" value="OLT-DS">
									OLT-DS
								</label>
				    		</div>				    		
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_13" value="OLT-ERES">
									OLT-ERES
								</label>
				    		</div>								
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_14" value="OLT-Global">
									OLT-Global
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_15" value="OLT-LIB-LEC">
									OLT-LIB-LEC
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_16" value="OLT-Managers">
									OLT-MANAGERs
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_17" value="OLT-WEB">
									OLT-WEB
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_18" value="OLT-WID">
									OLT-WID
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_19" value="Resource-Acquisitions-Discovery">
									Resource-Acquisitions-Discovery
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_20" value="RI-CIRC-GLOBAL">
									RI-CIRC-GLOBAL
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_21" value="RI-CIRC-STAFF">
									RI-CIRC-STAFF
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_22" value="RI-CIRC-STUDENTS">
									RI-CIRC-STUDENTS
								</label>
				    		</div>
							<div class="checkbox"> 
								<label>
								<input type="checkbox" class="email_distribution_groups" name="OBKey_UL_Email_Distribution_Groups_23" value="RL-CIRC-STAFF">
									RL-CIRC-STAFF
								</label>
              </div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_76" value="3DRODGERS EMAIL" />
								RODGERS 3D PRINTING EMAIL
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_77" value="CALRODGERS EMAIL" />
								RODGERS CALENDAR EMAIL
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_46" value="RUSHCATS EMAIL" />
								RUSHCATS EMAIL 
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_48" value="SELILL EMAIL" />
								SELILL EMAIL 
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_49" value="SMC EMAIL" />
								SMC EMAIL
								</label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" class="departmental_share_access" name="OBKey_UL_Departmental_Share_Access_82" value="SMC-STAFF" />
								SMC-STAFF
								</label>
							</div>
							<div class="checkbox">	
								<label>
								<input type="checkbox" class="web_services" name="OBKey_UL_Departmental_Share_Access_55" value="WEBDEV EMAIL" />
								WEBDEV EMAIL
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

 <hr>

 <div class="form-group">
      <label for="comment">Comments:</label>
		<textarea name="comment" class="form-control" rows="3" id="comment"></textarea>
 </div>
		
		<!--
		<button name="OBBtn_Yes" id="submitbutton" type="submit" class="btn btn-primary btn-lg">  
			Submit
		</button>  
		-->
		
		<input type="submit" id="submit" name="OBBtn_Yes" value="Submit" class="navbtn btn btn-primary btn-lg" />
		
	</form> 
</div>

</body>
</html>
?>
