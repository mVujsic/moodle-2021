<!DOCTYPE html>
<html lang="srb">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Добродошли</title>
</head>

<body>
    <div class="container-fluid bg">
        <br>
        <br>
        <br>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-4">
                <div class="info" align=center>
                    <h4 style="font-size: 35px;color:white"> <b> Портал за е-учење</b></h4>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-4">
                <form class="form-container" method="POST" action="">
                    <div class="form-group">
                        <label for="" style="font-size: 25px;">Пријавна форма</label><br><br>
                        <label for="exampleInputEmail1"><b>Адреса е-поште:</b></label>
                        <input type="email" name='username' class="form-control" id="uname" required
                            placeholder="Ваша e-mail адреса">
                        <small id="emailHelp" class="form-text text-muted"> <a href=""></a></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"><b>Шифра:</b></label>
                        <input type="password" name='password' class="form-control" id="pass" required
                            placeholder="Унесите шифру овде">
                        <small id="emailHelp" class="form-text text-muted">
                            <span class="help-block"></span></small>
                    </div>
                    <div class="form-group form-check">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" aria-pressed="true" style="font-size: 20px;">Пријави се</button><br>
                    <div class="container-fluid">
                        <a href="http://www.mfkg.rs/sr/" class="btn btn-primary btn-lg active link1 btn-block"
                            role="button" aria-pressed="true">Страница факултета</a>

                    </div>
                </form>

            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>