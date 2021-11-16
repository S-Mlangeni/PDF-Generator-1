<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Generation</title>
    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="CSSstyle.css">
</head>
<body>
    <div class="container shadow-lg p-3 mb-5 bg-white">
        <h1>Interview Confirmation</h1>
        <p>Please enter your interview details below</p>
        <form action="PDF.php" method="POST"> 
            <div class="form-group mb-2">
                <input class="form-control" name="username" type="text" placeholder="Name" required>
            </div> 

            <div class="form-group mb-2">
                <input class="form-control" name="useremail" type="text" placeholder="Email" required>
            </div> 
        
            <div class="form-group mb-2">
                <input class="form-control" name="jobPosition" type="text" placeholder="Job Position" required>
            </div>
            
            <div class="form-group mb-2">
                <input class="form-control" name="availableDate" type="text" placeholder="Available Date" required>
            </div>
            
            <div class="form-group mb-2">
                <input class="form-control" name="availableTime" type="text" placeholder="Available Time" required>
            </div>

            <div class="form-group mb-2">
                <textarea class="form-control" name="specialNote" type="textbox" placeholder="Special Note(s)" ></textarea>
            </div>

            <div class="form-group mb-2" style="display: flex; align-items: center; ">
                <input name="checkbox" type="checkbox">
                <p style="margin: 0px 5px">Send PDF to your email</p>
            </div>
            
            <button [disabled]="F.form.invalid" class="container-fluid btn btn-success" type="submit">Generate Confirmation Letter</button>
            <mat-progress-bar mode="indeterminate" *ngIf="loader" color="accent"></mat-progress-bar>  
        </form>
    </div>
</body>
</html>