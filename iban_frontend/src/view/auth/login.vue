<template>
  <main class="d-flex justify-content-between align-items-center flex-column vh-100" >
    <div class="container mt-2">
      <section class="wrapper">
        <div class="heading">
          <h2 class="text text-large d-block">Sign In</h2>
          <p class="text text-normal mt-2">New user? <span><router-link to="/register" class="text text-links">Create an
                account</router-link></span></p>
        </div>
        <form name="signin" class="form" @submit.prevent="login">
          <input-field title="Email Address" v-model="email.value" :validation="true"
            :validationMessage="email.validationMessage" />
          <input-password title="Password" v-model="password.value" :validation="true"
            :validationMessage="password.validationMessage" />
          <div class="input-control">
            <button type="submit" class="input-submit btn btn-primary" >Sign In</button>
          </div>
        </form>
      </section>
    </div>
  </main>
</template>

<script>

import { useUserStore } from '@/store/user';
import { mapState } from "pinia";
export default {
  data: function () {
    return {
      email: {
        value: '',
        validationMessage: '',
      },
      password: {
        value: '',
        validationMessage: '',
      },
      validationFields: [
        'email',
        'password',
      ],
    }
  },
  methods: {
    login: function () {
      this.resetValidationErrors();
      let formData = new FormData();
      formData.append('email', this.email.value);
      formData.append('password', this.password.value);
      this.$http.post(`/login`, formData).then(response => {
        console.log(response);

        // this.$http.defaults.headers.authorization = `Bearer ${response.data.access_token}`
        // this.setUser(response.data);
        // window.location.href = '/home';
      }).catch(error => {
        let otherErrors = true;
        if (error.response.data.error) {
          this.validationFields.forEach(validationField => {
            if (error.response.data.error[validationField]) {
              this[validationField].validationMessage = error.response.data.error[validationField].join(', ');
              otherErrors = false;
            }
          });
          if (otherErrors) {
            console.log(error.response.data.error);

            // this.toggleNotification('Error', error.response.data.error, 'error');
          }
        }
      });
    },
    resetValidationErrors: function () {
      this.validationFields.forEach(validationField => {
        this[validationField].validationMessage = '';
      });
    }


  }
};
</script>
