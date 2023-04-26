<template>
    <div class="container mt-5">
        <h2>Register</h2>
        <form @submit.prevent="submitForm">
            <b-row>
                <b-col sm="6">
                    <b-form-group id="first-name-group"
                                  label="First Name:"
                                  label-for="first-name">
                        <b-form-input id="first-name"
                                      v-model="firstName"
                                      required
                                      placeholder="Enter first name">
                        </b-form-input>
                    </b-form-group>
                </b-col>

                <b-col sm="6">
                    <b-form-group id="last-name-group"
                                  label="Last Name:"
                                  label-for="last-name">
                        <b-form-input id="last-name"
                                      v-model="lastName"
                                      required
                                      placeholder="Enter last name">
                        </b-form-input>
                    </b-form-group>
                </b-col>
            </b-row>

            <b-form-group id="mobile-group"
                          label="Mobile:"
                          label-for="mobile">
                <b-form-input id="mobile"
                              v-model="mobile"
                              placeholder="Enter mobile number">
                </b-form-input>
            </b-form-group>

            <b-form-group id="email-group"
                          label="Email:"
                          label-for="email">
                <b-form-input id="email"
                              v-model="email"
                              required
                              placeholder="Enter email">
                </b-form-input>
            </b-form-group>

            <b-button type="submit"
                      variant="primary">
                Register
            </b-button>
        </form>
    </div>
</template>

<script>
export default {
    name: "Register",
    data() {
        return {
            firstName: '',
            lastName: '',
            mobile: '',
            email: ''
        }
    },
    methods: {
        submitForm() {
            // perform registration logic here
            console.log('Submitting form with firstName:', this.firstName, 'lastName:', this.lastName, 'mobile:', this.mobile, 'and email:', this.email);
        }
    }
}
</script>

<style scoped>

</style>
