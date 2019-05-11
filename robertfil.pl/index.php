<!DOCTYPE html>
<html lang="PL-pl">
    <head>
        <title>Komis Samochodowy</title>
        <link rel="stylesheet" type="text/css" href="auto.css">
    </head>
    <body>
        <header>
            <h1>SAMOCHODY</h1>
        </header>
        <div class="left">
            <h2>Wykaz samochodów</h2>
            <ul>
  
            <?php

                $connection = mysqli_connect("192.168.100.20", "root", "test1995test", "komis");
    
                $sql = "SELECT `id`, `marka`, `model` FROM `samochody`";
                $result = mysqli_querry($connection, $sql);

                while($rows = mysqli_fetch_row($result)) {
                echo '<li>'.$rows[0].' '.$rows[1].' '.$rows[2].'</li>';
                }

                mysqli_close($connection);
            ?>

            </ul>
            <h2>Zamówienia</h2>
            <ul>
            <?php

                $connection = mysqli_connect("192.168.100.20", "root", "test1995test", "komis");

                $sql = "SELECT `Samochody_id`, `Klient` FROM `zamowienia`";
                $result = mysqli_querry($connection, $sql);

                while($rows = mysqli_fetch_row($result)) {
                echo '<li>'.$rows[0].' '.$rows[1].'</li>';
                }

                mysqli_close($connection);
            ?>
            </ul>

        </div>
        <div class="right">
            <h2>Pełne dane: Fiat</h2>
            <?php

                $connection = mysqli_connect("192.168.100.20", "root", "test1995test", "komis");

                $sql = 'SELECT * FROM `samochody` WHERE `marka` = "Fiat"';
                $result = mysqli_querry($connection, $sql);

                while($rows = mysqli_fetch_row($result)) {
                echo $rows[0].' / '.$rows[1].' / '.$rows[2].' / '.$rows[3].' / '.$rows[4].' / '.$rows[5].'<br />';
                }

                mysqli_close($connection);
            ?>
        </div>
        <footer>
            <table>
                <tbody>
                    <tr>
                        <td><a href="kwerendy.txt"></td>
                        <td><p>Autor</p><p>906660666</p></td>
                        <td><img src="auto.png" alt="komis samochodowy"></td>
                    </tr>
                </tbody>
            </table>

        </footer>

    </body>
</html>
