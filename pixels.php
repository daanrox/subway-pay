<?php 
include 'conectarbanco.php';
$conn = new mysqli('localhost', $config['db_user'], $config['db_pass'], $config['db_name']);

$sql = "SELECT * FROM app";
$result2 = $conn->query($sql);
$result = $result2->fetch_assoc();

$google_ads_tag = $result['google_ads_tag'];
$facebook_ads_tag = $result['facebook_ads_tag'];
$conn->close();
?>

<!-- Meta Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '<?php $facebook_ads_tag ?>');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=<?php $facebook_ads_tag ?>&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

<script async src="https://www.googletagmanager.com/gtag/js?id=<?php $google_ads_tag ?>"> </script>
<script>
    window.dataLayer = window.dataLayer | | [ ] ;
    function gtag ( ) {dataLayer.push (arguments ) ; }
    gtag ('js' , new Date ( ) ) ;
    gtag ('config', '<?php $google_ads_tag ?>') ;
</script>