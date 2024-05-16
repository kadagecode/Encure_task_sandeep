<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    
<div class="container mt-5">

<a href="{{ route('student.index') }}" class="btn btn-success mb-3">Student list</a>

<h1>Create Student</h1>
<form  id="createStudentForm" action="" method="POST">
            @csrf

           <div class="form-group">
             <label for="fullname">Full Name</label>
             <input type="text" class="form-control" id="fullname" name="fullname">
            </div>
            <div class="form-group">
                <label for="gender">Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="male" name="gender" value="male" required>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="female" name="gender" value="female" required>
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="other" name="gender" value="other" required>
                    <label class="form-check-label" for="other">Other</label>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
           
            <div class="form-group">
                <label for="state">State</label>
                <select class="form-control" id="state" name="state" required onchange="updateCities()">
                    <option value="">Select State</option>
                    <option value="Maharashtra">Maharashtra</option>
                    <option value="Karnataka">Karnataka</option>
                    <option value="Gujarat">Gujarat</option>
                </select>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <select class="form-control" id="city" name="city" required>
                    <option value="">Select City</option>
                </select>
            </div>
            <div class="form-group">
                <label for="branch">Branch</label>
                <select class="form-control" id="branch" name="branch" required>
                    <option value="">Select Branch</option>
                    <option value="art">Art</option>
                    <option value="science">Science</option>
                    <option value="commerce">Commerce</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


        <h2 class="mt-5">Submitted Information</h2>
        <table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>State</th>
            <th>City</th>
            <th>Branch</th>
            <th>Gender</th>
        </tr>
    </thead>
    <tbody id="studentTableBody">
        <!-- Submitted data will be appended here -->
    </tbody>
</table>

</div>

<script>
        function updateCities() {
            var cities = {
                "Maharashtra": ["Mumbai", "Pune", "Nagpur"],
                "Karnataka": ["Bangalore", "Mysore", "Hubli"],
                "Gujarat": ["Ahmedabad", "Surat", "Vadodara"]
            };

            var state = $('#state').val();
            var cityOptions = '<option value="">Select City</option>';
            if (state) {
                $.each(cities[state], function(index, city) {
                    cityOptions += '<option value="' + city + '">' + city + '</option>';
                });
            }
            $('#city').html(cityOptions);
        }
    </script>
    
    <script>
    $(document).ready(function() {
            $('#createStudentForm').submit(function(event) {
                event.preventDefault(); // Prevent form from submitting the traditional way

                var isValid = true;

                // Validate email
                var email = $('#email').val();
                if (!email || !isValidEmail(email)) {
                    isValid = false;
                    $('#email').addClass('is-invalid');
                } else {
                    $('#email').removeClass('is-invalid');
                }

                // Validate password
                var password = $('#password').val();
                if (!password || password.length < 8) {
                    isValid = false;
                    $('#password').addClass('is-invalid');
                } else {
                    $('#password').removeClass('is-invalid');
                }

                

                // Validate gender
                var gender = $('input[name="gender"]:checked').val();
                if (!gender) {
                    isValid = false;
                    $('input[name="gender"]').addClass('is-invalid');
                } else {
                    $('input[name="gender"]').removeClass('is-invalid');
                }

                if (isValid) {
                    var formData = {
                        full_name: $('#fullname').val(),
                        email: $('#email').val(),
                        password: $('#password').val(),
                        state: $('#state').val(),
                        city: $('#city').val(),
                        branch: $('#branch').val(),
                        gender: $('input[name="gender"]:checked').val(),
                        _token: $('input[name="_token"]').val() // CSRF token
                    };

                    $.ajax({
                        type: 'POST',
                        url: '{{ route("students.store") }}',
                        data: formData,
                        success: function(response) {
                            if(response.success) {
                            var students = response.students;
                            var studentTableBody = '';
                            $.each(students, function(index, student) {
                                studentTableBody += '<tr>' +
                                    '<td>' + student.full_name + '</td>' +
                                    '<td>' + student.email + '</td>' +
                                    '<td>' + student.state + '</td>' +
                                    '<td>' + student.city + '</td>' +
                                    '<td>' + student.branch + '</td>' +
                                    '<td>' + student.gender + '</td>' +
                                    '</tr>';
                            });
                            $('#studentTableBody').html(studentTableBody);
                        }
                        },
                        error: function(response) {
                            // Handle error here
                            console.log('Error:', response);
                        }
                    });
                }
            });

            
            function isValidEmail(email) {
                var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return pattern.test(email);
            }
        });
    </script> </body>
</html>