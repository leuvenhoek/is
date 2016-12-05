    <?php
        
        //$db = new PDO('mysql:host=localhost;dbname=id240676_informatycy;charset=utf8mb4', 'id240676_leuvenhoek', '9AsAhYmy');
        $db = new PDO('mysql:host=localhost;dbname=informatycy;charset=utf8mb4', 'root', '');
                        $q="call dajWszystko('".$_GET["nick"]."')";
            $what='imie';
            if($_GET["lista2"]=="URL"){
                $what='strona_url';
            }else if($_GET["lista2"]=="Posada"){
                $what='stanowisko';
            }else if($_GET["lista2"]=="Język obcy"){
                $what='jezyk';
            }else if($_GET["lista2"]=="Gdzie mieszka"){
                $what='miasto';
            }else if($_GET["lista2"]=="Aplikacja"){
                $what='aplikacja';
            }
            if($_GET["lista2"]=="Wszystko"){
                foreach($db->query($q) as $row) {
                    echo $row["imie"]."</br>";
                    echo $row["nazwisko"]."</br>";
                    echo $row["telefon"]."</br>";
                    echo $row["miasto"]."</br>";
                    echo $row["email"];
                }    
            }else{
                foreach($db->query($q) as $row) {
                    echo $row[$what]."\n";
                }    
            }
            
            $s="'".$_SERVER['REQUEST_URI']."','".date("F j, Y")."','".date("g:i a")."','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."'";
            $db->query('call aktualizujLog('.$s.')');       
        ?>
