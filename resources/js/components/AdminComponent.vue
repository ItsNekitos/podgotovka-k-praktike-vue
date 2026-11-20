<template>
<div>
    <div>
        <a href="#" @click.prevent="changePage('UserPage', 'orders')" type="button" class="btn btn-primary">Список заказов</a>
        <a href="#" @click.prevent="changePage('UserPage', 'places')" type="button" class="btn btn-primary">Список мест</a>
        <a href="#" @click.prevent="changePage('PlacePage')" type="button" class="btn btn-primary">Создать место</a>
    </div>
    <div v-if="pageId == 'places'">
        <AdminPlacesComponent :server="server" :changePage="changePage" :PUBLIC="PUBLIC" :user="user" />
    </div>
    <div v-else>
        <AdminOrdersComponent :server="server" :changePage="changePage" :PUBLIC="PUBLIC" :user="user" />
    </div>
</div>
</template>


<script>
import AdminPlacesComponent from '@/components/AdminPlacesComponent.vue';
import AdminOrdersComponent from '@/components/AdminOrdersComponent.vue';

export default {
    name: 'AdminComponent',
    props: ['changePage', 'PUBLIC', 'user', 'server', 'pageId'],
    components: {
        AdminPlacesComponent,
        AdminOrdersComponent,
    },
};
</script>