<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Student</h1>
    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Use PUT method for updating -->
        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $student->full_name }}" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="male" name="gender" value="male" {{ $student->gender === 'male' ? 'checked' : '' }} required>
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="female" name="gender" value="female" {{ $student->gender === 'female' ? 'checked' : '' }} required>
                <label class="form-check-label" for="female">Female</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="other" name="gender" value="other" {{ $student->gender === 'other' ? 'checked' : '' }} required>
                <label class="form-check-label" for="other">Other</label>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
        </div>
        <div class="form-group">
            <label for="state">State</label>
            <select class="form-control" id="state" name="state" required onchange="updateCities()">
                <option value="">Select State</option>
                <option value="Maharashtra" {{ $student->state === 'Maharashtra' ? 'selected' : '' }}>Maharashtra</option>
                <option value="Karnataka" {{ $student->state === 'Karnataka' ? 'selected' : '' }}>Karnataka</option>
                <option value="Gujarat" {{ $student->state === 'Gujarat' ? 'selected' : '' }}>Gujarat</option>
            </select>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <select class="form-control" id="city" name="city" required>
                <option value="">Select City</option>
                <option value="{{ $student->city }}" selected>{{ $student->city }}</option> <!-- Pre-select the city -->
            </select>
        </div>
        <div class="form-group">
            <label for="branch">Branch</label>
            <select class="form-control" id="branch" name="branch" required>
                <option value="">Select Branch</option>
                <option value="art" {{ $student->branch === 'art' ? 'selected' : '' }}>Art</option>
                <option value="science" {{ $student->branch === 'science' ? 'selected' : '' }}>Science</option>
                <option value="commerce" {{ $student->branch === 'commerce' ? 'selected' : '' }}>Commerce</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
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
</body>
</html>
