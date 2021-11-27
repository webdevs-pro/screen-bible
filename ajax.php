<?php   
      $book_number = '10';
      $file_name = 'gen';
      $book_chapters_query = $db->query('SELECT DISTINCT	chapter FROM verses WHERE book_number ==' . $book_number);


      while ($book_chapters = $book_chapters_query->fetchArray()) {

         // echo '<pre>' . print_r($book_chapters['chapter'], true) . '</pre><br>'; // chapter number

         // fetch chapter verses
         $chapter_verses_query = $db->query('SELECT text FROM verses WHERE book_number ==' . $book_number . ' AND chapter ==' . $book_chapters['chapter']);
         
         $verse_number = 1;
         while ($verse = $chapter_verses_query->fetchArray()) {
         
            // echo($verse_number . '. ' . $verse['text'] . '<br>');

            $book_array[$book_chapters['chapter']][$verse_number] = strip_tags(preg_replace('#(<S.*?>).*?(</S>)#', '$1$2', $verse['text']));

            $verse_number++;
         }

      }


      echo '<pre>';
      var_export($book_array);
      echo '</pre>';