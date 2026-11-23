<template>
    <div style="width: 100%; height:700px; display:flex; flex-direction: column; align-items: center; justify-content: center; margin: 20px;">
        <div style="margin-bottom: 25px; margin-top: 25px;">
            <h1>Регистрация</h1>
        </div>
        <div style="width:70%;">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Имя аккаунта</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    v-model="name">
            </div>
            <p style="height: 40px; display:flex; align-items: center; padding: 10px; background-color: rgb(255, 100, 100); color: white; border:solid 1px; border-radius:5px; border-color:red;" v-if="errors.name">
                {{ errors.name.join('. ') }}
            </p>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    v-model="email">
            </div>
            <p style="height: 40px; display:flex; align-items: center; padding: 10px; background-color: rgb(255, 100, 100); color: white; border:solid 1px; border-radius:5px; border-color:red;" v-if="errors.email">
                {{ errors.email.join('. ') }}
            </p>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Номер телефона</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    v-model="phone">
            </div>
            <p style="height: 40px; display:flex; align-items: center; padding: 10px; background-color: rgb(255, 100, 100); color: white; border:solid 1px; border-radius:5px; border-color:red;" v-if="errors.phone">
                {{ errors.phone.join('. ') }}
            </p>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="exampleInputPassword1" v-model="password">
            </div>
            <p style="height: 40px; display:flex; align-items: center; padding: 10px; background-color: rgb(255, 100, 100); color: white; border:solid 1px; border-radius:5px; border-color:red;" v-if="errors.password">
                {{ errors.password.join('. ') }}
            </p>
            <button type="submit" @click="register" class="btn btn-primary">Зарегистрироваться</button>
        </div>
    </div>
</template>
<script>
export default {
    name: 'RegisterComponent',
    props: ['server', 'successUser', 'changePage'],
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
                        this.changePage('HomePage');
                    }
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>
