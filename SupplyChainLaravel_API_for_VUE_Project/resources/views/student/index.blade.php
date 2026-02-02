<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bootstrap Table</title>

  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
</head>
<body class="bg-light p-4">

  <div class="table-responsive">
    <table class="table table-bordered table-hover bg-white rounded">
      <thead class="table-secondary">
        <tr>
          <th class="text-start">ID</th>
          <th class="text-start">Name</th>
          <th class="text-start">Email</th>
          <th class="text-start">Status</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>1</td>
          <td>John Doe</td>
          <td>john@example.com</td>
          <td class="text-success fw-semibold">Active</td>
        </tr>

        <tr>
          <td>2</td>
          <td>Jane Smith</td>
          <td>jane@example.com</td>
          <td class="text-danger fw-semibold">Inactive</td>
        </tr>
      </tbody>
    </table>
  </div>

</body>
</html>
