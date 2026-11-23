<template>
    <div style="width: 100%; display:flex; flex-direction: column; align-items: center; justify-content: center;">
        <div style="margin-bottom: 25px; margin-top: 25px;">
            <h1>Список заказов</h1>
        </div>
        <div style="width: 80%; margin-bottom: 20px;">
            <article class="comment" v-for="value in orders">
                <div class="contains-inline" style="margin-bottom: 20px;">
                    <ul class="list-unstyled row text-center fw-bold m-0">
                        <li class="col border p-2">Помещение</li>
                        <li class="col border p-2">Мероприятие</li>
                        <li class="col border p-2">Дата</li>
                        <li class="col border p-2">Оплата</li>
                        <li class="col border p-2">Статус</li>
                        <li class="col border p-2"></li>
                    </ul>
                    <ul class="list-unstyled row text-center m-0">
                        <li class="col border p-2">{{ value.name }}</li>
                        <li class="col border p-2">{{ value.event }}</li>
                        <li class="col border p-2">{{ value.date }}</li>
                        <li v-if="value.oplata == 'nal'" class="col border p-2">Наличными</li>
                        <li v-else class="col border p-2">По карте</li>

                        <li class="col border p-2">
                            <select class="form-select" id="categorySelect" v-model="value.status">
                                <option value="in_process">Мероприятие назначено</option>
                                <option value="new">Новое</option>
                                <option value="done">Завершено</option>
                                <option value="canceled">Отменено</option>
                            </select>
                        </li>

                        <li class="col border p-2">
                            <button type="button" @click="orderedit(value.id, value.status)"
                                class="btn btn-primary">Редактировать заказ</button>
                        </li>
                    </ul>
                </div>
            </article>
        </div>
    </div>
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
                        alert("Статус заказа изменён.");
                    }
                })
                .catch((error) => console.log('error', error));
        },
    },
};

</script>