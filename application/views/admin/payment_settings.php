<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <div class="row">
      
      <div class="col-md-8">
        <form method="post" action="<?php echo base_url('admin/payment/update') ?>" role="form" class="form-horizontal">
          
          <div class="row">
            <div class="col-sm-12">
              <div class="box">
                  <div class="form-group mt-20">
                    <label class="col-sm-4 control-label" for="example-input-normal">Currency </label>
                    <div class="col-sm-12">
                      <select class="form-control single_select" id="country" name="country" style="width: 100%">
                          <option value="">Select</option>
                          <?php foreach ($currencies as $currency): ?>
                              <?php if (!empty($currency->currency_name)): ?>
                                <option value="<?php echo html_escape($currency->id); ?>" 
                                  <?php echo (settings()->currency_code == $currency->currency_code) ? 'selected' : ''; ?>>
                                  <?php echo html_escape($currency->name.'  -  '.$currency->currency_code.' ('.$currency->currency_symbol.')'); ?>
                                </option>
                              <?php endif ?>
                          <?php endforeach ?>
                      </select>
                    </div>
                </div>
              </div>
            </div>
          </div>
         
          <div class="row">
            <div class="col-sm-6">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title d-block">Paypal <span class="pull-right"><input type="checkbox" name="paypal_payment" value="1" <?php if(settings()->paypal_payment == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100"></span></h3>
                </div>

                <div class="box-body">
                    <div class="form-group mt-20">
                        <label class="col-sm-6 control-label" for="example-input-normal">Paypal mode </label>
                        <div class="col-sm-12">
                          <select class="form-control" name="paypal_mode" style="width: 100%">
                              <option value="">Select</option>
                                <option value="sandbox" <?php echo (settings()->paypal_mode == 'sandbox') ? 'selected' : ''; ?>>Sandbox</option>
                                <option value="live" <?php echo (settings()->paypal_mode == 'live') ? 'selected' : ''; ?>>Live</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label" for="example-input-normal">Paypal Account</label>
                        <div class="col-sm-12">
                            <input type="text" name="paypal_email" value="<?php echo html_escape(settings()->paypal_email); ?>" class="form-control" >
                        </div>
                    </div>
                </div>

              </div>
            </div>

            <div class="col-sm-6">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title d-block">Stripe  <span class="pull-right"><input type="checkbox" name="stripe_payment" value="1" <?php if(settings()->stripe_payment == 1){echo 'checked';} ?> data-toggle="toggle" data-onstyle="info" data-width="100"></span></h3>
                </div>

                <div class="box-body">

                  <div class="row">

                    <div class="col-sm-12">
                      <div class="form-group mt-20">
                          <label class="col-sm-4 control-label" for="example-input-normal">Publish key</label>
                          <div class="col-sm-12">
                            <input type="text" name="publish_key" value="<?php echo html_escape(settings()->publish_key); ?>" class="form-control" >
                          </div>
                      </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group mt-20">
                          <label class="col-sm-4 control-label" for="example-input-normal">Secret key </label>
                          <div class="col-sm-12">
                            <input type="text" name="secret_key" value="<?php echo html_escape(settings()->secret_key); ?>" class="form-control" >
                          </div>
                      </div>
                    </div>

                  </div>
                    
                </div>

              </div>
            </div>
          </div>

          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <div class="div">
            <button type="submit" class="btn btn-info btn-lgs waves-effect w-md waves-light m-b-5"><i class="fa fa-check"></i> Save Changes</button>
          </div>

        </form>
      </div>



      <div class="col-md-4 box add_area">
        
        <div class="box-header with-border">
          <h3 class="box-title">Add Offline Payment</h3>
        </div>

        <div class="box-body">
          <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/payment/offline')?>" role="form" novalidate>

            <div class="form-group mt-10">
                <select class="form-control single_select" name="user" required>
                    <option value="">Select User</option>
                    <?php foreach ($users as $user): ?>
                      <option value="<?php echo html_escape($user->id) ?>"><?php echo html_escape($user->name.' - '.$user->email) ?> 
                        <span class="c-b"><?php if(!empty($user->payment_status)){echo '('.$user->payment_status.')';} ?></span>
                      </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <select class="form-control single_select" name="package" required>
                    <option value="">Select package</option>
                    <?php foreach ($packages as $package): ?>
                      <option value="<?php echo html_escape($package->id) ?>"><?php echo html_escape($package->name) ?> </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group mt-10">
              <label>Subscription type</label>
              <div class="radio radio-info radio-inline mt-10">
                <input type="radio" id="inlineRadio1" value="monthly" name="billing_type" required>
                <label for="inlineRadio1"> monthly </label>
                &emsp;&emsp;
                <input type="radio" id="inlineRadio2" value="yearly" name="billing_type" required>
                <label for="inlineRadio2"> yearly </label>
              </div>
            </div>
              
            <div class="form-group mt-10">
              <label>Payment Status</label>
              <div class="radio radio-info radio-inline mt-10">
                <input type="radio" id="inlineRadio3" value="verified" name="status" required>
                <label for="inlineRadio3"> Verified </label>
                &emsp;&emsp;
                <input type="radio" id="inlineRadio4" value="pending" name="status" required>
                <label for="inlineRadio4"> Pending </label>
              </div>
            </div>
           
            <!-- csrf token -->
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

            <div class="row mb-20">
              <div class="col-sm-12">
                  <button type="submit" class="btn btn-info pull-left"><i class="fa fa-check"></i> Add Payment</button>
              </div>
            </div>

          </form>

        </div>
      </div>

    </div>

  </section>
</div>
