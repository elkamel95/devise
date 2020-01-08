<a class="navbar-brand" href="#">Module Change</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="index.php" onclick="valider()">échange <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="bon.php">bon</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?destory=yes" >Pricing</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
    </ul>
    <form action="index.php" class="form-inline my-0 my-lg-0 logout">
        <input type="hidden" name="destory" value="yes">
        <a class="nav-link"  >
        <?php     session_start();
            echo $_SESSION["user_name"] ;?></a>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Deconnexion</button>

    </form>
</div>
