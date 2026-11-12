<template>
    <header style="width: 100%; height:100px; display:flex; align-items: center;">
        <div class="container">
            <div class="row">
                <div class="col">
                    <img src="" alt="" />
                    <a href="#" @click.prevent="changePage('HomePage')">Конференции.рф</a>
                </div>
                <div class="col-6"></div>
                <div class="col">
                    <button type="button" class="btn btn-primary">Войти</button>
                    <button type="button" class="btn btn-secondary">Регистрация</button>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: 'HeaderComponent',
    props: ['isUser', 'user', 'changePage', 'PUBLIC'],
};
</script>
