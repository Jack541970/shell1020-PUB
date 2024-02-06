<?php
if (isset($_GET['msg'])) {
$message = $_GET['msg'];
echo '<div class="msgt" style="background-color: red; padding: 10px;
text-align: center;">' . $message . '</div>';
echo '<script>setTimeout(function(){
document.querySelector(".msgt").style.display = "none"; },
3000);</script>';
}
?>