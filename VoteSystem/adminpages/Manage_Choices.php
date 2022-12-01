<?php

session_start();
$user = $_SESSION['user'];
$id = $_SESSION['id'];

include(dirname(__DIR__) . '/Helpers.php');
require(dirname(__DIR__) . '/Connection.php');

?>
<!DOCTYPE html>
<html>

<head>
    <title>Home Page Title</title>
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Homepage.css" />
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/popup_admin_choices.css" />
    <script src="/VoteSystem/Javascript/pop_handler.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <h2><?php echo $user ?></h2>
    <?php
    profile_pic();

    ?>


    <div>
        <h3>HOME</h3>
        <nav>
            <ul>

                <li><a href="/VoteSystem/adminpages/homepage.php"> DASHBOARD</a></li>
                <li><a href="/VoteSystem/adminpages/results.php"> RESULTS</a></li>

            </ul>

        </nav>

        <h3>MANAGE</h3>
        <nav>
            <ul>

                <li><a href="/VoteSystem/adminpages/Manage_Polls.php"> POLL </a></li>
                <li><a href="/VoteSystem/adminpages/Manage_Choices.php"> CHOICES</a></li>
                <li><a href="/VoteSystem/adminpages/Manage_Voters.php"> VOTERS</a></li>


            </ul>
        </nav>

        <h3>SETTINGS</h3>
        <nav>
            <ul>
                <li><a href="/VoteSystem/adminpages/settings.php"> USER</a></li>
            </ul>
        </nav>
    </div>

    <form action="/VoteSystem/logout.php" method="POST">
        <button type="submit" name="logout" class="btn btn-primary">Logout</button>
    </form>

    <div class="popup" id="add_selection">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup_addselection()">&times;</div>
            <h1>Add New Selection</h1>
            <form action="/VoteSystem/FormHandlers/action_addcandidates.php" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <title>Add Selection </title>
                    <br>
                    <label for="new_choice">Entry:</label>
                    <input type="text" id="new_choice" name="new_choice"></input>
                    <br>
                    <label for="img">Choose File:</label><br>
                    <input type="file" id="img_upload" name="img_upload" required></input>
                </fieldset>
                <input class="form-button" name="submit" type="submit" value="Upload"></input>
            </form>
        </div>
    </div>

    <br><br>

    <div id="greeting"></div>

    <script type="text/javascript">
        var count = <?php echo json_encode($id); ?>;
        console.log(count);

        <?php
        $conn = new mysqli($server, $user, $pass, $dbname);
        $sql = mysqli_query($conn, "SELECT * FROM choices");
        $query = array();
        while ($row = mysqli_fetch_array($sql)) {
            $query[] = array(
                'id' => $row['Choice_ID'],
                'choice' => $row['TEXT'],
                'selections' => $row['SELECTIONS']
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
                <td>${person.choice}</td>
                <td>${person.selections}/<?php echo mysqli_num_rows($sql); ?></td>
                <td><button>Edit</button>
                <form action="/Votesystem/FormHandlers/action_deletechoice.php" method="POST">
                    <input class="form-button" type="submit" name="delete" value="Delete Choice ${person.id}">
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


    <div>
        <div>
            <button class="ui_box" id="add_voter" onclick="togglePopup_addselection()">ADD SELECTION</button>
        </div>
    </div>

    <div>
        <table>
            <thead>
                <tr>
                    <th onclick="sortColumn('id')">ID</th>
                    <th onclick="sortColumn('choice')">CHOICE</th>
                    <th onclick="sortColumn('selections')">SELECTIONS</th>
                    <th>Edit/Delete</th>
                </tr>
            <tbody id="table_data">

            </tbody>
            </thead>
        </table>
    </div>

</body>

</html>