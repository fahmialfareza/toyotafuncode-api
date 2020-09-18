<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title id="reminder">Booking</title>

</head>
<body>

@include('layouts.nav')

<div class="container" style="margin-top: 50px;">

    <h4 class="text-center" id="booking2">Booking</h4><br>

    <h5># Booking</h5>
    <table class="table table-bordered">
        <tr>
            <th>Kolom</th>
            <th>Deskripsi</th>
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

    var fullName = firebase.database().ref('user/{{$userId}}/fullName');
    fullName.once('value', function(snapshot) {
        var value = snapshot.val();
        var htmls_booking = [];
        htmls_booking.push('Booking ' + value);
        $('#booking').html(htmls_booking);
        $('#booking2').html(htmls_booking);
    });

    // Get Data
    firebase.database().ref('bookings/{{$id}}').on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        if (value.status !== "Selesai") {
            htmls.push('<tr>\
                <td>Status</td>\
                <td>' + value.status + '</td>\
                <td><button data-toggle="modal" data-target="#update-modal" class="btn btn-info updateData" data-id="status">Perbarui</button>\
            </tr>');
        } else {
            htmls.push('<tr>\
                <td>Status</td>\
                <td>' + value.status + '</td>\
                <td></td>\
            </tr>');
        }
        htmls.push('<tr>\
            <td>Menunggu Persetujuan</td>\
            <td id="waitingApproval" name="waitingApproval">' + value.waitingApproval + '</td>\
            <td></td>\
        </tr>');
        if (value.waitingApproval === false) {
            htmls.push('<tr>\
                <td>Komponen</td>\
                <td>' + value.component + '</td>\
                <td><button data-toggle="modal" data-target="#update-modal" class="btn btn-info updateData" data-id="component">Perbarui</button>\
            </tr>');
        } else {
            htmls.push('<tr>\
                <td>Komponen</td>\
                <td>' + value.component + '</td>\
                <td></td>\
            </tr>');
        }
        if (value.waitingApproval === false) {
            htmls.push('<tr>\
                <td>Estimasi</td>\
                <td>' + value.estimation + '</td>\
                <td><button data-toggle="modal" data-target="#update-modal" class="btn btn-info updateData" data-id="estimation">Perbarui</button>\
            </tr>');
        } else {
            htmls.push('<tr>\
                <td>Estimasi</td>\
                <td>' + value.estimation + '</td>\
                <td></td>\
            </tr>');
        }
        if (value.waitingApproval === false) {
            htmls.push('<tr>\
                <td>Teknisi</td>\
                <td>' + value.officer + '</td>\
                <td><button data-toggle="modal" data-target="#update-modal" class="btn btn-info updateData" data-id="officer">Perbarui</button>\
            </tr>');
        } else {
            htmls.push('<tr>\
                <td>Teknisi</td>\
                <td>' + value.officer + '</td>\
                <td></td>\
            </tr>');
        }
        if (value.waitingApproval === false) {
            htmls.push('<tr>\
                <td>Total Biaya</td>\
                <td>' + value.totalCost + '</td>\
                <td><button data-toggle="modal" data-target="#update-modal" class="btn btn-info updateData" data-id="totalCost">Perbarui</button>\
            </tr>');
        } else {
            htmls.push('<tr>\
                <td>Total Biaya</td>\
                <td>' + value.totalCost + '</td>\
                <td></td>\
            </tr>');
        }
        htmls.push('<tr>\
            <td>Nama</td>\
            <td>' + value.userName + '</td>\
            <td></td>\
        </tr>');
        htmls.push('<tr>\
            <td>Email</td>\
            <td>' + value.userEmail + '</td>\
            <td></td>\
        </tr>');
        htmls.push('<tr>\
            <td>Tanggal</td>\
            <td>' + value.date + '</td>\
            <td></td>\
        </tr>');
        htmls.push('<tr>\
            <td>Waktu</td>\
            <td>' + value.time + '</td>\
            <td></td>\
        </tr>');
        htmls.push('<tr>\
            <td>Provinsi</td>\
            <td>' + value.province + '</td>\
            <td></td>\
        </tr>');
        htmls.push('<tr>\
            <td>Kota</td>\
            <td>' + value.city + '</td>\
            <td></td>\
        </tr>');
        htmls.push('<tr>\
            <td>Bengkel</td>\
            <td>' + value.garage + '</td>\
            <td></td>\
        </tr>');
        htmls.push('<tr>\
            <td>Keluhan</td>\
            <td>' + value.complaint + '</td>\
            <td></td>\
        </tr>');
        htmls.push('<tr>\
            <td>Servise Tambahan</td>\
            <td>' + value.additionalService + '</td>\
            <td></td>\
        </tr>');
        // htmls.reverse();
        $('#tbody').html(htmls);
        $("#submitUser").removeClass('desabled');
    });

    // Random String
    function makeid(length) {
       var result           = '';
       var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
       var charactersLength = characters.length;
       for ( var i = 0; i < length; i++ ) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
       }
       return result;
    }

    // Add Data
    $('#submitCustomer').on('click', function () {
        var values = $("#addCustomer").serializeArray();
        var date = values[0].value;
        var description = values[1].value;
        var userID = makeid(20);

        console.log(values);

        firebase.database().ref('user/{{$id}}/reminders/' + userID).set({
            date: date,
            description: description,
        });

        // Reassign lastID value
        // lastIndex = userID;
        $("#addCustomer input").val("");
    });

    // Update Data
    var updateID = 0;
    $('body').on('click', '.updateData', function () {
        updateID = $(this).attr('data-id');
        if (updateID === "status") {
          firebase.database().ref('bookings/{{$id}}').on('value', function (snapshot) {
              var values = snapshot.val();
              var updateData = '<div class="form-group">\
                  <label for="first_name" class="col-md-12 col-form-label">Status</label>\
                  <div class="col-md-12">\
                      <select id="statusselection" name="statusselection" required autofocus>\
                          <option value="Sudah Dipesan">Sudah Dipesan</option>\
                          <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>\
                          <option value="Pengerjaan">Pengerjaan</option>\
                          <option value="Pembayaran">Pembayaran</option>\
                          <option value="Selesai">Selesai</option>\
                      </select>\
                  </div>\
              </div>';

              $('#updateBody').html(updateData);
          });
        } else if (updateID === "estimation") {
          firebase.database().ref('bookings/{{$id}}').on('value', function (snapshot) {
              var values = snapshot.val();
              var updateData = '<div class="form-group">\
                  <label for="first_name" class="col-md-12 col-form-label">Estimasi (jam)</label>\
                  <div class="col-md-12">\
                      <input id="first_name" type="number" class="form-control" name="name" value="' + values.estimation + '" required autofocus>\
                  </div>\
              </div>';

              $('#updateBody').html(updateData);
          });
        } else if (updateID === "officer") {
          var updateData = '';
          var selectengineer = [];
          firebase.database().ref('bookings/{{$id}}').on('value', function (snapshot) {
              var values = snapshot.val();
              updateData = '<div class="form-group">\
                  <label for="first_name" class="col-md-12 col-form-label">Teknisi</label>\
                  <div class="col-md-12">\
                    <select id="selectengineer" name="name" required autofocus>\
                    </select>\
                  </div>\
              </div>';
          });
          firebase.database().ref('engineers/').on('value', function (snapshot) {
              var value = snapshot.val();
              console.log(selectengineer);
              $.each(value, function (index, value) {
                  selectengineer.push('<option value="' + value.name +'">' + value.name + '</option>');
              });
              $('#selectengineer').html(selectengineer);
          });
          $('#updateBody').html(updateData);
        } else if (updateID === "component") {
          firebase.database().ref('bookings/{{$id}}').on('value', function (snapshot) {
              var values = snapshot.val();
              var updateData = '<div class="form-group">\
                  <label for="first_name" class="col-md-12 col-form-label">Komponen</label>\
                  <div class="col-md-12">\
                      <textarea id="first_name" class="form-control" name="name" required autofocus>'+ values.component + '</textarea>\
                  </div>\
              </div>';

              $('#updateBody').html(updateData);
          });
        } else if (updateID === "totalCost") {
          firebase.database().ref('bookings/{{$id}}').on('value', function (snapshot) {
              var values = snapshot.val();
              var updateData = '<div class="form-group">\
                  <label for="first_name" class="col-md-12 col-form-label">Total Biaya</label>\
                  <div class="col-md-12">\
                      <input id="first_name" type="number" class="form-control" name="name" value="' + values.totalCost + '" required autofocus>\
                  </div>\
              </div>';

              $('#updateBody').html(updateData);
          });
        }
    });

    $('.updateCustomer').on('click', function () {
        var values = $(".users-update-record-model").serializeArray();
        if (updateID === "status") {
            var status = values[0].value;

            var updates = {};
            updates['/bookings/{{$id}}/status'] = status;

            firebase.database().ref().update(updates);
        } else if (updateID === "estimation") {
            var estimation = Number(values[0].value);

            var updates = {};
            updates['/bookings/{{$id}}/estimation'] = estimation;

            firebase.database().ref().update(updates);
        } else if (updateID === "officer") {
            var officer = values[0].value;

            var updates = {};
            updates['/bookings/{{$id}}/officer'] = officer;

            firebase.database().ref().update(updates);
        } else if (updateID === "component") {
            var component = values[0].value;

            var updates = {};
            updates['/bookings/{{$id}}/component'] = component;

            firebase.database().ref().update(updates);
        } else if (updateID === "totalCost") {
            var totalCost = Number(values[0].value);

            var updates = {};
            updates['/bookings/{{$id}}/totalCost'] = totalCost;

            firebase.database().ref().update(updates);
        }

        $("#update-modal").modal('hide');
    });

    // Remove Data
    $("body").on('click', '.removeData', function () {
        var id = $(this).attr('data-id');
        $('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
    });

    $('.deleteRecord').on('click', function () {
        var values = $(".users-remove-record-model").serializeArray();
        var id = values[0].value;
        firebase.database().ref('user/{{$id}}/reminders/' + id).remove();
        $('body').find('.users-remove-record-model').find("input").remove();
        $("#remove-modal").modal('hide');
    });
    $('.remove-data-from-delete-form').click(function () {
        $('body').find('.users-remove-record-model').find("input").remove();
    });
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
