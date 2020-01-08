<div class="card-body">
    <form action = " services/user/userService.php" method="post">
        <input type="hidden" name="Action" value="add" >
        <div class="input-group form-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control" name="nom"  placeholder="Nom d'utilisateur
">

        </div>
        <div class="input-group form-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" class="form-control" name="password"   id="password" placeholder="mot de passe ">
        </div>
        <div class="input-group form-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" class="form-control" oninput="chekValue(this.value)"  chekValname="passwor"  placeholder="mot de passe ">
        </div>
        <div class="row align-items-center remember">
            <input type="checkbox">Remember Me
        </div>
        <div class="form-group">
            <input type="submit" id="myBtn" value="inscrire" class="btn float-right login_btn">
        </div>
    </form>
    <script>
        document.getElementById("myBtn").disabled = true;
        function chekValue(value) {
            pass = document.getElementById('password').value;
            if (pass === value)
                document.getElementById("myBtn").disabled = false;

            else
                document.getElementById("myBtn").disabled = true;
        }
    </script>
</div>
