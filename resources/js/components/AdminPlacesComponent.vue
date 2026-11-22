<template>
    <div
        style="width: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column; background-color: #f8f9fa;">
        <h1 style="margin-top: 40px; margin-bottom: 40px;">Помещения</h1>
        <div style="width: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column;">
            <div style="margin:20px;">
                <article v-for="value in places">
                    <div class="card card-row" style="max-width: 1040px; margin-bottom: 20px;">
                        <img :src="PUBLIC + value.photo" class="card-img-start" alt="...">
                        <div class="card-body">
                            <h4 class="card-title">{{ value.name }}</h4>
                            <p class="card-text">{{ value.desc }}</p>
                            <a href="#" @click.prevent="changePage('PlacePage', value.id)" type="button"
                                class="btn btn-primary" style="margin-right: 10px;">Редактировать место</a>
                            <button type="button" @click="placedelete(value.id)" class="btn"
                                style="background-color: red; color: white;">Удалить место</button>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
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