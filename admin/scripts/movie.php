<?php

function addMovie($cover, $title, $year, $run, $trailer, $release, $story, $genre)
{
    try {
        // 1. Build the DB connection
        include 'connect.php';
        // 2. Validate file
        $file_type = pathinfo($cover['name'], PATHINFO_EXTENSION);

        $accepted_types = array('gif', 'jpg', 'jpeg', 'jpe', 'png');
        if (!in_array($file_type, $accepted_types)) {
            throw new Exception('Invalid file format!');
        }
        // 3. Move the file around -> save it to the images folder
        $target_path = '../images/' . $cover['name'];
        if (!move_uploaded_file($cover['tmp_name'], $target_path)) {
            throw new Exception('Failed to move uploaded file, check permissions!');
        }
        //Find out how to change the file size for this copy
        $th_copy = '../images/TH_' . $cover['name'];
        if (!copy($target_path, $th_copy)) {
            throw new Exception('Failed to move copy file, check permission!');
        }
        // 4. adding entry to database
        // INSERTO INTO tbl_movies
        $add_movie_query = "INSERT INTO tbl_movies(movies_cover, movies_title, movies_year, movies_runtime, movies_storyline, movies_trailer, movies_release) VALUES(:cover, :title, :year, :runtime, :storyline, :trailer, :release)";
        $add_movie = $pdo->prepare($add_movie_query);
        $add_movie->execute(
            array(
                ':cover' => $cover['name'],
                ':title' => $title,
                ':year' => $year,
                ':runtime' => $run,
                ':storyline' => $story,
                ':trailer' => $trailer,
                ':release' => $release,
            )
        );
        //GET new movie ID
        if (!$add_movie) {
            throw new Exception('Failed to insert new movie!');
        }
        $new_movie_id = $pdo->lastInsertId();
        // var_dump($new_movie_id);
        //INSERT INTO tbl_genres
        $genre_link_query = "INSERT INTO tbl_mov_genre(movies_id, genre_id) VALUES(:movie_id, :genre_id)";
        $genre_insert = $pdo->prepare($genre_link_query);
        $genre_insert->execute(
            array(
                ':movie_id' => $new_movie_id,
                ':genre_id' => $genre,
            )
        );
        if (!$genre_insert) {
            throw new Exception('Failed to set Genre!');
        }
        // 5. redirect user
        redirect_to('index.php');
    } catch (Exception $e) {
        $error = $e->getMessage();
        return $error;
    }

    // var_dump($cover);
    // var_dump($genre);
}
