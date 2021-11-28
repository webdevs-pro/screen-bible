<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8"/>
      <title>Screen bible</title>
      <link rel="stylesheet" href="style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script type="text/javascript" src="script.js"></script>
   </head>
   <body>

      <?php
         // $db = new SQLite3('modules/RST+.SQLite3', SQLITE3_OPEN_READWRITE);
         // $db = new SQLite3('modules/Бран\'92.SQLite3', SQLITE3_OPEN_READWRITE);
         // $db = new SQLite3('modules/ЕНЗ.SQLite3', SQLITE3_OPEN_READWRITE);
         // $db = new SQLite3('modules/UBIO\'88.SQLite3', SQLITE3_OPEN_READWRITE);
         // $info_results = $db->query('SELECT * FROM info WHERE name == "description"');
         // $description = $info_results->fetchArray()['value'];
         // echo '<pre>' . print_r($description, true) . '</pre><br>';

         // gel list of SQLite3 files in directory
         $bible_modules = glob( __DIR__ . '/modules/*.SQLite3' );
      ?>

      <div id="main">
         <div class="main-form-wrapper">
            <form id="main-form">
               <select name="module" autocomplete="off">
                  <?php
                     foreach ( $bible_modules as $module_path ) {
                        $db = new SQLite3( $module_path, SQLITE3_OPEN_READWRITE );
                        $query = $db->query( 'SELECT * FROM info WHERE name == "description"' );
                        $description = $query->fetchArray()['value'];
                        echo '<option value="' . $module_path . '">' . $description . '</option>';
                     }
                  ?>
               </select>
               <select name="book" size="10" autocomplete="off">
                  <?php
                     $db = new SQLite3( $bible_modules[0], SQLITE3_OPEN_READWRITE );
                     $query = $db->query( 'SELECT * FROM books' );
                     $books = [];
                     $i = 0;
                     while ($row = $query->fetchArray()) {
                        $i++;
                        $books[$i]['num'] = $row['book_number'];
                        $books[$i]['name'] = $row['long_name'];
                        // if ($i == 66) break;
                     }
                     foreach ( $books as $book ) {
                        echo '<option value="' . $book['num'] . '">' . $book['name'] . '</option>';
                     }
                  ?>
               </select>
               <select name="verse" size="10" autocomplete="off">
                  <?php
                     $db = new SQLite3( $bible_modules[0], SQLITE3_OPEN_READWRITE );
                     $query = $db->query( 'SELECT text FROM verses WHERE book_number == "10" AND chapter == "1"' );
                     $verse_number = 1;
                     while ( $verse = $query->fetchArray() ) {
                        $book_array[$verse_number] = strip_tags( preg_replace('#(<S.*?>).*?(</S>)#', '$1$2', $verse['text']) );
                        $verse_number++;
                     }
                     foreach ( $book_array as $index => $verse ) {
                        echo '<option value="' . $index . '">' . $verse . '</option>';
                     }
                  ?>
               </select>
            </form>
         </div>
      </div>


          <?php

         // // get books list
         // $results = $db->query('SELECT * FROM books');

         // $books = [];
         // $i = 0;
         // while ($row = $results->fetchArray()) {
         //    $i++;
         //    $books[$i]['num'] = $row['book_number'];
         //    $books[$i]['name'] = $row['long_name'];
         //    if ($i == 66) break;
         // }
         
         // echo '<pre>';
         // var_export($books);
         // echo '</pre>';

         // $book_chapters_query = $db->query('SELECT DISTINCT	chapter FROM verses WHERE book_number ==' . $book_number);
         
         
      ?>
   </body>
</html>


<?php

   
   




   
