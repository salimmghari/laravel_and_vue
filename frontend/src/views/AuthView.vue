<template>
    <AppLayout className="vh-100 overflow-y">
        <AppForm v-if="loginForm" title="Login" :fields="[
            {
                label: 'Username:',
                type: 'text',
                placeholder: 'Your username',
                onChange: (event: Event) => username = (event.target as HTMLInputElement).value
            }, {
                label: 'Password:',
                type: 'password',
                placeholder: 'Your password',
                onChange: (event: Event) => password = (event.target as HTMLInputElement).value
            }
        ]" link="Signup?" :onLinkClick="() => loginForm = !loginForm" :onClick="login" />
        <AppForm v-else title="Signup" :fields="[
            {
                label: 'Username:',
                type: 'text',
                placeholder: 'Your username',
                onChange: (event: Event) => newUsername = (event.target as HTMLInputElement).value
            }, {
                label: 'Password:',
                type: 'password',
                placeholder: 'Your password',
                onChange: (event: Event) => newPassword = (event.target as HTMLInputElement).value
            }, {
                label: 'Confirm Password:',
                type: 'password',
                placeholder: 'Confirm your password',
                onChange: (event: Event) => confirmNewPassword = (event.target as HTMLInputElement).value
            }
        ]" link="Login?" :onLinkClick="() => loginForm = !loginForm" :onClick="signup"/>
    </AppLayout>
</template>
<style scoped>
</style>
<script lang="ts">
    import {defineComponent} from 'vue';
    import axios, {AxiosResponse} from 'axios';
    import AppLayout from '../components/AppLayout.vue';
    import AppForm from '../components/AppForm.vue';
    import config from '../config.json';


    export default defineComponent(
        {
            name: 'AuthView',
            components: {
                AppLayout,
                AppForm
            },
            data() {
                return {
                    loginForm: true,
                    username: '',
                    password: '',
                    newUsername: '',
                    newPassword: '',
                    confirmNewPassword: ''
                }
            },
            methods: {
                login() {
                    if (
                        this.username !== ''
                        && this.password !== ''
                    ) {
                        axios.post(
                            `${config.url}/api/login`,
                            {
                                username: this.username,
                                password: this.password
                            }
                        ).then((response: AxiosResponse<any, any>) => {
                            localStorage.setItem('token', response.data.token);
                            this.$store.dispatch('login', response.data.token);
                            this.$router.push('/');
                        }).catch((error: any) => console.error(error));    
                    }
                },
                signup() {
                    if (
                        this.newUsername !== ''
                        && this.newPassword !== ''
                        && this.newPassword === this.confirmNewPassword
                    ) {
                        axios.post(
                            `${config.url}/api/signup`,
                            {
                                username: this.newUsername,
                                password: this.newPassword,
                                password_confirmation: this.confirmNewPassword
                            }
                        ).then((response: AxiosResponse<any, any>) => {
                            localStorage.setItem('token', response.data.token);
                            this.$store.dispatch('login', response.data.token);
                            this.$router.push('/');
                        }).catch((error: any) => console.error(error));    
                    }
                }
            } 
        }
    );
</script>
  