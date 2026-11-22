<template>
    <header style="width: 100%; height:100px; display:flex; align-items: center; background-color: #007bff;">
        <div class="container">
            <div class="row">
                <div class="col" style="display: flex; align-items: center;">
                    <img :src="PUBLIC + 'photos/logo.jpg'" alt="..." style="width: 75px; border-radius: 370px;">
                    <a href="#" @click.prevent="changePage('HomePage')" style="margin: 10px; text-decoration: none; color: white; font-size: 24px;">Конференции.рф</a>
                </div>
                <div class="col-6"></div>


                <div class="col" v-if="isUser" style="display: flex; align-items: center; justify-content: end;">
                    <div class="dropdown">
                        <button class="btn btn-primary" style="background-color: #0d47a1; width: 100px; height: 50px;" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Меню
                        </button>
                        <ul class="dropdown-menu">
                            <li v-if="user.role != 'admin'"><a href="#" @click.prevent="changePage('UserPage')" class="dropdown-item">Кабинет</a></li>
                            <li v-if="user.role == 'admin'"><a href="#" @click.prevent="changePage('UserPage', 'orders')" class="dropdown-item">Список заказов</a></li>
                            <li v-if="user.role == 'admin'"><a href="#" @click.prevent="changePage('UserPage', 'places')" class="dropdown-item">Список мест</a></li>
                            <li v-if="user.role == 'admin'"><a href="#" @click.prevent="changePage('PlacePage')" class="dropdown-item">Создать место</a></li>

                            <li><a href="" @click.prevent="logout()" class="dropdown-item">Выйти</a></li>
                        </ul>
                    </div>
                </div>


                <div class="col" style="display: flex; align-items: center; justify-content: center;" v-else>
                    <a href="#" @click.prevent="changePage('AuthPage', 'login')" type="button" class="btn btn-primary" style="display:flex; align-items: center; justify-content: center; width: 100px; height: 50px; background-color: #0d47a1; margin-right: 10px;">Войти</a>
                    <a href="#" @click.prevent="changePage('AuthPage', 'register')" type="button" class="btn btn-secondary" style="display:flex; align-items: center; justify-content: center; width: 120px; height: 50px;">Регистрация</a>
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
