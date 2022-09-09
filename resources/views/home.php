<?php include_once \App\Core\Application::$ROOT_DIR . '/resources/views/components/carousel.php' ?>

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-center mb-3">
        <h2>Popular Places</h2>
    </div>

    <div class="row gap-1">
        <?php if (isset($sites)) { ?>
            <?php foreach ($sites as $key => $site) { ?>
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header"><?php echo $site->site_name?></div>
                        <div class="card-body gap-1">
                            <p><?php echo $site->feature?></p>

                            <p class="text-secondary">Location: <?php echo $site->location?></p>

                            <p class="text-secondary">Location: <?php echo $site->contact?></p>

                            <p class="text-secondary">Price From: $<?php echo $site->price_from?></p>
                        </div>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
</div>
