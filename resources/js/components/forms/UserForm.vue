<template>
  <div class="col-md-6">
    <label for="firstName">First Name</label>
    <input
      id="firstName-input"
      type="text"
      v-model="user.firstName"
      class="form-control"
      placeholder="Example"
    />
    <div id="firstName-invalid" class="invalid-feedback"></div>
  </div>
  <div class="col-md-6">
    <label for="lastName">Last Name</label>
    <input
      id="lastName-input"
      type="text"
      v-model="user.lastName"
      class="form-control"
      placeholder="John"
    />
    <div id="lastName-invalid" class="invalid-feedback"></div>
  </div>
  <div class="col-12">
    <label for="email">Email</label>
    <input
      id="email-input"
      type="email"
      v-model="user.email"
      class="form-control"
      placeholder="example.john@cat.com"
    />
    <div id="email-invalid" class="invalid-feedback"></div>
  </div>
  <div class="col-md-3">
    <label for="zipCode">Zip code</label>
    <input
      id="zipCode-input"
      type="text"
      pattern="[0-9]{4}"
      v-model="user.zipCode.zipCode"
      :class="{
        'is-valid': zipCodeInput.isValid,
        'is-invalid': zipCodeInput.isError,
      }"
      class="form-control"
      placeholder="1000"
    />
    <div id="zipCode-invalid" class="invalid-feedback">
      Please provide a valid zip.
    </div>
  </div>
  <div class="col-md-4 offset-md-1">
    <label for="city">City</label>
    <input
      disabled
      type="text"
      v-model="user.zipCode.city"
      class="form-control"
      placeholder="Szeged"
    />
  </div>
  <div class="col-md-3 offset-md-1">
    <label for="county">County</label>
    <input
      disabled
      type="text"
      v-model="user.zipCode.county"
      class="form-control"
      placeholder="Csongrád-Csanád vármegye"
    />
  </div>
  <div class="col-12">
    <label for="address">Address</label>
    <input
      id="address-input"
      type="text"
      v-model="user.address"
      class="form-control"
      placeholder="Széchenyi tér 1"
    />
    <div id="address-invalid" class="invalid-feedback"></div>
  </div>
</template>

<script>
export default {
  name: "user-form",
  props: {
    user: {
      type: Object,
    },
  },
  data() {
    return {
      zipCodeInput: {
        isValid: false,
        isError: false,
      },
    };
  },
  methods: {
    showErrors(error) {
      for (const [field, message] of Object.entries(error.errors)) {
        const input = document.getElementById(field + "-input");
        const invalid = document.getElementById(field + "-invalid");
        invalid.innerHTML = message;
        input.classList.add("is-invalid");
      }
    },
    deleteErrors() {
      const errors = document.querySelectorAll(".is-invalid");
      errors.forEach((box) => {
        box.classList.remove("is-invalid");
      });
    },
  },
  watch: {
    "user.zipCode.zipCode": function (val) {
      if (val && val.length === 4) {
        axios
          .get(`api/zip-code/${val}`)
          .then(({ data }) => {
            this.user.zipCode = data.data;
            this.zipCodeInput.isError = false;
            this.zipCodeInput.isValid = true;
          })
          .catch(({ response }) => {
            if (response.status === 404) {
              this.zipCodeInput.isError = true;
              this.zipCodeInput.isValid = false;
              this.$emit("clearLocation");
            } else {
              console.error(response);
            }
          });
      } else {
        this.$emit("clearLocation");
        this.zipCodeInput.isError = false;
        this.zipCodeInput.isValid = false;
      }
    },
  },
};
</script>

<style>
</style>