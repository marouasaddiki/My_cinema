<!doctype html>
<html lang="fr" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>My Cinema</title>

</head>

<body class="d-flex h-100 text-center text-white bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">My Cinema</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link active" aria-current="page" href="my_cinema_index.html" title="index">Home </a>
                    <a class="nav-link" href="my_cinema_search_film.php" title="recherchefilm">Search For A Movie</a>
                    <a class="nav-link" href="my_cinema_search_membre.html" title="recherchefilm">Search For A Member</a>
                </nav>
            </div>
        </header>

        <main class="px-3">
            <h1>Welcome</h1>

        </main>

        <?php
        function search()
        {
            $bdd = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'maroua', 'Studentes01@');
            $like = $_POST['type'];
            $genre = $bdd->query("SELECT title,distributor.name FROM movie
         LEFT JOIN distributor
          ON movie.id_distributor = distributor.id
        WHERE distributor.name LIKE '%$like%'");
            $genres = $genre->fetchAll();
            foreach ($genres as $value) {
        ?>
                <meta charset="utf-8" /><?php
                                        echo "<h2 class='title'>" . $value['title'] . "</h2>";
                                        echo "<div class='resum'> </div><br><hr>";
                                    }
                                }
                                search();
                                        ?>
</body>

</html>