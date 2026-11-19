<template>
    <div>
        <div v-if="isUser && user.role == 'user'">
            <UserComponent :changePage="changePage" :PUBLIC="PUBLIC" :user="user" :isUser="isUser" :server="server" />
        </div>
        <div v-if="isUser && user.role == 'admin'">
            <AdminComponent :changePage="changePage" :PUBLIC="PUBLIC" :user="user" :server="server" />
        </div>
    </div>
</template>
<script>
import UserComponent from '@/components/UserComponent.vue';
import AdminComponent from '@/components/AdminComponent.vue';

export default {
    name: 'UserPage',
    props: ['server', 'PUBLIC', 'changePage', 'user', 'isUser'],
    components: {
        UserComponent,
        AdminComponent,
    },
};
</script>
