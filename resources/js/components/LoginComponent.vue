<template>
    <div style="width: 100%; height:700px; display:flex; flex-direction: column; align-items: center; justify-content: center;">
        <div style="margin-bottom: 25px; margin-top: 25px;">
            <h1>Вход в аккаунт</h1>
        </div>
        <div style="width:70%;">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Имя аккаунта</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    v-model="name">
            </div>
            <p class="red" v-if="errors.name">
                {{ errors.name.join('. ') }}
            </p>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="exampleInputPassword1" v-model="password">
            </div>
            <p class="red" v-if="errors.password">
                {{ errors.password.join('. ') }}
            </p>
            <button type="submit" @click="login" class="btn btn-primary">Отправить</button>
        </div>
    </div>
</template>
<script>
export default {
    name: 'LoginComponent',
    props: ['server', 'successUser', 'changePage'],
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
                        this.changePage('HomePage');
                    }
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>
