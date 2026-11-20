<template>
    <article class="comment" v-for="value in orders">
        <div class="contains-inline">
            <ul class="list-group md:list-group-horizontal">
                <li class="list-group-item">{{ value.name }}</li>
                <li class="list-group-item">{{ value.event }}</li>
                <li class="list-group-item">{{ value.date }}</li>
                <li class="list-group-item">{{ value.oplata }}</li>
                <li class="list-group-item">{{ value.status }}</li>
            </ul>
            <div v-if="value.status =='done'">
                <a href="#" @click.prevent="changePage('AuthPage')" type="button" class="btn btn-primary">Оставить отзыв</a>
            </div>
        </div>
    </article>
</template>


<script>

export default {
    name: 'UserComponent',
    props: ['changePage', 'PUBLIC', 'user', 'server', 'isUser'],
    data() {
        return {
            orders: [],
        };
    },
    mounted() {
        this.ordersUser();
    },
    methods: {
        ordersUser() {
            this.server('orderUser/', 'GET', null)
                .then((result) => {
                    this.orders = result.orders;
                })
                .catch((error) => console.log('error', error));
        },
    },
};

</script>