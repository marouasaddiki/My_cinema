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
          <a class="nav-link active" aria-current="page" href="my_cinema_index.html" title="index">Home</a>
          <a class="nav-link" href="my_cinema_search_film.php" title="recherchefilm">Search For A Movie</a>
          <a class="nav-link" href="my_cinema_search_membre.html" title="recherchefilm">Search For A Member</a>
        </nav>
      </div>
      <main class="px-3 ">
        <h1>Welcome</h1>

      </main>

      <?php
      // $like = $_GET["id"];
      // $_SESSION['id ficheperso'] = $_GET["id"];
      function search()
      {
        $bdd = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'maroua', 'Studentes01@');
        $like = $_GET["id"];
        // echo 'id fiche perso : ' . $like;
        $membre = $bdd->query("SELECT * FROM user LEFT JOIN membership ON membership.id_user = user.id
    WHERE user.id LIKE '$like'");

        while ($membres = $membre->fetch()) {
          echo "<H2 class='title'>" . $membres['lastname'] . " " . $membres['firstname'] . "</H2>";

          $likee = $membres['id_subscription'];
        }
        $membreabo = $bdd->query("SELECT * FROM membership LEFT JOIN subscription ON membership.id_subscription = subscription.id WHERE subscription.id LIKE '$likee'");
        $membreabos = $membreabo->fetch();
        $nbabo = $membreabos['id'];
        if ($nbabo != NULL) {
          echo "<h2><br><br>Abonnement:<h3><br>";
          echo "<H3 class='title'>" . $membreabos['name'] . ": " . $membreabos['description'] . "</H3>";
        } else {
          echo "<h2><br> <br>Pas d'abonnement</h2>";
        }
      }
      search();
      ?>
      <form method="post">
        <select name="type">
          <option value="NULL">Supprimer</option>
          <?php
          $bdd = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'maroua', 'Studentes01@');
          $abos = $bdd->query("SELECT * FROM subscription");
          foreach ($abos as $abo) {
            echo '<option value="' . $abo["id"] . '">' . $abo["name"] . '</option>';
          }
          ?>
        </select>
        <input type="submit" name="form" value="Modifier Abonnement">
      </form>

      <?php
if(isset($_POST["type"]))
{
  $type = $_POST["type"];
  $bdd = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'maroua', 'Studentes01@');
  $bdd->query("UPDATE membreship SET id_subscription = " .$type . " WHERE id_user = ".$like);
  header("location:membre.php?id=".$like);
}
echo "<H2 class='title'>"."Historique Membre:"."</H2>";
?>
<form action = "recherchefilmadd.php" method="post">
<input type="submit" name="form" value="Ajouter Film Historique">
</form>
 <!-- idjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj -->
<?php
$bdd = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'maroua', 'Studentes01@');
$membrejoin = $bdd->query("SELECT * FROM user LEFT JOIN membership ON membership.id_user = user.id
  WHERE user.id LIKE '$like'");
    while($membrejoins = $membrejoin->fetch())
    {
      $likeee = $membrejoins['id_user'];
    }
$membrehist = $bdd->query("SELECT * FROM movie INNER JOIN tp_historique_membre ON tp_historique_membre.id_movie = movie.id_movie INNER JOIN membership ON tp_historique_membre.id_user = membership.id_user
WHERE tp_historique_membre.id_user LIKE '$likeee'");
//$filmidhist = $bdd->query("SELECT * FROM")
  $idfilmhist = "";
  while($membrehists = $membrehist->fetch())
  {
  echo '<p>'.$membrehists['title'].'</p>';
  echo '<p>'." Avis du membre pour le film ".$membrehists['title'].": ".$membrehists['membre_avis'].'</p>';
  $idf = $membrehists['id_movie'];
  }
?>
    </header>
  </div>
</body>

</html>