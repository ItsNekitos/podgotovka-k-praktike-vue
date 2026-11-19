<template>
    <div v-if="this.pageId == 'register'">
        <RegisterComponent :changePage="changePage" :server="server" :successUser="successUser" :PUBLIC="PUBLIC" />
    </div>
    <div v-else>
        <LoginComponent :changePage="changePage" :server="server" :successUser="successUser" :PUBLIC="PUBLIC" />
    </div>
</template>
<script>
import RegisterComponent from '@/components/RegisterComponent.vue';
import LoginComponent from '@/components/LoginComponent.vue';

export default {
    name: 'AuthPage',
    props: ['server', 'successUser', 'changePage', 'pageId', 'PUBLIC', 'user'],
    components: {
        RegisterComponent,
        LoginComponent,
    },
};
</script>