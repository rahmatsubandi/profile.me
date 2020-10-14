<div class="content-wrapper">

  <section class="content">

    <div class="row">
      <div class="col-xl-3 col-lg-3">

        <!-- Profile Image -->
        <div class="box mt-50">
          <div class="box-header">
            <h3 class="box-title">Subscription</h3>
          </div>

          <div class="box-body box-profile">
            
            <p>Subscription: <strong><?php echo html_escape($user->package_name) ?> Plan</strong></p>
            <p>Price: <strong><?php echo html_escape($user->amount) ?> <?php echo html_escape($settings->currency_symbol) ?></strong></p>
            <p>Billing frequency : <strong><?php echo ucfirst(html_escape($user->billing_type)) ?></strong> </p>

            <?php if ($user->status != 'expire'): ?>
              <p>Last billing : <strong><?php echo my_date_show($user->created_at) ?></strong> </p>
              <p>Expire : <strong><?php echo my_date_show($user->expire_on); ?></strong> 
              <strong class="text-danger">(<?php echo date_dif(date('Y-m-d'), $user->expire_on) ?> days left)</strong></strong></p>
            <?php endif ?>

            <?php if (check_my_payment_status() == TRUE): ?>
              <h5 class="text-center pay_status"><b>Payment Status: &nbsp; <i class="fa fa-check"></i> <?php echo ucfirst($user->status);?></b></h5>
            <?php else: ?>
              <h5 class="text-center pay_pending"><b>Payment Status: &nbsp; <i class="fa fa-exclamation-circle"></i> <?php echo ucfirst($user->status);?></b></h5>
            <?php endif ?>
          </div>
        </div>
      </div>
      <!-- /.col -->

      <div class="col-xl-9 col-lg-9">  

          <div class="text-center mb-20">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-outline-primary custom-btngp <?php if($user->billing_type == 'monthly'){echo 'active';} ?>">
                <input type="radio" name="price_type" value="monthly" class="switch_price"> Monthly
              </label>
              <label class="btn btn-outline-primary custom-btngp <?php if($user->billing_type == 'yearly'){echo 'active';} ?>">
                <input type="radio" name="price_type" value="yearly" class="switch_price"> Yearly
              </label>
            </div>
          </div>

          <div class="row">

                  <?php $i=1; foreach ($packages as $package): ?>
                    <div class="col-md-<?php echo(12/count($packages)) ?>">
                       <div class="pricing-table purple text-center">

                        <h1 class="package_title mb-50"> <?php echo html_escape($package->name); ?> <i class="<?php if ($user->package_id == $package->id){echo "fa fa-check-circle";} ?> text-success"></i></h1>
                          <!-- Price -->
                          <div class="price-tag mb-20 mt-20">
                             <div class="yearly_price">
                                 <span class="symbol"><?php echo settings()->currency_symbol ?></span>
                                 <span class="amount"><?php echo round($package->price); ?></span>
                                 <span class="after">/month</span>
                             </div>

                             <div class="monthly_price" style="display: none;">
                                 <span class="symbol"><?php echo settings()->currency_symbol ?></span>
                                 <span class="amount"><?php echo round($package->monthly_price); ?></span>
                                 <span class="after">/year</span>
                             </div>
                          </div>

                          
                            <!-- Features -->
                            <div class="pricing-features">
                                <?php if (empty($package->features)): ?>
                                  Features not selected !
                                <?php else: ?>
                                  <?php foreach ($features as $all_feature): ?>

                                    <?php foreach ($package->features as $feature): ?>
                                        <?php if ($feature->feature_id == $all_feature->id): ?>
                                            <?php $icon = 'fa fa-check text-success'; break; ?>
                                        <?php else: ?>
                                            <?php $icon = 'fa fa-times text-danger'; ?>
                                        <?php endif ?>
                                    <?php endforeach ?>

                                    <div class="feature"><?php echo html_escape($all_feature->name) ?><span><i class="<?php echo $icon; ?>"></i></span></div>
                                  <?php endforeach ?>
                                <?php endif ?>
                            </div>
                          <!-- Button -->
                          <input type="hidden" name="billing_type" value="<?php if($user->billing_type == 'monthly'){echo "monthly";}else{echo "yearly";} ?>" class="billing_type">
            
                          <a class="price-button dash_package_btn" href="<?php echo base_url('admin/subscription/upgrade/'.$package->slug) ?>">Select</a>
                          
                       </div>
                    </div>
                  <?php endforeach ?>

                </div>
      </div>

  </section>

</div>