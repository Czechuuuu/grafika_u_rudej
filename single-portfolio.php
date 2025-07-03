<?php
get_header(); ?>

<main class="wrap single-project">
    <?php
    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post(); ?>

            <article class="project-details">
                <header class="project-header">
                    <h1><?php the_title(); ?></h1>
                    <?php if (get_field('client_name')) : ?>
                        <p class="client">Klient: <?php echo get_field('client_name'); ?></p>
                    <?php endif; ?>
                    <?php if (get_field('project_date')) : ?>
                        <p class="date">Data realizacji: <?php echo get_field('project_date'); ?></p>
                    <?php endif; ?>
                </header>

                <div class="project-gallery">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="main-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (get_field('project_images')) : ?>
                        <div class="additional-images">
                            <?php 
                            $images = get_field('project_images');
                            if ($images) :
                                foreach ($images as $image) : ?>
                                    <div class="project-image">
                                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                                    </div>
                                <?php endforeach;
                            endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="project-content">
                    <div class="project-description">
                        <h2>O projekcie</h2>
                        <?php the_content(); ?>
                    </div>

                    <?php if (get_field('project_process')) : ?>
                        <div class="project-process">
                            <h2>Proces projektowy</h2>
                            <?php echo get_field('project_process'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (get_field('tools_used')) : ?>
                        <div class="tools-used">
                            <h2>Narzędzia</h2>
                            <div class="tools-list">
                                <?php 
                                $tools = get_field('tools_used');
                                if ($tools) :
                                    foreach ($tools as $tool) : ?>
                                        <span class="tool-tag"><?php echo $tool; ?></span>
                                    <?php endforeach;
                                endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (get_field('project_link')) : ?>
                        <div class="project-links">
                            <h2>Linki</h2>
                            <a href="<?php echo get_field('project_link'); ?>" class="btn btn-external" target="_blank">
                                Zobacz projekt online
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <nav class="project-navigation">
                    <div class="nav-links">
                        <?php 
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        ?>
                        
                        <?php if ($prev_post) : ?>
                            <a href="<?php echo get_permalink($prev_post); ?>" class="nav-link prev">
                                <span class="nav-arrow">←</span>
                                <div class="nav-content">
                                    <span class="nav-label">Poprzedni projekt</span>
                                    <span class="nav-title"><?php echo get_the_title($prev_post); ?></span>
                                </div>
                            </a>
                        <?php endif; ?>

                        <?php if ($next_post) : ?>
                            <a href="<?php echo get_permalink($next_post); ?>" class="nav-link next">
                                <div class="nav-content">
                                    <span class="nav-label">Następny projekt</span>
                                    <span class="nav-title"><?php echo get_the_title($next_post); ?></span>
                                </div>
                                <span class="nav-arrow">→</span>
                            </a>
                        <?php endif; ?>
                    </div>
                </nav>
            </article>

        <?php }
    } ?>
</main>

<?php
get_footer();
