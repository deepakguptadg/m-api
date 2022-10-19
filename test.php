<input type="hidden" value="asdf" name="name">
<?php
    $name = $_POST['name'];
    print_r($name);die;

?>


<script>
    function FetchData() {
        var name = document.getElementById('name').value();
        alert(name)
    }
    setInterval(FetchData, 60);
</script>