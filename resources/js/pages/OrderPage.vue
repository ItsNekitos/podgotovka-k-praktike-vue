<template>
    <!-- Main -->
    <div id="main">
        <!-- Post -->
        <article class="post">
            <h1>Сделать заказ</h1>
            <input type="text" v-model="name" placeholder="Post name" /><br />
            <p class="red" v-if="errors.name">
                {{ errors.name.join('. ') }}
            </p>
            <input type="text" v-model="event" placeholder="Event" /><br />
            <p class="red" v-if="errors.event">
                {{ errors.event.join('. ') }}
            </p>
            <input type="datetime-local" v-model="date">
            <p class="red" v-if="errors.date">
                {{ errors.date.join('. ') }}
            </p>
            <div class="mb-3">
                <label>Способ оплаты</label>
                <select name="oplata" v-model="oplata">
                    <option value="nal">Наличные</option>
                    <option value="perevod">По карте</option>
                </select>
            </div>
            <p class="red" v-if="errors.oplata">
                {{ errors.oplata.join('. ') }}
            </p>
            <button type="button" @click="orderadd" class="button big fit">Заказать</button>
        </article>
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
