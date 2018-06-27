<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 26-Jun-18
 * Time: 12:54 AM
 */
?>
<html>
<head>
    <title>Redirecting...</title>
</head>
<body>
</body>
<script>
    window.onload = function () {
        window.open("<?php echo site_url('transactions/struk?id=' . $id) ?>", "_blank"); // will open new tab on window.onload
        window.location.replace("<?php echo site_url() ?>");
    }
</script>
</html>
