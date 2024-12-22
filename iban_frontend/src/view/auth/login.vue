<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center bg-primary text-white">
            <h2 class="text text-large d-block">Sign-In</h2>
          
          </div>
          <div class="card-body">
            <form name="signin" class="form" @submit.prevent="login">
          <input-field title="Email Address" v-model="email.value" :validation="true"
            :validationMessage="email.validationMessage" />
          <input-password title="Password" v-model="password.value" :validation="true"
            :validationMessage="password.validationMessage" />
          <div class="input-control">
            <button type="submit" class="input-submit btn btn-primary" >Sign-In</button>
          </div>
          <hr>
          <p class="text text-normal mt-2">New user? <span><router-link to="/register" class="text text-links">Create an
            account</router-link></span></p>
        </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</template>

<script>

import role from '@/constants/role';
import { mapState } from "pinia";
import {useUserStore} from '@/store/user'
import { ElNotification } from 'element-plus'

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
  computed: {
    ...mapState(useUserStore, ['setUser']),
  },
  methods: {
    login: function () {
      this.resetValidationErrors();
      let formData = new FormData();
      formData.append('email', this.email.value);
      formData.append('password', this.password.value);
      this.$http.post(`/login`, formData).then(response => {
        
        let user = response.data.user
        user.token = response.data.token
        this.$http.defaults.headers.authorization = `Bearer ${response.data.token}`
        
        this.setUser(user);

        if(role.ADMIN === user.role_id) {
          this.$router.push('/admin/home');
        } else if(role.USER === user.role_id) {
          this.$router.push('user/home');
        }

      }).catch(error => {
        if (error.response.status === 401) {
          ElNotification({
              title: 'Error',
              message: error.response.data.message,
              type: 'error',
          })
        }
        if (error.response.data.error) {
          this.validationFields.forEach(validationField => {
            if (error.response.data.error[validationField]) {
              this[validationField].validationMessage = error.response.data.error[validationField].join(', ');
            }
          });
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
