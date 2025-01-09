<?php
$con = mysqli_connect("localhost","root","","dbmovies");
if(!$con)
    die ("Connection Failed".mysqli_connect_error());
include '../components/adminfixed.php'
?>
<section>
<?php 
$sql = "SELECT id, name, email FROM users";
$result = $con->query($sql);

if ($result->num_rows > 0) {
?>
<h1>Registered Users</h1>
    <table>
        <tr>
            <th>I.D.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
<?php
    // output data of each row
    while($row = $result->fetch_assoc()) {    
    echo "<tr>";
    echo "<td>".$row["id"]."</td>";
    echo "<td>".$row["name"]."</td>";
    echo "<td>".$row["email"]."</td>";
    echo "<td><a class='btn btndelete' id=".$row['id'].">Delete</a></td>";
    echo "</tr>";
    }
} else {
    echo "<h2>Oops! It looks like there are no registered users</h2>";
}
$con->close();
?>
    </table>
</section>
<script>
    var x =document.querySelectorAll(".btndelete");
    x.forEach(del => {
        del.addEventListener("click", ()=> {
            var li = del.getAttribute("id");
            var check = confirm("Do you want to delete this user?");
            if(check === true) {
                let file = "delete.php?id="+li+"&tbl=users&self=manageusers";
                window.location.replace(file);
            }
        });
    });
</script>
</body>
</html>