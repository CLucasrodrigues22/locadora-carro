<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form method="POST" action="" @submit.prevent="login($event)">
            <input type="hidden" name="_token" :value="token" />
            <div class="row mb-3">
              <label for="email" class="col-md-4 col-form-label text-md-end"
                >E-mail</label
              >
              <div class="col-md-6">
                <input
                  id="email"
                  type="email"
                  class="form-control"
                  name="email"
                  required
                  autocomplete="email"
                  v-model="email"
                  autofocus
                />
              </div>
            </div>

            <div class="row mb-3">
              <label for="password" class="col-md-4 col-form-label text-md-end"
                >Senha</label
              >

              <div class="col-md-6">
                <input
                  id="password"
                  type="password"
                  class="form-control"
                  name="password"
                  required
                  autocomplete="current-password"
                  v-model="password"
                />
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6 offset-md-4">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    name="remember"
                    id="remember"
                  />

                  <label class="form-check-label" for="remember">
                    Lembrar de Mim
                  </label>
                </div>
              </div>
            </div>

            <div class="row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-success">
                  Inciar Sessão
                </button>
                <a class="btn btn-primary m-1" href="/register">Registrar-se</a>
                <button type="submit" class="btn btn-link">
                  Esqueceu a senha?
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["token"],
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    login(e) {
      let url = "http://127.0.0.1:8000/api/login";
      let cfg = {
        method: "post",
        body: new URLSearchParams({
          email: this.email,
          password: this.password,
        }),
      };
      // requisições http
      fetch(url, cfg)
        .then((response) => response.json())
        .then((data) => {
          if (data.token) {
            document.cookie = "token=" + data.token + ";SameSite=Lax";
          }
          //dar sequência no envio do form de autenticação por sessão
          e.target.submit();
        });
    },
  },
};
</script>
