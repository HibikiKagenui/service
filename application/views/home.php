<?php
/**
 * Created by PhpStorm.
 * User: Muhammad Abel
 * Date: 09-Jun-18
 * Time: 2:40 PM
 */
?>
<script>
    $(function () {
        //var ids = <?php //echo json_encode($customer_id) ?>//;
        var ids = [
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
        ];

        $('#auto').autocomplete({
            source: ids
        });
    });
</script>
<div class="col-md">
    <h1><b>Menu Utama</b></h1>
    <form action="<?php echo site_url('process/new_transaction') ?>" method="post">
        <input type="text" class="form-control" name="id" id="auto">
    </form>
<!--    <h1 class="text-center"><b>Under Construction</b></h1>-->
<!--    <h3>What you can expect:</h3>-->
<!--    <ol>-->
<!--        <li>Form to create new transaction (with autocomplete!)</li>-->
<!--        <li>Graphs (only available for managers)</li>-->
<!--    </ol>-->
</div>
