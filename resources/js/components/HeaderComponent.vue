<template>
    <header style="width: 100%; height:100px; display:flex; align-items: center;">
        <div class="container">
            <div class="row">
                <div class="col">
                    <img src="" alt="" />
                    <a href="#" @click.prevent="changePage('HomePage')">Конференции.рф</a>
                </div>
                <div class="col-6"></div>
                <div class="col" v-if="isUser">
                    <a href="#" @click.prevent="changePage('UserPage')" type="button" class="btn btn-primary">Кабинет</a>
                    <a href="" @click.prevent="logout()">Выйти</a>
                </div>
                <div class="col" v-else>
                    <a href="#" @click.prevent="changePage('AuthPage', 'login')" type="button" class="btn btn-primary">Войти</a>
                    <a href="#" @click.prevent="changePage('AuthPage', 'register')" type="button"
                        class="btn btn-secondary">Регистрация</a>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: 'HeaderComponent',
    props: ['isUser', 'user', 'changePage', 'PUBLIC', 'logout'],
};
</script>
