<?php
/*
 Template Name: Games
 */

//$wpdb;
$games = $wpdb->get_results('
        SELECT * FROM `games` `g`
        LEFT JOIN `Platform` `p`
        ON `g`.`PlatformId` = `p`.`PlatformId`
        LEFT JOIN `Form` `f`
        ON `g`.`FormId` = `f`.`FormId`
        WHERE 1
');
$user = wp_get_current_user();
get_header();
if (in_array('administrator', (array)$user->roles)) {
    ?>

    <h1 class="Title mb-5">Games</h1>
    <?php
    if (in_array('administrator', (array)$user->roles)) {
//    echo "<button href='/account'>Change</button>";
        echo '<a href="/GameChange">Change</a>';
    }
    ?>
    <select id="Platform">
        <option value=""></option>
        <option value="1">Playstation 4</option>
        <option value="2">Nintendo Switch</option>
        <option value="3">Nintendo 64</option>
        <option value="4">Nintendo Gameboy advance</option>
        <option value="5">Nintendo Gameboy Colour</option>
        <option value="6">Nintendo DS</option>
        <option value="7">PC</option>
    </select>

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
                <!--                <th scope="row">--><?php //echo $gamesItem->GameId; ?><!--</th>-->
                <td><?php echo $gamesItem->Name; ?></td>
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
} else {
    ?>
        <h1 class="Title">HAHAHAHAHAHA wat doe jij uberhaupt hier ben je schele kut kop</h1>
    <?php
}
?>
<?php
get_footer();