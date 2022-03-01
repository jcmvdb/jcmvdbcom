<?php
/*
 Template Name: Contact
 */
get_header();
?>

    <h1 class="Title">Contact</h1>
    <div class="contact">
        <div class="point">
            <h2>E-mail:</h2>
            <p>mvdb.jeroen@gmail.com</p>
        </div>
        <div class="point">
            <h2>Telefoon</h2>
            <p>mvdb.jeroen@gmail.com</p>
        </div>
        <div class="Form">
            <form method="post" action="">
                <label for="Name">Naam:</label>
                <input type="text" id="Name" name="Name" placeholder="Naam" autofocus required><br>
                <label for="Phone">Telefoon nummer:</label>
                <input type="text" id="Phone" name="Phone" placeholder="Telefoon nummer" required><br>
                <label for="Email">E-mail:</label>
                <input type="email" id="Email" name="Email" placeholder="E-mail" required><br>
                <input type="submit" name="submit" value="submit">
            </form>
        </div>
    </div>

<?php
get_footer();
