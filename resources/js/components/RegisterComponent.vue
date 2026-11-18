<template>
    <li><h3>Registration</h3></li>
    <li>
        <input type="text" placeholder="Name" v-model="name" /><br />

        <p class="red" v-if="errors.name">
            {{ errors.name.join('. ') }}
        </p>
        <input type="text" placeholder="Email" v-model="email" /><br />
        <p class="red" v-if="errors.email">
            {{ errors.email.join('. ') }}
        </p>
        <input type="phone" placeholder="Phone" v-model="phone" /><br />
        <p class="red" v-if="errors.phone">
            {{ errors.phone.join('. ') }}
        </p>
        <input type="password" placeholder="Password" v-model="password" /><br />
        <p class="red" v-if="errors.password">
            {{ errors.password.join('. ') }}
        </p>
        <button type="button" @click="register" class="button big fit">Регистрация</button>
    </li>
</template>
<script>
export default {
    name: 'RegisterComponent',
    props: ['server', 'successUser'],
    data() {
        return {
            name: null,
            email: null,
            phone: null,
            password: null,
            errors: {},
        };
    },
    methods: {
        register() {
            let formdata = new FormData();
            if (this.name) formdata.append('name', this.name);
            if (this.email) formdata.append('email', this.email);
            if (this.phone) formdata.append('phone', this.phone);
            if (this.password) formdata.append('password', this.password);
            this.server('register', 'POST', formdata)
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
