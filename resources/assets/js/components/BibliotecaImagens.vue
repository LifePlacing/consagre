<template>    
   
    <div class="modal fade" v-bind:id="identifica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            
            <h4 class="modal-title" id="myModalLabel">{{ titulo }}</h4>

          </div>
          <div class="modal-body">

                <slot v-bind:imgid="imgid"></slot>

          </div>

        </div>
      </div>
    </div>

</template>

<script>
    
    export default {

        data: () => ({ 
                                                       
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }),  

        props:['identifica', 'titulo', 'imgid'],



    }

</script>

