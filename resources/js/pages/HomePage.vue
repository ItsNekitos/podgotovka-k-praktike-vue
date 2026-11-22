<template>
    <div style="width: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column; background-color: #f8f9fa;">
        <h1 style="margin-top: 40px; margin-bottom: 40px;">Помещения</h1>
        <div style="width: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column;">
            <template v-for="place in places">
                <PlaceComponent :place="place" :changePage="changePage" :PUBLIC="PUBLIC" :user="user"
                    :isUser="isUser" />
            </template>
        </div>
    </div>

</template>
<script>
import PlaceComponent from '@/components/PlaceComponent.vue';

export default {
    name: 'HomePage',
    props: ['server', 'changePage', 'PUBLIC', 'user', 'isUser'],
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
            this.server('placesHome/', 'GET', null)
                .then((result) => {
                    this.places = result.places;
                })
                .catch((error) => console.log('error', error));
        },
    },
};
</script>
