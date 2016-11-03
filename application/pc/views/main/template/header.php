<head>
<meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<meta name="keywords" content="<?=isset($meta) ? $meta['keyword'] : ''?>" />
<meta name="description"    content="<?=isset($meta) ? $meta['description'] : ''?>"/>

<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-title" content="" />


<title>
<?=isset($meta) ? $meta['title'] : ''?>
</title>
<link href="<?=base_url()?>images/favicon.ico" rel="icon">
<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]
-->
<meta property="og:url"           content="<?=str_replace(array('index.php?','index.php'),'',current_url())?>" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="<?=isset($meta) ? $meta['title'] : ''?>" />
<meta property="og:description"   content="<?=isset($meta) ? $meta['description'] : ''?>" />
<meta property="og:image"         content="<?=isset($share['facebook_image']) ? $share['facebook_image'] : '' ?>" />

<link href="<?=asset_url()?>/style/main/fonticon.css" rel="stylesheet" type="text/css" media="screen" />
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&subset=latin-ext,vietnamese" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,400i,700,700i&amp;subset=vietnamese" rel="stylesheet">
<link href="<?=asset_url()?>/style/general/bootstrap.min.css" rel="stylesheet">
<link href="<?=asset_url()."style/main/blog.css?version=1"?>" rel="stylesheet" type="text/css" media="screen" />

<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.min.js"></script>
<script type="text/javascript" src="<?=asset_url()?>javascript/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=asset_url()?>javascript/fix.min.js"></script>
<script type="text/javascript" src="<?=asset_url()?>javascript/price.js"></script>
<script type="text/javascript" src="<?=asset_url()?>javascript/jsPage.js"></script>

<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.jscrollpane.min.js"></script>
<script type="text/javascript" src="<?=asset_url()?>javascript/coin-slider.min.js"></script>
<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.easing.1.3.js"></script>
</head>
