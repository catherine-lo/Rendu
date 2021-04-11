<template>
    <form @submit="onSubmit" class ="add-form">
        <div class= "form-control">
            <label>Note</label>
            <input type="text" v-model="text" name= "text" placeholder="Add a Note"/>
            </div>
        <div class= "form-control">
            <label>Description</label>
            <input type="text" v-model="description" name= "description" placeholder="Add a description"/>
            </div>

            <input type="submit" value="Save Note" class="btn btn-block" />
        </form>

        </template>


        <script>
  
            export default {
                name: 'AddNote',
                data(){
                    return{
                        text: '',
                        description: ''
                    }
                },

                methods: {
                    onSubmit(e){
                        e.preventDefault()

                        if(!this.text){
                            alert('Please add a note')
                            return
                        }

                        const newNote= {
                            text: this.text,
                            description : this.description
                        }
                        
                        this.$emit('add-note', newNote);

                        this.text = ''
                        this.description = ''

                    }
                }
    
         }
        </script>

        <style scoped>
        .form-control{
            margin: 20px 0;
        }

         .form-control label{
           display:block;
        }

        .form-control input{
          width: 100%;
          height: 40px;
          margin: 5px;
          padding: 3px 7px;
          font-size: 17px;
        }

        </style>