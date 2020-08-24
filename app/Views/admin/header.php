<!DOCTYPE html>
<html lang="sr">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Facebook -->
    <meta property="og:url"           content="<?php echo $meta_tags['url']; ?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo $meta_tags['title']; ?>" />
    <meta property="og:description"   content="<?php echo $meta_tags['desc']; ?>" />
    <meta property="og:image"         content="<?php echo $meta_tags['image']; ?>" />

    <!-- Title -->
    <?php if($site_title): ?>
    <title><?php echo esc($site_title); ?></title>
    <?php else: ?>
        <title>Document</title>
    <?php endif; ?>

    <!-- Load CSS --> 
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>/public/assets/css/fa/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/css/cms_script.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/css/view-script.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/css/mobile.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/css/add.css" />
    
    <!-- Load JS -->
    <script src="<?php echo base_url(); ?>/public/assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/js/jq-validator.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/js/cms-script.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/js/view-script.js"></script>
    <script src="<?php echo base_url(); ?>/public/assets/js/mobile.js"></script>


</head>
<body>

<?php if( !isset( $_COOKIE['gdpr_stmt_add'] ) ): ?>
<div class="cookies-info text-white">
<div class="card bg-dark">
    <div class="card-body">
        <h3>Koristenje kolačića</h3>
        <p>Kako bi osigurali ispravno i ugodno korištenje naše Web stranice na vaš računar spremamo malu količinu podataka
            tzv. kolačiće <i>(eng. cookies)</i>. Zbog Vaše sigurnosti i sigurnosti Vaših podataka preporučujemo Vam da pročitate
            našu izjavu o privatnosti i sami uvidite da koristimo isključivo kolačiće koji su neophodni da stranica funkcioniše 
            ispravno!
        </p>
        <p>Ukoliko nastavite koristiti našu stranicu smatramo da se slažete sa korištenjem kolačića i da nam odobravate
            korištenje istih.
        </p>
        <button class="btn btn-warning set-cookie">Slažem se sa korištenjem kolačića</button>
        <a href="#" class="btn btn-default text-white">Želim pročitati više o kolačićima</a>
    </div>
</div>
</div>
<?php endif; ?>
