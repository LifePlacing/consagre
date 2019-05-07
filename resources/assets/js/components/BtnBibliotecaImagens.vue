<template>    
   
   	<button type="button" v-bind:class="'btn '+ css" data-toggle="modal" v-bind:data-target="'#'+ identifica">
  			{{ textobtn }}
	</button>


</template>

<script>
    
    export default {

    	props:['identifica', 'textobtn', 'css']

    }
    
</script>