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
        $sql = mysqli_query($conn, "SELECT * FROM logins WHERE permission = 0");
        $query = array();
        while ($row = mysqli_fetch_array($sql)) {
            $query[] = array(
                'id' => $row['id'],
                'username' => $row['user'],
                'vote' => 'False'
            );
        }
        ?>

        let sort = false;
        let personData = <?php echo json_encode($query); ?>;

        window.onload = () => {
            loadtableData(personData);
        };

        function loadtableData(personData) {
            const tablebody = document.getElementById('table_data');
            let dataHtml = '';
            for (let person of personData) {
                dataHtml += `<tr>
                <td>${person.id}</td>
                <td>${person.username}</td>
                <td>${person.vote}</td>
                <td><button>Edit</button>
                <form action="/Votesystem/FormHandlers/action_deletevoteradmin.php" method="POST">
                    <input class="form-button" type="submit" name="delete" value="Delete user ${person.id}">
                </form></td></tr>`;
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
    <title>Home Page Title</title>
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Homepage.css" />
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/voters.css">
    <script src="/VoteSystem/Javascript/pop_handler.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
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
    <div class="popup" id="register_voter">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup_voter()">&times;</div>
            <h1>Register New Voter</h1>
            <form action="/VoteSystem/FormHandlers/action_registervoter.php" method="POST">
                <fieldset>
                    <title>Voter Information</title>
                    <label for="user">Username:</label><br>
                    <input type="text" id="user" name="user" required></input>
                    <label for="pass">Password:</label><br>
                    <input type="text" id="pass" name="pass" required></input>
                </fieldset>
                <button class="form-button" type="submit">Register</button>
            </form>
        </div>
    </div>

    <br><br>

    <div>
        <div>
            <button class="ui_box" id="add_voter" onclick="togglePopup_voter()">ADD VOTER</button>
        </div>
    </div>

    <div>
        <table>
            <thead>
                <tr>
                    <th onclick="sortColumn('id')">ID</th>
                    <th onclick="sortColumn('username')">UserName</th>
                    <th onclick="sortColumn('vote')">Vote Status</th>
                    <th>Edit/Delete</th>
                </tr>
            <tbody id="table_data">

            </tbody>
            </thead>
        </table>
    </div>
    </div>
</body>

</html>