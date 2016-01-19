<?php $url = base_url('items')?>
<section class="content-header">
  <h1>
    Items Listing
    <small></small>
  </h1>
</section>
<section class="content">

  <!-- Default box -->
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
    </div>
      <form class="form-horizontal" method="post" data-action="<?= $mode === MODE_CREATE ? "{$url}/store" : "{$url}/update/{$data['id']}" ?>">
      <div class="box-body">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2">
            <div class="alert alert-danger hidden">
              <ul class="list-unstyled">
                
              </ul>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Item Name</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="name" value="<?= preset($data, 'name', '')?>" />
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label">Acquisition Method</label>
          <div class="col-sm-5">
            <?= acqm_dropdown('acquisition_method', preset($data, 'acquisition_method', ''), 'class="form-control"')?>
          </div>
        </div>
         <div class="form-group">
          <label class="col-sm-2 control-label">Acquisition State</label>
          <div class="col-sm-5">
            <?= acqs_dropdown('acquisition_state', preset($data, 'acquisition_state', ''), 'class="form-control"')?>
          </div>
        </div>
        
      <hr>
        <div class="form-group">
          <label class="col-sm-2 control-label">Estimated cost</label>
          <div class="col-sm-5">
         <input type="text" class="form-control" name="estimated_cost" value="<?= preset($data, 'estimated_cost', '')?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Item class</label>
          <div class="col-sm-5">
           <?= itemclass_dropdown('class', preset($data, 'class', ''), 'class="form-control"')?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Beginning Quantity</label>
          <div class="col-sm-3">
            <input type="number" class="form-control" name="beginning_quantity" value="<?= preset($data, 'beginning_quantity', '')?>" />
          </div>
        </div>
      <div class="form-group">
          <label class="col-sm-2 control-label">Details</label>
          <div class="col-sm-8">
              <textarea class="form-control" name="details"><?= preset($data, 'details', '')?></textarea>
          </div>
        </div>
        <?php if($mode === MODE_EDIT):?>
          <hr>
          <div class="form-group">
          <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-8">
               <div class="checkbox"><label><input type="checkbox" name="is_disposed" value="1" <?= isset($data['is_disposed']) && intval($data['is_disposed']) ? 'checked="checked"' : '' ?>>Mark as disposed</label></div>
            </div>
          </div>
        <?php endif;?>
      </div><!-- /.box-body -->
      <div class="box-footer clearfix">
        <a href="<?=$url?>" id="cancel" class="btn btn-default cancel pull-right btn-flat">Cancel</a>
        <button type="submit" class="btn btn-success btn-flat">Submit</button>
      </div><!-- /.box-footer -->
    </form>
  </div><!-- /.box -->
</section>