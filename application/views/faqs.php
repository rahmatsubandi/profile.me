
<!-- FAQ Area -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="page-title">
                        <h2 class="title">Frequently Asked & Questions</h2>
                        <div class="space-20"></div>
                    </div>
                </div>
            </div>

            <div class="row minh-400">

                <section class="accordion-section clearfix mt-3" aria-label="Question Accordions">
                  <div class="container">
  
                      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php $i=1; foreach ($faqs as $row): ?>
                        <div class="panel panel-default accordions">
                          <a class="collapsed" role="button" title="" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i;?>" aria-expanded="true" aria-controls="collapse0">
                              <div class="panel-heading p-3 mb-3" role="tab" id="heading<?php echo $i;?>">
                                <h3 class="panel-title pnl-title">
                                    <?php echo html_escape($row->title); ?>
                                </h3>
                              </div>
                          </a>

                          <div id="collapse<?php echo $i;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $i;?>">
                            <div class="panel-body pnl px-3 mb-4">
                              <p><?php echo strip_tags($row->details); ?></p>
                            </div>
                          </div>
                        </div>
                        <?php $i++; endforeach; ?>
                      </div>
                  
                  </div>
                </section>

            </div>

        </div>
    </section><!-- /FAQ Area -->