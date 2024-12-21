<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center bg-primary text-white">
            <h4>Sign-Up</h4>
          </div>
          <div class="card-body">
            <form @submit.prevent="signup">
              <div class="form-group">
                <input-field
                  title="Name"
                  v-model="name.value"
                  :validation="true"
                  :validationMessage="name.validationMessage"
                />
              </div>
              <div class="form-group">
                <input-field
                  title="Email"
                  v-model="email.value"
                  :validation="true"
                  :validationMessage="email.validationMessage"
                />
              </div>
              <div class="form-group">
                <input-password
                  title="Password"
                  v-model="password.value"
                  :validation="true"
                  :validationMessage="password.validationMessage"
                />
              </div>
              <div class="form-group">
                <input-password
                  title="Confirm Password"
                  v-model="password_confirmation.value"
                  :validation="true"
                  :validationMessage="password_confirmation.validationMessage"
                />
              </div>

              <button type="submit" class="btn btn-primary btn-block mt-3">
                Sign-Up
              </button>
              <hr />
              <p class="text text-normal mt-2">
                Already have an account?
                <span
                  ><router-link to="/login" class="text text-links"
                    >Sign-in</router-link
                  ></span
                >
                here.
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      name: {
        value: "",
        validationMessage: "",
      },
      email: {
        value: "",
        validationMessage: "",
      },
      password: {
        value: "",
        validationMessage: "",
      },
      password_confirmation: {
        value: "",
        validationMessage: "",
      },
      validationFields: ["name", "email", "password"],
    };
  },
  methods: {
    signup: function () {
      this.resetValidationErrors();
      let formData = new FormData();
      formData.append("name", this.name.value);
      formData.append("email", this.email.value);
      formData.append("password", this.password.value);
      formData.append(
        "password_confirmation",
        this.password_confirmation.value
      );

      this.$http
        .post(`/register`, formData)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          let otherErrors = true;
          if (error.response.data.error) {
            this.validationFields.forEach((validationField) => {
              if (error.response.data.error[validationField]) {
                this[validationField].validationMessage =
                  error.response.data.error[validationField].join(", ");
                otherErrors = false;
              }
            });
            if (otherErrors) {
              console.log(error.response.data.error);
            }
          }
        });
    },
    resetValidationErrors: function () {
      this.validationFields.forEach((validationField) => {
        this[validationField].validationMessage = "";
      });
    },
  },
};
</script>
