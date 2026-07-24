<div class="login-box">

    <div class="login-logo">
        <b>WhatsApp</b>Center
    </div>

    <div class="card">

        <div class="card-body login-card-body">

            <p class="login-box-msg">
                Iniciar sesión
            </p>

            <?php if(isset($error)): ?>

                <div class="alert alert-danger">

                    <?= $error ?>

                </div>

            <?php endif; ?>

            <form method="POST" action="index.php?page=login">

                <div class="input-group mb-3">

                    <input
                        type="email"
                        name="correo"
                        class="form-control"
                        placeholder="Correo"
                        required>

                    <div class="input-group-append">

                        <div class="input-group-text">

                            <span class="fas fa-envelope"></span>

                        </div>

                    </div>

                </div>

                <div class="input-group mb-3">

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Contraseña"
                        required>

                    <div class="input-group-append">

                        <div class="input-group-text">

                            <span class="fas fa-lock"></span>

                        </div>

                    </div>

                </div>

                <button
                    class="btn btn-success btn-block">

                    Entrar

                </button>

            </form>

        </div>

    </div>

</div>