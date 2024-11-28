<?php
include 'conectarbanco.php';

$conn = new mysqli($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT nome_unico, nome_um, nome_dois FROM app";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();


    $nomeUnico = $row['nome_unico'];
    $nomeUm = $row['nome_um'];
    $nomeDois = $row['nome_dois'];

} else {
    return false;
}

$conn->close();
?>
<!DOCTYPE html>

<html lang="pt-br" class="w-mod-js w-mod-ix wf-spacemono-n4-active wf-spacemono-n7-active wf-active"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><style>.wf-force-outline-none[tabindex="-1"]:focus{outline:none;}</style>
<meta charset="pt-br">
<title><?php echo $nomeUnico; ?></title>

<meta property="og:image" content="../img/logo.png">

<meta content="<?php echo $nomeUnico; ?>" property="og:title">
<meta name="twitter:site" content="@daanrox">
<meta name="twitter:image" content="../img/logo.png">
<meta property="og:type" content="website">

<meta content="width=device-width, initial-scale=1" name="viewport">

<link href="../arquivos/withdrawtable.css" rel="stylesheet" type="text/css">
<script src="../arquivos/webfont.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>

<script type="text/javascript">
                WebFont.load({
                    google: {
                        families: ["Space Mono:regular,700"]
                    }
                });
            </script>



<script type="text/javascript">
                ! function (o, c) {
                    var n = c.documentElement,
                        t = " w-mod-";
                    n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n
                        .className += t + "touch")
                }(window, document);
            </script>
<link rel="icon" type="image/png" sizes="32x32" href="../img/logo.png">
<link rel="icon" type="image/png" sizes="16x16" href="../img/logo.png">



<link rel="icon" type="image/x-icon" href="../img/logo.png">

<link rel="stylesheet" href="arquivos/css" media="all">
</head>
<body>
<div>
<div data-collapse="small" data-animation="default" data-duration="400" role="banner" class="navbar w-nav">
<div class="container w-container">
<a href="/" aria-current="page" class="brand w-nav-brand" aria-label="home">
<img src="arquivos/l2.png" loading="lazy" height="28" alt="" class="image-6">
<div class="nav-link logo"><?php echo $nomeUnico; ?></div>
</a>
<nav role="navigation" class="nav-menu w-nav-menu">
<a href="/presell/" class="nav-link w-nav-link" style="max-width: 940px;">Jogar</a>
<a href="/login/" class="nav-link w-nav-link w--current" style="max-width: 940px;">Login</a>

<a href="/cadastrar/" class="button nav w-button">Cadastrar</a>
</nav>







<style>
  .nav-bar {
      display: none;
      background-color: #333; /* Cor de fundo do menu */
      padding: 20px; /* Espaçamento interno do menu */
      width: 90%; /* Largura total do menu */
    
      position: fixed; /* Fixa o menu na parte superior */
      top: 0;
      left: 0;
      z-index: 1000; /* Garante que o menu está acima de outros elementos */
      margin-top: 18%;
  }

  .nav-bar a {
      color: white; /* Cor dos links no menu */
      text-decoration: none;
      padding: 10px; /* Espaçamento interno dos itens do menu */
      display: block;
      margin-bottom: 10px; /* Espaçamento entre os itens do menu */
  }

  .nav-bar a.login {
      color: white; /* Cor do texto para o botão Login */
  }
  
  .button.w-button {
  text-align: center;
}

</style>
<style>
    
    /*!normalize.css v3.0.3 | MIT License | github.com/necolas/normalize.css*/
html{
    font-family:sans-serif;
    -ms-text-size-adjust:100%;
    -webkit-text-size-adjust:100%
}
body{
    margin:0
}
article,aside,details,figcaption,figure,footer,header,hgroup,main,menu,nav,section,summary{
    display:block
}
audio,canvas,progress,video{
    display:inline-block;
    vertical-align:baseline
}
audio:not([controls]){
    display:none;
    height:0
}
[hidden],template{
    display:none
}
a{
    background-color:transparent
}
a:active,a:hover{
    outline:0
}
abbr[title]{
    border-bottom:1px dotted
}
b,strong{
    font-weight:700
}
dfn{
    font-style:italic
}
h1{
    font-size:2em;
    margin:.67em 0
}
mark{
    background:#ff0;
    color:#000
}
small{
    font-size:80%
}
sub,sup{
    font-size:75%;
    line-height:0;
    position:relative;
    vertical-align:baseline
}
sup{
    top:-.5em
}
sub{
    bottom:-.25em
}
img{
    border:0
}
svg:not(:root){
    overflow:hidden
}
figure{
    margin:1em 40px
}
hr{
    box-sizing:content-box;
    height:0
}
pre{
    overflow:auto
}
code,kbd,pre,samp{
    font-family:monospace,monospace;
    font-size:1em
}
button,input,optgroup,select,textarea{
    color:inherit;
    font:inherit;
    margin:0
}
button{
    overflow:visible
}
button,select{
    text-transform:none
}
button,html input[type=button],input[type=reset]{
    -webkit-appearance:button;
    cursor:pointer
}
button[disabled],html input[disabled]{
    cursor:default
}
button::-moz-focus-inner,input::-moz-focus-inner{
    border:0;
    padding:0
}
input{
    line-height:normal
}
input[type=checkbox],input[type=radio]{
    box-sizing:border-box;
    padding:0
}
input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button{
    height:auto
}
input[type=search]{
    -webkit-appearance:none
}
input[type=search]::-webkit-search-cancel-button,input[type=search]::-webkit-search-decoration{
    -webkit-appearance:none
}
fieldset{
    border:1px solid silver;
    margin:0 2px;
    padding:.35em .625em .75em
}
legend{
    border:0;
    padding:0
}
textarea{
    overflow:auto
}
optgroup{
    font-weight:700
}
table{
    border-collapse:collapse;
    border-spacing:0
}
td,th{
    padding:0
}
@font-face{
    font-family:webflow-icons;
    src:url(data:application/x-font-ttf;
    charset=utf-8;
    base64,AAEAAAALAIAAAwAwT1MvMg8SBiUAAAC8AAAAYGNtYXDpP+a4AAABHAAAAFxnYXNwAAAAEAAAAXgAAAAIZ2x5ZmhS2XEAAAGAAAADHGhlYWQTFw3HAAAEnAAAADZoaGVhCXYFgQAABNQAAAAkaG10eCe4A1oAAAT4AAAAMGxvY2EDtALGAAAFKAAAABptYXhwABAAPgAABUQAAAAgbmFtZSoCsMsAAAVkAAABznBvc3QAAwAAAAAHNAAAACAAAwP4AZAABQAAApkCzAAAAI8CmQLMAAAB6wAzAQkAAAAAAAAAAAAAAAAAAAABEAAAAAAAAAAAAAAAAAAAAABAAADpAwPA/8AAQAPAAEAAAAABAAAAAAAAAAAAAAAgAAAAAAADAAAAAwAAABwAAQADAAAAHAADAAEAAAAcAAQAQAAAAAwACAACAAQAAQAg5gPpA//9//8AAAAAACDmAOkA//3//wAB/+MaBBcIAAMAAQAAAAAAAAAAAAAAAAABAAH//wAPAAEAAAAAAAAAAAACAAA3OQEAAAAAAQAAAAAAAAAAAAIAADc5AQAAAAABAAAAAAAAAAAAAgAANzkBAAAAAAEBIAAAAyADgAAFAAAJAQcJARcDIP5AQAGA/oBAAcABwED+gP6AQAABAOAAAALgA4AABQAAEwEXCQEH4AHAQP6AAYBAAcABwED+gP6AQAAAAwDAAOADQALAAA8AHwAvAAABISIGHQEUFjMhMjY9ATQmByEiBh0BFBYzITI2PQE0JgchIgYdARQWMyEyNj0BNCYDIP3ADRMTDQJADRMTDf3ADRMTDQJADRMTDf3ADRMTDQJADRMTAsATDSANExMNIA0TwBMNIA0TEw0gDRPAEw0gDRMTDSANEwAAAAABAJ0AtAOBApUABQAACQIHCQEDJP7r/upcAXEBcgKU/usBFVz+fAGEAAAAAAL//f+9BAMDwwAEAAkAABcBJwEXAwE3AQdpA5ps/GZsbAOabPxmbEMDmmz8ZmwDmvxmbAOabAAAAgAA/8AEAAPAAB0AOwAABSInLgEnJjU0Nz4BNzYzMTIXHgEXFhUUBw4BBwYjNTI3PgE3NjU0Jy4BJyYjMSIHDgEHBhUUFx4BFxYzAgBqXV6LKCgoKIteXWpqXV6LKCgoKIteXWpVSktvICEhIG9LSlVVSktvICEhIG9LSlVAKCiLXl1qal1eiygoKCiLXl1qal1eiygoZiEgb0tKVVVKS28gISEgb0tKVVVKS28gIQABAAABwAIAA8AAEgAAEzQ3PgE3NjMxFSIHDgEHBhUxIwAoKIteXWpVSktvICFmAcBqXV6LKChmISBvS0pVAAAAAgAA/8AFtgPAADIAOgAAARYXHgEXFhUUBw4BBwYHIxUhIicuAScmNTQ3PgE3NjMxOAExNDc+ATc2MzIXHgEXFhcVATMJATMVMzUEjD83NlAXFxYXTjU1PQL8kz01Nk8XFxcXTzY1PSIjd1BQWlJJSXInJw3+mdv+2/7c25MCUQYcHFg5OUA/ODlXHBwIAhcXTzY1PTw1Nk8XF1tQUHcjIhwcYUNDTgL+3QFt/pOTkwABAAAAAQAAmM7nP18PPPUACwQAAAAAANciZKUAAAAA1yJkpf/9/70FtgPDAAAACAACAAAAAAAAAAEAAAPA/8AAAAW3//3//QW2AAEAAAAAAAAAAAAAAAAAAAAMBAAAAAAAAAAAAAAAAgAAAAQAASAEAADgBAAAwAQAAJ0EAP/9BAAAAAQAAAAFtwAAAAAAAAAKABQAHgAyAEYAjACiAL4BFgE2AY4AAAABAAAADAA8AAMAAAAAAAIAAAAAAAAAAAAAAAAAAAAAAAAADgCuAAEAAAAAAAEADQAAAAEAAAAAAAIABwCWAAEAAAAAAAMADQBIAAEAAAAAAAQADQCrAAEAAAAAAAUACwAnAAEAAAAAAAYADQBvAAEAAAAAAAoAGgDSAAMAAQQJAAEAGgANAAMAAQQJAAIADgCdAAMAAQQJAAMAGgBVAAMAAQQJAAQAGgC4AAMAAQQJAAUAFgAyAAMAAQQJAAYAGgB8AAMAAQQJAAoANADsd2ViZmxvdy1pY29ucwB3AGUAYgBmAGwAbwB3AC0AaQBjAG8AbgBzVmVyc2lvbiAxLjAAVgBlAHIAcwBpAG8AbgAgADEALgAwd2ViZmxvdy1pY29ucwB3AGUAYgBmAGwAbwB3AC0AaQBjAG8AbgBzd2ViZmxvdy1pY29ucwB3AGUAYgBmAGwAbwB3AC0AaQBjAG8AbgBzUmVndWxhcgBSAGUAZwB1AGwAYQByd2ViZmxvdy1pY29ucwB3AGUAYgBmAGwAbwB3AC0AaQBjAG8AbgBzRm9udCBnZW5lcmF0ZWQgYnkgSWNvTW9vbi4ARgBvAG4AdAAgAGcAZQBuAGUAcgBhAHQAZQBkACAAYgB5ACAASQBjAG8ATQBvAG8AbgAuAAAAAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==) format('truetype');
    font-weight:400;
    font-style:normal
}
[class^=w-icon-],[class*=" w-icon-"]{
    font-family:webflow-icons!important;
    speak:none;
    font-style:normal;
    font-weight:400;
    font-variant:normal;
    text-transform:none;
    line-height:1;
    -webkit-font-smoothing:antialiased;
    -moz-osx-font-smoothing:grayscale
}
.w-icon-slider-right:before{
    content:"\e600"
}
.w-icon-slider-left:before{
    content:"\e601"
}
.w-icon-nav-menu:before{
    content:"\☰"
}
.w-icon-arrow-down:before,.w-icon-dropdown-toggle:before{
    content:"\e603"
}
.w-icon-file-upload-remove:before{
    content:"\e900"
}
.w-icon-file-upload-icon:before{
    content:"\e903"
}
*{
    -webkit-box-sizing:border-box;
    -moz-box-sizing:border-box;
    box-sizing:border-box
}
html{
    height:100%
}
body{
    margin:0;
    min-height:100%;
    background-color:#fff;
    font-family:Arial,sans-serif;
    font-size:14px;
    line-height:20px;
    color:#333
}
img{
    max-width:100%;
    vertical-align:middle;
    display:inline-block
}
html.w-mod-touch *{
    background-attachment:scroll!important
}
.w-block{
    display:block
}
.w-inline-block{
    max-width:100%;
    display:inline-block
}
.w-clearfix:before,.w-clearfix:after{
    content:" ";
    display:table;
    grid-column-start:1;
    grid-row-start:1;
    grid-column-end:2;
    grid-row-end:2
}
.w-clearfix:after{
    clear:both
}
.w-hidden{
    display:none
}
.w-button{
    display:inline-block;
    padding:9px 15px;
    background-color:#3898ec;
    color:#fff;
    border:0;
    line-height:inherit;
    text-decoration:none;
    cursor:pointer;
    border-radius:0
}
input.w-button{
    -webkit-appearance:button
}
html[data-w-dynpage] [data-w-cloak]{
    color:transparent!important
}
.w-webflow-badge,.w-webflow-badge *{
    position:static;
    left:auto;
    top:auto;
    right:auto;
    bottom:auto;
    z-index:auto;
    display:block;
    visibility:visible;
    overflow:visible;
    overflow-x:visible;
    overflow-y:visible;
    box-sizing:border-box;
    width:auto;
    height:auto;
    max-height:none;
    max-width:none;
    min-height:0;
    min-width:0;
    margin:0;
    padding:0;
    float:none;
    clear:none;
    border:0 transparent;
    border-radius:0;
    background:0 0;
    background-image:none;
    background-position:0% 0%;
    background-size:auto auto;
    background-repeat:repeat;
    background-origin:padding-box;
    background-clip:border-box;
    background-attachment:scroll;
    background-color:transparent;
    box-shadow:none;
    opacity:1;
    transform:none;
    transition:none;
    direction:ltr;
    font-family:inherit;
    font-weight:inherit;
    color:inherit;
    font-size:inherit;
    line-height:inherit;
    font-style:inherit;
    font-variant:inherit;
    text-align:inherit;
    letter-spacing:inherit;
    text-decoration:inherit;
    text-indent:0;
    text-transform:inherit;
    list-style-type:disc;
    text-shadow:none;
    font-smoothing:auto;
    vertical-align:baseline;
    cursor:inherit;
    white-space:inherit;
    word-break:normal;
    word-spacing:normal;
    word-wrap:normal
}
.w-webflow-badge{
    position:fixed!important;
    display:inline-block!important;
    visibility:visible!important;
    z-index:2147483647!important;
    top:auto!important;
    right:12px!important;
    bottom:12px!important;
    left:auto!important;
    color:#aaadb0!important;
    background-color:#fff!important;
    border-radius:3px!important;
    padding:6px 8px 6px 6px!important;
    font-size:12px!important;
    opacity:1!important;
    line-height:14px!important;
    text-decoration:none!important;
    transform:none!important;
    margin:0!important;
    width:auto!important;
    height:auto!important;
    overflow:visible!important;
    white-space:nowrap;
    box-shadow:0 0 0 1px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.1);
    cursor:pointer
}
.w-webflow-badge>img{
    display:inline-block!important;
    visibility:visible!important;
    opacity:1!important;
    vertical-align:middle!important
}
h1,h2,h3,h4,h5,h6{
    font-weight:700;
    margin-bottom:10px
}
h1{
    font-size:38px;
    line-height:44px;
    margin-top:20px
}
h2{
    font-size:32px;
    line-height:36px;
    margin-top:20px
}
h3{
    font-size:24px;
    line-height:30px;
    margin-top:20px
}
h4{
    font-size:18px;
    line-height:24px;
    margin-top:10px
}
h5{
    font-size:14px;
    line-height:20px;
    margin-top:10px
}
h6{
    font-size:12px;
    line-height:18px;
    margin-top:10px
}
p{
    margin-top:0;
    margin-bottom:10px
}
blockquote{
    margin:0 0 10px;
    padding:10px 20px;
    border-left:5px solid #e2e2e2;
    font-size:18px;
    line-height:22px
}
figure{
    margin:0;
    margin-bottom:10px
}
figcaption{
    margin-top:5px;
    text-align:center
}
ul,ol{
    margin-top:0;
    margin-bottom:10px;
    padding-left:40px
}
.w-list-unstyled{
    padding-left:0;
    list-style:none
}
.w-embed:before,.w-embed:after{
    content:" ";
    display:table;
    grid-column-start:1;
    grid-row-start:1;
    grid-column-end:2;
    grid-row-end:2
}
.w-embed:after{
    clear:both
}
.w-video{
    width:100%;
    position:relative;
    padding:0
}
.w-video iframe,.w-video object,.w-video embed{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    border:none
}
fieldset{
    padding:0;
    margin:0;
    border:0
}
button,[type=button],[type=reset]{
    border:0;
    cursor:pointer;
    -webkit-appearance:button
}
.w-form{
    margin:0 0 15px
}
.w-form-done{
    display:none;
    padding:20px;
    text-align:center;
    background-color:#ddd
}
.w-form-fail{
    display:none;
    margin-top:10px;
    padding:10px;
    background-color:#ffdede
}
label{
    display:block;
    margin-bottom:5px;
    font-weight:700
}
.w-input,.w-select{
    display:block;
    width:100%;
    height:38px;
    padding:8px 12px;
    margin-bottom:10px;
    font-size:14px;
    line-height:1.42857143;
    color:#333;
    vertical-align:middle;
    background-color:#fff;
    border:1px solid #ccc
}
.w-input:-moz-placeholder,.w-select:-moz-placeholder{
    color:#999
}
.w-input::-moz-placeholder,.w-select::-moz-placeholder{
    color:#999;
    opacity:1
}
.w-input:-ms-input-placeholder,.w-select:-ms-input-placeholder{
    color:#999
}
.w-input::-webkit-input-placeholder,.w-select::-webkit-input-placeholder{
    color:#999
}
.w-input:focus,.w-select:focus{
    border-color:#3898ec;
    outline:0
}
.w-input[disabled],.w-select[disabled],.w-input[readonly],.w-select[readonly],fieldset[disabled] .w-input,fieldset[disabled] .w-select{
    cursor:not-allowed
}
.w-input[disabled]:not(.w-input-disabled),.w-select[disabled]:not(.w-input-disabled),.w-input[readonly],.w-select[readonly],fieldset[disabled]:not(.w-input-disabled) .w-input,fieldset[disabled]:not(.w-input-disabled) .w-select{
    background-color:#eee
}
textarea.w-input,textarea.w-select{
    height:auto
}
.w-select{
    background-color:#f3f3f3
}
.w-select[multiple]{
    height:auto
}
.w-form-label{
    display:inline-block;
    cursor:pointer;
    font-weight:400;
    margin-bottom:0
}
.w-radio{
    display:block;
    margin-bottom:5px;
    padding-left:20px
}
.w-radio:before,.w-radio:after{
    content:" ";
    display:table;
    grid-column-start:1;
    grid-row-start:1;
    grid-column-end:2;
    grid-row-end:2
}
.w-radio:after{
    clear:both
}
.w-radio-input{
    margin:4px 0 0;
    margin-top:1px \9;
    line-height:normal;
    float:left;
    margin-left:-20px
}
.w-radio-input{
    margin-top:3px
}
.w-file-upload{
    display:block;
    margin-bottom:10px
}
.w-file-upload-input{
    width:.1px;
    height:.1px;
    opacity:0;
    overflow:hidden;
    position:absolute;
    z-index:-100
}
.w-file-upload-default,.w-file-upload-uploading,.w-file-upload-success{
    display:inline-block;
    color:#333
}
.w-file-upload-error{
    display:block;
    margin-top:10px
}
.w-file-upload-default.w-hidden,.w-file-upload-uploading.w-hidden,.w-file-upload-error.w-hidden,.w-file-upload-success.w-hidden{
    display:none
}
.w-file-upload-uploading-btn{
    display:flex;
    font-size:14px;
    font-weight:400;
    cursor:pointer;
    margin:0;
    padding:8px 12px;
    border:1px solid #ccc;
    background-color:#fafafa
}
.w-file-upload-file{
    display:flex;
    flex-grow:1;
    justify-content:space-between;
    margin:0;
    padding:8px 9px 8px 11px;
    border:1px solid #ccc;
    background-color:#fafafa
}
.w-file-upload-file-name{
    font-size:14px;
    font-weight:400;
    display:block
}
.w-file-remove-link{
    margin-top:3px;
    margin-left:10px;
    width:auto;
    height:auto;
    padding:3px;
    display:block;
    cursor:pointer
}
.w-icon-file-upload-remove{
    margin:auto;
    font-size:10px
}
.w-file-upload-error-msg{
    display:inline-block;
    color:#ea384c;
    padding:2px 0
}
.w-file-upload-info{
    display:inline-block;
    line-height:38px;
    padding:0 12px
}
.w-file-upload-label{
    display:inline-block;
    font-size:14px;
    font-weight:400;
    cursor:pointer;
    margin:0;
    padding:8px 12px;
    border:1px solid #ccc;
    background-color:#fafafa
}
.w-icon-file-upload-icon,.w-icon-file-upload-uploading{
    display:inline-block;
    margin-right:8px;
    width:20px
}
.w-icon-file-upload-uploading{
    height:20px
}
.w-container{
    margin-left:auto;
    margin-right:auto;
    max-width:940px
}
.w-container:before,.w-container:after{
    content:" ";
    display:table;
    grid-column-start:1;
    grid-row-start:1;
    grid-column-end:2;
    grid-row-end:2
}
.w-container:after{
    clear:both
}
.w-container .w-row{
    margin-left:-10px;
    margin-right:-10px
}
.w-row:before,.w-row:after{
    content:" ";
    display:table;
    grid-column-start:1;
    grid-row-start:1;
    grid-column-end:2;
    grid-row-end:2
}
.w-row:after{
    clear:both
}
.w-row .w-row{
    margin-left:0;
    margin-right:0
}
.w-col{
    position:relative;
    float:left;
    width:100%;
    min-height:1px;
    padding-left:10px;
    padding-right:10px
}
.w-col .w-col{
    padding-left:0;
    padding-right:0
}
.w-col-1{
    width:8.33333333%
}
.w-col-2{
    width:16.66666667%
}
.w-col-3{
    width:25%
}
.w-col-4{
    width:33.33333333%
}
.w-col-5{
    width:41.66666667%
}
.w-col-6{
    width:50%
}
.w-col-7{
    width:58.33333333%
}
.w-col-8{
    width:66.66666667%
}
.w-col-9{
    width:75%
}
.w-col-10{
    width:83.33333333%
}
.w-col-11{
    width:91.66666667%
}
.w-col-12{
    width:100%
}
.w-hidden-main{
    display:none!important
}
@media screen and (max-width:991px){
    .w-container{
        max-width:728px
    }
    .w-hidden-main{
        display:inherit!important
    }
    .w-hidden-medium{
        display:none!important
    }
    .w-col-medium-1{
        width:8.33333333%
    }
    .w-col-medium-2{
        width:16.66666667%
    }
    .w-col-medium-3{
        width:25%
    }
    .w-col-medium-4{
        width:33.33333333%
    }
    .w-col-medium-5{
        width:41.66666667%
    }
    .w-col-medium-6{
        width:50%
    }
    .w-col-medium-7{
        width:58.33333333%
    }
    .w-col-medium-8{
        width:66.66666667%
    }
    .w-col-medium-9{
        width:75%
    }
    .w-col-medium-10{
        width:83.33333333%
    }
    .w-col-medium-11{
        width:91.66666667%
    }
    .w-col-medium-12{
        width:100%
    }
    .w-col-stack{
        width:100%;
        left:auto;
        right:auto
    }
}
@media screen and (max-width:767px){
    .w-hidden-main{
        display:inherit!important
    }
    .w-hidden-medium{
        display:inherit!important
    }
    .w-hidden-small{
        display:none!important
    }
    .w-row,.w-container .w-row{
        margin-left:0;
        margin-right:0
    }
    .w-col{
        width:100%;
        left:auto;
        right:auto
    }
    .w-col-small-1{
        width:8.33333333%
    }
    .w-col-small-2{
        width:16.66666667%
    }
    .w-col-small-3{
        width:25%
    }
    .w-col-small-4{
        width:33.33333333%
    }
    .w-col-small-5{
        width:41.66666667%
    }
    .w-col-small-6{
        width:50%
    }
    .w-col-small-7{
        width:58.33333333%
    }
    .w-col-small-8{
        width:66.66666667%
    }
    .w-col-small-9{
        width:75%
    }
    .w-col-small-10{
        width:83.33333333%
    }
    .w-col-small-11{
        width:91.66666667%
    }
    .w-col-small-12{
        width:100%
    }
}
@media screen and (max-width:479px){
    .w-container{
        max-width:none
    }
    .w-hidden-main{
        display:inherit!important
    }
    .w-hidden-medium{
        display:inherit!important
    }
    .w-hidden-small{
        display:inherit!important
    }
    .w-hidden-tiny{
        display:none!important
    }
    .w-col{
        width:100%
    }
    .w-col-tiny-1{
        width:8.33333333%
    }
    .w-col-tiny-2{
        width:16.66666667%
    }
    .w-col-tiny-3{
        width:25%
    }
    .w-col-tiny-4{
        width:33.33333333%
    }
    .w-col-tiny-5{
        width:41.66666667%
    }
    .w-col-tiny-6{
        width:50%
    }
    .w-col-tiny-7{
        width:58.33333333%
    }
    .w-col-tiny-8{
        width:66.66666667%
    }
    .w-col-tiny-9{
        width:75%
    }
    .w-col-tiny-10{
        width:83.33333333%
    }
    .w-col-tiny-11{
        width:91.66666667%
    }
    .w-col-tiny-12{
        width:100%
    }
}
.w-widget{
    position:relative
}
.w-widget-map{
    width:100%;
    height:400px
}
.w-widget-map label{
    width:auto;
    display:inline
}
.w-widget-map img{
    max-width:inherit
}
.w-widget-map .gm-style-iw{
    text-align:center
}
.w-widget-map .gm-style-iw>button{
    display:none!important
}
.w-widget-twitter{
    overflow:hidden
}
.w-widget-twitter-count-shim{
    display:inline-block;
    vertical-align:top;
    position:relative;
    width:28px;
    height:20px;
    text-align:center;
    background:#fff;
    border:#758696 solid 1px;
    border-radius:3px
}
.w-widget-twitter-count-shim *{
    pointer-events:none;
    -webkit-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    user-select:none
}
.w-widget-twitter-count-shim .w-widget-twitter-count-inner{
    position:relative;
    font-size:15px;
    line-height:12px;
    text-align:center;
    color:#999;
    font-family:serif
}
.w-widget-twitter-count-shim .w-widget-twitter-count-clear{
    position:relative;
    display:block
}
.w-widget-twitter-count-shim.w--large{
    width:36px;
    height:28px
}
.w-widget-twitter-count-shim.w--large .w-widget-twitter-count-inner{
    font-size:18px;
    line-height:18px
}
.w-widget-twitter-count-shim:not(.w--vertical){
    margin-left:5px;
    margin-right:8px
}
.w-widget-twitter-count-shim:not(.w--vertical).w--large{
    margin-left:6px
}
.w-widget-twitter-count-shim:not(.w--vertical):before,.w-widget-twitter-count-shim:not(.w--vertical):after{
    top:50%;
    left:0;
    border:solid transparent;
    content:' ';
    height:0;
    width:0;
    position:absolute;
    pointer-events:none
}
.w-widget-twitter-count-shim:not(.w--vertical):before{
    border-color:transparent;
    border-right-color:#5d6c7b;
    border-width:4px;
    margin-left:-9px;
    margin-top:-4px
}
.w-widget-twitter-count-shim:not(.w--vertical).w--large:before{
    border-width:5px;
    margin-left:-10px;
    margin-top:-5px
}
.w-widget-twitter-count-shim:not(.w--vertical):after{
    border-color:transparent;
    border-right-color:#fff;
    border-width:4px;
    margin-left:-8px;
    margin-top:-4px
}
.w-widget-twitter-count-shim:not(.w--vertical).w--large:after{
    border-width:5px;
    margin-left:-9px;
    margin-top:-5px
}
.w-widget-twitter-count-shim.w--vertical{
    width:61px;
    height:33px;
    margin-bottom:8px
}
.w-widget-twitter-count-shim.w--vertical:before,.w-widget-twitter-count-shim.w--vertical:after{
    top:100%;
    left:50%;
    border:solid transparent;
    content:' ';
    height:0;
    width:0;
    position:absolute;
    pointer-events:none
}
.w-widget-twitter-count-shim.w--vertical:before{
    border-color:transparent;
    border-top-color:#5d6c7b;
    border-width:5px;
    margin-left:-5px
}
.w-widget-twitter-count-shim.w--vertical:after{
    border-color:transparent;
    border-top-color:#fff;
    border-width:4px;
    margin-left:-4px
}
.w-widget-twitter-count-shim.w--vertical .w-widget-twitter-count-inner{
    font-size:18px;
    line-height:22px
}
.w-widget-twitter-count-shim.w--vertical.w--large{
    width:76px
}
.w-background-video{
    position:relative;
    overflow:hidden;
    height:500px;
    color:#fff
}
.w-background-video>video{
    background-size:cover;
    background-position:50% 50%;
    position:absolute;
    margin:auto;
    width:100%;
    height:100%;
    right:-100%;
    bottom:-100%;
    top:-100%;
    left:-100%;
    object-fit:cover;
    z-index:-100
}
.w-background-video>video::-webkit-media-controls-start-playback-button{
    display:none!important;
    -webkit-appearance:none
}
.w-background-video--control{
    position:absolute;
    bottom:1em;
    right:1em;
    background-color:transparent;
    padding:0
}
.w-background-video--control>[hidden]{
    display:none!important
}
.w-slider{
    position:relative;
    height:300px;
    text-align:center;
    background:#ddd;
    clear:both;
    -webkit-tap-highlight-color:transparent;
    tap-highlight-color:transparent
}
.w-slider-mask{
    position:relative;
    display:block;
    overflow:hidden;
    z-index:1;
    left:0;
    right:0;
    height:100%;
    white-space:nowrap
}
.w-slide{
    position:relative;
    display:inline-block;
    vertical-align:top;
    width:100%;
    height:100%;
    white-space:normal;
    text-align:left
}
.w-slider-nav{
    position:absolute;
    z-index:2;
    top:auto;
    right:0;
    bottom:0;
    left:0;
    margin:auto;
    padding-top:10px;
    height:40px;
    text-align:center;
    -webkit-tap-highlight-color:transparent;
    tap-highlight-color:transparent
}
.w-slider-nav.w-round>div{
    border-radius:100%
}
.w-slider-nav.w-num>div{
    width:auto;
    height:auto;
    padding:.2em .5em;
    font-size:inherit;
    line-height:inherit
}
.w-slider-nav.w-shadow>div{
    box-shadow:0 0 3px rgba(51,51,51,.4)
}
.w-slider-nav-invert{
    color:#fff
}
.w-slider-nav-invert>div{
    background-color:rgba(34,34,34,.4)
}
.w-slider-nav-invert>div.w-active{
    background-color:#222
}
.w-slider-dot{
    position:relative;
    display:inline-block;
    width:1em;
    height:1em;
    background-color:rgba(255,255,255,.4);
    cursor:pointer;
    margin:0 3px .5em;
    transition:background-color 100ms,color 100ms
}
.w-slider-dot.w-active{
    background-color:#fff
}
.w-slider-dot:focus{
    outline:none;
    box-shadow:0 0 0 2px #fff
}
.w-slider-dot:focus.w-active{
    box-shadow:none
}
.w-slider-arrow-left,.w-slider-arrow-right{
    position:absolute;
    width:80px;
    top:0;
    right:0;
    bottom:0;
    left:0;
    margin:auto;
    cursor:pointer;
    overflow:hidden;
    color:#fff;
    font-size:40px;
    -webkit-tap-highlight-color:transparent;
    tap-highlight-color:transparent;
    -webkit-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    user-select:none
}
.w-slider-arrow-left [class^=w-icon-],.w-slider-arrow-right [class^=w-icon-],.w-slider-arrow-left [class*=' w-icon-'],.w-slider-arrow-right [class*=' w-icon-']{
    position:absolute
}
.w-slider-arrow-left:focus,.w-slider-arrow-right:focus{
    outline:0
}
.w-slider-arrow-left{
    z-index:3;
    right:auto
}
.w-slider-arrow-right{
    z-index:4;
    left:auto
}
.w-icon-slider-left,.w-icon-slider-right{
    top:0;
    right:0;
    bottom:0;
    left:0;
    margin:auto;
    width:1em;
    height:1em
}
.w-slider-aria-label{
    border:0;
    clip:rect(0 0 0 0);
    height:1px;
    margin:-1px;
    overflow:hidden;
    padding:0;
    position:absolute;
    width:1px
}
.w-slider-force-show{
    display:block!important
}
.w-dropdown{
    display:inline-block;
    position:relative;
    text-align:left;
    margin-left:auto;
    margin-right:auto;
    z-index:900
}
.w-dropdown-btn,.w-dropdown-toggle,.w-dropdown-link{
    position:relative;
    vertical-align:top;
    text-decoration:none;
    color:#222;
    padding:20px;
    text-align:left;
    margin-left:auto;
    margin-right:auto;
    white-space:nowrap
}
.w-dropdown-toggle{
    -webkit-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    user-select:none;
    display:inline-block;
    cursor:pointer;
    padding-right:40px
}
.w-dropdown-toggle:focus{
    outline:0
}
.w-icon-dropdown-toggle{
    position:absolute;
    top:0;
    right:0;
    bottom:0;
    margin:auto;
    margin-right:20px;
    width:1em;
    height:1em
}
.w-dropdown-list{
    position:absolute;
    background:#ddd;
    display:none;
    min-width:100%
}
.w-dropdown-list.w--open{
    display:block
}
.w-dropdown-link{
    padding:10px 20px;
    display:block;
    color:#222
}
.w-dropdown-link.w--current{
    color:#0082f3
}
.w-dropdown-link:focus{
    outline:0
}
@media screen and (max-width:767px){
    .w-nav-brand{
        padding-left:10px
    }
}
.w-lightbox-backdrop{
    color:#000;
    cursor:auto;
    font-family:serif;
    font-size:medium;
    font-style:normal;
    font-variant:normal;
    font-weight:400;
    letter-spacing:normal;
    line-height:normal;
    list-style:disc;
    text-align:start;
    text-indent:0;
    text-shadow:none;
    text-transform:none;
    visibility:visible;
    white-space:normal;
    word-break:normal;
    word-spacing:normal;
    word-wrap:normal;
    position:fixed;
    top:0;
    right:0;
    bottom:0;
    left:0;
    color:#fff;
    font-family:helvetica neue,Helvetica,Ubuntu,segoe ui,Verdana,sans-serif;
    font-size:17px;
    line-height:1.2;
    font-weight:300;
    text-align:center;
    background:rgba(0,0,0,.9);
    z-index:2000;
    outline:0;
    opacity:0;
    -webkit-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    -webkit-tap-highlight-color:transparent;
    -webkit-transform:translate(0,0)
}
.w-lightbox-backdrop,.w-lightbox-container{
    height:100%;
    overflow:auto;
    -webkit-overflow-scrolling:touch
}
.w-lightbox-content{
    position:relative;
    height:100vh;
    overflow:hidden
}
.w-lightbox-view{
    position:absolute;
    width:100vw;
    height:100vh;
    opacity:0
}
.w-lightbox-view:before{
    content:"";
    height:100vh
}
.w-lightbox-group,.w-lightbox-group .w-lightbox-view,.w-lightbox-group .w-lightbox-view:before{
    height:86vh
}
.w-lightbox-frame,.w-lightbox-view:before{
    display:inline-block;
    vertical-align:middle
}
.w-lightbox-figure{
    position:relative;
    margin:0
}
.w-lightbox-group .w-lightbox-figure{
    cursor:pointer
}
.w-lightbox-img{
    width:auto;
    height:auto;
    max-width:none
}
.w-lightbox-image{
    display:block;
    float:none;
    max-width:100vw;
    max-height:100vh
}
.w-lightbox-group .w-lightbox-image{
    max-height:86vh
}
.w-lightbox-caption{
    position:absolute;
    right:0;
    bottom:0;
    left:0;
    padding:.5em 1em;
    background:rgba(0,0,0,.4);
    text-align:left;
    text-overflow:ellipsis;
    white-space:nowrap;
    overflow:hidden
}
.w-lightbox-embed{
    position:absolute;
    top:0;
    right:0;
    bottom:0;
    left:0;
    width:100%;
    height:100%
}
.w-lightbox-control{
    position:absolute;
    top:0;
    width:4em;
    background-size:24px;
    background-repeat:no-repeat;
    background-position:center;
    cursor:pointer;
    -webkit-transition:all .3s;
    transition:all .3s
}
.w-lightbox-left{
    display:none;
    bottom:0;
    left:0;
    background-image:url(data:image/svg+xml;
    base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9Ii0yMCAwIDI0IDQwIiB3aWR0aD0iMjQiIGhlaWdodD0iNDAiPjxnIHRyYW5zZm9ybT0icm90YXRlKDQ1KSI+PHBhdGggZD0ibTAgMGg1djIzaDIzdjVoLTI4eiIgb3BhY2l0eT0iLjQiLz48cGF0aCBkPSJtMSAxaDN2MjNoMjN2M2gtMjZ6IiBmaWxsPSIjZmZmIi8+PC9nPjwvc3ZnPg==)
}
.w-lightbox-right{
    display:none;
    right:0;
    bottom:0;
    background-image:url(data:image/svg+xml;
    base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9Ii00IDAgMjQgNDAiIHdpZHRoPSIyNCIgaGVpZ2h0PSI0MCI+PGcgdHJhbnNmb3JtPSJyb3RhdGUoNDUpIj48cGF0aCBkPSJtMC0waDI4djI4aC01di0yM2gtMjN6IiBvcGFjaXR5PSIuNCIvPjxwYXRoIGQ9Im0xIDFoMjZ2MjZoLTN2LTIzaC0yM3oiIGZpbGw9IiNmZmYiLz48L2c+PC9zdmc+)
}
.w-lightbox-close{
    right:0;
    height:2.6em;
    background-image:url(data:image/svg+xml;
    base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9Ii00IDAgMTggMTciIHdpZHRoPSIxOCIgaGVpZ2h0PSIxNyI+PGcgdHJhbnNmb3JtPSJyb3RhdGUoNDUpIj48cGF0aCBkPSJtMCAwaDd2LTdoNXY3aDd2NWgtN3Y3aC01di03aC03eiIgb3BhY2l0eT0iLjQiLz48cGF0aCBkPSJtMSAxaDd2LTdoM3Y3aDd2M2gtN3Y3aC0zdi03aC03eiIgZmlsbD0iI2ZmZiIvPjwvZz48L3N2Zz4=);
    background-size:18px
}
.w-lightbox-strip{
    position:absolute;
    bottom:0;
    left:0;
    right:0;
    padding:0 1vh;
    line-height:0;
    white-space:nowrap;
    overflow-x:auto;
    overflow-y:hidden
}
.w-lightbox-item{
    display:inline-block;
    width:10vh;
    padding:2vh 1vh;
    box-sizing:content-box;
    cursor:pointer;
    -webkit-transform:translate3d(0,0,0)
}
.w-lightbox-active{
    opacity:.3
}
.w-lightbox-thumbnail{
    position:relative;
    height:10vh;
    background:#222;
    overflow:hidden
}
.w-lightbox-thumbnail-image{
    position:absolute;
    top:0;
    left:0
}
.w-lightbox-thumbnail .w-lightbox-tall{
    top:50%;
    width:100%;
    -webkit-transform:translate(0,-50%);
    -ms-transform:translate(0,-50%);
    transform:translate(0,-50%)
}
.w-lightbox-thumbnail .w-lightbox-wide{
    left:50%;
    height:100%;
    -webkit-transform:translate(-50%,0);
    -ms-transform:translate(-50%,0);
    transform:translate(-50%,0)
}
.w-lightbox-spinner{
    position:absolute;
    top:50%;
    left:50%;
    box-sizing:border-box;
    width:40px;
    height:40px;
    margin-top:-20px;
    margin-left:-20px;
    border:5px solid rgba(0,0,0,.4);
    border-radius:50%;
    -webkit-animation:spin .8s infinite linear;
    animation:spin .8s infinite linear
}
.w-lightbox-spinner:after{
    content:"";
    position:absolute;
    top:-4px;
    right:-4px;
    bottom:-4px;
    left:-4px;
    border:3px solid transparent;
    border-bottom-color:#fff;
    border-radius:50%
}
.w-lightbox-hide{
    display:none
}
.w-lightbox-noscroll{
    overflow:hidden
}
@media(min-width:768px){
    .w-lightbox-content{
        height:96vh;
        margin-top:2vh
    }
    .w-lightbox-view,.w-lightbox-view:before{
        height:96vh
    }
    .w-lightbox-group,.w-lightbox-group .w-lightbox-view,.w-lightbox-group .w-lightbox-view:before{
        height:84vh
    }
    .w-lightbox-image{
        max-width:96vw;
        max-height:96vh
    }
    .w-lightbox-group .w-lightbox-image{
        max-width:82.3vw;
        max-height:84vh
    }
    .w-lightbox-left,.w-lightbox-right{
        display:block;
        opacity:.5
    }
    .w-lightbox-close{
        opacity:.8
    }
    .w-lightbox-control:hover{
        opacity:1
    }
}
.w-lightbox-inactive,.w-lightbox-inactive:hover{
    opacity:0
}
.w-richtext:before,.w-richtext:after{
    content:" ";
    display:table;
    grid-column-start:1;
    grid-row-start:1;
    grid-column-end:2;
    grid-row-end:2
}
.w-richtext:after{
    clear:both
}
.w-richtext[contenteditable=true]:before,.w-richtext[contenteditable=true]:after{
    white-space:initial
}
.w-richtext ol,.w-richtext ul{
    overflow:hidden
}
.w-richtext .w-richtext-figure-selected.w-richtext-figure-type-video div:after,.w-richtext .w-richtext-figure-selected[data-rt-type=video] div:after{
    outline:2px solid #2895f7
}
.w-richtext .w-richtext-figure-selected.w-richtext-figure-type-image div,.w-richtext .w-richtext-figure-selected[data-rt-type=image] div{
    outline:2px solid #2895f7
}
.w-richtext figure.w-richtext-figure-type-video>div:after,.w-richtext figure[data-rt-type=video]>div:after{
    content:'';
    position:absolute;
    display:none;
    left:0;
    top:0;
    right:0;
    bottom:0
}
.w-richtext figure{
    position:relative;
    max-width:60%
}
.w-richtext figure>div:before{
    cursor:default!important
}
.w-richtext figure img{
    width:100%
}
.w-richtext figure figcaption.w-richtext-figcaption-placeholder{
    opacity:.6
}
.w-richtext figure div{
    font-size:0;
    color:transparent
}
.w-richtext figure.w-richtext-figure-type-image,.w-richtext figure[data-rt-type=image]{
    display:table
}
.w-richtext figure.w-richtext-figure-type-image>div,.w-richtext figure[data-rt-type=image]>div{
    display:inline-block
}
.w-richtext figure.w-richtext-figure-type-image>figcaption,.w-richtext figure[data-rt-type=image]>figcaption{
    display:table-caption;
    caption-side:bottom
}
.w-richtext figure.w-richtext-figure-type-video,.w-richtext figure[data-rt-type=video]{
    width:60%;
    height:0
}
.w-richtext figure.w-richtext-figure-type-video iframe,.w-richtext figure[data-rt-type=video] iframe{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%
}
.w-richtext figure.w-richtext-figure-type-video>div,.w-richtext figure[data-rt-type=video]>div{
    width:100%
}
.w-richtext figure.w-richtext-align-center{
    margin-right:auto;
    margin-left:auto;
    clear:both
}
.w-richtext figure.w-richtext-align-center.w-richtext-figure-type-image>div,.w-richtext figure.w-richtext-align-center[data-rt-type=image]>div{
    max-width:100%
}
.w-richtext figure.w-richtext-align-normal{
    clear:both
}
.w-richtext figure.w-richtext-align-fullwidth{
    width:100%;
    max-width:100%;
    text-align:center;
    clear:both;
    display:block;
    margin-right:auto;
    margin-left:auto
}
.w-richtext figure.w-richtext-align-fullwidth>div{
    display:inline-block;
    padding-bottom:inherit
}
.w-richtext figure.w-richtext-align-fullwidth>figcaption{
    display:block
}
.w-richtext figure.w-richtext-align-floatleft{
    float:left;
    margin-right:15px;
    clear:none
}
.w-richtext figure.w-richtext-align-floatright{
    float:right;
    margin-left:15px;
    clear:none
}
.w-nav{
    position:relative;
    background:#ddd;
    z-index:1000
}
.w-nav:before,.w-nav:after{
    content:" ";
    display:table;
    grid-column-start:1;
    grid-row-start:1;
    grid-column-end:2;
    grid-row-end:2
}
.w-nav:after{
    clear:both
}
.w-nav-brand{
    position:relative;
    float:left;
    text-decoration:none;
    color:#333
}
.w-nav-link{
    position:relative;
    display:inline-block;
    vertical-align:top;
    text-decoration:none;
    color:#222;
    padding:20px;
    text-align:left;
    margin-left:auto;
    margin-right:auto
}
.w-nav-link.w--current{
    color:#0082f3
}
.w-nav-menu{
    position:relative;
    float:right
}
[data-nav-menu-open]{
    display:block!important;
    position:absolute;
    top:100%;
    left:0;
    right:0;
    background:#c8c8c8;
    text-align:center;
    overflow:visible;
    min-width:200px
}
.w--nav-link-open{
    display:block;
    position:relative
}
.w-nav-overlay{
    position:absolute;
    overflow:hidden;
    display:none;
    top:100%;
    left:0;
    right:0;
    width:100%
}
.w-nav-overlay [data-nav-menu-open]{
    top:0
}
.w-nav[data-animation=over-left] .w-nav-overlay{
    width:auto
}
.w-nav[data-animation=over-left] .w-nav-overlay,.w-nav[data-animation=over-left] [data-nav-menu-open]{
    right:auto;
    z-index:1;
    top:0
}
.w-nav[data-animation=over-right] .w-nav-overlay{
    width:auto
}
.w-nav[data-animation=over-right] .w-nav-overlay,.w-nav[data-animation=over-right] [data-nav-menu-open]{
    left:auto;
    z-index:1;
    top:0
}
.w-nav-button{
    position:relative;
    float:right;
    padding:18px;
    font-size:24px;
    display:none;
    cursor:pointer;
    -webkit-tap-highlight-color:transparent;
    tap-highlight-color:transparent;
    -webkit-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    user-select:none
}
.w-nav-button:focus{
    outline:0
}
.w-nav-button.w--open{
    background-color:#c8c8c8;
    color:#fff
}
.w-nav-dep{
    position:relative;
    float:right;
    padding:18px;
    font-size:24px;
    display:none;
    cursor:pointer;
    -webkit-tap-highlight-color:transparent;
    tap-highlight-color:transparent;
    -webkit-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    user-select:none
}
.w-nav-dep:focus{
    outline:0
}
.w-nav-dep.w--open{
    background-color:#c8c8c8;
    color:#fff
}
.w-nav[data-collapse=all] .w-nav-menu{
    display:none
}
.w-nav[data-collapse=all] .w-nav-dep{
    display:block
}
.w-nav[data-collapse=all] .w-nav-button{
    display:block
}
.w--nav-dropdown-open{
    display:block
}
.w--nav-dropdown-toggle-open{
    display:block
}
.w--nav-dropdown-list-open{
    position:static
}
@media screen and (max-width:991px){
    .w-nav[data-collapse=medium] .w-nav-menu{
        display:none
    }
    .w-nav[data-collapse=medium] .w-nav-button{
        display:block
    }
    .w-nav[data-collapse=medium] .w-nav-dep{
        display:block
    }
}
@media screen and (max-width:767px){
    .w-nav[data-collapse=small] .w-nav-menu{
        display:none
    }
    .w-nav[data-collapse=small] .w-nav-button{
        display:block
    }
    .w-nav[data-collapse=small] .w-nav-dep{
        display:block
    }
    .w-nav-brand{
        padding-left:10px
    }
}
@media screen and (max-width:479px){
    .w-nav[data-collapse=tiny] .w-nav-menu{
        display:none
    }
    .w-nav[data-collapse=tiny] .w-nav-button{
        display:block
    }
    .w-nav[data-collapse=tiny] .w-nav-dep{
        display:block
    }
}
.w-tabs{
    position:relative
}
.w-tabs:before,.w-tabs:after{
    content:" ";
    display:table;
    grid-column-start:1;
    grid-row-start:1;
    grid-column-end:2;
    grid-row-end:2
}
.w-tabs:after{
    clear:both
}
.w-tab-menu{
    position:relative
}
.w-tab-link{
    position:relative;
    display:inline-block;
    vertical-align:top;
    text-decoration:none;
    padding:9px 30px;
    text-align:left;
    cursor:pointer;
    color:#222;
    background-color:#ddd
}
.w-tab-link.w--current{
    background-color:#c8c8c8
}
.w-tab-link:focus{
    outline:0
}
.w-tab-content{
    position:relative;
    display:block;
    overflow:hidden
}
.w-tab-pane{
    position:relative;
    display:none
}
.w--tab-active{
    display:block
}
@media screen and (max-width:479px){
    .w-tab-link{
        display:block
    }
}
.w-ix-emptyfix:after{
    content:""
}
@keyframes spin{
    0%{
        transform:rotate(0deg)
    }
    100%{
        transform:rotate(360deg)
    }
}
.w-dyn-empty{
    padding:10px;
    background-color:#ddd
}
.w-dyn-hide{
    display:none!important
}
.w-dyn-bind-empty{
    display:none!important
}
.w-condition-invisible{
    display:none!important
}
.wf-layout-layout{
    display:grid!important
}
.wf-layout-cell{
    display:flex!important
}
.w-layout-grid{
    display:-ms-grid;
    display:grid;
    grid-auto-columns:1fr;
    -ms-grid-columns:1fr 1fr;
    grid-template-columns:1fr 1fr;
    -ms-grid-rows:auto auto;
    grid-template-rows:auto auto;
    grid-row-gap:16px;
    grid-column-gap:16px
}
body{
    font-family:space mono,sans-serif;
    color:#1f2024;
    font-size:16px;
    line-height:1.5em
}
h1{
    margin-top:20px;
    margin-bottom:10px;
    font-family:right grotesk,sans-serif;
    font-size:38px;
    line-height:1.1em;
    font-weight:700
}
h2{
    margin-top:0;
    margin-bottom:8px;
    font-family:right grotesk,sans-serif;
    font-size:3em;
    line-height:1.2em;
    font-weight:700;
    letter-spacing:.04em;
    text-transform:uppercase
}
h3{
    margin-top:48px;
    margin-bottom:10px;
    font-family:right grotesk,sans-serif;
    font-size:1.7em;
    line-height:30px;
    font-weight:700;
    text-transform:uppercase
}
p{
    margin-bottom:10px;
    line-height:1.8em
}
a{
    color:#1f2024;
    font-weight:700;
    text-decoration:none
}
li{
    padding-bottom:8px
}
.hero-letters{
    position:relative;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex
}
.hero-section{
    position:relative;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    overflow:hidden;
    height:100vh;
    -webkit-box-orient:vertical;
    -webkit-box-direction:normal;
    -webkit-flex-direction:column;
    -ms-flex-direction:column;
    flex-direction:column;
    -webkit-box-pack:center;
    -webkit-justify-content:center;
    -ms-flex-pack:center;
    justify-content:center;
    -webkit-box-align:center;
    -webkit-align-items:center;
    -ms-flex-align:center;
    align-items:center;
    background: url(https://daanrox.github.io/subway-pay/assets/img/home/background.jpeg);
    color:#fff;
    text-align:center
}
.hero-section.dark{
    height:auto;
    min-height:100vh;
    padding:130px 24px;
    background: url(https://daanrox.github.io/subway-pay/assets/img/home/background.jpeg);
    color:#000
}
.hero-heading{
    position:relative;
    z-index:1;
    margin-top:0;
    margin-bottom:0;
    font-size:10vw;
    text-shadow:-17px 17px 0 #1f2024;
    cursor:crosshair
}
.hero-heading:hover{
    color:#eedf39
}
.hero-heading._2{
    z-index:2
}
.hero-heading._2:hover{
    color:#5879ff
}
.hero-heading._3{
    z-index:3
}
.hero-heading._3:hover{
    color:#ff2cb2
}
.primary-button{
    padding:16px 40px;
    border-style:solid;
    border-width:4px;
    border-color:#1f2024;
    border-radius:8px;
    background-color:#1fbffe;
    box-shadow:-3px 3px 0 0 #1f2024;
    -webkit-transition:background-color 200ms ease,box-shadow 200ms ease,-webkit-transform 200ms ease;
    transition:background-color 200ms ease,box-shadow 200ms ease,-webkit-transform 200ms ease;
    transition:background-color 200ms ease,transform 200ms ease,box-shadow 200ms ease;
    transition:background-color 200ms ease,transform 200ms ease,box-shadow 200ms ease,-webkit-transform 200ms ease;
    font-family:right grotesk,sans-serif;
    color:#fff;
    font-size:1.25em;
    text-align:center;
    letter-spacing:.12em
}
.primary-button:hover{
    background-color:#e42c7f;
    box-shadow:-6px 6px 0 0 #1f2024;
    -webkit-transform:translate(4px,-4px);
    -ms-transform:translate(4px,-4px);
    transform:translate(4px,-4px)
}
.primary-button.hero{
    z-index:1000;
    margin-top:16px;
    margin-bottom:24px;
    padding:20px 40px;
    -webkit-align-self:center;
    -ms-flex-item-align:center;
    -ms-grid-row-align:center;
    align-self:center;
    border-width:8px;
    border-radius:12px;
    background-color:#ace5d7;
    box-shadow:-6px 6px 0 0 #1f2024;
    -webkit-transition:color 200ms ease,background-color 200ms ease,box-shadow 200ms ease,-webkit-transform 200ms ease;
    transition:color 200ms ease,background-color 200ms ease,box-shadow 200ms ease,-webkit-transform 200ms ease;
    transition:color 200ms ease,background-color 200ms ease,transform 200ms ease,box-shadow 200ms ease;
    transition:color 200ms ease,background-color 200ms ease,transform 200ms ease,box-shadow 200ms ease,-webkit-transform 200ms ease;
    color:#1f2024;
    font-size:1.5em
}
.primary-button.hero:hover{
    position:relative;
    z-index:4;
    background-color:#ff00a1;
    box-shadow:-11px 11px 0 0 #1f2024;
    color:#fff
}
.primary-button.hero:active{
    box-shadow:-6px 6px 0 0 #1f2024;
    -webkit-transform:translate(0px,0px);
    -ms-transform:translate(0px,0px);
    transform:translate(0px,0px)
}
.primary-button.footer{
    padding:20px 32px;
    -webkit-align-self:center;
    -ms-flex-item-align:center;
    -ms-grid-row-align:center;
    align-self:center;
    border-width:4px;
    border-color:#461a97;
    background-color:#672fcf;
    box-shadow:-6px 6px 0 0 #461a97;
    font-size:1.5em
}
.primary-button.footer:hover{
    background-color:#ff0d11
}
.primary-button.dark{
    background-color:#2377d4
}
.nav-bar{
    position:fixed;
    left:0%;
    top:12px;
    right:0%;
    bottom:auto;
    z-index:9999;
    display:none;
    max-width:580px;
    margin-right:auto;
    margin-left:auto;
    padding-right:16px;
    padding-left:12px;
    -webkit-justify-content:space-around;
    -ms-flex-pack:distribute;
    justify-content:space-around;
    -webkit-box-align:center;
    -webkit-align-items:center;
    -ms-flex-align:center;
    align-items:center;
    border-radius:16px;
    background-color:#1f2024
}
.nav-bar.license{
    max-width:420px
}
.nav-bar.your-stuff{
    max-width:520px
}
.link-block{
    padding:20px 16px;
    color:#fff;
    text-decoration:none
}
.link-block:hover{
    color:#74dcf9
}
.link-block.w--current{
    color:#c6dd42
}
.link-block.last{
    padding-right:24px
}
.button{
    border-radius:8px;
    background-color:#39c0ff;
    -webkit-transition:background-color 200ms ease;
    transition:background-color 200ms ease
}
.button:hover{
    background-color:#5100ff
}
.button.nav{
    margin-left:8px
}
.mint-section{
    position:relative;
    padding:120px 24px 180px;
    background-color:#74dcf9;
    background-image:url(https://assets.website-files.com/61702f71b7840a016f189c88/61702f71b7840ac73f189cd9_pattern-bg.png);
    background-position:50% 50%;
    background-size:auto
}
.price{
    margin-top:24px;
    padding:12px 16px;
    border-radius:6px;
    background-color:#f3f2ed;
    color:rgba(31,32,36,.8);
    font-size:.9em;
    line-height:1.5em;
    letter-spacing:1px
}
.minting-container{
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    max-width:1200px;
    padding:58px 58px 32px;
    -webkit-box-orient:vertical;
    -webkit-box-direction:normal;
    -webkit-flex-direction:column;
    -ms-flex-direction:column;
    flex-direction:column;
    -webkit-box-align:center;
    -webkit-align-items:center;
    -ms-flex-align:center;
    align-items:center;
    border-style:solid;
    border-width:8px;
    border-color:#1f2024;
    border-radius:24px;
    background-color:#fff;
    box-shadow:-3px 3px 0 0 #1f2024;
    text-align:center
}
.minting-container.left{
    text-align:left
}
.image{
    position:absolute;
    left:-20px;
    top:auto;
    right:auto;
    bottom:-20px;
    z-index:1;
    width:14vw;
    max-width:300px;
    min-width:160px;
    -webkit-transform:rotate(-23deg);
    -ms-transform:rotate(-23deg);
    transform:rotate(-23deg)
}
.image.bl1{
    left:10vw;
    bottom:21%;
    -webkit-transform:rotate(20deg);
    -ms-transform:rotate(20deg);
    transform:rotate(20deg)
}
.image.cl2{
    left:18%;
    top:23%;
    bottom:auto;
    width:16vw;
    -webkit-transform:rotate(-18deg);
    -ms-transform:rotate(-18deg);
    transform:rotate(-18deg)
}
.image.cl1{
    left:-1%;
    top:20%;
    bottom:auto;
    z-index:0;
    -webkit-transform:rotate(20deg);
    -ms-transform:rotate(20deg);
    transform:rotate(20deg)
}
.image.tl{
    left:12%;
    top:-3%;
    bottom:auto;
    z-index:0;
    width:12vw;
    -webkit-transform:rotate(8deg);
    -ms-transform:rotate(8deg);
    transform:rotate(8deg)
}
.image.bc{
    left:auto;
    -webkit-transform:rotate(-11deg);
    -ms-transform:rotate(-11deg);
    transform:rotate(-11deg)
}
.image.br{
    left:auto;
    right:0;
    -webkit-transform:rotate(14deg);
    -ms-transform:rotate(14deg);
    transform:rotate(14deg)
}
.image.br1{
    left:auto;
    right:10vw;
    bottom:25%;
    -webkit-transform:scale(.8) rotate(-14deg);
    -ms-transform:scale(.8) rotate(-14deg);
    transform:scale(.8) rotate(-14deg)
}
.image.cr2{
    left:auto;
    top:23%;
    right:24%;
    bottom:auto;
    z-index:2;
    -webkit-transform:rotate(10deg);
    -ms-transform:rotate(10deg);
    transform:rotate(10deg)
}
.image.tr{
    left:auto;
    top:-2%;
    right:12%;
    bottom:auto;
    z-index:0;
    width:12vw;
    -webkit-transform:rotate(8deg);
    -ms-transform:rotate(8deg);
    transform:rotate(8deg)
}
.image.cr1{
    left:auto;
    top:18%;
    right:-1%;
    bottom:auto;
    z-index:6;
    -webkit-transform:rotate(20deg);
    -ms-transform:rotate(20deg);
    transform:rotate(20deg)
}
.hero-container{
    position:relative;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    width:100%;
    height:100%;
    padding-right:16px;
    padding-left:16px;
    -webkit-box-orient:vertical;
    -webkit-box-direction:normal;
    -webkit-flex-direction:column;
    -ms-flex-direction:column;
    flex-direction:column;
    -webkit-box-pack:center;
    -webkit-justify-content:center;
    -ms-flex-pack:center;
    justify-content:center;
    -webkit-box-align:center;
    -webkit-align-items:center;
    -ms-flex-align:center;
    align-items:center
}
.intermission{
    position:relative;
    margin-bottom:-100px;
    background-color:#1f2024
}
.center-image-block{
    position:relative;
    top:-100px
}
.center-image-block._2{
    top:-100px;
    margin-top:-100px
}
.image-3{
    margin-bottom:-100px
}
.rarity-section{
    position:relative;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    padding:120px 24px;
    -webkit-box-orient:vertical;
    -webkit-box-direction:normal;
    -webkit-flex-direction:column;
    -ms-flex-direction:column;
    flex-direction:column;
    -webkit-box-pack:center;
    -webkit-justify-content:center;
    -ms-flex-pack:center;
    justify-content:center;
    -webkit-box-align:center;
    -webkit-align-items:center;
    -ms-flex-align:center;
    align-items:center;
    border-style:solid;
    border-width:16px;
    border-color:#1f2024;
    background-color:#2377d3
}
.rarity-section.white{
    background-color:#fff
}
.rarity-chart{
    position:relative;
    display:-ms-grid;
    display:grid;
    width:100%;
    max-width:740px;
    padding:32px;
    grid-auto-columns:1fr;
    grid-column-gap:24px;
    grid-row-gap:0;
    -ms-grid-columns:1fr 1fr;
    grid-template-columns:1fr 1fr;
    -ms-grid-rows:auto auto;
    grid-template-rows:auto auto;
    border-style:solid;
    border-width:8px;
    border-color:#1f2024;
    border-radius:24px;
    background-color:#fff;
    box-shadow:-11px 11px 0 -4px #1f2024
}
.rarity-row{
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    margin-top:8px;
    margin-bottom:8px;
    padding:8px;
    -webkit-box-align:center;
    -webkit-align-items:center;
    -ms-flex-align:center;
    align-items:center;
    border-radius:4px
}
.rarity-row.blue{
    background-color:#cae9fa
}
.rarity-row.roboto-type{
    display:-ms-grid;
    display:grid;
    grid-auto-columns:1fr;
    grid-column-gap:24px;
    grid-row-gap:0;
    -ms-grid-columns:1fr 1fr;
    grid-template-columns:1fr 1fr;
    -ms-grid-rows:auto;
    grid-template-rows:auto;
    border-style:dashed;
    border-width:3px;
    border-color:#cae9fa;
    background-color:rgba(202,233,250,.5)
}
.rarity-row.roboto-type2{
    display:-ms-grid;
    display:grid;
    grid-auto-columns:1fr;
    grid-column-gap:24px;
    grid-row-gap:0;
    -ms-grid-columns:1fr 1fr;
    -ms-grid-rows:auto;
    grid-template-rows:auto;
    border-style:dashed;
    border-width:3px;
    border-color:#cae9fa;
    background-color:rgba(202,233,250,.5)
}
.rarity-number{
    width:50%;
    font-weight:700
}
.rarity-heading{
    font-size:1em
}
.faq-section{
    position:relative;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    overflow:hidden;
    padding:200px 24px;
    -webkit-box-orient:vertical;
    -webkit-box-direction:normal;
    -webkit-flex-direction:column;
    -ms-flex-direction:column;
    flex-direction:column;
    -webkit-box-align:center;
    -webkit-align-items:center;
    -ms-flex-align:center;
    align-items:center;
    background-color:#cae9fa
}
.question{
    padding-top:48px;
    padding-bottom:48px
}
.question.last{
    padding-bottom:0
}
.question.first{
    padding-top:64px
}
.faq-container{
    max-width:720px
}
.footer-section{
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    padding:80px 16px;
    -webkit-box-orient:vertical;
    -webkit-box-direction:normal;
    -webkit-flex-direction:column;
    -ms-flex-direction:column;
    flex-direction:column;
    -webkit-box-pack:center;
    -webkit-justify-content:center;
    -ms-flex-pack:center;
    justify-content:center;
    -webkit-box-align:center;
    -webkit-align-items:center;
    -ms-flex-align:center;
    align-items:center;
    background-color:#1f2024;
    color:#fff;
    text-align:center
}
.domo-text{
    font-family:right grotesk,sans-serif;
    font-size:16vw;
    line-height:.8em
}
.domo-text:hover{
    color:#74dcf9
}
.domo-text.purple{
    padding-bottom:32px
}
.domo-text.purple:hover{
    color:#a774f9
}
.follow-test{
    padding:16px
}
.bold-white-link{
    color:#fff
}
.bold-white-link:hover{
    color:#74dcf9
}
.faq-left{
    position:absolute;
    left:0%;
    top:0%;
    right:auto;
    bottom:0%;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    -webkit-box-orient:vertical;
    -webkit-box-direction:normal;
    -webkit-flex-direction:column;
    -ms-flex-direction:column;
    flex-direction:column;
    -webkit-justify-content:space-around;
    -ms-flex-pack:distribute;
    justify-content:space-around
}
.faq-img{
    max-width:160px;
    -webkit-transform:rotate(-10deg);
    -ms-transform:rotate(-10deg);
    transform:rotate(-10deg)
}
.faq-img._1{
    -webkit-transform:translate(32px,0px) rotate(10deg);
    -ms-transform:translate(32px,0px) rotate(10deg);
    transform:translate(32px,0px) rotate(10deg)
}
.faq-img._2{
    -webkit-transform:translate(-32px,0px) rotate(-10deg) rotate(20deg);
    -ms-transform:translate(-32px,0px) rotate(-10deg) rotate(20deg);
    transform:translate(-32px,0px) rotate(-10deg) rotate(20deg)
}
.faq-img._3{
    -webkit-transform:translate(0px,0px) rotate(-5deg);
    -ms-transform:translate(0px,0px) rotate(-5deg);
    transform:translate(0px,0px) rotate(-5deg)
}
.faq-right{
    position:absolute;
    left:auto;
    top:0%;
    right:0%;
    bottom:0%;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    -webkit-box-orient:vertical;
    -webkit-box-direction:normal;
    -webkit-flex-direction:column;
    -ms-flex-direction:column;
    flex-direction:column;
    -webkit-justify-content:space-around;
    -ms-flex-pack:distribute;
    justify-content:space-around
}
.faq-bottom{
    position:absolute;
    left:auto;
    top:auto;
    right:auto;
    bottom:-24px;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    width:68%;
    -webkit-justify-content:space-around;
    -ms-flex-pack:distribute;
    justify-content:space-around
}
.faq-top{
    position:absolute;
    left:auto;
    top:-24px;
    right:auto;
    bottom:auto;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    width:68%;
    -webkit-justify-content:space-around;
    -ms-flex-pack:distribute;
    justify-content:space-around
}
.rarity-image{
    padding:16px
}
.div-block{
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    -webkit-box-orient:vertical;
    -webkit-box-direction:normal;
    -webkit-flex-direction:column;
    -ms-flex-direction:column;
    flex-direction:column;
    -webkit-box-align:stretch;
    -webkit-align-items:stretch;
    -ms-flex-align:stretch;
    align-items:stretch
}
.mint-card-image{
    width:200px;
    margin:-120px auto 16px;
    border:5px solid #000;
    border-radius:100%
}
.mint-card-image.v2{
    width:auto;
    margin-top:0
}
.mint-card-image.no-height{
    margin-top:0
}
.paragraph{
    width:710px;
    max-width:100%;
    margin-bottom:24px
}
.hero-price{
    position:relative;
    z-index:999;
    padding:8px 12px;
    border-radius:8px;
    background-color:#ec0f18
}
.your-roboto-name{
    margin-top:16px;
    margin-bottom:0;
    font-size:1.5em
}
.your-roboto-card{
    overflow:hidden;
    margin-top:8px;
    margin-bottom:8px;
    padding:12px 12px 16px;
    border-style:solid;
    border-width:4px;
    border-color:#1f2024;
    border-radius:20px
}
.your-roboto-card:hover{
    box-shadow:-6px 6px 0 0 #1f2024;
    -webkit-transform:translate(4px,-4px);
    -ms-transform:translate(4px,-4px);
    transform:translate(4px,-4px)
}
.your-roboto-image{
    padding:12px;
    border-style:solid;
    border-width:2px;
    border-color:#c9c9c9;
    border-radius:12px
}
.yourstuff-container{
    display:-ms-grid;
    display:grid;
    max-width:1200px;
    padding:58px 58px 32px;
    -webkit-box-orient:vertical;
    -webkit-box-direction:normal;
    -webkit-flex-direction:column;
    -ms-flex-direction:column;
    flex-direction:column;
    -webkit-box-align:start;
    -webkit-align-items:start;
    -ms-flex-align:start;
    align-items:start;
    grid-auto-columns:1fr;
    grid-column-gap:16px;
    grid-row-gap:16px;
    -ms-grid-columns:1fr 1fr;
    grid-template-columns:1fr 1fr;
    -ms-grid-rows:auto auto;
    grid-template-rows:auto auto;
    border-style:solid;
    border-width:8px;
    border-color:#1f2024;
    border-radius:24px;
    background-color:#fff;
    box-shadow:-3px 3px 0 0 #1f2024;
    text-align:center
}
.your-roboto-asseet{
    overflow:hidden;
    margin-top:8px;
    margin-bottom:8px;
    padding:12px 12px 16px;
    border-style:none;
    border-width:4px;
    border-color:#1f2024;
    border-radius:20px
}
.your-roboto-card-image{
    border-radius:12px
}
.nav-link{
    padding:16px;
    color:#fff
}
.nav-link.w--current{
    color:#ffee31
}
.nav-link.logo{
    padding-left:4px
}
.brand{
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    padding-left:16px;
    -webkit-box-align:center;
    -webkit-align-items:center;
    -ms-flex-align:center;
    align-items:center;
    border-right:1px solid #494949;
    border-radius:8px 0 0 8px;
    background-color:#1f2024;
    color:#fff
}
.navbar{
    position:fixed;
    left:0%;
    top:0%;
    right:0%;
    bottom:auto;
    background-color:transparent
}
.nav-menu{
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    padding-right:8px;
    -webkit-box-align:center;
    -webkit-align-items:center;
    -ms-flex-align:center;
    align-items:center;
    border-radius:0 8px 8px 0;
    background-color:#1f2024;
    color:#fff
}
.container{
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    padding:8px;
    -webkit-box-pack:center;
    -webkit-justify-content:center;
    -ms-flex-pack:center;
    justify-content:center
}
.container.flexed{
    display:block;
    max-width:1200px;
    -webkit-box-pack:justify;
    -webkit-justify-content:space-between;
    -ms-flex-pack:justify;
    justify-content:space-between
}
.image-6{
    margin-right:8px
}
.section{
    position:relative;
    display:-ms-grid;
    display:grid;
    overflow:hidden;
    width:100%;
    padding:96px 32px 32px;
    -webkit-justify-content:space-around;
    -ms-flex-pack:distribute;
    justify-content:space-around;
    justify-items:stretch;
    -webkit-box-align:stretch;
    -webkit-align-items:stretch;
    -ms-flex-align:stretch;
    align-items:stretch;
    grid-auto-columns:1fr;
    grid-column-gap:16px;
    grid-row-gap:16px;
    -ms-grid-columns:1fr 1.5fr;
    grid-template-columns:1fr 1.5fr;
    -ms-grid-rows:auto;
    grid-template-rows:auto;
    background-color:#74dcf9
}
.section.bw{
    background-color:transparent
}
.parts-subtitle{
    font-family:space mono,sans-serif;
    font-size:1.25em;
    font-weight:400;
    text-transform:none
}
.heading-3{
    margin-top:0;
    margin-bottom:8px;
    font-family:right grotesk,sans-serif;
    font-size:2.25em
}
.spec-grid{
    display:-ms-grid;
    display:grid;
    height:100%;
    max-width:800px;
    padding:24px;
    justify-items:center;
    -webkit-box-align:center;
    -webkit-align-items:center;
    -ms-flex-align:center;
    align-items:center;
    -ms-grid-row-align:center;
    align-self:center;
    grid-auto-flow:row dense;
    grid-auto-columns:1fr;
    grid-column-gap:24px;
    grid-row-gap:24px;
    -ms-grid-columns:1fr 2fr 1fr;
    grid-template-columns:1fr 2fr 1fr;
    -ms-grid-rows:auto auto auto;
    grid-template-rows:auto auto auto;
    border-style:solid;
    border-width:8px;
    border-color:#1f2024;
    border-radius:16px;
    background-color:rgba(0,0,0,.1)
}
.spec-details{
    position:-webkit-sticky;
    position:sticky;
    left:0;
    top:0;
    bottom:auto;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    height:88vh;
    padding-right:32px;
    -webkit-box-orient:vertical;
    -webkit-box-direction:normal;
    -webkit-flex-direction:column;
    -ms-flex-direction:column;
    flex-direction:column;
    -webkit-box-pack:justify;
    -webkit-justify-content:space-between;
    -ms-flex-pack:justify;
    justify-content:space-between;
    -webkit-box-align:start;
    -webkit-align-items:flex-start;
    -ms-flex-align:start;
    align-items:flex-start
}
.tech-part-container{
    text-align:center
}
.tech-part-container.bw{
    -webkit-filter:brightness(131%) grayscale(100%) contrast(200%);
    filter:brightness(131%) grayscale(100%) contrast(200%)
}
.tech-description{
    padding-top:4px
}
.download{
    position:absolute;
    left:auto;
    top:auto;
    right:auto;
    bottom:32px;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    max-width:520px;
    padding:24px;
    -webkit-box-orient:vertical;
    -webkit-box-direction:normal;
    -webkit-flex-direction:column;
    -ms-flex-direction:column;
    flex-direction:column;
    -webkit-box-align:stretch;
    -webkit-align-items:stretch;
    -ms-flex-align:stretch;
    align-items:stretch;
    border-radius:16px;
    background-color:#fff
}
.tech-message{
    padding-bottom:8px
}
.spec-grid-flex{
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    max-width:800px;
    padding:24px;
    -webkit-box-orient:vertical;
    -webkit-box-direction:normal;
    -webkit-flex-direction:column;
    -ms-flex-direction:column;
    flex-direction:column;
    justify-items:center;
    -webkit-box-align:center;
    -webkit-align-items:center;
    -ms-flex-align:center;
    align-items:center;
    align-self:center;
    grid-auto-flow:row dense;
    grid-auto-columns:1fr;
    -ms-grid-columns:1fr 2fr 1fr;
    grid-template-columns:1fr 2fr 1fr;
    -ms-grid-rows:auto auto auto;
    grid-template-rows:auto auto auto;
    border-style:solid;
    border-width:8px;
    border-color:#1f2024;
    border-radius:16px;
    background-color:rgba(0,0,0,.1)
}
.spec-row{
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    -webkit-box-align:center;
    -webkit-align-items:center;
    -ms-flex-align:center;
    align-items:center
}
.tech-part-container-row{
    margin:16px;
    text-align:center
}
.heading{
    position:fixed;
    width:100%
}
.bw{
    -webkit-filter:contrast(163%) grayscale(100%) brightness(108%);
    filter:contrast(163%) grayscale(100%) brightness(108%)
}
.properties{
    width:800px;
    max-width:100%;
    margin-bottom:24px;
    text-align:left
}
.properties.centered{
    text-align:center
}
.grid{
    grid-column-gap:24px;
    grid-row-gap:0;
    grid-template-areas:"Area Area-2";
    -ms-grid-rows:auto;
    grid-template-rows:auto
}
.padded{
    padding-left:8px
}
.grid-box{
    display:-ms-grid;
    display:grid;
    width:100%;
    grid-auto-columns:1fr;
    grid-column-gap:24px;
    grid-row-gap:0;
    -ms-grid-columns:1fr 1fr;
    grid-template-columns:1fr 1fr;
    -ms-grid-rows:auto;
    grid-template-rows:auto
}
.grid-2{
    width:100%;
    grid-column-gap:48px;
    grid-row-gap:24px;
    grid-template-areas:"Area Area-2";
    -ms-grid-rows:auto;
    grid-template-rows:auto
}
.special-sub-paragraph{
    padding:8px;
    border-style:dashed;
    border-width:3px;
    border-color:rgba(35,119,211,.5);
    border-radius:4px;
    background-color:rgba(35,119,211,.1)
}
.comic-book{
    position:relative;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    padding:120px 24px;
    -webkit-box-orient:vertical;
    -webkit-box-direction:normal;
    -webkit-flex-direction:column;
    -ms-flex-direction:column;
    flex-direction:column;
    -webkit-box-pack:center;
    -webkit-justify-content:center;
    -ms-flex-pack:center;
    justify-content:center;
    -webkit-box-align:center;
    -webkit-align-items:center;
    -ms-flex-align:center;
    align-items:center;
    border-style:solid;
    border-width:16px;
    border-color:#1f2024;
    background-color:#2377d3
}
.comic-book.white{
    background-color:#fff
}
.comic{
    width:100%;
    grid-column-gap:48px;
    grid-row-gap:24px;
    grid-template-areas:"Area Area-2" "Area-3 Area-4" "Area-5 Area-6";
    -ms-grid-rows:auto 24px auto 24px auto;
    grid-template-rows:auto auto auto
}
.roboto-card{
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    max-width:1200px;
    padding:58px 58px 32px;
    -webkit-box-orient:vertical;
    -webkit-box-direction:normal;
    -webkit-flex-direction:column;
    -ms-flex-direction:column;
    flex-direction:column;
    -webkit-box-align:center;
    -webkit-align-items:center;
    -ms-flex-align:center;
    align-items:center;
    border-style:solid;
    border-width:8px;
    border-color:#1f2024;
    border-radius:24px;
    background-color:#fff;
    box-shadow:-3px 3px 0 0 #1f2024;
    -webkit-transition:box-shadow 200ms cubic-bezier(.25,.46,.45,.94);
    transition:box-shadow 200ms cubic-bezier(.25,.46,.45,.94);
    text-align:center
}
.roboto-card:hover{
    box-shadow:-6px 6px 0 0 #1f2024
}
.roboto-card.left{
    text-align:left
}
.new-grid{
    display:-ms-grid;
    display:grid;
    grid-auto-columns:1fr;
    grid-column-gap:16px;
    grid-row-gap:16px;
    grid-template-areas:"Area Area-2 Area-3" "Area-4 Area-5 Area-6";
    -ms-grid-columns:1fr 16px 1fr 16px 1fr;
    grid-template-columns:1fr 1fr 1fr;
    -ms-grid-rows:auto 16px auto;
    grid-template-rows:auto auto
}
@media screen and (max-width:991px){
    body{
        font-size:14px
    }
    .hero-heading{
        text-shadow:-11px 11px 0 #1f2024
    }
    .mint-section{
        overflow:hidden
    }
    .price{
        font-size:1em
    }
    .minting-container{
        max-width:100%;
        padding:40px
    }
    .image{
        max-width:200px;
        min-width:140px
    }
    .rarity-section{
        overflow:hidden
    }
    .rarity-chart{
        width:100%;
        -ms-grid-columns:1fr;
        grid-template-columns:1fr
    }
    .rarity-row.roboto-type{
        margin-bottom:0;
        grid-column-gap:0
    }
    .faq-left{
        display:none
    }
    .faq-img{
        max-width:120px
    }
    .faq-right{
        display:none
    }
    .faq-bottom{
        bottom:0;
        width:100%
    }
    .faq-top{
        top:0;
        width:100%
    }
    .rarity-image{
        max-width:320px;
        margin-right:auto;
        margin-left:auto;
        -webkit-box-ordinal-group:0;
        -webkit-order:-1;
        -ms-flex-order:-1;
        order:-1
    }
    .yourstuff-container{
        padding:40px
    }
    .container{
        max-width:530px
    }
    .section{
        padding-top:88px
    }
    .download{
        position:relative;
        width:100%;
        max-width:none
    }
    .spec-grid-flex{
        max-width:none
    }
    .heading{
        position:relative
    }
    .properties{
        width:100%
    }
    .grid{
        display:-webkit-box;
        display:-webkit-flex;
        display:-ms-flexbox;
        display:flex;
        -webkit-box-orient:vertical;
        -webkit-box-direction:normal;
        -webkit-flex-direction:column;
        -ms-flex-direction:column;
        flex-direction:column
    }
    .padded{
        padding-left:0
    }
    .grid-box{
        grid-row-gap:24px;
        -ms-grid-columns:1fr;
        grid-template-columns:1fr
    }
    .comic-book{
        overflow:hidden
    }
    .roboto-card{
        padding:40px
    }
}
@media screen and (max-width:767px){
    .hero-letters{
        -webkit-box-orient:vertical;
        -webkit-box-direction:normal;
        -webkit-flex-direction:column;
        -ms-flex-direction:column;
        flex-direction:column;
        -webkit-box-align:center;
        -webkit-align-items:center;
        -ms-flex-align:center;
        align-items:center
    }
    .hero-section{
        height:auto
        background-image: url('https://i.postimg.cc/0yXSG9g3/background-1.jpg');
    }
    .hero-heading{
        margin-top:0;
        font-size:17vw;
        line-height:.75em;
        text-shadow:-8px 8px 0 #1f2024
    }
    .primary-button.hero{
        padding-right:0;
        padding-left:0;
        -webkit-align-self:stretch;
        -ms-flex-item-align:stretch;
        -ms-grid-row-align:stretch;
        align-self:stretch
    }
    .button.nav{
        margin-left:auto
    }
    .minting-container{
        padding-right:24px;
        padding-left:24px;
        border-width:6px
    }
    .image{
        max-width:180px;
        min-width:120px
    }
    .image.cl2{
        top:10%
    }
    .image.cr2{
        top:10%
    }
    .hero-container{
        padding-top:220px;
        padding-bottom:220px
    }
    .intermission{
        display:none
    }
    .center-image-block{
        top:auto
    }
    .center-image-block._2{
        position:relative;
        top:auto
    }
    .rarity-section{
        padding-right:16px;
        padding-left:16px;
        border-style:none
    }
    .rarity-chart{
        padding:24px
    }
    .faq-img{
        max-width:100px
    }
    .faq-img._1{
        -webkit-transform:rotate(10deg);
        -ms-transform:rotate(10deg);
        transform:rotate(10deg)
    }
    .faq-img._3{
        max-width:80px
    }
    .faq-bottom{
        bottom:24px
    }
    .faq-top{
        top:24px
    }
    .rarity-image{
        width:100%
    }
    .yourstuff-container{
        padding-right:24px;
        padding-left:24px;
        border-width:4px
    }
    .nav-link{
        padding-left:0
    }
    .nav-link.logo{
        display:none
    }
    .brand{
        padding-top:12px;
        padding-right:16px;
        padding-bottom:12px;
        -webkit-box-ordinal-group:0;
        -webkit-order:-1;
        -ms-flex-order:-1;
        order:-1;
        border-radius:8px
    }
    .nav-menu{
        margin-right:8px;
        margin-left:8px;
        padding-right:16px;
        padding-bottom:16px;
        padding-left:16px;
        -webkit-box-orient:vertical;
        -webkit-box-direction:normal;
        -webkit-flex-direction:column;
        -ms-flex-direction:column;
        flex-direction:column;
        -webkit-box-align:stretch;
        -webkit-align-items:stretch;
        -ms-flex-align:stretch;
        align-items:stretch;
        border-radius:8px;
        background-color:#1f2024
    }
    .container{
        max-width:100%;
        -webkit-box-pack:justify;
        -webkit-justify-content:space-between;
        -ms-flex-pack:justify;
        justify-content:space-between;
        border-radius:8px
    }
    .image-6{
        margin-right:0
    }
    .menu-button{
        -webkit-box-ordinal-group:2;
        -webkit-order:1;
        -ms-flex-order:1;
        order:1;
        border-radius:16px;
        background-color:#000
    }
    .menu-button.w--open{
        background-color:#ff3979
    }
    .icon{
        color:#fff
    }
    .section{
        height:auto;
        padding-right:24px;
        padding-left:24px;
        -webkit-box-orient:vertical;
        -webkit-box-direction:normal;
        -webkit-flex-direction:column;
        -ms-flex-direction:column;
        flex-direction:column;
        -webkit-box-align:center;
        -webkit-align-items:center;
        -ms-flex-align:center;
        align-items:center;
        -ms-grid-columns:1fr;
        grid-template-columns:1fr;
        text-align:center
    }
    .spec-grid{
        width:100%
    }
    .spec-details{
        width:auto;
        height:auto;
        padding-right:0;
        padding-bottom:24px;
        -webkit-box-align:center;
        -webkit-align-items:center;
        -ms-flex-align:center;
        align-items:center
    }
    .download{
        bottom:auto;
        margin-top:32px;
        padding-top:16px;
        padding-bottom:16px
    }
    .grid-2{
        display:-webkit-box;
        display:-webkit-flex;
        display:-ms-flexbox;
        display:flex;
        -webkit-box-orient:vertical;
        -webkit-box-direction:normal;
        -webkit-flex-direction:column;
        -ms-flex-direction:column;
        flex-direction:column
    }
    .comic-book{
        padding-right:16px;
        padding-left:16px;
        border-style:none
    }
    .comic{
        display:-webkit-box;
        display:-webkit-flex;
        display:-ms-flexbox;
        display:flex;
        -webkit-box-orient:vertical;
        -webkit-box-direction:normal;
        -webkit-flex-direction:column;
        -ms-flex-direction:column;
        flex-direction:column
    }
    .roboto-card{
        padding-right:24px;
        padding-left:24px;
        border-width:6px
    }
}
@media screen and (max-width:479px){
    h2{
        font-size:2em
    }
    .hero-section.dark{
        padding-right:12px;
        padding-left:12px
    }
    .primary-button{
        padding-right:20px;
        padding-left:20px
    }
    .nav-bar{
        margin-right:16px;
        margin-left:16px
    }
    .link-block{
        padding-right:12px;
        padding-left:12px
    }
    .link-block.w--current{
        display:none
    }
    .link-block.rarity{
        display:none
    }
    .mint-section{
        padding-right:12px;
        padding-left:12px
    }
    .minting-container{
        padding-right:16px;
        padding-left:16px
    }
    .image{
        max-width:160px;
        min-width:100px
    }
    .rarity-section{
        padding-right:16px;
        padding-left:16px;
        background-image:none
    }
    .rarity-chart{
        padding:0;
        border-style:none;
        box-shadow:none
    }
    .rarity-number.full{
        width:100%
    }
    .faq-section{
        padding-right:16px;
        padding-left:16px
    }
    .faq-container{
        max-width:100%
    }
    .heading-2{
        text-align:center
    }
    .text-block-8{
        display:none
    }
    .your-roboto-name{
        margin-top:8px;
        font-size:1em
    }
    .your-roboto-card{
        padding:9px
    }
    .yourstuff-container{
        padding-right:8px;
        padding-left:8px
    }
    .license-container{
        max-width:100%
    }
    .your-roboto-asseet{
        padding:9px
    }
    .section{
        padding-right:16px;
        padding-left:16px
    }
    .spec-grid{
        padding:12px
    }
    .spec-grid-flex{
        padding:12px
    }
    .comic-book{
        padding-right:16px;
        padding-left:16px;
        background-image:none
    }
    .roboto-card{
        padding-right:16px;
        padding-left:16px
    }
}
@font-face{
    font-family:right grotesk;
    src:url(https://assets.website-files.com/61702f71b7840a016f189c88/61702f71b7840ac431189cac_PPRightGrotesk-SpatialBlack.woff2) format('woff2'),url(https://assets.website-files.com/61702f71b7840a016f189c88/61702f71b7840a3dcf189ca0_PPRightGrotesk-SpatialBlack.eot) format('embedded-opentype'),url(https://assets.website-files.com/61702f71b7840a016f189c88/61702f71b7840aab3e189c9c_PPRightGrotesk-SpatialBlack.woff) format('woff'),url(https://assets.website-files.com/61702f71b7840a016f189c88/61702f71b7840a0fc5189c9d_PPRightGrotesk-SpatialBlack.ttf) format('truetype'),url(https://assets.website-files.com/61702f71b7840a016f189c88/61702f71b7840aa4bf189ca1_PPRightGrotesk-SpatialBlack.otf) format('opentype');
    font-weight:900;
    font-style:normal;
    font-display:swap
}

    
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      var menuButton = document.querySelector('.menu-button');
      var navBar = document.querySelector('.nav-bar');

      menuButton.addEventListener('click', function () {
          // Toggle the visibility of the navigation bar
          if (navBar.style.display === 'block') {
              navBar.style.display = 'none';
          } else {
              navBar.style.display = 'block';
          }
      });
  });
</script>



<style>
  .menu-button2{
      border-radius: 15px;
      background-color: #000;
  }
</style>




<div class="w-nav-button" style="-webkit-user-select: text;" aria-label="menu" role="button" tabindex="0" aria-controls="w-nav-overlay-0" aria-haspopup="menu" aria-expanded="false">
<div class="" style="-webkit-user-select: text;">


<a href="/" class="menu-button2 w-nav-dep nav w-button">OPS!</a>
</div>
</div>
<div class="menu-button w-nav-button" style="-webkit-user-select: text;" aria-label="menu" role="button" tabindex="0" aria-controls="w-nav-overlay-0" aria-haspopup="menu" aria-expanded="false">
<div class="icon w-icon-nav-menu"></div>
</div>
</div>
<div class="w-nav-overlay" data-wf-ignore="" id="w-nav-overlay-0"></div></div>
<div class="nav-bar">
<a href="../playdemo/" class="button w-button">
<div>Jogar</div>
</a>


<a href="../login/" class="button w-button">
<div >Login</div>
</a>
<a href="../cadastrar/" class="button w-button">Cadastrar</a>
</div>





<section id="hero" class="hero-section dark wf-section" style="background-image: url('https://i.postimg.cc/0yXSG9g3/background-1.jpg'); background-position: center; background-size: cover;">
        <div class="minting-container w-container">
          
          <h2>PÁGINA NÃO ENCONTRADA</h2>
          <p>
            A página que você tentou acessar não existe!
          </p>
       
       <a href='javascript:history.go(-1);'>
            <button 
  style="padding: 20px 40px; margin-top:35px; background-color: #00c489; color: black;" 
  onmouseover="this.style.backgroundColor = '#4bfac5';" 
  onmouseout="this.style.backgroundColor = '#00c489';"
>
  <strong>VOLTAR</strong>
</button>
</a>
        </div>
      </section>
    <div class="footer-section wf-section">
        <div class="domo-text"> <?= $nomeUm ?> <br>
        </div>
        <div class="domo-text purple"> <?= $nomeDois ?> <br>
        </div>
        <div class="follow-test">© Copyright xlk Limited, with registered offices at Dr. M.L. King Boulevard 117, accredited by license GLH-16289876512. </div>
        <div class="follow-test">
          <a href="/legal">
            <strong class="bold-white-link">Termos de uso</strong>
          </a>
        </div>
          <div class="follow-test">contato@<?php
$nomeUnico = strtolower(str_replace(' ', '', $nomeUnico));
echo $nomeUnico;
?>.com</div>
      </div>





<script type="text/javascript">
            <!-- Inclua a biblioteca jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Seu script jQuery -->
    <script type="text/javascript">
        $(document).ready(function () {
            $("#withdrawValue").keyup(function (e) {
                var value = $("[name='withdrawValue']").val();
                var final = (value / 100) * 95;
                $('#updatedValue').text('' + final.toFixed(2));
            });
        });
    </script>
        </div>
        <div id="imageDownloaderSidebarContainer">
          <div class="image-downloader-ext-container">
            <div tabindex="-1" class="b-sidebar-outer"><!---->
              <div id="image-downloader-sidebar" tabindex="-1" role="dialog" aria-modal="false" aria-hidden="true"
                class="b-sidebar shadow b-sidebar-right bg-light text-dark" style="width: 500px; display: none;"><!---->
                <div class="b-sidebar-body">
                  <div></div>
                </div><!---->
              </div><!----><!---->
            </div>
          </div>
        </div>
        <div style="visibility: visible;">
          <div></div>
          <div>
            <div
              style="display: flex; flex-direction: column; z-index: 999999; bottom: 88px; position: fixed; right: 16px; direction: ltr; align-items: end; gap: 8px;">
              <div style="display: flex; gap: 8px;"></div>
            </div>
            <style> @-webkit-keyframes ww-1d3e1845-0974-4ce9-92ae-64548dac571e-launcherOnOpen {
          0% {
            -webkit-transform: translateY(0px) rotate(0deg);
                    transform: translateY(0px) rotate(0deg);
          }

          30% {
            -webkit-transform: translateY(-5px) rotate(2deg);
                    transform: translateY(-5px) rotate(2deg);
          }

          60% {
            -webkit-transform: translateY(0px) rotate(0deg);
                    transform: translateY(0px) rotate(0deg);
          }


          90% {
            -webkit-transform: translateY(-1px) rotate(0deg);
                    transform: translateY(-1px) rotate(0deg);

          }

          100% {
            -webkit-transform: translateY(-0px) rotate(0deg);
                    transform: translateY(-0px) rotate(0deg);
          }
        }
        @keyframes ww-1d3e1845-0974-4ce9-92ae-64548dac571e-launcherOnOpen {
          0% {
            -webkit-transform: translateY(0px) rotate(0deg);
                    transform: translateY(0px) rotate(0deg);
          }

          30% {
            -webkit-transform: translateY(-5px) rotate(2deg);
                    transform: translateY(-5px) rotate(2deg);
          }

          60% {
            -webkit-transform: translateY(0px) rotate(0deg);
                    transform: translateY(0px) rotate(0deg);
          }


          90% {
            -webkit-transform: translateY(-1px) rotate(0deg);
                    transform: translateY(-1px) rotate(0deg);

          }

          100% {
            -webkit-transform: translateY(-0px) rotate(0deg);
                    transform: translateY(-0px) rotate(0deg);
          }
        }

        @keyframes ww-1d3e1845-0974-4ce9-92ae-64548dac571e-widgetOnLoad {
          0% {
            opacity: 0;
          }
          100% {
            opacity: 1;
          }
        }

        @-webkit-keyframes ww-1d3e1845-0974-4ce9-92ae-64548dac571e-widgetOnLoad {
          0% {
            opacity: 0;
          }
          100% {
            opacity: 1;
          }
        }
      </style></div>
      </div>
      </body>
      
      </html>
