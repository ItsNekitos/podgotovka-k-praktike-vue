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