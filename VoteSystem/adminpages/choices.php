<?php

session_start();
$user = $_SESSION['user'];
$id = $_SESSION['id'];

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home Page Title</title>
        <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/Homepage.css" /> 
        <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/popup.css" />
        <link rel="stylesheet" type="text/css" href="/VoteSystem/StyleS/voters.css">
        <script src="/VoteSystem/Javascript/pop_handler.js"></script> 
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    
    <body>

    <h2><?php echo $user?></h2>
    <div>
        <img id="profile_pic" src ="/VoteSystem/User_Imgs/defaultimg.jpg" alt="Default_User Image">

    </div>


    <div>
    <h3>HOME</h3>
        <nav>
            <ul>

                <li><a href="/VoteSystem/homepage.php"> DASHBOARD</a></li>
                <li><a href="#"> RESULTS</a></li>

            </ul>

        </nav>

        <h3>MANAGE</h3>
        <nav>
            <ul>

                <li><a href="#"> POLL </a></li>
                <li><a href="#"> CHOICES</a></li>
                <li><a href="/VoteSystem/Manage_Voters.php"> VOTERS</a></li>
                

            </ul>
        </nav>

        <h3>SETTINGS</h3>
        <nav>
            <ul>
                <li><a href="/VoteSystem/settings.php"> USER</a></li>
            </ul>
        </nav>
    </div>

    <form action="/VoteSystem/logout.php" method="POST"> 
      <button type="submit" name="logout" class="btn btn-primary">Logout</button>
    </form>

    <div class="popup" id="image_upload">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup()">&times;</div>
            <h1>Upload New Image</h1>
            <form action="#" method="POST">
                <fieldset>
                    <title>Upload Image </title>
                    <label for="img_upload">Choose File:</label><br>
                    <input type="file" id="img_upload" name="img"></input>
                </fieldset>
                <button class="form-button" type="submit">Upload</button>
            </form>
        </div>
    </div>

    <br><br>

    <div id="greeting"></div>

<script type="text/javascript">  
 var count = <?php echo json_encode($id); ?>;
 console.log(count);

        let sort = false;
        let personData = [
            {id: 2,username:'money',vote:'False' },
            {id: 2,username:'comes',vote:'True' },
            {id: 1,username:'easy',vote:'False' },
            {id: 3,username:'pretty',vote:'True' },
            {id: 5,username:'lady',vote:'False' }
        ];

    window.onload = () => {
        loadtableData(personData);
    };

    function loadtableData(personData) {
        const tablebody = document.getElementById('table_data');
        let dataHtml = '';
        for(let person of personData) {
            dataHtml += `<tr><td>${person.id}</td><td>${person.username}</td><td>${person.vote}</td><td><button>Edit</button><button>Delete</button></td></tr>`;
        }
        tablebody.innerHTML = dataHtml;
       }
    

    function sortColumn(colName){
        const dataType = typeof personData[0][colName];
        sort = !sort;
        

        switch(dataType){
            case 'number':
            sortNumCol(sort,colName);
            break;

            case 'string':
            sortCharCol(sort,colName);
            break;
            
            case 'boolean':
            sortNumCol(sort,colName);
            break;
        }
        
            loadtableData(personData);
    }

    function sortNumCol(sort, colName){
        personData = personData.sort((p1,p2) => {
            return sort ?  p1[colName] - p2[colName] : p2[colName] - p1[colName]
        });
    }

    function sortCharCol(sort, colName){
        personData = personData.sort((p1, p2) => {
        return sort ? ('' + p1[colName]).localeCompare(p2[colName]) : ('' + p2[colName]).localeCompare(p1[colName])
        });
    }
</script>


    <div>
        <div>
        <button class="ui_box" id="add_voter"onclick="togglePopup()">ADD BALLOT</button>
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

    </body>
</html>