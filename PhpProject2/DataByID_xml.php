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
            $xml=new DomDocument('1.0');
            $informatycy=$xml->createElement("informatycy");
            $xml->appendChild($informatycy);
            
            foreach($db->query($q) as $row) {
                $kategoria=$xml->createElement($what,$row[$what]);
                $informatycy->appendChild($kategoria);
                $data=$what." : ".$row[$what];
            }
            
            $s="'".$_SERVER['REQUEST_URI']."','".date("F j, Y")."','".date("g:i a")."','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."'";
            $db->query('call aktualizujLog('.$s.')'); 
            
            if($_GET["button"]=="JSON"){
                $s = simplexml_import_dom($xml);
                $json = json_encode($s);
                echo $json;
                $array = json_decode($json,TRUE);
                header('Content-Type: application/json');
                header('Content-Disposition: attachment; filename="text.json"'); 
            }else if($_GET["button"]=="XML"){
                echo "<xmp>".$xml->saveXML()."</xmp>";
                header('Content-type: text/xml');
                header('Content-Disposition: attachment; filename="text.xml"');
            }else{
                $file = 'wynik.yml';        
                file_put_contents($file, $data);
                header('Content-Type: application/octet-stream');
                header("Content-Transfer-Encoding: Binary"); 
                header("Content-disposition: attachment; filename=\"" . basename($file) . "\""); 
                readfile($file);
            }
                   
        ?>
