<?php
get_header();
if (is_user_logged_in()) {
    $user = wp_get_current_user();
    $games = $wpdb->get_results('
        SELECT * FROM `Games` `g`
        LEFT JOIN `Platform` `p`
        ON `g`.`PlatformId` = `p`.`PlatformId`
        LEFT JOIN `Form` `f`
        ON `g`.`FormId` = `f`.`FormId`
        WHERE 1
');
    ?>
    <style>
        .topbar a {
            float: right;
            text-align: center;
            padding: 20px 26px;
            text-decoration: none;
            font-size: 26px;
        }

        .sidebar {
            height: 100%;
        }

        .sidebar a {
            margin-left: 10px;
            display: block;
            color: black;
            padding-bottom: 10px;
            font-size: 30px;
            text-decoration: none;
        }

        .sidebar:hover {
            color: green;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
        }
    </style>
    <div class="container">
        <h1 class="text-center">Account</h1>
        <div class="row">
            <div class="col-md-4 mt-1">
                <div class="card text-center sidebar">
                    <div class="card-body">
                        <img src="<?php echo esc_url(get_avatar_url($user->ID)); ?>" class="rounded-circle" width="150">
                        <div class="mt-3">
                            <h3><?= $user->first_name . " " . $user->last_name ?></h3>
                            <hr>
                            <hr>
                            <!--                            <a href="">Dashboard</a><hr>-->
                            <a href="/games">Game lijst</a>
                            <hr>
                            <a href="/wp-admin/profile.php">Account Instellingen</a>
                            <hr>
                            <?php if (in_array('administrator', (array)$user->roles)) { // logged in as administrator ?>
                                <a href="/404">404 Testing</a>
                                <hr>
                            <?php } else { // normal users?>

                            <?php } ?>
                            <a href="/wp-login.php?action=logout&redirect_to=https://portfolio:8890/&_wpnonce=dde1f0453f">Logout</a>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mt-1">
                <div class="card mb-3 content">
                    <h1 class="m-3 pt-3">About</h1>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h5>Full Name</h5>
                            </div>
                            <div class="col-md-9 text-secondary">
                                <?= $user->first_name . " " . $user->last_name ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <h5>Gebruikersnaam</h5>
                            </div>
                            <div class="col-md-9 text-secondary">
                                <?= $user->user_nicename ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <h5>Email</h5>
                            </div>
                            <div class="col-md-9 text-secondary">
                                <?= $user->user_email ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                foreach ($games as $GameItem) {
                    $gameArray[] = $GameItem->GameId;
                }
                $count = count($gameArray) - 1;
                $rand = rand(0, $count);
                $randomGame = $gameArray[$rand];
                ?>
                <div class="card mb-3 content">
                    <h1 class="m-3">Random Game</h1>
                    <div class="card-body">
                        <?php foreach ($games as $item) {
                            if ($item->GameId == $randomGame) {
                                ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Game</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <?php print_r($item->Name) ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Uitgever</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <?php print_r($item->Developer) ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Fysiek/Download</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <?php print_r($item->Form) ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Platform</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <?php print_r($item->Platform) ?>
                                    </div>
                                </div>
                            <?php } else {
//                                echo "<pre>";
//                                var_dump($gameArray);
//                                echo "</pre>";
//                                echo count($gameArray);
                            }
                        }

                        ?>
                    </div>
                </div>
                <?php
                function AmountOfGames($wpdb, $number = 1)
                {
                    $count = 0;
                    $amount = $wpdb->get_results('SELECT * FROM `Games` WHERE `PlatformId` = ' . $number . '');
                    foreach ($amount as $item) {
                        $count++;
                    }
                    echo $count;
                }
                ?>

                <div class="card content">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load("current", {packages: ["corechart"]});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Console', 'Amount of Games'],
                                ['Playstation 4',     <?php AmountOfGames($wpdb, 1); ?>],
                                ['Nintendo Switch',      <?php echo AmountOfGames($wpdb, 2); ?>],
                                ['Nintendo 64',  <?php echo AmountOfGames($wpdb, 3); ?>],
                                ['Nintendo Gameboy Advance', <?php echo AmountOfGames($wpdb, 4); ?>],
                                ['Nintendo Gameboy Colour', <?php echo AmountOfGames($wpdb, 5); ?>],
                                ['Nintendo DS', <?php echo AmountOfGames($wpdb, 6); ?>],
                                ['PC', <?php echo AmountOfGames($wpdb, 7); ?>],
                                //['Nintendo 64', <?php //echo $nintendo64Count ?>//],
                            ]);

                            var options = {
                                title: 'My Games Collection',
                                pieHole: 0.3,
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                            chart.draw(data, options);
                        }
                    </script>
                    <div id="donutchart" style="height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php
} else {
    echo "je moet inloggen";
}
get_footer();