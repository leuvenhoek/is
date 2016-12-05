<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" href="newCSS.css">
        <meta charset="UTF-8" content="text/xml">
        <title></title>
    </head>
    <body>
        <h1>Integracja systemów</h1>
        <?php
        $s="'".$_SERVER['REMOTE_ADDR']."','".date("F j, Y")."'";
$db = new PDO('mysql:host=localhost;dbname=informatycy;charset=utf8mb4', 'root', '');        
//$db = new PDO('mysql:host=localhost;dbname=id240676_informatycy;charset=utf8mb4', 'id240676_leuvenhoek', '9AsAhYmy');
        foreach ($db->query('call liczOperacje('.$s.')') as $row) {
            if($row['COUNT(id)']>1000){
                echo 'Maksymalna liczba połączeń(10) została przekroczona. Spróbuj ponownie za godzinę';
                die();
            };
        }
        ?>
        <form action="DataById.php" method="get">
            <input list="dane" name="lista" placeholder="Jakie dane chcesz znać?">
            <datalist id="dane">
              <option value="Imie">
              <option value="Nazwisko">
              <option value="Telefon">
              <option value="Email">
              <option value="Nick">
            </datalist>
            <input type="text" name="id" placeholder="Wprowadź id"/>
            <button formaction="DataByID_xml.php" name="button" value="XML">XML</button>
            <button formaction="DataByID_xml.php" name="button" value="JSON">JSON</button>
            <button formaction="DataByID_xml.php" name="button" value="YAML">YAML</button>
            <input type="submit" value="Strona">
        </form><br/>
        <form action="DataByName.php" method="get">
         <input list="dane2" name="lista2" placeholder="Jakie dane chcesz znać?">
            <datalist id="dane2">
              <option value="Aplikacja">
              <option value="Gdzie mieszka">
              <option value="Posada">
              <option value="Język obcy">
              <option value="URL">
              <option value="Wszystko">
            </datalist>
            <input type="text" name="nick" placeholder="nick">
            <button formaction="DataByName_xml.php" name="button" value="XML">XML</button>
            <button formaction="DataByName_xml.php" name="button" value="JSON">JSON</button>
            <button formaction="DataByName_xml.php" name="button" value="YAML">YAML</button>
            <input type="submit" value="Strona">
        </form><br/><br/>
    </body>
</html>
