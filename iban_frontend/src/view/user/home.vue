<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center bg-primary text-white">
            <h4>Check your IBAN Number</h4>
          </div>
          <div class="card-body">
            <form @submit.prevent="signup">
              <div class="form-group">
                <input-field title="International Bank Account Number" v-model="iban.value" :validation="true"
                  :validationMessage="iban.validationMessage" />
              </div>
              <button type="submit" class="btn btn-primary btn-block mt-3">
                Check
              </button>
            </form>
            <div class="mt-4" v-if="validIban.isValid">
              <h5 class="text-success text-center">{{ validIban.message }}</h5>
            </div>
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
      iban: {
        value: "",
        validationMessage: "",
      },
      validIban: {
        isValid: false,
        message: ""
      },
      validationFields: ["iban"],

    };
  },
  methods: {
    signup: function () {
      this.resetValidationErrors();
      let formData = new FormData();
      formData.append("iban", this.iban.value);

      this.$http
        .post(`/validate/iban`, formData)
        .then((response) => {
          this.validIban.isValid = true;
          this.validIban.message = response.data.result
        })
        .catch((error) => {
          this.validIban.isValid = false;
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
