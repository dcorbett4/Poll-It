<?php

session_start();
$user = $_SESSION['user'];
$id = $_SESSION['id'];

include(dirname(__DIR__) . '/Helpers.php');
require(dirname(__DIR__) . '/Connection.php');

?>
   <script type="text/javascript">

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
            <td><img width="15%"id="profile_picture" src = "/VoteSystem/Choice_Imgs/${person.img_name}" alt="Profile_Picture"></td>
            <td>                
                <form action="/Votesystem/FormHandlers/action_uservote.php" method="POST">
                    <input class="table_btn" type="submit" name="vote" value="Vote for ${person.id}">
                </form>
            </td>
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
    <title>Home Page Title</title>
    <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Homepage.css?ver=2.0" />
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
            <h4 id="username"><?php echo $_SESSION['user']; ?></h4>
        </center>

        <a href="/VoteSystem/userpages/homepage_user.php"><i class="fa fa-home" aria-hidden="true"></i><span>DASHBOARD</span></a>
        <a href="/VoteSystem/userpages/results_user.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span>RESULTS</span></a>
 
        <a href="/VoteSystem/userpages/vote_user.php"><i class="fa fa-check-to-slot" aria-hidden="true"></i><span>VOTE</span></a>
        <a href="/VoteSystem/userpages/settings_user.php"><i class="fa fa-cogs" aria-hidden="true"></i><span>SETTINGS</span></a>
    </div>

    <div class="content">
    <div id="votenfo">
    <h1 class="voter"> <?php err_display_vote(); ?> <h1>
        
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th onclick="sortColumn('id')">ID</th>
                    <th onclick="sortColumn('choice')">CHOICE</th>
                    <th> IMAGE</th>
                    <th>VOTE</th>
                </tr>
            <tbody id="table_data">

            </tbody>
            </thead>
        </table>
    </div>
    </div>

</body>

</html>