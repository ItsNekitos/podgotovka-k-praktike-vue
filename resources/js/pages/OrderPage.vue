<template>
    <div
        style="width: 100%; height:700px; display:flex; flex-direction: column; align-items: center; justify-content: center; margin: 20px;">
        <div style="margin-bottom: 25px; margin-top: 25px;">
            <h1>Сделать заказ</h1>
        </div>
        <div style="width:70%;">
            <div class="mb-3">
                <label for="disabledInput" class="form-label">Название помещения</label>
                <input type="text" class="form-control" id="disabledInput" aria-describedby="emailHelp"
                    v-model="name" disabled>
            </div>
            <p class="red" v-if="errors.name">
                {{ errors.name.join('. ') }}
            </p>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Название вашего мероприятия</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    v-model="event">
            </div>
            <p class="red" v-if="errors.event">
                {{ errors.event.join('. ') }}
            </p>
            <div class="mb-3">
                <label for="eventDate" class="form-label">Дата</label>
                <input type="date" class="form-control" id="eventDate" name="date" v-model="date">
            </div>
            <p class="red" v-if="errors.date">
                {{ errors.date.join('. ') }}
            </p>
            <div class="mb-3">
                <label for="categorySelect" class="form-label">Способ оплаты</label>
                <select class="form-select" id="categorySelect" name="oplata" v-model="oplata">
                    <option value="nal">Наличные</option>
                    <option value="perevod">По карте</option>
                </select>
            </div>
            <p class="red" v-if="errors.oplata">
                {{ errors.oplata.join('. ') }}
            </p>
            <button type="button" @click="orderadd" class="btn btn-primary">Заказать</button>
        </div>
    </div>
</template>
<script>
export default {
    name: 'OrderPage',
    props: ['server', 'changePage', 'pageId', 'PUBLIC'],
    data() {
        return {
            name: null,
            event: null,
            date: null,
            oplata: 'nal',
            errors: {},
        };
    },
    mounted() {
        if (this.pageId) {
            this.getPlace();
        }
    },
    methods: {
        getPlace() {
            this.server('place/' + this.pageId)
                .then((result) => {
                    this.name = result.place.name;
                    this.desc = result.place.desc;
                    this.photo = result.place.photo;
                })
                .catch((error) => console.log('error', error));
        },
        orderadd() {
            let formdata = new FormData();
            if (this.name) formdata.append('name', this.name);
            if (this.event) formdata.append('event', this.event);
            if (this.date) formdata.append('date', this.date);
            if (this.oplata) formdata.append('oplata', this.oplata);
            this.server('orderadd', 'POST', formdata)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                    }

                    if (result.id) {
                        this.changePage('UserPage');
                    }
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>
