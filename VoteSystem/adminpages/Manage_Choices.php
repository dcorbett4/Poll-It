<?php

session_start();
$user = $_SESSION['user'];
$id = $_SESSION['id'];

include(dirname(__DIR__) . '/Helpers.php');
require(dirname(__DIR__) . '/Connection.php');

?>
<!DOCTYPE html>
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
                'img_name' => $row['IMAGE']
            );
        }
        $sql2 = mysqli_query($conn, "SELECT * FROM logins");
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
                <td><img width="15%"id="profile_picture" src = "/VoteSystem/Choice_Imgs/${person.img_name}" alt="Profile_Picture"> </td>
                <td>
                <form action="/Votesystem/FormHandlers/action_deletechoice.php" method="POST">
                    <input  class="table_btn" type="submit" name="delete" value="Delete Choice ${person.id}">
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



<html>

<head>
    <title>Home Page Title</title>
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Homepage.css" />
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/popup_admin_choices.css?ver=5.0" />
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
    <div id="voteinfo">
    <h1 class="voter"> <?php  if(isset($_SESSION['cand_err'][0])) {print_r($_SESSION['cand_err'][0]);  unset($_SESSION['cand_err']); } ?> <h1>
        
    </div>
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
    


    <div>
        <div>
            <button class="ui_box" id="add_voter" onclick="togglePopup_addselection()"><i class="fa-solid fa-circle-plus"></i></button>
        </div>
    </div>


    <div>
    <i class="fa-solid fa-circle-plus"></i>
        <table>
            <thead>
                <tr>
       
                    <th onclick="sortColumn('id')">ID</th>
                    <th onclick="sortColumn('choice')">CHOICE</th>
                    <th>IMAGES</th>
                    <th>Delete</th>
                </tr>
            <tbody id="table_data">

            </tbody>
            </thead>
        </table>
    </div>

    </div>
    </div>
    </div>
</body>

</html>