<template>
    <article>
        <div class="card card-row" style="max-width: 540px;">
            <img :src="PUBLIC + place.photo" class="card-img-start" alt="...">
            <div class="card-body">
                <h4 class="card-title">{{ place.name }}</h4>
                <p class="card-text">{{ place.desc }}</p>
                <a v-if="isUser && user.role != 'admin'" href="#" @click.prevent="changePage('OrderPage', place.id)" type="button" class="btn btn-primary">Заказать</a>
            </div>
        </div>
    </article>
</template>


<script>

export default {
    name: 'PlaceComponent',
    props: ['place', 'changePage', 'PUBLIC', 'user', 'isUser'],
};
</script>
