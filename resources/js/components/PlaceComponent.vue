<template>
        <article>
            <header>
                <div>
                    <h2><a href="#" @click.prevent="changePage('SinglePage', place.id)">{{ place.name }}</a></h2>
                    <p>{{ place.desc }}</p>
                </div>
                <div class="meta">
                    <time class="published" datetime="2015-11-01">{{ place.created_at.split("T")[0] }}, {{ place.created_at.split(".")[0].split("T")[1] }}</time>
                </div>
            </header>
            <a href="#" @click.prevent="changePage('SinglePage', place.id)" class="image featured"><img :src="PUBLIC + place.photo" alt="" /></a>
            <footer>
                <ul class="actions">
                    <li><a href="#" @click.prevent="changePage('SinglePage', place.id)" class="button big">Continue Reading</a></li>
                </ul>
            </footer>
        </article>
</template>


<script>

export default {
    name: 'PlaceComponent',
    props: ['place', 'changePage', 'PUBLIC'],
};
</script>
