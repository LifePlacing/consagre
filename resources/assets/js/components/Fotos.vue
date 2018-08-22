<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-sm-12">
                        <image-uploader> Carregando modulo imagens ... </image-uploader>
            </div>
        </div>
    </div>
</template>

<script>
    import ImageUploader from './ImageUploader';
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components: {
            ImageUploader
        }
    }
</script>

<style lang="sass">
@import '~vue-toastr/src/vue-toastr.scss';
</style>

