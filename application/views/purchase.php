
<?php $settings = get_settings(); ?>
<?php
    $paypal_url = ($settings->paypal_mode == 'sandbox')?'https://www.sandbox.paypal.com/cgi-bin/webscr':'https://www.paypal.com/cgi-bin/webscr';
    $paypal_id= html_escape($settings->paypal_email);
?>

<section class="section section-padding">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                
                <div class="pay-boxs">

                    <div class="text-center mt-20">
                        <?php if (isset($success_msg) && $success_msg=='Success'): ?>
                            <div class="padding-200">
                                <h1 class="text-success"><i class="fa fa-check-circle fa-2x text-success"></i> <br>Done</h1>
                                <h5 class="text-successs">You have paid successfully !</h5><br>

                                <?php if ($this->settings->enable_email_verify == 1): ?>
                                    <a href="<?php echo base_url('auth/email_verify') ?>" class="bttn-2">Verify Email <i class="fa fa-long-arrow-right"></i></a>
                                <?php else: ?>
                                    <a href="<?php echo base_url('admin/profile') ?>" class="bttn-2">Continue <i class="fa fa-long-arrow-right"></i></a>
                                <?php endif ?>
                            </div>

                        <?php elseif (isset($error_msg) && $error_msg=='Error'): ?>
                            <div class="padding-200">
                                <h3 class="text-danger"><i class="fa fa-times fa-2x text-danger"></i> Error</h3>
                                <h5 class="error">Your payment has been failed!</h5><br>
                                <a href="<?php echo base_url() ?>" class="btn btn-secondary btn-lg">Back</a>
                            </div>
                        <?php else: ?>
                    </div>

                    <?php if ($payment->billing_type == 'monthly'): ?>
                        <?php 
                            $price = round($package->monthly_price); 
                            $frequency = 'Per month';
                            $billing_type = 'monthly';
                        ?>
                    <?php else: ?>
                        <?php 
                            $price = round($package->price); 
                            $frequency = 'Per year';
                            $billing_type = 'yearly';
                        ?>
                    <?php endif ?>


                    <div class="tabbable-panel mt-20">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#tab_default_1" data-toggle="tab">
                                    Paypal </a>
                                </li>
                                <li class="<?php if(settings()->stripe_payment == 1 && settings()->paypal_payment == 0){echo "active";} ?>">
                                    <a href="#tab_default_2" data-toggle="tab">
                                    Stripe </a>
                                </li>
                            </ul>
                            <div class="tab-content">

                                <!-- paypal payment area -->
                                <div class="tab-pane active text-center" id="tab_default_1">
                                    <!-- paypal payment -->
                                    <?php if ($settings->paypal_payment == 1): ?>
                                        <div class="payment_area container" id="paypal" style="display: <?php if ($settings->paypal_payment == 1){echo "block";}else{echo "none";} ?>">
                                           <div class="row">
                                                <div class="box col-md-12 text-center">
                                                    
                                                    <div class="box-body text-center">

                                                        <h4 class="">Paypal Payment - Upgrade Plan</h4>
                                                        <p class="mb-0 text-center">Package: <?php echo html_escape($package->name);?> (<strong><?php echo $settings->currency_symbol; ?><?php echo html_escape($price) ?> <?php echo html_escape($frequency) ?></strong>)</p><br>


                                                        <!-- PRICE ITEM -->
                                                        <form action="<?php echo html_escape($paypal_url); ?>" method="post" name="frmPayPal1">
                                                            <div class="pipanel price panel-red">
                                                                <input type="hidden" name="business" value="<?php echo html_escape($paypal_id); ?>" readonly>
                                                                <input type="hidden" name="cmd" value="_xclick">
                                                                <input type="hidden" name="item_name" value="<?php echo html_escape($package->name);?>">
                                                                <input type="hidden" name="item_number" value="1">
                                                                <input type="hidden" name="amount" value="<?php echo html_escape($price) ?>" readonly>
                                                                <input type="hidden" name="no_shipping" value="1">
                                                                <input type="hidden" name="currency_code" value="<?php echo html_escape($settings->currency_symbol);?>">
                                                                <input type="hidden" name="cancel_return" value="<?php echo base_url('admin/subscription/payment_cancel/'.$billing_type.'/'.html_escape($package->id).'/'.html_escape($payment_id)) ?>">
                                                                <input type="hidden" name="return" value="<?php echo base_url('admin/subscription/payment_success/'.$billing_type.'/'.html_escape($package->id).'/'.html_escape($payment_id)) ?>">  
                                                             
                                                                <!-- <div class="text-center p-0">
                                                                    <p class="leads fs-30"><strong><?php //echo currency_to_symbol($settings->currency_symbol); ?><?php echo html_escape($price) ?> <?php echo html_escape($frequency) ?></strong></p>
                                                                </div><br> -->
                                                                <div class="mt-30">
                                                                    <button class="bttn-2" href="#">Pay Now <?php echo $settings->currency_symbol; ?><?php echo html_escape($price) ?></button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- /PRICE ITEM -->

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>  
                                </div>

                                <!-- stripe payment area -->
                                <div class="tab-pane text-center <?php if(settings()->stripe_payment == 1 && settings()->paypal_payment == 0){echo "active";} ?>" id="tab_default_2">
                                    <?php if ($settings->stripe_payment == 1): ?>
                                        <div class="payment_area container" id="stripe">
                                           <div class="row justify-content-center">
                                                <div class="box col-md-12 text-center">

                                                    <h4 class="text-center">Stripe Payment - Upgrade Plan</h4>
                                                    <p class="mb-0 text-center">Package Plan: <?php echo html_escape($package->name);?> (<strong><?php echo $settings->currency_symbol; ?><?php echo html_escape($price) ?> <?php echo html_escape($frequency) ?></strong>)</p><br>
                           
                                                    <div class="box credit-card-box">
                                                        <h4 class="box-title text-left">Payment Details <span class="pull-right mt--5"><img class="img-responsive" src="http://i76.imgup.net/accepted_c22e0.png"></span></h4>
                                                        <hr>
                                                        <div class="spacer py-1"></div>

                                                        <div class="box-body">
                                            
                                                            <form role="form" action="<?php echo base_url('auth/stripe_payment') ?>" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo $settings->publish_key; ?>" id="payment-form">
                                                                
                                                                <div class='row'>
                                                                    <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                                    </div>
                                                                    <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                                    </div>
                                                                </div>

                                                                <div class='row'>
                                                                    <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                                        <label class='control-label'>Name on card</label> 
                                                                        <input class='textfield textfield--grey' type='text' value="" size='6'>
                                                                    </div>
                                                                    <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                                        <label class='control-label'>Card Number</label> 
                                                                        <input autocomplete='off' class='textfield textfield--grey card-number'
                                                                            type='text' value="" size='6'>
                                                                    </div>
                                                                </div>
                                                    

                                                                <div class='form-row row'>
                                                                    <div class='col-xs-12 col-md-4 form-group cvc required text-left'>
                                                                        <label class='control-label'>CVC</label> <input autocomplete='off'
                                                                            class='textfield textfield--grey card-cvc' placeholder='ex. 311' size='4'
                                                                            type='text' value="">
                                                                    </div>
                                                                    <div class='col-xs-12 col-md-4 form-group expiration required text-left'>
                                                                        <label class='control-label'>Expiration month</label> <input
                                                                            class='textfield textfield--grey card-expiry-month' placeholder='MM' size='2'
                                                                            type='text' value="">
                                                                    </div>
                                                                    <div class='col-xs-12 col-md-4 form-group expiration required text-left'>
                                                                        <label class='control-label'>Expiration year</label> <input
                                                                            class='textfield textfield--grey card-expiry-year' placeholder='YYYY' size='4'
                                                                            type='text' value="">
                                                                    </div>
                                                                </div>

                                                                <div class="text-center text-success">
                                                                    <div class="payment_loader" style="display: none;"><i class="fa fa-spinner fa-spin"></i> Loading....</div><br>
                                                                </div>
                                                         
                                                                <!-- csrf token -->
                                                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                                                                <input type="hidden" name="billing_type" value="<?php echo $billing_type; ?>" readonly>
                                                                <input type="hidden" name="package_id" value="<?php echo $package->id; ?>" readonly>
                                                                <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>" readonly>
                                                                <div class="row">
                                                                    <div class="spacer py-2"></div>
                                                                    <div class="col-md-12">
                                                                        <button class="bttn-2 payment_btn" type="submit">Pay Now <?php echo $settings->currency_symbol; ?><?php echo html_escape($price) ?></button>
                                                                    </div>
                                                                </div>
                                                                     
                                                            </form>
                                                        </div>
                                                    </div>        
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>      
                                </div>
                            </div>
                        </div>
                    </div>

                        
                    <?php endif ?>      

                </div>

            </div>

        </div>
    </div>
</section>
