<template>
    <div>
        <div v-if="isUser && user.role == 'user'">
            <UserComponent :changePage="changePage" :PUBLIC="PUBLIC" :user="user" :isUser="isUser" :server="server" />
        </div>
        <div v-if="isUser && user.role == 'admin'">
            <AdminComponent :changePage="changePage" :PUBLIC="PUBLIC" :user="user" :server="server" :pageId="pageId" />
        </div>
    </div>
</template>
<script>
import UserComponent from '@/components/UserComponent.vue';
import AdminComponent from '@/components/AdminComponent.vue';

export default {
    name: 'UserPage',
    props: ['server', 'PUBLIC', 'changePage', 'user', 'isUser', 'pageId'],
    components: {
        UserComponent,
        AdminComponent,
    },
};
</script>
