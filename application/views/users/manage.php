<?php $url = base_url('users')?>
<section class="content-header">
  <h1>
    Users Listing
    <small></small>
  </h1>
</section>
<section class="content">

  <!-- Default box -->
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
    </div>
      <form class="form-horizontal" method="post" action="<?= $mode === MODE_CREATE ? "{$url}/create" : "{$url}/edit/{$data['id']}" ?>">
      <div class="box-body">
        <?php $errors = validation_errors() ?>
        <?php if($errors):?>
          <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
              <div class="alert alert-danger">
                <h4><i class="icon fa fa-ban"></i> Ooops! Please review your input.</h4>
                <?= $errors?>
              </div>
            </div>
          </div>
        <?php endif;?>

        <?php if($mode === MODE_CREATE):?>
        <div class="form-group">
          <label class="col-sm-2 control-label">Username</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="username" value="<?= preset($data, 'username', '')?>" />
          </div>
        </div>
      <?php else:?>
        <div class="form-group">
          <label class="col-sm-2 control-label">Username</label>
          <div class="col-sm-8">
            <p class="form-control-static"><?= $data['username']?></p>
          </div>
        </div>
      <?php endif;?>

        <div class="form-group">
          <label class="col-sm-2 control-label">First Name</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="firstname" value="<?= preset($data, 'firstname', '')?>" />
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label">Last Name</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="lastname" value="<?= preset($data, 'lastname', '')?>" />
          </div>
        </div>
         <div class="form-group">
          <label class="col-sm-2 control-label">Position</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="position" value="<?= preset($data, 'position', '')?>" />
          </div>
        </div>
        <?php if($mode === MODE_EDIT):?>
           <hr>
        <div class="form-group">
          <label class="col-sm-2 control-label">Password</label>
          <div class="col-sm-8">
            <input type="password" class="form-control" name="password"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Confirm Password</label>
          <div class="col-sm-8">
            <input type="password" class="form-control" name="confirm_password"/>
          </div>
        </div>
      <?php endif;?>
      <hr>
        <div class="form-group">
          <label class="col-sm-2 control-label">Gender</label>
          <div class="col-sm-5">
            <?= gender_dropdown('gender', preset($data, 'gender', ''), 'class="form-control"')?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Date of birth</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="birthdate" value="<?= preset($data, 'birthdate', '')?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Current address</label>
          <div class="col-sm-8">
            <textarea class="form-control" name="current_address"><?= preset($data, 'current_address', '')?></textarea>
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label class="col-sm-2 control-label">Role</label>
          <div class="col-sm-5">
            <?= role_dropdown('role', preset($data, 'role', ''), 'class="form-control role"')?>
          </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Module Access</label>
            <div class="col-sm-8">
                <div class="checkbox">
                <?php $modules = isset($data['modules']) && $data['modules'] ? $data['modules'] : []?>
                    <label>
                      <input class="disabled-type-superuser" value="<?= MODULE_ITEM_DATA?>" name="modules[]" type="checkbox" <?= in_array(MODULE_ITEM_DATA, $modules) ? 'checked="checked"' : ''?>> Items Data Entry
                    </label><br>
                    <label>
                     <input class="disabled-type-superuser" value="<?= MODULE_BORROW_REQUESTS?>" name="modules[]" type="checkbox" <?= in_array(MODULE_BORROW_REQUESTS, $modules) ? 'checked="checked"' : ''?>> Item Borrow Requests 
                    </label><br>
                    <label>
                      <input class="disabled-type-superuser" value="<?= MODULE_ITEM_MAINTENANCE?>" name="modules[]" type="checkbox" <?= in_array(MODULE_ITEM_MAINTENANCE, $modules) ? 'checked="checked"' : ''?>> Item Maintenance 
                    </label><br>
                    <label>
                      <input class="disabled-type-superuser" value="<?= MODULE_ITEM_ADJUSTMENTS?>" name="modules[]" type="checkbox" <?= in_array(MODULE_ITEM_ADJUSTMENTS, $modules) ? 'checked="checked"' : ''?>> Item Quantity Adjustments 
                    </label>
                </div>
            </div>  
        </div>
      </div><!-- /.box-body -->
      <div class="box-footer clearfix">
        <a href="<?=$url?>" class="btn btn-default cancel pull-right btn-flat">Cancel</a>
        <button type="submit" class="btn btn-success btn-flat">Submit</button>
      </div><!-- /.box-footer -->
    </form>
  </div><!-- /.box -->
</section>