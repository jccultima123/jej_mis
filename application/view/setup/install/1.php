<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agree'])){
    header('Location: 2');
    exit;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['agree'])){
    echo "You must agree to the license.";
}
?>
    <p>Our LICENSE will go here.</p>
    <form action="1" method="post">
        <p>
            I agree to the license
            <input type="checkbox" name="agree" />
        </p>
        <input type="submit" value="Continue" />
    </form>
<?php