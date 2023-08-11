<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query Buttons</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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
                <button class="btn btn-danger btn-block mb-2" id="query11Btn">Query 11</button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6 offset-md-3">
                <div id="queryResults" class="text-center"></div>
            </div>
        </div>
    </div>

   
    <script>
    $(document).ready(function () {
        function displayResults(queryNumber) {
            $.ajax({
                url: 'QueriesResult.php', 
                method: 'POST',
                data: { queryNumber: queryNumber },
                success: function (data) {
                    $('#queryResults').html(data); 
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    $('#queryResults').html('<p class="text-danger">Error fetching results.</p>');
                }
            });
        }

        $('#query1Btn').click(function () {
            displayResults(1);
        });

        $('#query2Btn').click(function () {
            displayResults(2);
        });

        $('#query3Btn').click(function () {
            displayResults(3);
        });

        $('#query4Btn').click(function () {
            displayResults(4);
        });

        $('#query5Btn').click(function () {
            displayResults(5);
        });

        $('#query6Btn').click(function () {
            displayResults(6);
        });

        $('#query7Btn').click(function () {
            displayResults(7);
        });

        $('#query8Btn').click(function () {
            displayResults(8);
        });

        $('#query9Btn').click(function () {
            displayResults(9);
        });

        $('#query10Btn').click(function () {
            displayResults(10);
        });
        

        $('#query11Btn').click(function () {
            displayResults(11);
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
