<template>
  <div class="table-responsive">
    <h3>Contacts</h3>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Header</th>
          <th>Header</th>
          <th>Header</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="contact in contacts" v-bind:key="contact.id">
          <td>{{ contact.id }}</td>
          <td>{{ contact.full_name }}</td>
          <td>{{ contact.phone }}</td>
          <td>{{ contact.email }}</td>
          <td>
            <router-link :to="'/update/'+contact.id" class="btn btn-secondary btn-sm">Update</router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      contacts: []
    };
  },
  created() {
    (document.title = "My Contacts"), this.fetchContacts();
  },
  methods: {
    fetchContacts() {
      fetch("api/list?token=" + localStorage.token)
        .then(res => res.json())
        .then(res => {
          this.contacts = res.contacts;
        });
    }
  }
};
</script>