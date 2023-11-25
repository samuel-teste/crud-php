
<?php
    include __DIR__.'/src/Crud.php';
    $crud = new Crud();
    if(isset($_POST['criar'])){
        $crud->create();
    }

    if(isset($_GET['excluir'])){
        $crud->delete($_GET['excluir']);
    }

    if(isset($_POST['atualizar'])){
        $crud->update($_GET['id']);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
</head>
<body>
    <h1>CRUD de Filmes</h1>

    <form method="post">
        <?php foreach($crud->list($_GET['id']) as $key => $film): ?>
        <input type="text" name="title" value="<?= $film['title'] ?>">
        <input type="submit" name="atualizar" value="Atualizar">
        <?php endforeach; ?>

    </form>

    <ul>
        <?php foreach($crud->list() as $key => $film): ?>
            <ul>
                <li>
                    <?= $film['title'] ?>
                    <a href="?excluir=<?= $film['id'] ?>">Excluir</a>
                    <a href="update.php?id=<?= $film['id'] ?>">Editar</a>
                </li>
            </ul>
        <?php endforeach; ?>
    </ul>
</body>
</html>