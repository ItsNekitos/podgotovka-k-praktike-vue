<template>
    <article class="comment" v-for="value in orders">
        <div class="contains-inline">
            <ul class="list-group md:list-group-horizontal">
                <li class="list-group-item">{{ value.name }}</li>
                <li class="list-group-item">{{ value.event }}</li>
                <li class="list-group-item">{{ value.date }}</li>
                <li class="list-group-item">{{ value.oplata }}</li>
                <li class="list-group-item zstatus" style="display: flex; flex-direction: column;">
                    <select id="" name="status" v-model="value.status">
                        <option value="in_process">Мероприятие назначено</option>
                        <option value="new">Новое</option>
                        <option value="done">Завершено</option>
                        <option value="canceled">Отменено</option>
                    </select>
                </li>
                <li>
                    <button type="button" @click="orderedit(value.id, value.status)" class="button big fit">Редактировать заказ</button>
                </li>
            </ul>
        </div>
    </article>
</template>


<script>

export default {
    name: 'AdminOrdersComponent',
    props: ['changePage', 'PUBLIC', 'user', 'server'],
    data() {
        return {
            orders: [],
        };
    },
    mounted() {
        this.ordersAdmin();
    },
    methods: {
        ordersAdmin() {
            this.server('orderAdmin/', 'GET', null)
                .then((result) => {
                    this.orders = result.orders;
                })
                .catch((error) => console.log('error', error));
        },
        orderedit(order, status) {
            let formdata = new FormData();
            if (status) formdata.append('status', status);
            this.server('orderedit/' + order, 'POST', formdata)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                    }

                    if (result.id) {
                        this.changePage('UserPage', 'orders');
                    }
                })
                .catch((error) => console.log('error', error));
        },
    },
};

</script>