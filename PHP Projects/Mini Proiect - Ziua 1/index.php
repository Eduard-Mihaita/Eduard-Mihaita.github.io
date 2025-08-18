<?php
    $name = $email = $age = "";
    $errors = [];
    // TODO: Validări (nume, email, vârstă)
    // TODO: Dacă erori → salvează în $errors
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(empty($_POST['name'])){
            $errors[] = "Câmpul Nume este obligatoriu.";
        }else{
            $name = trim($_POST['name']);
            if(!filter_var($name, ));
        }
        if(empty($_POST['email'])){
            $errors[] = "Câmpul Email este obligatoriu.";
        }else{
            $email = trim($_POST['email']);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[] = "Format email invalid.";
            }
        }
        if(empty($_POST['age'])){
            $errors[] = "Câmpul Vârsta este obligatoriu.";
        }else{
            $age = trim($_POST['age']);
            if(!filter_var($age, FILTER_VALIDATE_INT, ["options"=>["min_range"=>0]])){
                $errors[] = "Vârsta trebuie să fie un număr pozitiv.";
            }
        }
    }
?>
<!doctype html>
<html lang="ro">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Formular PHP</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous" />
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Formular simplu</h1>
            <form method="post" class="row g-3 needs-validation" novalidate>
                <label class="form-label">Nume:</label>
                    <input class="form-control" type="text" name="name" required>
                <label class="form-label">Email:</label>
                    <input class="form-control" type="email" name="email" required>
                <label class="form-label">Vârstă:</label>
                    <input class="form-control" type="number" name="age" required>
                <button type="submit" class="btn btn-primary">Trimite</button>
            </form>
        <?php if (!empty($errors)): ?>
        <ul style="color:red;">
        <?php foreach($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errors)): ?>
            <p style="color:green;">
            Salut, <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>!<br>
            Ți-am trimis un email la <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8');?>.<br>
            Ai <?php echo (int)$age; ?> ani — bine ai venit!
        </p>
        <?php endif; ?>
        </div>
    </body>
</html>