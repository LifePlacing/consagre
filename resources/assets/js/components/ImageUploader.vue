<template>
<div>

    <div class="uploader"
        @dragenter="OnDragEnter"
        @dragleave="OnDragLeave"
        @dragover.prevent
        @drop="onDrop"
        :class="{ dragging: isDragging }">
        
        <div class="upload-control" v-show="images.length">

            <label for="file" v-bind="{ 'disabled' : submited }" >Selecione suas imagens</label>

            <button v-on:click="upload" v-bind="{ 'disabled' : submited }">Enviar</button>

        </div>


        <div v-show="!images.length">
            <i class="fa fa-cloud-upload"></i>
            <p>Arraste suas imagens aqui</p>
            <div>OU</div>

            <div class="file-input">
                <label for="file">Selecionar Fotos</label>
                <input type="file" id="file" ref="file" @change="onInputChange" multiple >
                <input type="hidden" name="_token" :value="csrf">
            </div>

        </div>

        <div class="images-preview" v-show="images.length">
            <div class="img-wrapper" v-for="(image, index) in images" :key="index">
                <img :src="image" :alt="`Image Uplaoder ${index}`" >
                <div class="details">                    
                    <span class="size" v-text="getFileSize(files[index].size)"></span>
                </div>
                <div class="remove-container" v-bind:class="{'d-none' : submited }" > 
                    <a class="remove"  v-on:click="removeFile(index)">Remover</a> 
                </div> 
                
            </div>

        </div>          

    </div>

    <div id="progress" v-bind:class="{'d-none' : submited }" >  
        <div :style="{width:uploadPercentage+'%'}" v-text="uploadPercentage+'%' " id="progbar"
        > </div>    
    </div>


</div>

</template>

<script>
export default {
    data: () => ({
        isDragging: false,
        dragCount: 0,
        files: [],
        images: [],                
        uploadPercentage: 0,        
        submited: false,                      
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

    }),   

    methods: {

        OnDragEnter(e) {
            e.preventDefault();
            
            this.dragCount++;
            this.isDragging = true;

            return false;
        },
        OnDragLeave(e) {
            e.preventDefault();
            this.dragCount--;

            if (this.dragCount <= 0)
                this.isDragging = false;
        },
        onInputChange(e) {
            const files = e.target.files;


            Array.from(files).forEach(file => this.addImage(file));
        },
        onDrop(e) {
            e.preventDefault();
            e.stopPropagation();

            this.isDragging = false;

            const files = e.dataTransfer.files;

            Array.from(files).forEach(file => this.addImage(file));
        },


        addImage(file) {
            if (!file.type.match('image.*')) {
                this.$toastr.e(`${file.name} não é uma imagem`);
                return;
            }

            let fileMegabyte = file.size /1024;

            
            if( fileMegabyte > 4096 ){
                this.$toastr.e(`${file.name} não pode ser maior que 4MB`);
                return;
            }

            this.files.push(file);

            const img = new Image(),
            reader = new FileReader();

            reader.onload = (e) => this.images.push(e.target.result);

            reader.readAsDataURL(file);
        },

        removeFile(key){ 
            this.images.splice(key, 1); 
        },

        getFileSize(size) {
            const fSExt = ['Bytes', 'KB', 'MB', 'GB'];
            let i = 0;
            
            while(size > 900) {
                size /= 1024;
                i++;
            }

            return `${(Math.round(size * 100) / 100)} ${fSExt[i]}`;
        },
        
        upload() {

            const formData = new FormData();
            
            if(this.images.length < 21){

                this.files.forEach(file => {
                    formData.append('images[]', file, file.name);
                });

            }else{

                this.$toastr.e(`Você só pode fazer o upload de até 20 imagens`);
                    return;
            }

            axios.post('/images-upload', formData, {onUploadProgress: function( progressEvent ){                    this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded * 100 ) / progressEvent.total ) ); }.bind(this) })
                .then(response => {
                    this.$toastr.s('Todas as imagens foram enviadas com sucesso');
                    this.submited = true;
                                        
                }).catch(error =>{
                    this.$toastr.w(`Ops! Talvez você já tenha imagens suficiente neste imóvel`);
                    
                })
        }

    }
}
</script>

<style lang="scss" scoped>

.d-none{
    display:none!important;
}

.uploader {
    width: 100%;
    background: rgb(0,122,165);
    color: #fff;
    padding: 40px 15px;
    text-align: center;
    border-radius: 10px;
    border: 3px dashed #fff;
    font-size: 20px;
    position: relative;

    &.dragging {
        background: #fff;
        color: rgb(0,122,165);
        border: 3px dashed rgb(0,122,165);

        .file-input label {
            background: rgb(0,122,165);
            color: #fff;
        }
    }

    i {
        font-size: 85px;
    }

    .file-input {
        width: 200px;
        margin: auto;
        height: 68px;
        position: relative;

        label,
        input {
            background: #fff;
            color: rgb(0,122,165);
            width: 100%;
            position: absolute;
            left: 0;
            top: 0;
            padding: 10px;
            border-radius: 4px;
            margin-top: 7px;
            cursor: pointer;
        }

        input {
            opacity: 0;
            z-index: -2;
        }
    }

    .images-preview{
    
        display: flex;
        flex-wrap: wrap;
        margin-top: 20px;

        .remove-container{ 
            text-align: center; 
            } 
        .remove-container a{ 
            color: rgb(255,90,0)!important; 
            cursor: pointer; 
            }

        .d-none{
            display:none!important;
        }

        .img-wrapper {
            width: 22%!important;
            display: flex;
            flex-direction: column;
            margin: 10px;
            height: auto!important;
            justify-content: space-between;
            background: #fff;
            box-shadow: 5px 5px 20px #3e3737;
            
        }

        .details {
            font-size: 14px;
            background: #fff;
            color: rgb(0,122,165)!important;
            display: flex;
            flex-direction: column;
            align-items: self-start;
            padding: 3px 6px;
       }
    }

    .upload-control {
        position: absolute;
        width: 100%;
        background: #fff;
        top: 0;
        left: 0;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
        padding: 10px;
        padding-bottom: 4px;
        text-align: right;

        button, label {
            background: rgb(0,122,165);
            border: 2px solid #03A9F4;
            border-radius: 3px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
        }

        label {
            padding: 2px 5px;
            margin-right: 10px;
        }
    }
}
</style>
