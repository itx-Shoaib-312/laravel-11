<!doctype html>
<html lang="en">

<head>
    <title>Laravel 11</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--   CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header class="container-fluid bg-dark">
        <nav class="navbar navbar-expand-sm navbar-dark ">
            <a class="navbar-brand" href="#">Laravel 11</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavId">
                <h4 class="text-white ">Ajax..!</h4>
            </div>
        </nav>
    </header>
    <main class=" justify-content-center align-items-center">
        <div class="container my-5 px-5 ">
            <span id="output" class="bg-success"></span>
            <div class="card my-2 border-2">
                <div class="card-body">
                    <form id="my_form">
                        @csrf
                        <div class="container">
                            <div class="mb-3 row">
                                <input type="hidden" class="form-control" name="id" id="id" />
                                <div class="col-4">
                                    <label for="fname" class="col-form-label">First Name</label>
                                    <input type="text" class="form-control" name="fname" id="fname"
                                        placeholder="First Name" />
                                </div>

                                <div class="col-4">
                                    <label for="lname" class=" col-form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lname" id="lname"
                                        placeholder="Last Name" />
                                </div>

                                <div class="col-4">
                                    <label for="email" class=" col-form-label">E-mail</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="@gmail.com" />
                                </div>
                            </div>
                            <div class="container text-end">

                                <button type="submit" class="btn btn-primary ">Add Details</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row  ">
                <div class="col-6">
                    <h3>Show Records</h3>
                </div>
                <div class="col-6 text-end">
                    <!--  Modal trigger button  -->
                    <div class="mb-3 row">
                        <label for="search" class="col-4 col-form-label">Search</label>
                        <div class="col-8">
                            <input type="search" class="form-control" name="search" id="search"
                                placeholder="Search..." />
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-primary" id="student-table">
                    <thead>
                        <tr>
                            <th scope="col">Sr No.</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        </div>

    </main>
    <footer>

    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            get_data();
            $('#my_form').submit(function(event){
                event.preventDefault();
                var form = $("#my_form")[0];
                // console.log(event);
                var data =new FormData(form);
                // console.log(data);
                $.ajax({
                    url:'{{route('add-record')}}',
                    type:"POST",
                    data:data,
                    processData:false,
                    contentType:false,
                    success: function(response){
                        // console.log(response);
                        $("#id").val('');
                        $("#fname").val('');
                        $("#lname").val('');
                        $("#email").val('');
                        console.log(response);
                        $('#student-table tbody').empty();

                        get_data();

                    }
                });

            });


            function get_data(){
                $.ajax({
                    url: '{{ route('get-record') }}',
                    type: 'GET',

                    success: function(data){
                        console.log(data);
                        // Clear existing rows
                        $('#student-table tbody').empty();
                        // Append new rows

                        data.forEach(function(item, index) {

                            $('#student-table tbody').append(`
                                <tr class="">
                                    <td scope="row">${index + 1}</td>
                                    <td scope="row">${item.fname}</td>
                                    <td scope="row">${item.lname}</td>
                                    <td scope="row">${item.email}</td>
                                    <td scope="row">
                                        <button type="button" id="fetch_data${item.id}" class="btn btn-warning">Edit</button>
                                        <button type="button" id="del-data${item.id}"  class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            `);
                        });
                    },
                    error: function(xhr, status, error){
                        console.error("XHR Status:", status);
                        console.error("Error:", error);
                        console.error("Response:", xhr.responseText);
                    }
                });
            }



            $(document).on('click', '[id^="del-data"]', function() {
                var id = $(this).attr('id').replace('del-data', '');
                console.log(id);
                $.ajax({
                    url: "/del-record/"+id,
                    type: 'GET', // Pass the ID to the server
                    success: function(response) {
                    // Handle success, e.g., remove the row from the table
                        $(`#del-data${id}`).closest('tr').remove();
                    },
                    error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });
            });


            $(document).on('click', '[id^="fetch_data"]', function() {
                var id = $(this).attr('id').replace('fetch_data', '');
                    // Get the ID of the clicked button
                console.log(id);
                // AJAX request to fetch data from the server
                $.ajax({
                    url: '/fetch_data/' + id, // Replace 'fetch_data.php' with the actual URL to your server-side script
                    type: 'GET',
                    success: function(response){
                        console.log("response data", response);
                            // Update the content of the data-container with the fetched data
                            $("#id").val(response.id);
                            $("#fname").val(response.fname);
                            $("#lname").val(response.lname);
                            $("#email").val(response.email);

                    },
                    error: function(){
                        // Handle AJAX error
                        alert('Error fetching data!');
                    }
                });
            });
    </script>
</body>

</html>