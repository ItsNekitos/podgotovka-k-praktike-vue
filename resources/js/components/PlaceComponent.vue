<template>
    <div style="margin:20px;">
        <article>
            <div class="card card-row" style="max-width: 2040px;">
                <img :src="PUBLIC + place.photo" class="card-img-start" alt="...">
                <div class="card-body">
                    <h4 class="card-title">{{ place.name }}</h4>
                    <p class="card-text">{{ place.desc }}</p>
                    <a href="#" @click.prevent="changePage('SinglePage', place.id)" type="button"
                        class="btn btn-secondary" style="background-color: #6c757d; margin-right: 10px;">Посмотреть</a>
                    <a v-if="isUser && user.role != 'admin'" href="#" @click.prevent="changePage('OrderPage', place.id)"
                        type="button" class="btn btn-primary" style="background-color: #007bff;">Заказать</a>
                </div>
            </div>
        </article>
    </div>
</template>


<script>

export default {
    name: 'PlaceComponent',
    props: ['place', 'changePage', 'PUBLIC', 'user', 'isUser'],
};
</script>
