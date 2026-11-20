<template>
    <div>
        <HeaderComponent :user="user" :isUser="isUser" :logout="logout" :changePage="changePage" :PUBLIC="PUBLIC" />

        <template v-if="isLoad">
            <HomePage v-if="page == 'HomePage'" :user="user" :isUser="isUser" :server="server" :changePage="changePage" :PUBLIC="PUBLIC" />
            <AuthPage v-if="page == 'AuthPage'" :user="user" :server="server" :successUser="successUser" :changePage="changePage" :pageId="pageId" :PUBLIC="PUBLIC" />
            <OrderPage v-if="page == 'OrderPage'" :server="server" :changePage="changePage" :pageId="pageId" :PUBLIC="PUBLIC" />
            <SinglePage v-if="page == 'SinglePage'" :pageId="pageId" :isUser="isUser" :server="server" :changePage="changePage" :PUBLIC="PUBLIC" />
            <PlacePage v-if="page == 'PlacePage'" :pageId="pageId" :isUser="isUser" :server="server" :changePage="changePage" :PUBLIC="PUBLIC" />
            <UserPage v-if="page == 'UserPage'" :user="user" :isUser="isUser" :pageId="pageId" :server="server" :changePage="changePage" :PUBLIC="PUBLIC" />
        </template>
        <template v-else>
            <h1>ЗАГРУЗКА...</h1>
        </template>
    </div>
    <FooterComponent />
</template>

<script>
import FooterComponent from './components/FooterComponent.vue';
import HeaderComponent from './components/HeaderComponent.vue';
import HomePage from './pages/HomePage.vue';
import OrderPage from './pages/OrderPage.vue';
import PlacePage from './pages/PlacePage.vue';
import UserPage from './pages/UserPage.vue';
import AuthPage from './pages/AuthPage.vue';
import SinglePage from './pages/SinglePage.vue';

export default {
    name: 'App',
    data() {
        return {
            page: localStorage.getItem('page')||"HomePage",
            pageId: localStorage.getItem('pageId')||"pageId",
            API: 'http://127.0.0.1:8000/api/',
            PUBLIC: 'http://127.0.0.1:8000/storage/',
            isUser: false,
            isLoad: false,
            user: {},
        };
    },
    components: {
        HeaderComponent,
        FooterComponent,
        HomePage,
        OrderPage,
        PlacePage,
        UserPage,
        AuthPage,
        SinglePage,
    },
    mounted() {
        if (localStorage.getItem('token')) {
            this.getUser();
        } else {
            this.isLoad = true;
        }
    },
    methods: {
        changePage(page, pageId = null) {
            this.page = page;
            this.pageId = pageId;
            localStorage.setItem("page", this.page);
            localStorage.setItem("pageId", this.pageId);
        },
        getUser() {
            this.server('user')
                .then((result) => {
                    this.user = result;
                    this.isUser = true;
                    this.isLoad = true;
                })
                .catch((error) => console.log('error', error));
        },
        successUser(token) {
            localStorage.setItem('token', token);
            this.isUser = true;
            this.getUser();
        },
        logout() {
            localStorage.removeItem('token');
            this.user = {};
            this.isUser = false;
            this.isLoad = true;
        },
        async server(route, method = 'GET', formdata = null, userid = null) {
            let myHeaders = new Headers();
            myHeaders.append('Accept', 'application/json');

            if (localStorage.getItem('token')) {
                myHeaders.append('Authorization', 'Bearer ' + localStorage.getItem('token'));
                if(userid){
                    myHeaders.append('userid', userid);
                }
            }

            let requestOptions = {
                method: method,
                headers: myHeaders,
                redirect: 'follow',
            };
            if (method != 'GET') {
                requestOptions.body = formdata;
            }

            return await fetch(this.API + route, requestOptions).then((response) => {
                if (response.status == 401) {
                    localStorage.removeItem('token');
                    this.changePage('HomePage');
                }
                return response.json();
            });
        },
    },
};
</script>
