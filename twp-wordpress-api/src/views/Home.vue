<template>
  <div class="home">
  
    <HelloWorld></HelloWorld>
      <!-- <Comment></Comment> -->
     

  </div>
  
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue';
// import Comment from '@/components/Comment.vue';
export default {
  name: 'Home',

  components: {
    HelloWorld,
    
    // Comment
  }
}
</script>
