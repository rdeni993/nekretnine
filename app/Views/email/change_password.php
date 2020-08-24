<html>
    <head>
        <title>Activation E-mail</title>
        <meta http-equiv="Content-Type"  content="text/html;charset=UTF-8" />
    </head>
    <body>
        <h1>Vaša lozinka je promjenjena uspješno</h1>
        <p>U slučaju da Vi niste zatražili ovu promjenu molimo da odmah kontaktirate administratore!</p>
        <p>Vaša nova lozinka je: <b><?php echo $new_pass; ?></b></p>
        <p>Nakon izmjene lozinke Vaš profil je restartovan i ponovo se možete prijaviti na svoj profil
            <a href="<?php echo site_url('login'); ?>">ovdje!</a>
        </p>
        <hr>
        <p><b>Ako Vi niste koristili ovaj e-mail ili našu stranicu molimo vas da se pobrinete za sigurnost Vašeg e-maila...</b></p>
    </body>
</html>