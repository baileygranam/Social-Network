<?php $form_attributes = array('class' => 'animated zoomIn', 'id' => 'form', 'method' => 'GET'); ?>

<div class="container-fluid">
    <div class="row h-100 justify-content-center align-items-center">  
        <div class="col-12">
            <div class="m-4 mt-5">
            	<div class="card card-custom mx-auto" style="max-width:400px; width:auto; padding:40px;">
					<?php echo form_open('/search/search', $form_attributes); ?>
						<p>Find friends to add:</p>
						<div class="form-group">
						    <input type="text" class="form-control" name="q" aria-describedby="search" placeholder="Search" autocomplete="off"
>
						</div>
						<button class="btn btn-dark btn-login" type="submit">Search</button>
					</form>
				</div>
				<?php if(!empty($results)) { ?>
				<table class="table m-4 mt-5 animated bounceInDown mx-auto table-responsive-sm" style="max-width:800px;">
					<h3 class="text-center mt-5 animated zoomIn">Search Results</h3>
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
				  		<?php foreach ($results as $row) { ?>
				    	<tr>
				      		<td><?php echo ucfirst($row->first_name); ?></td>
				      		<td><?php echo ucfirst($row->last_name); ?></td>
				      		<td><a href="/profile/<?php echo $row->username; ?>">@<?php echo ucfirst($row->username); ?></a></td>
				      		<td><img src="/uploads/<?php echo (empty($this->session->avatar)) ? 'default.jpg' : $this->session->avatar; ?>" width="50"></td>
				      		<td>
				      			<?php if($row->user_id == $this->session->user_id) { ?>
				      			<a href="/profile/<?php echo $row->username; ?>" class="btn btn-dark">View</a>
				      			<?php } else if($row->isFriend) { ?>
				      			<a href="/friends/remove/<?php echo $row->user_id; ?>" class="btn btn-danger">Remove</a>
				      			<?php } else { ?>
				      			<a href="/friends/add/<?php echo $row->user_id; ?>" class="btn btn-success">Add</a>
				      			<?php } ?>
				      		</td>
				    	</tr>
				    	<?php } ?>
				  	</tbody>
				</table>
				<?php } ?>
			</div>
		</div>
	</div>
</div>