
<template>
  <div>
    <h3>Login</h3>
    <form @submit.prevent="submit">
      <div class="form-group">
        <label for="email">Email</label>
        <input
          type="email"
          class="form-control"
          :class="{ 'is-invalid': $v.form.email.$error }"
          id="email"
          placeholder="Enter your email"
          v-model="form.email"
        >
        <div class="text-sm mt-2 text-red" v-if="$v.form.email.$error">
          <div v-if="!$v.form.email.$error.email">Email field is not a valid email address</div>
          <div v-if="!$v.form.email.$error.required">Email field is required</div>
        </div>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input
          type="password"
          class="form-control"
          :class="{ 'is-invalid': $v.form.password.$error }"
          id="password"
          placeholder="Enter your password"
          v-model="form.password"
        >
        <div class="text-sm mt-2 text-red" v-if="$v.form.password.$error">
          <div v-if="!$v.form.password.$error.required">Password field is required</div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
</template>

<script>
import { required, email } from "vuelidate/lib/validators";

export default {
  data() {
    return {
      form: {
        email: "",
        password: ""
      }
    };
  },
  validations: {
    form: {
      email: { required, email },
      password: { required }
    }
  },
  created() {
    document.title = "Login";
  },
  methods: {
    submit() {
      this.$v.form.$touch();
      // if its still pending or an error is returned do not submit
      if (this.form.$pending || this.form.$error) {
        return false;
      } else {
        fetch("api/login", {
          method: "post",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(this.form)
        })
          .then(res => res.json())
          .then(res => {
            if (res.success) {
              localStorage.token = res.token;
              this.$parent.$emit("authed");
            } else {
              this.flash("Login error", "warning", { timeout: 3000 });
            }
          });
      }
    }
  }
};
</script>