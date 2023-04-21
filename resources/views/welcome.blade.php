<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <form action="" method="POST" id="regForm">
            <div class="row mt-5">
                <div class="col-12 col-md-6 mx-auto">
                    @csrf
                    <div class="form-group">
                        <label for="fullname" class="form-control-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-control-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="form-control-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number">
                    </div>
                    <div class="form-group">
                        <label for="whatsapp_number" class="form-control-label">Whatsapp Number</label>
                        <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number">
                    </div>
                    <div class="form-group">
                        <label for="status" class="form-control-label">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">Select</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="website_url" class="form-control-label">Website URL</label>
                        <textarea class="form-control" id="website_url" name="website_url"></textarea>
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-secondary">Close</button>
                        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#regForm").validate({
                rules: {
                    full_name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    phone_number: {
                        required: true,
                        digits: true,
                        maxlength: 11
                    },
                    whatsapp_number: {
                        required: true,
                        digits: true,
                        maxlength: 11
                    },
                    status: "required",
                    website_url: {
                        required: true,
                        url: true
                    }
                },
                messages: {
                    full_name: {
                        required: "Please enter full name",
                        maxlength: "Your full name maxlength should be 50 characters long."
                    },
                    email: {
                        required: "Please enter valid email",
                        email: "Please enter valid email"
                    },
                    phone_number: {
                        required: "Please enter phone number",
                        maxlength: "Your phone number maxlength should be 11 characters long."
                    },
                    whatsapp_number: {
                        required: "Please enter whatsapp number",
                        maxlength: "Your whatsapp number maxlength should be 11 characters long."
                    },
                    status: {
                        required: "Please select a status"
                    },
                    website_url: {
                        required: "Please enter a website url"
                    },
                },
                // submitHandler: function() {
                //     $.ajaxSetup({
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         }
                //     });
                //     $('#submit').html('Please Wait...');
                //     $("#submit").attr("disabled", true);
                //     $.ajax({
                //         url: "/store",
                //         type: "POST",
                //         data: $('#regForm').serialize(),
                //         success: function(response) {
                //             $('#submit').html('Submit');
                //             $("#submit").attr("disabled", false);
                //             alert('Ajax form has been submitted successfully');
                //             document.getElementById("regForm").reset();
                //         }
                //     });
                // },
            });

            $("#regForm").submit(function(event) {
                event.preventDefault(); // prevent default form submission
                if ($(this).valid()) { // check if form is valid
                    var formData = $(this).serialize(); // encode form data as string
                    $('#submit').html('Please Wait...');
                    $("#submit").attr("disabled", true);
                    $.ajax({
                        url: "/store",
                        type: "POST",
                        data: formData,
                        success: function(response) {
                            // handle success response from server
                            $('#submit').html('Submit');
                            $("#submit").attr("disabled", false);
                            alert('Ajax form has been submitted successfully');
                            document.getElementById("regForm").reset();
                        },
                        error: function(xhr, status, error) {
                            // handle error response from server
                        }
                    });
                }
            });

        });
    </script>

</body>

</html>