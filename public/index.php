<?php


/**
 * Settings Class
 */
class footballLeagueDataSettings
{

    function main()
    {


        $jsonString = file_get_contents('database_tv.json');
        $data = json_decode($jsonString, true);

        $data['db_host'] = $db_host;
        $data['db_name'] = $db_name;
        $data['db_user'] = $db_user;
        $data['db_pass'] = $db_pass;

        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if ($connection) {
            header("location: file-data.php");
        }

        // if($db_host != "xxxx" && $db_host != "xxxx" && $db_host != "xxxx" && $db_host != "xxxx")
        // {
        //     header("location: file-data.php");
        // }

        if (isset($_POST['db_host'])) {


            $db_host = $_POST['db_host'];
            $db_name = $_POST['db_name'];
            $db_user = $_POST['db_user'];
            $db_pass = $_POST['db_pass'];

            $jsonString = file_get_contents('database_tv.json');
            $data = json_decode($jsonString, true);

            $data['db_host'] = $db_host;
            $data['db_name'] = $db_name;
            $data['db_user'] = $db_user;
            $data['db_pass'] = $db_pass;

            $newJsonString = json_encode($data);
            file_put_contents('database_tv.json', $newJsonString);
        }

        $jsonString = file_get_contents('database_tv.json');
        $data = json_decode($jsonString, true);


        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        $txt = "John Doe\n";
        fwrite($myfile, $txt);
        $txt = "Jane Doe\n";
        fwrite($myfile, $txt);
        fclose($myfile);

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <style>
                .teamlogo {
                    width: 60px;
                    height: 60px;
                    transition: transform .2s;
                    /* Animation */
                    cursor: pointer;
                    margin: 0 auto;
                    padding: 5px;

                    transition: linear .1s;
                }

                .playerimg {
                    width: 60px;
                    height: 60px;
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 25px 0 rgba(0, 0, 0, 0.19);
                }

                .teamlogo:hover {
                    transform: scale(1.1);
                    /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
                }

                .logodiv {
                    vertical-align: middle;
                }

                .centeralign {
                    margin-top: auto;
                    margin-bottom: auto;
                    font-weight: bold;
                }

                .triangle {
                    border-color: transparent transparent rgb(12, 111, 223) transparent;
                    border-style: solid;
                    border-width: 0px 20px 20px 20px;
                    height: 0px;
                    width: 0px;
                }

                .triangle:hover {
                    cursor: pointer;
                }

                .rowbn {
                    /* border: 0.5px solid rgb(150, 146, 197); */
                    border-radius: 15px;
                    margin: 3px;
                    /* cursor: pointer; */
                    box-shadow: 1px 1px 2px black, 0 0 25px rgb(36, 91, 240), 0 0 5px rgb(17, 59, 177);
                    margin-top: 10px;
                }

                .bordersm {
                    border-radius: 1px;
                }

                .flip {
                    transform: rotate(-180deg);
                    transition-duration: 0.5s;
                }

                .tablediv {
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 25px 0 rgba(0, 0, 0, 0.19);
                    padding-top: 20px;
                    overflow-x: scroll;
                }

                .bigger {
                    width: 70px;
                    height: 70px;
                    transition-duration: 0.1s;

                }

                .center {
                    margin: auto;
                    width: 50%;
                    border: 3px solid white;
                    padding: 10px;
                    background-color: white;
                    margin-top: 5%;
                }
            </style>
            <script>
                function toggletable(num) {
                    console.log("FG")
                    let x = document.getElementById(num + "table");
                    if (x.style.display === "none") {
                        x.style.display = "block";
                    } else {
                        x.style.display = "none";
                    }
                }

                function rotate_trng(num) {
                    let element = document.getElementById(num + "triangle");
                    element.classList.toggle("flip");
                }

                function zoomimg(num) {

                }

                function underrow(num) {
                    console.log(num + "  entered")
                    let element = document.getElementById(num + "logo");
                    element.classList.toggle("bigger");
                }

                function underrowleave(num) {
                    console.log(num + "  leave")
                    let element = document.getElementById(num + "logo");
                    element.classList.toggle("bigger");
                }
            </script>
            <script src="chrome-extension://mooikfkahbdckldjjndioackbalphokd/assets/prompt.js"></script>



        </head>

        <body cz-shortcut-listen="true">
            <div class="container col-md-8 bg-white text-black center" style="height: 7 0vh; ">
                <form action="" enctype="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Host</label>
                        <input type="text" class="form-control" id="dbhost" name="db_host" placeholder="<?php echo $data['db_host']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Database Name:</label>
                        <input type="text" class="form-control" id="dbname" name="db_name" placeholder="<?php echo $data['db_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">User:</label>
                        <input type="text" class="form-control" id="dbuser" name="db_user" placeholder="<?php echo $data['db_user']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password:</label>
                        <input type="password" class="form-control" id="dbpass" name="db_pass" placeholder="<?php echo $data['db_pass']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </body>

        </html>
<?php    }
};

$FLDSettings = new footballLeagueDataSettings;
