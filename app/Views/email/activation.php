<html>
    <head>
        <title>Activation E-mail</title>
        <meta http-equiv="Content-Type"  content="text/html;charset=UTF-8" />
    </head>
    <body>
        <h1>Hvala Vam!</h1>
        <p>Hvala Vam što koristite našu stranicu. Za korištenje naloga na stranici potrebno je da potvrdite
            Vaš identitet koristeći Vaš e-mail.
        </p>
        <p>Ovaj E-mail je validan svega 30minuta nakon što ste izradili nalog radi vaše sigurnosti!</p>
        <p>Za registraciju ste koristili e-mail: <?php echo $email; ?></p>
        <p>Ako je to Vaš e-mail molimo da potvrdite vaš nalog koristeći link ispod.</p>
        <p><a href="<?php echo site_url('user/activate'); ?>/<?php echo $hash; ?>">Link za aktivaciju naloga!</a></p>
        <hr>
        <p><b>Ako Vi niste koristili ovaj e-mail ili našu stranicu molimo vas da se pobrinete za sigurnost Vašeg e-maila...</b></p>
    </body>
</html>