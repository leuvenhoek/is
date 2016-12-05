    <?php
        
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        if (!$id) {
            echo 'Podane dane są niedopuszczalne';
            die();
        }
        $db = new PDO('mysql:host=localhost;dbname=informatycy;charset=utf8mb4', 'root', '');
        //$db = new PDO('mysql:host=localhost;dbname=id240676_informatycy;charset=utf8mb4', 'id240676_leuvenhoek', '9AsAhYmy');
            $q='call dajImie('.$_GET["id"].')';
            $what='imie';
            if($_GET["lista"]=="Imie"){
                $q='call dajImie('.$_GET["id"].')';
                $what='imie';
            }else if($_GET["lista"]=="Nazwisko"){
                $q='call dajNazwisko('.$_GET["id"].')';
                $what='nazwisko';
            }else if($_GET["lista"]=="Telefon"){
                $q='call dajTelefon('.$_GET["id"].')';
                $what='telefon';
            }else if($_GET["lista"]=="Email"){
                $q='call dajEmail('.$_GET["id"].')';
                $what='email';
            }else if($_GET["lista"]=="Nick"){
                $q='call dajNick('.$_GET["id"].')';
                $what='nick';
            }
            foreach($db->query($q) as $row) {
                echo $row[$what]."\n";
            }
            
            $s="'".$_SERVER['REQUEST_URI']."','".date("F j, Y")."','".date("g:i a")."','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."'";
            $db->query('call aktualizujLog('.$s.')');       
        ?>
