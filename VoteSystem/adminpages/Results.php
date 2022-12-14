<?php

session_start();
$user = $_SESSION['user'];
$id = $_SESSION['id'];

include(dirname(__DIR__) . '/Helpers.php');
require(dirname(__DIR__) . '/Connection.php');

?>
    <script type="text/javascript">
        var count = <?php echo json_encode($id); ?>;
        console.log(count);

        <?php
        $conn = new mysqli($server, $user, $pass, $dbname);
        $sql = mysqli_query($conn, "SELECT * FROM choices");
        $query = array();
        while ($row = mysqli_fetch_array($sql)) {
            $query[] = array(
                'choice' => $row['TEXT'],
                'selections' => $row['SELECTIONS'],
            );
        }
        ?>

        let sort = false;
        let personData = <?php echo json_encode($query); ?>;

        window.onload = () => {
            loadtableData(personData);
            sortColumn('selections');
            sortColumn('selections');
        };

        function loadtableData(personData) {
            const tablebody = document.getElementById('table_data');
            let dataHtml = '';
            for (let person of personData) {
                dataHtml += `<tr>
                    <td>${person.choice}</td>
                    <td>${person.selections}</td>
                    </tr>`;
            }
            tablebody.innerHTML = dataHtml;
        }


        function sortColumn(colName) {
            const dataType = typeof personData[0][colName];
            sort = !sort;


            switch (dataType) {
                case 'number':
                    sortNumCol(sort, colName);
                    break;

                case 'string':
                    sortCharCol(sort, colName);
                    break;

                case 'boolean':
                    sortNumCol(sort, colName);
                    break;
            }

            loadtableData(personData);
        }

        function sortNumCol(sort, colName) {
            personData = personData.sort((p1, p2) => {
                return sort ? p1[colName] - p2[colName] : p2[colName] - p1[colName]
            });
        }

        function sortCharCol(sort, colName) {
            personData = personData.sort((p1, p2) => {
                return sort ? ('' + p1[colName]).localeCompare(p2[colName]) : ('' + p2[colName]).localeCompare(p1[colName])
            });
        }
    </script>
    


<!DOCTYPE html>
<html>
<head>
    <title>Results</title>
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Homepage.css" />
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/popup_admin_choices.css" />
    <script src="/VoteSystem/Javascript/pop_handler.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
    <div  class="left_side">
        <h2 >POLL <span>IT</span></h2>
    </div>

    <div id="center">
     
    </div>

    <div class="right_side">
        <a  href="/VoteSystem/logout.php" name="logout"  class="logout_btn">Logout</a>
    </div>


    </header>
    
    <div class="navbar">
        <center>
            <?php
            profile_pic();
            ?>
            <h4 id="username"> <?php echo $_SESSION['user']; ?></h4>
        </center>

        <a href="/VoteSystem/adminpages/homepage.php"><i class="fa fa-home" aria-hidden="true"></i><span>DASHBOARD</span></a>
        <a href="/VoteSystem/adminpages/Results.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span>RESULTS</span></a>
 
        <a href="/VoteSystem/adminpages/Manage_Polls.php"><i class="fa fa-question" aria-hidden="true"></i><span>POLL</span></a>
        <a href="/VoteSystem/adminpages/Manage_Choices.php"><i class="fa fa-th" aria-hidden="true"></i><span>CHOICES</span></a>
        <a href="/VoteSystem/adminpages/Manage_Voters.php"><i class="fa fa-user" aria-hidden="true"></i><span>VOTERS</span></a>
        <a href="/VoteSystem/adminpages/settings.php"><i class="fa fa-cogs" aria-hidden="true"></i><span>SETTINGS</span></a>
    </div>

  

    <div class="content">
    <div>
        <table>
            <thead>
                <tr>
                    <th onclick="sortColumn('choice')">CHOICE</th>
                    <th onclick="sortColumn('selections')">SELECTIONS</th>
                </tr>
            <tbody id="table_data">

            </tbody>
            </thead>
        </table>
    </div>
        

        
    </div>


</body>

</html>
