<template>
  <nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item" v-if="authenticated">
          <a class="nav-link" href="#">
            <span></span>
            <router-link to="/">Contacts</router-link>
            <span class="sr-only"></span>
          </a>
        </li>
        <li class="nav-item" v-if="authenticated">
          <a class="nav-link" href="#">
            <span></span>
            <router-link to="/new">New Contact</router-link>
            <span class="sr-only"></span>
          </a>
        </li>
        <li class="nav-item" v-if="!authenticated">
          <a class="nav-link" href="#">
            <span></span>
            <router-link to="/register">Register</router-link>
            <span class="sr-only"></span>
          </a>
        </li>
        <li class="nav-item" v-if="!authenticated">
          <a class="nav-link" href="#">
            <span></span>
            <router-link to="/login">Login</router-link>
            <span class="sr-only"></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://github.com/edmunds22/vuemycontacts" target="_blank">
            <span></span>
            My source code
            <span class="sr-only"></span>
          </a>
        </li>
        <li class="nav-item" v-if="authenticated">
          <a class="nav-link" href="#" v-on:click="logout()">Sign out</a>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  props: ["authenticated"]
};
</script>