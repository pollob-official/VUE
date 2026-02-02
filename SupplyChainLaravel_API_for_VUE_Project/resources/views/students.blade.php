<?php
    $student=["Hasan", "Masud", "M A Jalil"];
    print_r($student);
?>

<table border="2" cellpadding="15" cellspacing="0">
    <tr>
        <th>Id</th>
        <th>Name</th>
    </tr>

    @foreach ($student as $key=>$student)
    <tr>
        <th>{{$key +1}}</th>
        <th>{{$student}}</th>
    </tr>
    @endforeach
</table>