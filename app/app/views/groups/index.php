<?php $form_attributes = array('class' => 'animated zoomIn', 'id' => 'form'); ?>
<div class="container-fluid">
    <div class="row h-100 justify-content-center align-items-center">  
        <div class="col-12">
            <div class="m-4 mt-5">
            	<div class="card card-custom mx-auto" style="max-width:600px; width:auto; padding:40px;">
					<?php echo form_open('/groups/create', $form_attributes); ?>
						<h3>Create a new group...</h3>
						<div class="form-group">
							<input type="text" class="form-control" name="title" id="title" placeholder="Group Title" autocomplete="off" style="background-color: white;">
						</div>
						<div class="form-group">
						    <textarea class="form-control" id="description" name="description" placeholder="Group Description" maxlength="255" rows="3"></textarea>
						</div>
						<button class="btn btn-dark btn-login" type="submit">Create</button>
					</form>
				</div>
				<?php if(!empty($groups)) { ?>
				<table class="table m-4 mt-5 animated bounceInDown mx-auto table-responsive-sm" style="max-width:800px;">
					<h3 class="text-center mt-5 animated zoomIn">My Groups</h3>
					<thead class="thead-dark">
				    	<tr>
				      		<th scope="col">Owner</th>
				      		<th scope="col">Title</th>
				      		<th scope="col">Description</th>
				      		<th scope="col">Visit</th>
				    	</tr>
				  	</thead>
				  	<tbody>
				  		<?php foreach ($groups->result() as $row) { ?>
				    	<tr>
				      		<td><a href="/profile/<?php echo $row->username; ?>">@<?php echo ucfirst($row->username); ?></a></td>
				      		<td><?php echo ucfirst($row->title); ?></td>
				      		<td><?php echo ucfirst($row->description); ?></td>
				      		<td><a href="/groups/<?php echo $row->group_id; ?>/" class="btn btn-dark">View</a></td>
				    	</tr>
				    	<?php } ?>
				  	</tbody>
				</table>
				<?php } ?>
			</div>
		</div>
	</div>
</div>