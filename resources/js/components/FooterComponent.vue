<template>
    <section id="footer" style="background-color: #007bff;">
        <img :src="PUBLIC + 'photos/soc.png'" alt="">
    </section>
</template>

<script>
export default {
    name: 'FooterComponent',
    props: ['PUBLIC'],
};
</script>
