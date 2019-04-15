<?php
require_once 'scripts/config.php';
require_once 'scripts/connect.php';
confirm_logged_in();
$tbl = "tbl_genre";
$movie_categories = getAll($tbl);
if (isset($_POST['submit'])) {
    // var_dump($_FILES['cover']);
    $cover = $_FILES['cover'];
    $title = trim($_POST['title']);
    $year = trim($_POST['year']);
    $run = trim($_POST['run']);
    $trailer = trim($_POST['trailer']);
    $release = trim($_POST['release']);
    $story = trim($_POST['story']);
    $genre = $_POST['genlist'];
    $result = addMovie($cover, $title, $year, $run, $trailer, $release, $story, $genre);
    $message = $result;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,500" rel="stylesheet">
  <link rel="stylesheet" href="../css/main.css">
  <title>Add Movie</title>
</head>
<body>
  <h1>Add Movies</h1>
  <form action="admin_addmovie.php" method="post" enctype="multipart/form-data">
  <label for="cover">Cover Image:</label>
  <input type="file" name="cover" id="cover" value="">

  <label for="title">Movie Title:</label>
  <input type="text" name="title" id="title" value="">

  <label for="year">Movie Year:</label>
  <input type="text" name="year" id="year" value="">

  <label for="run">Movie Runtime:</label>
  <input type="text" name="run" id="run" value="">

  <label for="trailer">Movie Trailer:</label>
  <input type="text" name="trailer" id="trailer" value="">

  <label for="release">Movie Release:</label>
  <input type="text" name="release" id="release" value="">

  <label for="story">Movie Storyline:</label>
  <textarea name="story" id="story"></textarea>

  <label for="genlist">Movie Genre:</label>
  <select name="genlist" id="genlist">
  <option>Please select a movie genre..</option>
  <?php while ($movie_category = $movie_categories->fetch(PDO::FETCH_ASSOC)): ?>
  <option value="<?php echo $movie_category['genre_id'] ?>"><?php echo $movie_category['genre_name'] ?></option>
  <?php endwhile?>
  </select>

  <button type="submit" name="submit" class="btn">Add Movie</button>
  </form>
</body>
</html>
