<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <div class="col-md-8">

      <div class="box add_area">
        <div class="box-header with-border">
          <h3 class="box-title">Edit User</h3>

          <div class="box-tools pull-right">
              <a href="<?php echo base_url('admin/users') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
          </div>
        </div>

        <div class="box-body">
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/users/edit')?>" role="form" novalidate>

            <div class="form-group">
              <label>Name </label>
              <input type="text" class="form-control" required name="name" value="<?php echo html_escape($user->name); ?>" >
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" required name="email" value="<?php echo html_escape($user->email); ?>" >
            </div>

            <div class="form-group">
              <label>Phone</label>
              <input type="text" class="form-control" name="phone" value="<?php echo html_escape($user->phone); ?>" >
            </div>

            <div class="form-group">
              <label>Designation</label>
              <input type="text" class="form-control" name="designation" value="<?php echo html_escape($user->designation); ?>" >
            </div>

            <div class="form-group">
              <label>Address</label>
              <textarea class="form-control" name="address"><?php echo $user->address; ?></textarea>
            </div>


            <div class="form-group">
                <select class="form-control" name="package" required>
                    <option value="">Select package</option>

                    <?php foreach ($packages as $package): ?>
                      <option <?php if(isset($payment) && $package->id == $payment->package_id){echo "selected";} ?> value="<?php echo html_escape($package->id) ?>"><?php echo html_escape($package->name) ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <input type="hidden" name="id" value="<?php echo html_escape($user->id); ?>">
            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <hr>

            <div class="row m-t-30">
              <div class="col-sm-12">
                <?php if (isset($page_title) && $page_title == "Edit"): ?>
                  <button type="submit" class="btn btn-info pull-left">Save Changes</button>
                <?php else: ?>
                  <button type="submit" class="btn btn-info pull-left"> Save Category</button>
                <?php endif; ?>
              </div>
            </div>

          </form>

        </div>

        <div class="box-footer">

        </div>
      </div>

    </div>

  </section>
</div>
