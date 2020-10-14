

<div class="col-md-12">
    <div id="content" class="panel-container">
        <div id="portfolio" class="row bottom_45">
            <section class="col-md-12">
                <div class="col-md-12 content-header bottom_15">
                    <div class="section-title top_30 bottom_30"><span></span><h2><?php if(isset($page_title)) {echo html_escape($page_title);} ?></h2></div>
                </div>

                <div id="grid-container" class="top_60">
                    <?php foreach ($blog_posts as $post): ?>
                        <div class="cbp-item <?php echo html_escape($portfolio->category) ?>">
                            <a href="<?php echo base_url('post/'.$user->slug.'/'.$post->slug) ?>">
                                <figure>
                                    <img src="<?php echo base_url($post->image) ?>" alt="Image">
                                    <figcaption>
                                        <span class="date"><i class="fa fa-folder-open"></i> <?php echo html_escape($post->category) ?> &emsp; <i class="fa fa-clock-o"></i> <?php echo my_date_show($post->created_at) ?></span> 
                                        <span class="title"><?php echo html_escape($blog->title) ?></span><br/>
                                        <span class="info"><?php echo character_limiter($blog->details, 100) ?></span>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>

                <div class="row">
                    <div class="cbp-l-loadMore-button top_60">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
                
            </section>
        </div>
    </div>
</div>