        <?php
        $db = new PDO('mysql:host=localhost;dbname=informatycy;charset=utf8mb4', 'root', '');
        //$db = new PDO('mysql:host=localhost;dbname=id240676_informatycy;charset=utf8mb4', 'id240676_leuvenhoek', '9AsAhYmy');
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
            $file = 'wynik.yml';
            file_put_contents($file,"\n");
            $xml=new DomDocument('1.0');
            $informatycy=$xml->createElement("informatycy");
            $xml->appendChild($informatycy);
            if($_GET["lista2"]=="Wszystko"){
                foreach($db->query($q) as $row) {
                    $imie=$xml->createElement("imie",$row["imie"]);
                    $informatycy->appendChild($imie);
                    file_put_contents($file,"imie : ".$row["imie"]."\n",FILE_APPEND);
                    $nazwisko=$xml->createElement("nazwisko",$row["nazwisko"]);
                    $informatycy->appendChild($nazwisko);
                    file_put_contents($file,"nazwisko : ".$row["nazwisko"]."\n",FILE_APPEND);
                    $telefon=$xml->createElement("telefon",$row["telefon"]);
                    $informatycy->appendChild($telefon);
                    file_put_contents($file,"telefon : ".$row["telefon"]."\n",FILE_APPEND);
                    $miasto=$xml->createElement("miasto",$row["miasto"]);
                    $informatycy->appendChild($miasto);
                    file_put_contents($file,"miasto : ".$row["miasto"]."\n",FILE_APPEND);
                    $email=$xml->createElement("email",$row["email"]);
                    $informatycy->appendChild($email);
                    file_put_contents($file,"email : ".$row["email"]."\n",FILE_APPEND);
                }    
            }else{
                foreach($db->query($q) as $row) {
                    $kategoria=$xml->createElement($what,$row[$what]);
                    $informatycy->appendChild($kategoria);
                    file_put_contents($file,$what." : ".$row[$what]);
                }    
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
                
                header('Content-Type: application/octet-stream');
                header("Content-Transfer-Encoding: Binary"); 
                header("Content-disposition: attachment; filename=\"" . basename($file) . "\""); 
                readfile($file);
            }
        ?>
