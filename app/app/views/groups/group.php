<?php $form_attributes = array('class' => 'animated zoomIn', 'id' => 'form', 'method' => 'GET'); ?>

<div class="container-fluid">
    <div class="row h-100 justify-content-center align-items-center">  
        <div class="col-12">
            <div class="m-4 mt-5">
				<?php if(!empty($group)) { ?>
				<table class="table m-4 mt-5 animated bounceInDown mx-auto table-responsive-sm" style="max-width:800px;">
					<h3 class="text-center mt-5 animated zoomIn">Group Information</h3>
					<thead class="thead-dark">
				    	<tr>
				      		<th scope="col">Owner</th>
				      		<th scope="col">Title</th>
				      		<th scope="col">Description</th>
				    	</tr>
				  	</thead>
				  	<tbody>
				  		<?php foreach ($group->result() as $row) { ?>
				    	<tr>
				      		<td><a href="/profile/<?php echo $row->username; ?>">@<?php echo ucfirst($row->username); ?></a></td>
				      		<td><?php echo ucfirst($row->title); ?></td>
				      		<td><?php echo ucfirst($row->description); ?></td>
				    	</tr>
				    	<?php } ?>
				  	</tbody>
				</table>
				<?php } ?>
				<?php if(!empty($friends)) { ?>
				<table class="table m-4 mt-5 animated bounceInDown mx-auto table-responsive-sm" style="max-width:800px;">
					<h3 class="text-center mt-5 animated zoomIn">Add users to the group</h3>
					<thead class="thead-dark">
				    	<tr>
				      		<th scope="col">First</th>
				      		<th scope="col">Last</th>
				      		<th scope="col">Handle</th>
				      		<th scope="col">Avatar</th>
				      		<th scope="col">Action</th>
				    	</tr>
				  	</thead>
				  	<tbody>
				  		<?php foreach ($friends as $row) { ?>
				    	<tr>
				      		<td><?php echo ucfirst($row->first_name); ?></td>
				      		<td><?php echo ucfirst($row->last_name); ?></td>
				      		<td><a href="/profile/<?php echo $row->username; ?>">@<?php echo ucfirst($row->username); ?></a></td>
				      		<td><img src="/uploads/<?php echo (empty($row->avatar)) ? 'default.jpg' : $row->avatar; ?>" width="50"></td>
				      		<td><a href="add/<?php echo $row->user_id; ?>" class="btn btn-success">Add</a></td>
				    	</tr>
				    	<?php } ?>
				  	</tbody>
				</table>
				<?php } ?>
				<?php if(!empty($members)) { ?>
				<table class="table m-4 mt-5 animated bounceInDown mx-auto table-responsive-sm" style="max-width:800px;">
					<h3 class="text-center mt-5 animated zoomIn">Group Members</h3>
					<thead class="thead-dark">
				    	<tr>
				      		<th scope="col">First</th>
				      		<th scope="col">Last</th>
				      		<th scope="col">Handle</th>
				      		<th scope="col">Avatar</th>
				    	</tr>
				  	</thead>
				  	<tbody>
				  		<?php foreach ($members as $row) { ?>
				    	<tr>
				      		<td><?php echo ucfirst($row->first_name); ?></td>
				      		<td><?php echo ucfirst($row->last_name); ?></td>
				      		<td><a href="/profile/<?php echo $row->username; ?>">@<?php echo ucfirst($row->username); ?></a></td>
				      		<td><img src="/uploads/<?php echo (empty($this->session->avatar)) ? 'default.jpg' : $this->session->avatar; ?>" width="50"></td>
				    	</tr>
				    	<?php } ?>
				  	</tbody>
				</table>
				<?php } ?>
			</div>
		</div>
	</div>
</div>