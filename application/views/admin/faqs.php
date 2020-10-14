<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">


    <div class="col-md-8 m-auto box add_area mt-50" style="display: <?php if($page_title == "Edit"){echo "block";}else{echo "none";} ?>">
      
      <div class="box-header with-border">
        <?php if (isset($page_title) && $page_title == "Edit"): ?>
          <h3 class="box-title">Edit FAQ</h3>
        <?php else: ?>
          <h3 class="box-title">Add New Faq </h3>
        <?php endif; ?>

        <div class="box-tools pull-right">
          <?php if (isset($page_title) && $page_title == "Edit"): ?>
            <?php $required = ''; ?>
            <a href="<?php echo base_url('admin/faq') ?>" class="pull-right btn btn-default btn-sm"><i class="fa fa-angle-left"></i> Back</a>
          <?php else: ?>
            <?php $required = 'required'; ?>
            <a href="#" class="text-right btn btn-default btn-sm cancel_btn"><i class="fa fa-angle-left"></i> Back</a>
          <?php endif; ?>
        </div>
      </div>

      <div class="box-body">
        <form id="cat-form" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/faq/add')?>" role="form" novalidate>

          <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" name="title" value="<?php echo html_escape($faq[0]['title']); ?>" <?php echo html_escape($required); ?>>
          </div>

         
          <div class="form-group">
              <label>Details</label>
              <textarea id="ckEditor" class="form-control" name="details"><?php echo html_escape($faq[0]['details']); ?></textarea>
          </div>

          <input type="hidden" name="id" value="<?php echo html_escape($faq['0']['id']); ?>">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <div class="row m-t-30">
            <div class="col-sm-12">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <button type="submit" class="btn btn-info pull-left">Save changes</button>
              <?php else: ?>
                <button type="submit" class="btn btn-info pull-left"> Save</button>
              <?php endif; ?>
            </div>
          </div>

        </form>

      </div>
    </div>


    <?php if (isset($page_title) && $page_title != "Edit"): ?>

    <div class="box list_area container">

      <div class="box-header with-border">
      <?php if (isset($page_title) && $page_title == "Edit"): ?>
        <h3 class="box-title">Edit <a href="<?php echo base_url('admin/pages') ?>" class="pull-right btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a></h3>
      <?php else: ?>
        <h3 class="box-title">All Faq</h3>
      <?php endif; ?>

      <div class="box-tools pull-right">
         <a href="#" class="pull-right btn btn-info btn-sm add_btn"><i class="fa fa-plus"></i> Add new FAQ</a>
        </div>
    </div>

      <div class="col-md-12 col-sm-12 col-xs-12 scroll table-responsive p-0">
          <table class="table table-bordered <?php if(count($faqs) > 10){echo "datatable";} ?>" id="dg_tables">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Details</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($faqs as $row): ?>
                  <tr id="row_<?php echo ($row->id); ?>">
                      
                      <td width="5%"><?php echo $i; ?></td>
                      <td  width="20%"><?php echo html_escape($row->title); ?></td>
                      <td><?php echo strip_tags(character_limiter($row->details, 300)); ?></td>

                      <td class="actions" width="12%">
                        <a href="<?php echo base_url('admin/faq/edit/'.html_escape($row->id));?>" class="on-default edit-row" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp; 

                        <a data-val="page" data-id="<?php echo html_escape($row->id); ?>" href="<?php echo base_url('admin/faq/delete/'.html_escape($row->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> &nbsp;

                      </td>
                  </tr>
                <?php $i++; endforeach; ?>
              </tbody>
          </table>
      </div>

    </div>
    <?php endif; ?>

  </section>
</div>
