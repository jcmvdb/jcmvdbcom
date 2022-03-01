<?php
/*
 Template Name: Account
 */

get_header();
if (is_user_logged_in()) {
    $user = wp_get_current_user();
    $testResult = $wpdb->get_results("
        SELECT * FROM `testing` `t`
        LEFT JOIN `wp_users` `wpu`
        ON `t`.`wpUsersID` = `wpu`.`ID`
        LEFT JOIN `roomtypes` `rt`
        ON `t`.`roomtypeID` = `rt`.`roomtypeID`
        WHERE `wpUsersID` = $user->ID
        ORDER BY `testingID` DESC
        LIMIT 1
    ");
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

                <div class="card mb-3 content">
                    <h1 class="m-3">Recent geboekte kamers</h1>
                    <div class="card-body">
                        <?php foreach ($testResult as $item) { ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Bestelling nummer</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <?php print_r($item->testingID) ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Begin Datum</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <?php print_r($item->test1) ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Eind Datum</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <?php print_r($item->test2) ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>kamer type</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <?php print_r($item->type) ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>tijdstip van boeking</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <?php print_r($item->Timestamp) ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
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