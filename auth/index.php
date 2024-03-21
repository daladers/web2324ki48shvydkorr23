<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
$username = $_SESSION["user"]["fullname"]
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>User Dashboard</title>
</head>
<body>
    <div class="container mt-5 d-flex flex-column justify-content-center align-items-center">
        <h1 class="text-center">Welcome to Dashboard, <?php echo $username  ?></h1>
        <div class="d-flex justify-content-center">
            <a href="login.php" class="btn btn-warning">Logout</a>
        </div>
        <section class="mt-5">
            <h1 class="text-center">Write about yourself</h1>
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <span>Status:</span>
                        <span id="status"></span>
                    </div>
                </div>
                <form id="myForm" class="mt-3">
                    <div class="mb-3">
                        <label for="statusId" class="form-label">Status edit</label>
                        <textarea class="form-control" id="statusId" name="status" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="d-grid gap-2 mx-auto">
                                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
 <script>
        // Function to make the AJAX request
        function fetchData() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'data.php', true);

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    const result=JSON.parse(xhr.response) 
                    console.log(result)
                    document.getElementById("status").innerHTML=result.status
                } else {
                    // Request failed, handle the error
                    console.error('Request failed with status:', xhr.status);
                }
            };
            xhr.onerror = function() {
                // Handle network errors
                console.error('Request failed');
            };
            xhr.send();
        }
        
       function stress(){
        setInterval(()=>{  fetch("http://localhost/auth/data.php")},3000)
}

        // Call the fetchData function when the page loads
        window.onload =()=> {
            fetchData()
            stress()

        };
        
        // Function to make the AJAX request
        function sendData() {
            var xhr = new XMLHttpRequest();
            var formData = new FormData(document.getElementById('myForm'));
            console.log(formData);
            xhr.open('POST', 'data.php', true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                   fetchData()
                } else {
                    // Request failed, handle the error
                    console.error('Request failed with status:', xhr.status);
                }
            };

            xhr.onerror = function() {
                // Handle network errors
                console.error('Request failed');
            };

            xhr.send(formData);
        }

        // Call the sendData function when the form is submitted
        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault();
            sendData();
        });
    </script>
</body>
</html>