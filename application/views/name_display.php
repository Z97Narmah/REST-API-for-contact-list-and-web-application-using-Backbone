<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>ContactBook</title>
    
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.0.0/backbone-min.js"></script>

</head>
<body>
<div style="text-align: center;" class="container">
	<h1>Welcome to Your Contacts</h1>
	<p>Below are the list of people in your contact book</p>

	<div style="text-align: center;"id ="data">
	<table class="table table-hover">
	<table class="table table-hover table-striped">
	<tr>
                <th style="color:orange">Contact Id</th>
                <th style="color:orange">First Name</th>
                <th style="color:orange">Surname</th>
				<th style="color:orange">Email</th>
                <th style="color:orange">Telephone</th>
				<th style="color:orange">Tag</th>

                <th></th>
            </tr>
		</thead>
   <?php foreach ($names as $row) { ?>
   
   <tr>
      <td><?=$row->personID?></td>
      <td><?=$row->name?></td>
      <td><?=$row->surname?></td>
	  <td><?=$row->email?></td>
      <td><?=$row->telephone?></td>
	  <td><?=$row->tag?></td>
    </tr>
    
    <?php } ?>
</table>
</div>

<br>

<p id="message"></p>
<p id="createmsg"></p>

<br> <br><br>

<h3>Create Persons</h3>

   <form>
   
   <label for='Name'> Name </label>
   <input type='text' name='name' id='name' size='30' /> <br>

   <label for='Surname'> Surname </label>
   <input type='text' name='surname' id='surname' size='30' /> <br>

   <label for='Email'> Email </label>
   <input type='text' name='email' id='email' size='30' /> <br>
   
      <label for='Telephone'> Telephone </label>
   <input type='text' name='telephone' id='telephone' size='30' /> <br>

   <label for='Tag'> Tag </label>
   <input type='text' name='tag' id='tag' size='30' /> <br>
   
   <input type="submit" value="Create" id="create" />
   
   </form>
   
   <br><br>
   
   <form>
     <label for="edit"> Type in the contact id you with to delete/edit</label>
       <input type="text" name="personID" id="personID" size="10" /> <br>
       
          <input type="submit" value="Delete" id="delete" />
             <input type="submit" value="Edit" id="edit" />
   </form>
   
   <br><br><br>
   
  <div id="editBox" style="display: none;"> 
   <form>
   <h2>Edit Contact</h2>
   <input type="hidden" name="personID" id="personID" size="20" /> <br>
   
     <label for="editname">Edit Name</label>
      <input type="text" name="editname" id="editname" size="30" /> <br>
      
      <label for="editname">Edit Surname</label>
      <input type="text" name="editsurname" id="editsurname" size="30" /> <br>

	  <label for="editname">Edit Email</label>
      <input type="text" name="editemail" id="editemail" size="30" /> <br>
      
      <label for="editname">Edit Telephone</label>
      <input type="text" name="edittelephone" id="edittelephone" size="30" /> <br>

	  <label for="editname">Edit Tag</label>
      <input type="text" name="edittag" id="edittag" size="30" /> <br>
      
      <input type="submit" value="Update" id="update">
   
   </form>


   
   
   </div>
   
 
    


   
  <script>
  
  $(document).ready(function() {
	  
	  $("#create").click(function(event) {
		  event.preventDefault();
		var name = $("input#name").val();  
	    var surname = $("input#surname").val(); 
		var email = $("input#email").val(); 
	    var telephone = $("input#telephone").val(); 
		var tag = $("input#tag").val(); 
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); ?>index.php/People/person",	
		dataType: 'JSON',
		data: {name: name, surname: surname, email: email, telephone: telephone, tag: tag},
		
		success: function(data) {
			console.log(name, surname, email, telephone, tag);
			$("#data").load(location.href + " #data");
			$("input#name").val(""); 
			$("input#surname").val(""); 
			$("input#email").val(""); 
			$("input#telephone").val("");  
			$("input#tag").val("");  
		}
	});
	  });
  });
  
  
  
  
  
  $(document).ready(function() {
	  $("#delete").click(function(event) {
		  event.preventDefault();
		var personID = $("input#personID").val();  
	$.ajax({
		method: "GET",
		url: "<?php echo base_url(); ?>index.php/People/person",	
		dataType: 'JSON',
		data: {personID: personID},
		success: function(data) {
			console.log(personID);
			$("#data").load(location.href + " #data");
			$("#message").html("You have successfully deleted number " + personID + " Thank you");
			$("#message").show().fadeOut(3000);
			$("input#personID").val("");  
		}
	});
	  });
  });
  
  
  
   $(document).ready(function() {
	  $("#edit").click(function(event) {
		  event.preventDefault();
		var personID = $("input#personID").val();  
	$.ajax({
		method: "GET",
		url: "<?php echo base_url(); ?>index.php/People/user",	
		dataType: 'JSON',
		data: {personID: personID},
		
		success: function(data) {
			
			$.each(data,function(personID, name, surname, email, telephone, tag) {
			
			console.log(personID, name, surname, email, telephone, tag);
			$("input#personID").val(personID); 
			$("#editBox").show();
			$("input#editname").val(name[0]);
			$("input#editsurname").val(name[1]);
			$("input#editemail").val(name[2]);
			$("input#edittelephone").val(name[3]);
			$("input#edittag").val(name[4]);
			});
		}
	});
	  });
  });
  
  
  
   $(document).ready(function() {
	  
	  $("#update").click(function(event) {
		  event.preventDefault();
		 var personID = $("input#personID").val();
		var name = $("input#editname").val();  
	    var surname = $("input#editsurname").val(); 
		var email = $("input#editemail").val(); 
	    var telephone = $("input#edittelephone").val(); 
		var tag = $("input#edittag").val(); 
	$.ajax({
		method: "POST",
		url: "<?php echo base_url(); ?>index.php/People/user",	
		dataType: 'JSON',
		data: {personID: personID, name: name, surname: surname, email: email, telephone: telephone, tag: tag},
		
		success: function(data) {
			console.log(personID, name, surname, email, telephone, tag);
			$("#data").load(location.href + " #data");
			$("#message").html("You have successfully updated " + name + " Thank you");
			$("#message").show().fadeOut(3000);
			$("#editBox").hide();
		}
	});
	  });
  });
  
  
     $(document).ready(function() {
		 
		var Create = Backbone.Model.extend({
			url: function () {
				var link = "<?php echo base_url(); ?>index.php/People/person?name=" + this.get("name");
				return link;
			},
			defaults: {
				name: null,
				surname: null,
				telephone: null }
		});
		
		var createModel = new Create();
		
		var DisplayView = Backbone.View.extend({
			el: ".container", 
			model: createModel,
			initialize: function () {
				this.listenTo(this.model,"sync change",this.gotdata);
			},
			
			events: {
				"click #create" : "getdata"
			},
			
			getdata: function (event) {
				var name = $('input#name').val();
				var surname = $('input#surname').val();
				this.model.set({name: name, surname:surname});
				this.model.fetch();
			},
			
			gotdata: function () {
				$('#createmsg').html('Name ' + this.model.get('name') + ' and address ' + this.model.get('surname') + ' has been created').show().fadeOut(5000);
			}
		});
		
		var displayView = new DisplayView();
		
	 });
  
  
  
  
  </script>



</div>

</body>
</html>