<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8"/>
      <title>Download YouTube mp3</title>
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





         
         $bible_modules = glob(__DIR__ . "/modules/*.SQLite3");
      ?>
      <form>
         <select name="module" autocomplete="off">
            <?php
               foreach ( $bible_modules as $module_path ) {
                  $db = new SQLite3( $module_path, SQLITE3_OPEN_READWRITE );
                  $query = $db->query('SELECT * FROM info WHERE name == "description"');
                  $description = $query->fetchArray()['value'];
                  echo '<option value="' . $module_path . '">' . $description . '</option>';
               }
            ?>
         </select>
         <select name="book" size="10" autocomplete="off">
            <?php
               $db = new SQLite3( $bible_modules[0], SQLITE3_OPEN_READWRITE );
               $query = $db->query('SELECT * FROM books');
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


      </form>



          <?php

         // get books list
         $results = $db->query('SELECT * FROM books');

         $books = [];
         $i = 0;
         while ($row = $results->fetchArray()) {
            $i++;
            $books[$i]['num'] = $row['book_number'];
            $books[$i]['name'] = $row['long_name'];
            if ($i == 66) break;
         }
         
         echo '<pre>';
         var_export($books);
         echo '</pre>';

         // $book_chapters_query = $db->query('SELECT DISTINCT	chapter FROM verses WHERE book_number ==' . $book_number);
         
         
      ?>
         <div>
            Video URL: <input id="video_url" type="text"> 
            <input id="download" type="button" value="Download">
         </div>
         <div id="result"></div>
         <script>
            function updateText(video_url) {
                  var ajax = new XMLHttpRequest();
                  ajax.onreadystatechange = function() {
                     if (this.readyState == 3) {
                        var old_value = document.getElementById("result").innerHTML; 
                        document.getElementById("result").innerHTML = this.responseText;
                     }               
                  };          
                  var url = 'ajax.php?video_url='+video_url;
                  ajax.open('GET', url,true);
                  ajax.send();
            }
            document.getElementById("download").onclick = function(){
               video_url = document.getElementById("video_url").value;
                  updateText(video_url);
            }
         </script>
   </body>
</html>


<?php

   
   




   
