<template>
    <p>dsdsd</p>
    <article class="comment" v-for="value in places">
        <div class="contains-inline">
            <ul class="list-group md:list-group-horizontal">
                <li class="list-group-item">{{ value.name }}</li>
                <li class="list-group-item">{{ value.desc }}</li>
                <img :src="PUBLIC + value.photo" class="card-img-start" alt="...">
                <a href="#" @click.prevent="changePage('PlacePage', value.id)" type="button" class="btn btn-primary">Редактировать место</a>
                <button type="button" @click="placedelete(value.id)" class="button big fit">Удалить место</button>
            </ul>
        </div>
    </article>
</template>


<script>

export default {
    name: 'AdminPlacesComponent',
    props: ['changePage', 'PUBLIC', 'user', 'server'],
    data() {
        return {
            places: [],
        };
    },
    mounted() {
        this.placesAdmin();
    },
    methods: {
        placesAdmin() {
            this.server('placesHome/', 'GET', null)
                .then((result) => {
                    this.places = result.places;
                })
                .catch((error) => console.log('error', error));
        },
        placedelete(place) {
            this.server('placedelete/' + place, 'DELETE', null)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                    } else {
                        this.placesAdmin();
                    }
                })
                .catch((error) => console.log('error', error));
        },
    },
};

</script>