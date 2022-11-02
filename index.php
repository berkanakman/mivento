<!doctype html>
<html lang="tr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>Mivento Assessment</title>

    <style>
        .container {
            margin-top: 2rem !important;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="alert alert-danger" id="danger" style="visibility: hidden;"></div>
            <div class="alert alert-success" id="success" style="visibility: hidden;"></div>
            <form class="needs-validation" action="library/import.php" method="post" id="importMysql" name="importMysql" enctype="multipart/form-data" onsubmit="return false" novalidate>
                <div class="mb-3">
                    <label for="campaignName" class="form-label">Kampanya Adı</label>
                    <input type="text" class="form-control" name="campaignName" id="campaignName" required />
                </div>
                <div class="mb-3">
                    <select class="form-select" name="campaignDate" id="campaignDate" required>
                        <option selected disabled value="">Tarih Seçin</option>
                        <option value="2022-07">Temmuz 2022</option>
                        <option value="2022-08">Ağustos 2022</option>
                        <option value="2022-09">Eylül 2022</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="campaignFile" class="form-label">Dosya Yükleyin</label>
                    <input class="form-control" type="file" name="campaignFile" id="campaignFile" required accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                </div>
                <div class="d-grid">
                    <input type="hidden" name="Import" id="Import" value="ImportData" />
                    <button class="btn btn-primary btn-block" name="Import" id="Import" type="submit">Yükle</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Example starter JavaScript for disabling form submissions if there are invalid fields -->
<script>
    (function () {
        'use strict';

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation');
        var actionPath = "";
        var formData = null;
        var xhr = new XMLHttpRequest();

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        formData = new FormData(form);
                        actionPath = form.getAttribute("action");

                        xhr.onload = function() {
                            var response = JSON.parse(this.responseText);

                            if(response.Error.status == 1){
                                document.getElementById("success").style.visibility = "visible";
                                document.getElementById("success").innerHTML = response.Error.errorMessage;
                                document.getElementById("danger").style.visibility = "hidden";
                            } else {
                                document.getElementById("danger").style.visibility = "visible";
                                document.getElementById("danger").innerHTML = response.Error.errorMessage;
                                document.getElementById("success").style.visibility = "hidden";
                            }
                        }

                        xhr.open("POST", actionPath);
                        xhr.send(formData);
                    }

                    form.classList.add('was-validated');
                }, false);
            });
    })();
</script>
</body>
</html>
