<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h2 class="mt-5">Student Information</h2>
    <a href="{{ route('student.create') }}" class="btn btn-success mb-3">New Registration</a>

    <button id="deleteMultipleBtn" class="btn btn-danger mb-3">Delete Selected</button>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th></th>
                <th>Full Name</th>
                <th>Email</th>
                <th>State</th>
                <th>City</th>
                <th>Branch</th>
                <th>Gender</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td><input type="checkbox" name="selectedStudents[]" value="{{ $student->id }}"></td>
                <td>{{ $student->full_name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->state }}</td>
                <td>{{ $student->city }}</td>
                <td>{{ $student->branch }}</td>
                <td>{{ $student->gender }}</td>
                <td>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm">Edit</a>

                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#deleteMultipleBtn').click(function() {
            var selectedStudents = $('input[name="selectedStudents[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedStudents.length > 0) {
                $.ajax({
                    url: '{{ route("students.deleteMultiple") }}',
                    type: 'DELETE',
                    data: {
                        selectedStudents: selectedStudents,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Handle success response
                        console.log(response);

                        location.reload(); // Reload the page
                        // Reload the page or update the UI as needed
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            } else {
                alert('Please select at least one student to delete.');
            }
        });
    });
</script>

</body>
</html>
