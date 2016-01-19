<section class="content-header">
  <h1>
    Users Listing
    <a class="btn btn-flat btn-primary pull-right btn-sm" href="<?= base_url('users/create')?>"><i class="fa fa-plus"></i> Add new user</a>
  </h1>
</section>
<section class="content">

  <!-- Default box -->
  <div class="box box-success">
    <div class="box-body no-padding">
      <table class="table table-hover table-striped">
      	<thead>
			<tr><th>Last Name</th><th>First name</th><th>Username</th><th>Position</th><th>Status</th><th></th></tr>      		
      	</thead>
      	<tbody>
      		<?php foreach($items AS $row):?>
      			<tr>
      				<td><?= $row['lastname']?></td>
      				<td><?= $row['firstname']?></td>
      				<td><?= $row['username']?></td>
      				<td><?= $row['position']?></td>
      				<td>
      					<?php if(intval($row['is_locked'])):?>
      						<span class="label label-danger"><i class="fa fa-times"></i> Locked</span>
      					<?php else:?>
      						<span class="label label-success"><i class="fa fa-check"></i> Active</span>
      					<?php endif;?>
    					</td>
    					<td>
                <a class="btn btn-xs btn-flat btn-info" href="<?= base_url("users/edit/{$row['id']}") ?>"><i class="fa fa-pencil"></i> Update</a>&nbsp;&nbsp;
              </td>
      			</tr>
      		<?php endforeach;?>
      	</tbody>
      </table>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</section>