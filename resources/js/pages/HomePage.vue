<template>
    <h1>Помещения</h1>
    <div>
        <template v-for="place in places.data">
            <PlaceComponent :places="place" :changePage="changePage" :PUBLIC="PUBLIC" />
        </template>
    </div>

</template>
<script>
import PlaceComponent from '@/components/PlaceComponent.vue';

export default {
    name: 'HomePage',
    props: ['server', 'changePage', 'PUBLIC', 'user'],
    components: {
        PlaceComponent,
    },
    data() {
        return {
            places: [],
        };
    },
    mounted() {
        this.placesHome();
    },
    methods: {
        placesHome() {
            this.server('placesHome/', 'GET', null, this.user.id)
                .then((result) => {
                    this.places = result.places;
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>
