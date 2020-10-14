<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

  <?php if (isset($page_title) && $page_title == "Package"): ?>

    <div class="container">
       <div class="row">
          <div class="col-md-12 mb-5 text-center">
             <h2 class="main-head">Package & Features</h2>
          </div>
          <!-- Purple Table -->

          <?php $i=1; foreach ($packages as $package): ?>
            <div class="col-md-4 text-center">

               <div class="pricing-table purple text-center">

                  <?php if ($package->status == 1): ?>
                    <label class="label label-info"><i class="fa fa-check-circle"></i> Active</label>
                  <?php else: ?>
                    <label class="label label-danger"><i class="fa fa-times"></i> Inactive</label>
                  <?php endif ?><br><br>

                  <h1><?php echo html_escape($package->name); ?></h1>
                  
                  <!-- Price -->
                  <div class="price-tag mt-20">
                     <span class="symbol"><?php echo settings()->currency_symbol ?></span>
                     <span class="amount-sm"><?php echo round($package->monthly_price); ?></span>
                     <span class="after">/month</span>
                     &emsp;
                     |
                     &emsp;
                     <span class="symbol"><?php echo settings()->currency_symbol ?></span>
                     <span class="amount-sm"><?php echo round($package->price); ?></span>
                     <span class="after">/year</span>

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
                  <a class="price-button" href="<?php echo base_url('admin/package/edit/'.$package->id) ?>">Update/Assign</a>
               </div>
            </div>
          <?php endforeach ?>

       </div>
    </div>

  <?php endif; ?>


  <?php if (isset($page_title) && $page_title == "Edit"): ?>

    <a href="<?php echo base_url('admin/package') ?>" class="pull-left btn btn-info btn-sm mb-10"><i class="fa fa-angle-left"></i> Back</a>
          
    <div class="box add_area">
      
      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/package/add')?>" role="form" novalidate>


          <div class="row">
            <div class="col-md-6">
                <h3>Edit Package</h3><br>

                <div class="form-group">
                  <label>Package Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" required name="name" value="<?php echo html_escape($package[0]['name']); ?>" >
                </div>

                <div class="form-group">
                  <label>Monthly Price <span class="text-danger">*</span></label>
                  <input type="price" class="form-control" required name="monthly_price" value="<?php echo html_escape($package[0]['monthly_price']); ?>" >
                  <p><i class="fa fa-question-circle"></i> If you want to set the package as free, please keep the price 0</p>
                </div>

                <div class="form-group">
                  <label>Yearly Price <span class="text-danger">*</span></label>
                  <input type="price" class="form-control" required name="price" value="<?php echo html_escape($package[0]['price']); ?>" >
                  <p><i class="fa fa-question-circle"></i> If you want to set the package as free, please keep the price 0</p>
                </div>

                <div class="row m-t-30">
                  <div class="col-sm-2 text-left">
                    <div class="radio radio-info radio-inline">
                      <input type="radio" id="inlineRadio1" value="1" name="status" <?php if($package[0]['status'] == 1){echo "checked";}else{echo "";} ?>>
                      <label for="inlineRadio1"> Active </label>
                    </div>
                  </div>
                  <div class="col-sm-1 text-left">
                    <div class="radio radio-info radio-inline">
                      <input type="radio" id="inlineRadio2" value="2" name="status" <?php if($package[0]['status'] == 2){echo "checked";}else{echo "";} ?>>
                      <label for="inlineRadio2"> Inactive </label>
                    </div>
                  </div>
                </div>
            </div>

            <div class="col-md-1"></div>

            <div class="col-md-4">
                <h3>Assign features for package - <?php echo $package[0]['name'] ?></h3><br>
                <?php $p=50; foreach ($features as $feature): ?>
                  <?php foreach ($assign_features as $asg_feature): ?>
                    <?php if ($asg_feature->feature_id == $feature->id): ?>
                        <?php $checked = 'checked'; break; ?>
                    <?php else: ?>
                        <?php $checked = ''; ?>
                    <?php endif ?>
                  <?php endforeach ?>
                  <div class="form-group">
                    <input type="checkbox" name="features[]" value="<?php echo $feature->id; ?>" id="md_checkbox_<?php echo $p;?>" class="filled-in chk-col-blue" <?php echo $checked; ?> />
                    <label for="md_checkbox_<?php echo $p;?>"><?php echo $feature->name ?></label>
                  </div>
                <?php $p++; endforeach ?>
            </div>
          </div>

          


          <input type="hidden" name="id" value="<?php echo html_escape($package['0']['id']); ?>">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <div class="row m-t-30">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-info pull-left">Save Changes</button>
            </div>
          </div>

        </form>

      </div>
    </div>
  <?php endif; ?>


  </section>
</div>
