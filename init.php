<?php
//header("Location:form.php");

session_start();
require_once('User.php');
require_once('header.php');
require_once('Maneger.php');
require_once('Admin.php');
require_once('Client.php');
require_once('Translation.php');

?>

<?php if (isset($_SESSION['id'])) {

    $lang = $_POST['lang'] ?? $_SESSION['lang'];
    $translation = new Translation($user, $lang);
    $translation = $translation->getTranslation();


    echo $translation['hello'] . " &nbsp" . $user->present() . ' ' . $translation['opportunities'];

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">
    <title>multilang</title>
</head>
<body>
<?php if ($_SESSION['id'] && !$lang) { ?>
    <form method="post" action="/form.php">
        <label>
            <input type="radio" name="lang" value="ru"> ru </label> <br>
        <label>
            <input type="radio" name="lang" value="en"> en </label> <br>
        <label>
            <input type="radio" name="lang" value="it"> it </label> <br>
        <label>
            <input type="radio" name="lang" value="ua"> ua </label> <br>
        <button type="submit" value="selLang">
            выбрать
        </button>
    </form>
<?php  } ?>
</body>
</html>

