<!DOCTYPE html>
<html>
<head>
    <title>Patients List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Patients Information</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Contact Info</th>
            </tr>
        </thead>
        <tbody>
           @foreach($patients as $patient)
                <tr>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->dateofBirth }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ $patient->contactInfo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
