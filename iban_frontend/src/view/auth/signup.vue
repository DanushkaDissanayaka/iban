<template>
    <div>
      <h1>Signup</h1>
      <form @submit.prevent="register">
        <div>
          <label>Email:</label>
          <input type="email" v-model="email" required />
        </div>
        <div>
          <label>Password:</label>
          <input type="password" v-model="password" required />
        </div>
        <button type="submit">Register</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        email: '',
        password: '',
      };
    },
    methods: {
      register() {
        console.log('Registering:', this.email, this.password);
        // Add logic to register user
      },
    },
  };
  </script>
  