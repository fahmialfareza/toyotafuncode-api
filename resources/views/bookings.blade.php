<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Booking</title>

</head>
<body>

@include('layouts.nav')

<div class="container" style="margin-top: 50px;">

    <h4 class="text-center">Booking</h4><br>

    <h5># Booking</h5>
    <table class="table table-bordered">
        <tr>
            <th>Booking Number</th>
            <th>Nama Pengguna</th>
            <th width="180" class="text-center">Aksi</th>
        </tr>
        <tbody id="tbody">

        </tbody>
    </table>
</div>

<!-- Update Model -->
<form action="" method="POST" class="users-update-record-model form-horizontal">
    <div id="update-modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Perbarui</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body" id="updateBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-success updateCustomer">Perbarui
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Delete Model -->
<form action="" method="POST" class="users-remove-record-model">
    <div id="remove-modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Hapus</h4>
                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah kamu ingin menghapus?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                            data-dismiss="modal">Tutup
                    </button>
                    <button type="button" class="btn btn-danger waves-effect waves-light deleteRecord">Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


{{--Firebase Tasks--}}
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.3/firebase.js"></script>
<script>
    // Initialize Firebase
    var config = {
        apiKey: "{{ config('services.firebase.api_key') }}",
        authDomain: "{{ config('services.firebase.auth_domain') }}",
        databaseURL: "{{ config('services.firebase.database_url') }}",
        storageBucket: "{{ config('services.firebase.storage_bucket') }}",
        projectId: "{{ config('services.firebase.project_id') }}",
        messagingSenderId: "{{ config('services.firebase.messaging_sender_id') }}",
        appId: "{{ config('services.firebase.app_id') }}",
        measurementId: "{{ config('services.firebase.measurement_id') }}"
    };
    firebase.initializeApp(config);

    // // [START get_messaging_object]
    // // Retrieve Firebase Messaging object.
    // const messaging = firebase.messaging();
    // // [END get_messaging_object]
    // // [START set_public_vapid_key]
    // // Add the public key generated from the console here.
    // messaging.usePublicVapidKey('BGUYMPGLhP1-NTVuAblLaIxOXlZXyDw8U8GHz3MXqJcJuaGywvTLN-DL5WGKPDMeSpRhPETvPoGY7QJ1XXpszMo');
    // // [END set_public_vapid_key]
    //
    // var notificationData = {
    //   "to": "dR3179CIBdk...",
    //   "data": {
    //     "mrp": 5000,
    //     "retailPrice": 3000
    //   },
    //   "notification": {
    //     "color": "#FF0000",
    //     "title": "Off Upto 70% yofunky.com"
    //   }
    // }
    //
    // $.ajax({
    //     url: 'https://fcm.googleapis.com/fcm/send',
    //     type: 'post',
    //     data: JSON.stringify(notificationData),
    //     headers: {
    //       'Content-Type': 'application/json',
    //       'Authorization': 'key=AAAAAfx_EtY:APA91bGtiJ1zBPX2maL4KRzmws6JQx7rtbm_uVfyBt2h0Ahy2L23xJbxZlfY_FIFv03RqqKk_mr85RYsvQ14yHmJJGvoU8y-oO9iXknOsFDjTKkYXXC4jihTkBhfJpJ2M1qN3uLouWhi'
    //     },
    //     dataType: 'json',
    //     success: function (data) {
    //       console.info(data);
    //     }
    //   });

    var database = firebase.database();

    var lastIndex = 0;
    {{$i = 0}}

    // Get Data
    firebase.database().ref('bookings/').on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                htmls.push('<tr>\
                		<td>' + index + '</td>\
                		<td>' + value.userName + '</td>\
                		<td><a href="/bookings/'+ index + '/' + value.userId +'" class="btn btn-info updateData" data-id="' + index + '">Lihat Detail</a>\
              	</tr>');
            }
            lastIndex = index;
        });
        // htmls.reverse();
        $('#tbody').html(htmls);
        $("#submitUser").removeClass('desabled');
    });
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
