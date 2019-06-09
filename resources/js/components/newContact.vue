
<template>
  <div>
    <h3>Create new contact</h3>
    <form @submit.prevent="submit">
      <div class="form-group">
        <label for="name">Name</label>
        <input
          type="text"
          class="form-control"
          :class="{ 'is-invalid': $v.form.name.$error }"
          id="name"
          placeholder="Enter contact name"
          v-model="form.name"
        >
        <div class="text-sm mt-2 text-red" v-if="$v.form.name.$error">
          <div v-if="!$v.form.name.$error.required">Name field is required</div>
        </div>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input
          type="email"
          class="form-control"
          :class="{ 'is-invalid': $v.form.email.$error }"
          id="email"
          placeholder="Enter contact email"
          v-model="form.email"
        >
        <div class="text-sm mt-2 text-red" v-if="$v.form.email.$error">
          <div v-if="!$v.form.email.$error.email">Email field is not a valid email address</div>
          <div v-if="!$v.form.email.$error.required">Email field is required</div>
        </div>
      </div>
      <div class="form-group">
        <label for="phone">Telephone</label>
        <input
          type="text"
          class="form-control"
          :class="{ 'is-invalid': $v.form.phone.$error }"
          id="phone"
          placeholder="Enter contact phone"
          v-model="form.phone"
        >
        <div class="text-sm mt-2 text-red" v-if="$v.form.phone.$error">
          <div v-if="!$v.form.phone.$error.required">Email field is required</div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save {{ form.name }}</button>
    </form>
  </div>
</template>

<script>
import { required, email } from "vuelidate/lib/validators";

export default {
  data() {
    return {
      form: {
        name: "",
        email: "",
        phone: ""
      }
    };
  },
  validations: {
    form: {
      name: { required },
      email: { required, email },
      phone: { required }
    }
  },
  created() {
    document.title = "New Contact";
  },
  methods: {
    submit() {
      this.$v.form.$touch();
      // if its still pending or an error is returned do not submit
      if (this.form.$pending || this.form.$error) {
        return false;
      } else {
        fetch("api/create" + "?token=" + localStorage.token, {
          method: "post",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(this.form)
        })
          .then(res => res.json())
          .then(res => {
            this.flash("Contact saved", "success", { timeout: 3000 });
            this.$router.push("/");
          });
      }
    }
  }
};
</script>