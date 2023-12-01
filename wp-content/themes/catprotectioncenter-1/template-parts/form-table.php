<?php
/**
 *  Template name: Table Form
 */

get_header();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <style>
    table,
    th,
    td {
        border: 1px solid black;
    }
    </style>
<div class="userRegistration textCenter">
	<!--message wrapper-->
	<div id="message" class="alert-box"></div>

	<form method="post" id="rsUserRegistration" action="" enctype="multipart/form-data">
		<?php
			wp_nonce_field( 'rs_user_registration_action', 'rs_user_registration_nonce' );
		?>
		<div class="form-group">
	      <label>First Name</label>
	      <input type="text" name="vb_firstname" id="vb_firstname" value="" placeholder="First Name" class="form-control" required />
	      <span class="help-block">
    	</div>	
 		<div class="form-group">
	      <label>Last Name</label>
	      <input type="text" name="vb_lastname" id="vb_lastname" value="" placeholder="Last Name" class="form-control" required/>
	      <span class="help-block">
    	</div>
    	<div class="form-group">
	      <label>Email</label>
	      <input type="Email" name="vb_email" id="vb_email" value="" placeholder="Email" class="form-control" required/>
	      <span class="help-block">
    	</div>
    	<div class="form-group">
	      <label>Phone</label>
	      <input type="number" name="vb_phone" id="vb_phone" value="" placeholder="Phone" class="form-control" required/>
	      <span class="help-block">
    	</div>
    	<div class="form-group">
	      <label>Profile Picture</label>
	       <div class="circle">
       			<img class="profile-pic" src="https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg">
     		</div>
     		<div class="p-image">
	      	 	<i class="fa fa-camera upload-button"></i>
	        	<input class="file-upload" name="file-upload" type="file" id="file-upload" accept="image/*" required/>
     		</div>
    	</div>
    	<input type="hidden" name="action" value="user_add_form">
    	<input type="button" class="btn btn-primary" id="bt-new-user" value="Submit" />
	</form>
</div>
<div class="table-form" style="margin-top: 51px;">
	<?php 
		$table_name = 'wp_user_data';
		$results = $wpdb->get_results( "SELECT * FROM $table_name");

	?>
	<table class="table-auto" name="user">
	  	<tr>
		    <th>SR NO.</th>
		    <th>First Name</th>
		    <th>Last Name</th>
		    <th>Email</th>
		    <th>Phone</th>
		    <th>Profile Picture</th>
		    <th>Update/Delete</th>
	  	</tr>
		<?php 
			foreach ($results as $rows) {?>
			  	<tr>
				  	<td><?php echo $rows->ID; ?></td>
				    <td><?php echo $rows->firstname; ?></td>
				    <td><?php echo $rows->lastname; ?></td>
				    <td><?php echo $rows->email; ?></td>
				    <td><?php echo $rows->phone; ?></td>
				    <td>
				    	<?php 
				    		if($rows->profilepicture !=""){ ?>
				    			<img src="<?php echo site_url()."/wp-content/uploads/".$rows->profilepicture; ?>" width="100"><?php 
				    		} 
				    	?>	
				    </td>
			  		<td>
				  		<button class="uptbtn" ><?php echo "Update";?></button>
				  		<input type='submit' name= 'delete' value='delete'/>
				  		<?php
				  			if(isset($_POST[$rows->ID])){
        						$wpdb->delete( 'wp_user_data' , array( 'id' => $rows->ID ) );
    						}
						?>
			  		</td>
		  		</tr><?php
			}
		?>
	</table>
</div>

<?php 

get_footer();

?>