<template>
    <div
        style="width: 100%; display:flex; flex-direction: column; align-items: center; justify-content: center;">
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
                    </ul>
                    <ul class="list-unstyled row text-center m-0">
                        <li class="col border p-2">{{ value.name }}</li>
                        <li class="col border p-2">{{ value.event }}</li>
                        <li class="col border p-2">{{ dateNormalno(value.date) }}</li>
                        <li v-if="value.oplata == 'nal'" class="col border p-2">Наличными</li>
                        <li v-else class="col border p-2">По карте</li>

                        <li v-if="value.status == 'new'" class="col border p-2">Новое</li>
                        <li v-if="value.status == 'in_process'" class="col border p-2">Мероприятие назначено</li>
                        <li v-if="value.status == 'done'" class="col border p-2">
                            <p>Завершено</p>
                            <a href="#" @click.prevent="changePage('SinglePage', value.id)" type="button"
                            class="btn btn-primary">Оставить
                            отзыв</a>
                        </li>
                        <li v-if="value.status == 'canceled'" class="col border p-2">Отменен</li>
                    </ul>
                </div>
            </article>
        </div>
    </div>
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
        dateNormalno(date){
            let date1 = date.split('T');
            let date2= date1[0].split('-')
            let datenorm = date2[2] + '-' + date2[1] + '-' + date2[0] + ' ' + date1[1];
            return(datenorm);
        },
    },
};

</script>