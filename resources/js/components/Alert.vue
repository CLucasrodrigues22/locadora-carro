<template>
    <div :class="style" role="alert">
        <strong>{{ conteudo }}</strong>
        <p v-if="feedback.data.message"> - {{ feedback.data.message }} </p>
        <p v-if="feedback.data.nome"> - {{ 'Nome da marca: ' + feedback.data.nome }} </p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</template>

<script>
    export default {
        props: [
            'classe',
            'feedback',
            'conteudo'
        ],
        computed: {
            style() {
                return 'alert alert-'+this.classe+' alert-dismissible fade show'
            }
        }
    }
</script>