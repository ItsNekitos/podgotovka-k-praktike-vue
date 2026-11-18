<template>
    <li><h3>Login</h3></li>
    <li>
        <input type="text" placeholder="Name" v-model="name" /><br />
        <p class="red" v-if="errors.name">
            {{ errors.name.join('. ') }}
        </p>
        <input type="password" placeholder="Password" v-model="password" /><br />
        <p class="red" v-if="errors.password">
            {{ errors.password.join('. ') }}
        </p>
        <button type="submit" @click="login" class="button big fit">Войти</button>
    </li>
</template>
<script>
export default {
    name: 'LoginComponent',
    props: ['server', 'successUser'],
    data() {
        return {
            name: null,
            password: null,
            errors: {},
        };
    },
    methods: {
        login() {
            let formdata = new FormData();
            if (this.name) formdata.append('name', this.name);
            if (this.password) formdata.append('password', this.password);

            this.server('login', 'POST', formdata)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                    }
                    if (result.token) {
                        this.successUser(result.token);
                    }
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>
