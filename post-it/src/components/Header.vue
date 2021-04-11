<template>
  <header>
      <h1>{{title}}</h1>
      <Button 
      @toggle-add-note="$emit
      ('toggle-add-note')"
      :text="showAddNote ? 'Close' : 'Add a postit +'"
      :color="showAddNote ? 'red' : 'black'"
      />
      
      </header>
</template>

<script>
  import Button from './Button'
  
  export default {
    name: "Header",
    props: {
        title: String,
        showAddNote: Boolean
    },

    components: {
      Button
    }
   
  }
</script>

<style scoped>
 *{
        margin:0;
        padding:0;
    }
  header {
      display:flex;
      justify-content: space-between;
      align-items: center;
      
  }
</style>