<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query Buttons</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">My Website</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/Tables/person.php">Person</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Tables/employee.php">Employees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Tables/student.php">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Tables/facility.php">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Tables/vaccination.php">Vaccinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Tables/infection.php">Infections</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ShowQueries.php">Show Queries</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5 text-center">
        <h2>Select a Query to Display Results</h2>
        <div class="row mt-4">
            <div class="col-md-6 offset-md-3">
                <button class="btn btn-primary btn-block mb-2" id="query1Btn">Query 1</button>
                <button class="btn btn-success btn-block mb-2" id="query2Btn">Query 2</button>
                <button class="btn btn-info btn-block mb-2" id="query3Btn">Query 3</button>
                <button class="btn btn-warning btn-block mb-2" id="query4Btn">Query 4</button>
                <button class="btn btn-danger btn-block mb-2" id="query5Btn">Query 5</button>
                <button class="btn btn-secondary btn-block mb-2" id="query6Btn">Query 6</button>
                <button class="btn btn-primary btn-block mb-2" id="query7Btn">Query 7</button>
                <button class="btn btn-success btn-block mb-2" id="query8Btn">Query 8</button>
                <button class="btn btn-info btn-block mb-2" id="query9Btn">Query 9</button>
                <button class="btn btn-warning btn-block mb-2" id="query10Btn">Query 10</button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6 offset-md-3">
                <div id="queryResults" class="text-center"></div>
            </div>
        </div>
    </div>

   
    <script>
    
    function displayResults(queryNumber) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'QueriesResult.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('queryResults').innerHTML = xhr.responseText;
                } else if (xhr.readyState === 4) {
                    document.getElementById('queryResults').innerHTML = '<p class="text-danger">Error fetching results.</p>';
                }
            };
            xhr.send('queryNumber=' + queryNumber);
        }

        document.getElementById('query1Btn').addEventListener('click', function () {
            displayResults(1);
        });

        document.getElementById('query2Btn').addEventListener('click', function () {
            displayResults(2);
        });

        document.getElementById('query3Btn').addEventListener('click', function () {
            displayResults(3);
        });

        document.getElementById('query4Btn').addEventListener('click', function () {
            displayResults(4);
        });

        document.getElementById('query5Btn').addEventListener('click', function () {
            displayResults(5);
        });

        document.getElementById('query6Btn').addEventListener('click', function () {
            displayResults(6);
        });

        document.getElementById('query7Btn').addEventListener('click', function () {
            displayResults(7);
        });

        document.getElementById('query8Btn').addEventListener('click', function () {
            displayResults(8);
        });

        document.getElementById('query9Btn').addEventListener('click', function () {
            displayResults(9);
        });

        document.getElementById('query10Btn').addEventListener('click', function () {
            displayResults(10);
        });


</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
