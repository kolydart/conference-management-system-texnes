<template>
    <div v-html="row.document_link"></div>
</template>


<script>
    export default {
        props: ['row'],
    }
</script>
