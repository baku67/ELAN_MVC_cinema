<?php 

    namespace Controller;
    use Model\Connect;


    class HomeController {

        public function getHomepage() {

            $pdo = Connect::seConnecter();
            $newsList = $pdo->query("
                SELECT * FROM news
                ORDER BY publishDate DESC
            ");

            // Est-ce qu'il faut créer une table dateAjout et la joigner à movie/person ?
            $lastAddsList = $pdo->query("
                SELECT m.movie_id AS id, m.movie_title AS title, movie_frenchPublishDate AS publishDate, movie_imgUrl AS imgUrl, create_Time, m.type
                FROM movie m
                UNION
                SELECT d.director_id AS id, CONCAT(p.person_firstName, ' ',p.person_lastName) AS title, person_birthDate AS publishDate, person_imgUrl AS imgUrl, create_Time, p.type
                FROM person p
                INNER JOIN director d ON d.person_id = p.person_id
                UNION
                SELECT a.actor_id AS id, CONCAT(p.person_firstName, ' ',p.person_lastName) AS title, person_birthDate AS publishDate, person_imgUrl AS imgUrl, create_Time, p.type
                FROM person p
                INNER JOIN actor a ON a.person_id = p.person_id
                ORDER BY create_time DESC
                LIMIT 6
            ");


            require 'view/homepage.php';
        }

        public function search() {

            $searchInput = htmlspecialchars($_POST["inputSearch"]);

            $pdo = Connect::seConnecter();
            $searchQuery = $pdo->prepare("
                SELECT movie_id AS id, movie_title AS title, m.type, m.movie_imgUrl AS img
                FROM movie m 
                WHERE m.movie_title LIKE :searchString
                GROUP BY m.movie_id
                UNION
                SELECT actor_id AS id, CONCAT(p.person_firstName, ' ', p.person_lastName) AS title, a.type, p.person_imgUrl AS img
                FROM actor a
                INNER JOIN person p ON p.person_id = a.person_id
                WHERE p.person_firstName LIKE :searchString
                OR p.person_lastName LIKE :searchString
                GROUP BY a.actor_id
                UNION 
                SELECT director_id AS id, CONCAT(p.person_firstName, ' ', p.person_lastName) AS title, d.type, p.person_imgUrl AS img
                FROM director d
                INNER JOIN person p ON p.person_id = d.person_id
                WHERE p.person_firstName LIKE :searchString
                OR p.person_lastName LIKE :searchString
                GROUP BY d.director_id
            ");
                // Search avec roles:
                    // UNION 
                    // SELECT role_id AS id, role_name AS title, r.type
                    // FROM role r
                    // WHERE r.role_name LIKE :searchString
            $searchQuery->execute([
                "searchString" => "%" . $searchInput . "%"
            ]);

            require 'view/searchResult.php';
        }

    }
