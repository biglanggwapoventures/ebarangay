<section class="content-header">
  <h1>
    Items Listing
    <a class="btn btn-flat btn-primary pull-right btn-sm" href="<?= base_url('items/create')?>"><i class="fa fa-plus"></i> Add new item</a>
  </h1>
</section>
<section class="content">

  <!-- Default box -->
  <div class="box box-success">
    <div class="box-body no-padding">
      <table class="table table-hover table-striped">
      	<thead>
            <tr><th>Item Name</th><th>Qty on hand</th><th>Acquisition Method</th><th>Acquisition State</th><th>Estimated Cost</th><th>Status</th><th></th></tr>      		
      	</thead>
      	<tbody>
      		<?php foreach($items AS $row):?>
      			<tr>
      				<td><a href="<?= base_url("items/edit/{$row['id']}") ?>"><?= $row['name']?></a></td>
      				<td><?= number_format($row['beginning_quantity'], 2)?></td>
      				<td>
                <?php if($row['acquisition_method'] === 'd'):?>
                  Donated
                <?php else:?>
                  Bought
                <?php endif;?>
              </td>
      				<td>
               <?php if($row['acquisition_state'] === 'o'):?>
                  Old / Used
                <?php else:?>
                  Brand New
                <?php endif;?>    
              </td>
              <td><?= number_format($row['estimated_cost'], 2)?></td>
      				<td>
      					<?php if(intval($row['is_disposed'])):?>
      						<span class="label label-danger"><i class="fa fa-times"></i> Disposed</span>
      					<?php else:?>
      						<span class="label label-success"><i class="fa fa-check"></i> Active</span>
      					<?php endif;?>
    					</td>
    					<td>
                <a class="btn btn-xs btn-flat btn-default" onclick="alert('Under development')"><i class="fa fa-search"></i> Logs</a>
              </td>
      			</tr>
      		<?php endforeach;?>
      	</tbody>
      </table>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</section>