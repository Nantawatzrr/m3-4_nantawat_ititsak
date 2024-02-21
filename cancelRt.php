<?php

session_start();
session_destroy();
?>
<script>
    alert("ยกเลิกเลยการ");
    window.location.href = 'index.php';
</script>
