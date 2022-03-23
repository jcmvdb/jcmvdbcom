<?php
/*
 Template Name: GameChange
 */

$user = wp_get_current_user();
get_header();

$games = $wpdb->get_results('
        SELECT * FROM `Games` `g`
        LEFT JOIN `Platform` `p`
        ON `g`.`PlatformId` = `p`.`PlatformId`
        LEFT JOIN `Form` `f`
        ON `g`.`FormId` = `f`.`FormId`
        WHERE 1
');

if (in_array('administrator', (array)$user->roles)) {
    ?>

    <h1 class="Title">Game Change</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Naam</th>
            <th scope="col">Uitgever</th>
            <th scope="col">Form</th>
            <th scope="col">Platform</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        foreach ($games as $gamesItem) {
            ?>
            <tr>
                <th scope="row"><?php echo $i; ?></th>
<!--                <td>--><?php //echo $gamesItem->Name; ?><!--</td>-->
                <input type="text" placeholder="<?php echo $gamesItem->Name ?>" value="<?php echo $gamesItem->Name ?>">
                <td><?php echo $gamesItem->Developer; ?></td>
                <td><?php echo $gamesItem->Form; ?></td>
                <td><?php echo $gamesItem->Platform; ?></td>
            </tr>
            <?php
            $i++;
        }
        ?>
        </tbody>
    </table>

    <?php
        foreach ($games as $gameItem) {}
    ?>
    <form action="">
        <input type="text" placeholder="<?php echo $gamesItem->Name ?>" value="<?php echo $gamesItem->Name ?>" name="<?php echo $gamesItem->Name ?>">
        <input type="text" placeholder="<?php echo $gamesItem->Name ?>" value="<?php echo $gamesItem->Name ?>" name="<?php echo $gamesItem->Name ?>">
        <input type="text" placeholder="<?php echo $gamesItem->Name ?>" value="<?php echo $gamesItem->Name ?>" name="<?php echo $gamesItem->Name ?>">
        <input type="text" placeholder="<?php echo $gamesItem->Name ?>" value="<?php echo $gamesItem->Name ?>" name="<?php echo $gamesItem->Name ?>">
        <input type="submit" value="submit" name="submit">
    </form>

    <?php
} else {
    ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <section class="error-404 not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'palmeria' ); ?></h1>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try search?', 'palmeria' ); ?></p>
                    <a href="<?php home_url();?>" class="button"><?php echo esc_html__('Go to home page', 'palmeria');?></a>
                </div>

            </section><!-- .error-404 -->

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php
}

get_footer();

?>
