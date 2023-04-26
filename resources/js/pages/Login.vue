<template>
    <div class="container mt-5">
        <h2>Login</h2>
        <form @submit.prevent="submitForm">
            <b-form-group id="username-group"
                          label="Username:"
                          label-for="username">
                <b-form-input id="username"
                              v-model="username"
                              required
                              placeholder="Enter username">
                </b-form-input>
            </b-form-group>

            <b-form-group id="password-group"
                          label="Password:"
                          label-for="password">
                <b-form-input id="password"
                              type="password"
                              v-model="password"
                              required
                              placeholder="Enter password">
                </b-form-input>
            </b-form-group>

            <b-button type="submit"
                      variant="primary">
                Login
            </b-button>
        </form>
    </div>
</template>

<script>
export default {
    name: 'Login',
    data() {
        return {
            username: '',
            password: ''
        }
    },
    methods: {
        submitForm() {
            // perform login authentication here
            console.log('Submitting form with username:', this.username, 'and password:', this.password);
        }
    }
}
</script>

<style scoped>

</style>
